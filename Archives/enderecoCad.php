<?php
session_start();
  if(!isset($_SESSION['id_user']))
  {
    header("location: index.html");
    exit;
  }


require 'classes/usuarios.php';
$u = new Usuario;

      
if (isset($_POST['rua'])) //verificar se clicou no botao, usando como parametro o campo 'rua', esta preenchido ou nao
 {
    $rua = ($_POST['rua']);
    $numero = ($_POST['numero']);
    $bairro = ($_POST['bairro']);
    $cep = ($_POST['cep']);
    $complemento = ($_POST['complement']);
    //verificar se esta preenchido
    if(!empty($rua) && !empty($numero) && !empty($bairro) && !empty($cep) && !empty($complemento)) 
    {
        $u->conectar("pizzaria", "localhost", "root", "");
        if($u->msgErro == "")//se esta tudo ok na conexao
        {
                if($u->cadastrarEnd($rua, $numero, $bairro, $cep, $complemento)) 
                {  
                    echo '<script> alert ("Endereço cadastrado com sucesso!"); location.href=("menuUser.html")</script>';
                }
        }
        else
        {
            echo "Erro: ";$u->msgErro; //erro  de conexao
        }
    }
    else
    {
        echo '<script> alert ("Você precisa preencher todos os campos!"); location.href=("enderecoCad.html")</script>';
    }
 }
?>
