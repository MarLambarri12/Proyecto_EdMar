<?php

include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';

//Verificar si existen los valores de POST
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '' ;

//Preparar la consulta SQL
$sql = "SELECT id, CONCAT_WS(' ', nombre, apellido_paterno, apellido_materno) 
AS nombreApellidos, nombre, apellido_paterno, apellido_materno, usuario, sexo, fecha_nacimiento, email, privilegio 
FROM usuarios WHERE 1=1";


if (!empty($usuario)){
    $sql .= " AND usuario LIKE ?";
}

$stmt = mysqli_prepare($conn,$sql);

//Enlazar parametros si hay valores
if (!empty($usuario)){
    $usuario = '%' . $usuario . '%';
    mysqli_stmt_bind_param($stmt, "s", $usuario);
}

//Ejecutar consulta
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nombreApellidos'] . "</td>";
        echo "<td>" . $row['usuario'] . "</td>";
        echo "<td>" . $row['sexo'] . "</td>";
        echo "<td>" . $row['fecha_nacimiento'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['privilegio'] . "</td>";
        echo "<td><button class='btn btn-warning btn-sm edit-btn' 
        data-bs-toggle='modal' 
        data-bs-target='#editModal'
        data-idmodal='{$row['id']}'
        data-nombremodal='{$row['nombre']}'
        data-apaternomodal='{$row['apellido_paterno']}'
        data-amaternomodal='{$row['apellido_materno']}'
        data-usuariomodal='{$row['usuario']}'
        data-sexomodal='{$row['sexo']}'
        data-fechamodal='{$row['fecha_nacimiento']}'
        data-emailmodal='{$row['email']}'
        data-privilegiomodal='{$row['privilegio']}'>
        Editar
      </button></td>";
echo "<td><button class='btn btn-danger btn-sm delete-btn' bi bi-backspace-fill' data-id='{$row['id']}'>
        Eliminar
      </button></td>";
echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No se encontraron Usuarios</td></tr>";
}

//Cerrar conexion 
mysqli_close($conn);