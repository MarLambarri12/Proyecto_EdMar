<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
require_once '../../clases/Productos.php';

$obj = new Productos();

$datos =array();
/* Procesando la imagen */
$nombreImg = $_FILES['imagen']['name'];
$rutaAlmacenamiento = $_FILES['imagen']['tmp_name']; 

    //Ruta relativa para guardar la imagen
    $carpeta = '../../archivos/';
    $rutaFinal = $carpeta.$nombreImg;

    $datosImg = array(
        $rutaFinal,
        $nombreImg
    );

   // Mover la imagen al directorio
   if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
    $idimagen = $obj->guardarImagen($datosImg);

    if($idimagen > 0){

            $datos[0] = $_POST['selectForm'];
            $datos[1] = $_POST['selectSubForm'];
            $datos[2] = $idimagen;
            $datos[3] = $_POST['descripcionForm'];
            $datos[4] = $_POST['precioForm'];
            echo $obj->guardarProducto($datos);
    }else{
        echo 0;
    }
}