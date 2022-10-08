<?php

require 'classes/usuarios.php';
$u = new Usuario;
       
if (isset($_POST['email'])) //verificar se clicou no botao, usando como parametro o campo 'nome', esta preenchido ou nao
 {
   $email = addslashes($_POST['email']);
   $senha = addslashes($_POST['senha']);
   if(!empty($email) || !empty($senha))
   {
       $u->conectar("pizzaria", "localhost", "root", "");
       if($u->msgErro == "")
       {
           if($u->logar($email, $senha))
           {
            header("location: menuUser.html");
            
           }else
           {
            echo '<script> alert ("Email ou senha incorretos!"); location.href=("index.html")</script>';
           }
       }else
       {
        echo "Erro: ".$u->msgErro;
       }
   }else
   {
    echo '<script> alert ("Preencha todos os campos!"); location.href=("index.html")</script>';
   }
 }

?>


