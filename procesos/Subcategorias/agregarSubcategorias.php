<?php
include $_SERVER ['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
require_once '../../clases/Subcategorias.php';

$obj = new Subcategorias();

$datos =array(
$_POST['nombreForm'],
$_POST['catForm']
);

echo $obj->AgregarSubcategoria($datos);