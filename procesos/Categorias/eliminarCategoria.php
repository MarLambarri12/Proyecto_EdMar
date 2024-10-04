<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
require_once '../../clases/Categorias.php';

$obj = new Categorias();

$id = $_POST['idcategorias'];

echo  $obj->eliminarCategoria($id);