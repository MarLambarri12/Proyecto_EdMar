<?php 
include '../../bd/conexion.php';

if($_SERVER['REQUEST_METHOD']=='POST'&& isset($_POST['id'])){
    $id = intval($_POST['id']); //Asegurando que el id sea un entero

    //Preparar la consulta para eliminar
    $sql="DELETE FROM usuarios WHERE id =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()){
        echo "success"; // Es importante la palabra éxito por que hace referencia para actualizar la tabla
    
    }else{
        echo "Error al eliminar el usuario" . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}else{
    echo "solicitud no valida";
}