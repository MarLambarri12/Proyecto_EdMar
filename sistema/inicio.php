<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}

include '../dependencias.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../bootstrap/bootstrap-icons/font/bootstrap-icons.css">
        <link rel="shortcut icon" href="../img/logosinfondo.png">
        <title>Bienvenido</title>
    </head>
    <body style="background-color: #E3F6F3">
        <?php
            include '../Vistas/MenuAdmin.php'
        ?>
    </body>
</html>