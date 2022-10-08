<?php
require 'classes/usuarios.php';
$u = new Usuario;
        
if (isset($_POST['nome'])) //verificar se clicou no botao, usando como parametro o campo 'nome', esta preenchido ou nao
 {
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confirmarSenha = addslashes($_POST['confsenha']);
    //verificar se esta preenchido
    if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($nome) && !empty($confirmarSenha)) 
    {
        $u->conectar("pizzaria", "localhost", "root", "");
        if($u->msgErro == "")//se esta tudo ok na conexao
        {
            if($senha == $confirmarSenha)
            {
                if($u->cadastrar($nome, $telefone, $email, $senha)) //passando parametros para a função cadastrar do usuarios.php dentro de uma condicional
                {  
                    echo '<script> alert ("Cadastro realizado com sucesso!"); location.href=("index.html")</script>';
                }
                else
                {
                    echo '<script> alert ("Email já cadastrado!"); location.href=("cadastrar.html")</script>';
                }
            }
            else
            {
                echo '<script> alert ("Senha e confirmar senha não correspondem!"); location.href=("cadastrar.html")</script>';
            }
        }
        else
        {
            echo "Erro: ";$u->msgErro; //erro  de conexao
        }
    }
    else
    {
        echo '<script> alert ("Você precisa preencher todos os campos!"); location.href=("cadastrar.html")</script>';
    }
}
?>
