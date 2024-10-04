<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
include '../../clases/Productos.php';

$obj = new Productos();
//Nombres del formulario
$datos=array(
    $_POST['id'],
    $_POST['selectCategoriaM'],
    $_POST['selectSubM'],
    $_POST['descripcionM'],
    $_POST['precioM']
);
echo $obj->ActualizarProducto($datos);