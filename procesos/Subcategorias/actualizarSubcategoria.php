<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
require_once '../../clases/Subcategorias.php';

$obj = new Subcategorias();

//Datos del formulario del Name no del Id
$datos = array(
$_POST['id'],
 $_POST['CatFormModal'],
 $_POST['nombreSubFormModal']
);

echo $obj->ActualizarSubcategoria($datos);