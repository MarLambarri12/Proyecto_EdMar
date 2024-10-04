<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
include '../../clases/Productos.php';

$obj = new Productos();

$id = $_POST['idproducto'];

echo $obj->eliminarProducto($id);