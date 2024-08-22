<?php
//Actualizando el modal
//1.- LLamar la conexión a la base de datos 

include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';

//Verificar si se ha enviado el formulario

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Obtener y sanitizar los datos del formulario

    // Obtener y sanitizar los datos del formulario
    $usuarioId = htmlspecialchars($_POST['usuarioId'], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $apellidoPaterno = htmlspecialchars($_POST['apellidoPaterno'], ENT_QUOTES, 'UTF-8');
    $apellidoMaterno = htmlspecialchars($_POST['apellidoMaterno'], ENT_QUOTES, 'UTF-8');
    $usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
    $sexo = htmlspecialchars($_POST['sexo'], ENT_QUOTES, 'UTF-8');
    $fechaNacimiento = htmlspecialchars($_POST['fechaNacimiento'], ENT_QUOTES, 'UTF-8');
    $correoElectronico = htmlspecialchars($_POST['correoElectronico'], ENT_QUOTES, 'UTF-8');
    $privilegio = htmlspecialchars($_POST['privilegio'], ENT_QUOTES, 'UTF-8');
    //$password = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Encriptar la contraseña


    // Verificar si se ha proporcionado un ID de usuario para la actualización
    if (!empty($usuarioId)) {
        // Comprobar si el ID del usuario existe en la base de datos
        $sql_check = "SELECT id FROM usuarios WHERE id = ?";
        $stmt_check = $conn->prepare($sql_check);
        if ($stmt_check === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }
        $stmt_check->bind_param("i", $usuarioId);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            // Si el ID existe, procede a la actualización
            $sql = "UPDATE usuarios SET nombre=?, apellido_paterno=?, apellido_materno=?, usuario=?, sexo=?, fecha_nacimiento=?, email=?, pass=?, privilegio=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Error en la preparación de la consulta: " . $conn->error);
            }
            $stmt->bind_param("sssssssssi", $nombre, $apellidoPaterno, $apellidoMaterno, $usuario, $sexo, $fechaNacimiento, $correoElectronico, $password, $privilegio, $usuarioId);
            
            if ($stmt->execute()) {
                //echo "Usuario actualizado exitosamente";
                header('Location: usuarios.php');
            } else {
                echo "Error al actualizar el usuario: " . $stmt->error;
            }
            $stmt->close();
        } else {
            // Si el ID no existe, muestra un mensaje de error
            echo "Error: El ID del usuario no existe. No se realizó ninguna actualización.";
        }
        $stmt_check->close();
    } else {
        // No hacer nada si no se proporcionó un ID (evitar inserción de nuevos registros)
        echo "Error: No se proporcionó un ID válido. No se realizó ninguna acción.";
    }
}

$conn->close();
