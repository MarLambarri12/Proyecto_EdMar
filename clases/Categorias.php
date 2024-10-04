<?php
header("Content-Type: text/html;charset=utf-8"); 
class Categorias{
public function AgregarCategoria($d){
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
mysqli_query($conn,"SET NAMES 'utf8'");

    $sql = "INSERT INTO categorias (nombre_categoria) VALUES ('$d[0]');";
    return mysqli_query($conn,$sql);
}

public function DatosCategoria($id){
    include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
    mysqli_query($conn, "SET NAMES 'utf8'");

    $sql ="SELECT * FROM categorias WHERE id_categoria='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $datos = array(
        "id" => $row[0],
        "nombreCategoria"=> $row[1]
    );
    return $datos;
}
public function ActualizarCategoria($d){
    include $_SERVER['DOCUMENT_ROOT']. '/Proyecto_EdMar/bd/conexion.php';
    mysqli_query($conn,"SET NAMES 'utf8'");
    
    $sql = "UPDATE categorias SET nombre_categoria = '$d[1]' WHERE id_categoria = '$d[0]'";
    return mysqli_query($conn,$sql);
}

public function eliminarCategoria($d){
    include $_SERVER['DOCUMENT_ROOT']. '/Proyecto_EdMar/bd/conexion.php';
    mysqli_query($conn,"SET NAMES 'utf8'");

    $sql= "DELETE from categorias WHERE id_categoria='$d'";
    return mysqli_query($conn, $sql);
}

}
