<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
require_once '../../clases/Subcategorias.php';

$obj = new Subcategorias();

$id = $_POST['id'];

echo $obj->EliminarMiCategoria($id);