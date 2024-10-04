<?php
/* header('Content-Type: application/json');  */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
require_once '../../clases/Productos.php';

$obj = new Productos();

$id = $_POST['id'];

echo json_encode($obj->DatosProductos($id));