<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';

if (isset($_POST['id_categoria'])){
    $id_categoria = $_POST['id_categoria'];

    $sql = "SELECT id_subcategoria, nombre_subcategoria FROM subcategorias WHERE id_categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_categoria);
    $stmt->execute();
    $result = $stmt->get_result();

    $options = '<option value=""> Selecciona la subcategoria</option>';

    while ($subcategoria = $result->fetch_assoc()){
            $options .= '<option value="' . $subcategoria['id_subcategoria'] . '">' . $subcategoria['nombre_subcategoria'] . '</option>';
        
    }
    echo $options;
}