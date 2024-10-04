<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
require_once '../../clases/Categorias.php';

$obj =new Categorias();
/* Aqui van los nombres del formulario */
$datos = array(
    $_POST['id'],
    $_POST['nombreM']
);

echo $obj->ActualizarCategoria($datos);