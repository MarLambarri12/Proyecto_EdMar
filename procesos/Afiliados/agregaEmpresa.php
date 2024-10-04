<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
require_once '../../clases/Afiliados.php';

$obj = new Afiliados();

$datos = array(
    $_POST['nombre'],
    $_POST['rfc'],
    $_POST['loc'],
    $_POST['email'],
    $_POST['tel']
);

echo $obj->AgregarEmpresa($datos);

?>