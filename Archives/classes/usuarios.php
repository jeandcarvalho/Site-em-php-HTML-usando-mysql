<?php

Class Usuario
{
    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        try
        {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } 
        catch (PDOEXCEPTION $e) 
        {
           $msgErro = $e->getMessage();
        }
    }


    public function cadastrar($nome, $telefone, $email, $senha)
    {   
        global $pdo;
        //verificar se já existe o email cadastrado
        $sql = $pdo->prepare("SELECT id_user FROM usuario WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false; //ja esta cadastrado
        }
        else
        {
               //caso nao, cadastrar
            $sql = $pdo->prepare("INSERT INTO usuario (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            return true; 
        }
    }


    public function logar($email, $senha)
    {   
        global $pdo;
        $sql = $pdo->prepare("SELECT id_user FROM usuario WHERE email = :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();
        if($sql->rowCount() > 0)   //entrar no sistema {sessao}
        {   
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_user'] = $dado['id_user'];
            return true;
        }
        else
        {   
            return false; //nao foi possivel logar
        }
    }



    public function cadastrarEnd($rua, $numero, $bairro, $cep, $complemento)
    {   
        global $pdo;
        
            $sql = $pdo->prepare("INSERT INTO endereço (rua, numero, bairro, cep, complement, id_user) VALUES (:r, :n, :b, :cep, :c, :id)");
            $sql->bindValue(":r", $rua);
            $sql->bindValue(":n", $numero);
            $sql->bindValue(":b", $bairro);
            $sql->bindValue(":cep", $cep);
            $sql->bindValue(":c", $complemento);
            $sql->bindValue(":id", $_SESSION['id_user']); //associa o id do usuario (da tabela usuario) com seus endereços cadastrados na tabela endereço
            
            $sql->execute();
            return true;   
    }
}

?>