<?php 
session_start();
if(!isset($_SESSION['id_user']))
{
  header("location: index.html");
  exit;
}

require 'classes/usuarios.php';
$u = new Usuario;
$u->conectar("pizzaria", "localhost", "root", "");

$consulta = $pdo->prepare("SELECT rua, numero, bairro, cep, complement FROM endereço WHERE id_user = :id");
$consulta->bindValue(":id", $_SESSION['id_user']); //associa o id do usuario (da tabela usuario) com seus endereços cadastrados na tabela endereço
$consulta->setFetchMode(PDO::FETCH_ASSOC);
$consulta->execute();

?>

<html lang="pt-br">
<head> 
    <meta charset="utf-8"/>
    <title>Endereços</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <div id="corpo-form">
    <h1>Endereços Cadastrados</h1>
    
    <table id="table">
        <tr>    
            <td>Rua</td>
            <td>Número</td>
            <td>Bairro</td>
            <td>CEP</td>
            <td>Complemento</td>
        </tr>
        <?php while($dado = $consulta->fetch()){ ?>
        <tr>
            <td><?php echo $dado["rua"]; ?></td>
            <td><?php echo $dado["numero"]; ?></td>
            <td><?php echo $dado["bairro"]; ?></td>
            <td><?php echo $dado["cep"]; ?></td>
            <td><?php echo $dado["complement"]; ?></td>
         
            
        </tr>
        <?php }?>
    </table>

    </div>
    <div id="corpo-form">
 <form method="POST" action="menuUser.html">
        <input type="submit" value="Voltar para menu"> 
    </form> 
 </div>
    
</body>
</html>