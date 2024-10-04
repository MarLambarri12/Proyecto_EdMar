<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
require_once '../../clases/Categorias.php';

$obj = new Categorias();

$id = $_POST['id'];

echo json_encode($obj->DatosCategoria($id));