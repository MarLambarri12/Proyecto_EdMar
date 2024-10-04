<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
require_once '../../clases/Afiliados.php';

$obj = new Afiliados();

$datos = array(
    $_POST['id'],
    $_POST['nombreE'],
    $_POST['rfcE'],
    $_POST['locE'],
    $_POST['emailE'],
    $_POST['telE']
);

echo $obj->ActualizarEmpresa($datos);
?>