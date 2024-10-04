<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
require_once '../../clases/Afiliados.php';

$obj = new Afiliados();

$idE = $_POST['id'];

echo json_encode($obj->DatosEmpresa($idE));

?>
