<?php

require_once '../Database/db.php';

session_start();

if(!isset($_SESSION['logado'])){
    header('location:index.php');
};    

$id = $_SESSION['id_usuario'];
$sql  = "SELECT * FROM usuarios WHERE id ='$id'";

$resultado  = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>ola <?php echo $dados['nome']?></h1>
<a href="logout.php">Sair</a>
    
</body>
</html>