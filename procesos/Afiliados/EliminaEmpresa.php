<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
require_once '../../clases/Afiliados.php';

$obj = new Afiliados();

$id = $_POST['idempresa'];

echo $obj->EliminaEmpresa($id);

?>