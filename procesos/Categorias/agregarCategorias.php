<?php 
include $_SERVER['DOCUMENT_ROOT'] . 'Proyecto_EdMar/bd/conexion.php';
require_once '../../clases/Categorias.php';

$obj = new Categorias();
/* Aqui son los datos del formulario*/
$datos = array(
    $_POST['nombreForm']
);

echo $obj->AgregarCategoria($datos);