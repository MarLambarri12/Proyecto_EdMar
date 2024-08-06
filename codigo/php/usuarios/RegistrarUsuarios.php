<?php
// Iniciar el búfer de salida
ob_start();

include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';

// Función para validar la fecha de nacimiento
function validarFechaNacimiento($fecha_nacimiento) {
    $fecha_nacimiento_obj = DateTime::createFromFormat('Y-m-d', $fecha_nacimiento);
    
    // Verificar que el objeto de fecha es válido y que la fecha formateada coincida con la original y que no sea una fecha futura
    return $fecha_nacimiento_obj &&
           $fecha_nacimiento_obj->format('Y-m-d') === $fecha_nacimiento &&
           $fecha_nacimiento_obj <= new DateTime();
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si el formulario es para registrar
    if (isset($_POST['tipo']) && $_POST['tipo'] === 'registro') {
        // Verificar si los campos no están vacíos
        if (
            !empty(trim($_POST['nombre'])) &&
            !empty(trim($_POST['apellidoPaterno'])) &&
            !empty(trim($_POST['apellidoMaterno'])) &&
            !empty(trim($_POST['usuario'])) &&
            !empty(trim($_POST['sexo'])) &&
            !empty(trim($_POST['fechaNacimiento'])) &&
            !empty(trim($_POST['correoElectronico'])) &&
            !empty(trim($_POST['contraseña']))
        ) {
            // Asignar los valores de los campos a las variables
            $nombre = trim($_POST['nombre']);
            $apellido_paterno = trim($_POST['apellidoPaterno']);
            $apellido_materno = trim($_POST['apellidoMaterno']);
            $usuario = trim($_POST['usuario']);
            $sexo = trim($_POST['sexo']);
            $fecha_nacimiento = trim($_POST['fechaNacimiento']);
            $email = trim($_POST['correoElectronico']);
            $contraseña = trim($_POST['contraseña']);

            //Permitir que el usuario solo tenga menos de 7 caracteres
            if(strlen($usuario) > 7 || !preg_match('/^[a-zA-Z0-9]+$/', $usuario)){
                echo "<div class='alert alert-danger'> El nombre de usuario no debe exeder de almenos 7 caracteres y solo debe contener letras y numeros. </div>";
            }else{

            // Verificar la fecha de nacimiento
            if (!validarFechaNacimiento($fecha_nacimiento)) {
                echo "<div class='alert alert-danger'>Fecha de nacimiento inválida o es una fecha futura. Por favor ingresa una fecha válida.</div>";
            } else {
                // Verificar si el correo ya fue registrado
                $query = "SELECT id FROM usuarios WHERE email = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    echo "<div class='alert alert-danger'>Error: El correo ya se encuentra registrado, por favor intenta con uno diferente.</div>";
                } else {
                    $stmt->close();

                    // Preparar y ejecutar SQL
                    $sql = "INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, usuario, sexo, fecha_nacimiento, email, contraseña) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT); // Hashear la contraseña
                    $stmt->bind_param("ssssssss", $nombre, $apellido_paterno, $apellido_materno, $usuario, $sexo, $fecha_nacimiento, $email, $hashed_password);

                    // Ejecutar la consulta y manejar el resultado
                    if ($stmt->execute()) {
                        $stmt->close();
                        $conn->close();
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Registro incorrecto, por favor intenta nuevamente.</div>";
                    }
                }
            }
        }
        } else {
            echo "<div class='alert alert-danger'>Todos los campos son requeridos.</div>";
        }
    }

    // Si el formulario es para iniciar sesión
    if (isset($_POST['tipo']) && $_POST['tipo'] === 'login') {
        // Verificar si los campos no están vacíos
        if (!empty(trim($_POST['usuariologin'])) && !empty(trim($_POST['floatingPassword']))) {
            $usuario = trim($_POST['usuariologin']);
            $contraseña = trim($_POST['floatingPassword']);

            // Consulta para obtener el usuario
            $query = "SELECT id, contraseña FROM usuarios WHERE usuario = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $stmt->store_result();

            // Verificar si existe el usuario
            if ($stmt->num_rows == 1) {
                // Recupera el ID de la contraseña hasheada
                $stmt->bind_result($id, $hashed_password);
                $stmt->fetch();

                // Verificar la contraseña
                if (password_verify($contraseña, $hashed_password)) {
                    // Iniciar sesión
                    session_start();
                    $_SESSION['usuario_id'] = $id; // Guardar el ID del usuario en la sesión
                    header("Location: Vistas/Menu.php"); // Redirigir a una página protegida
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Contraseña incorrecta, por favor intente nuevamente.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Usuario no encontrado.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Todos los campos son requeridos.</div>";
        }
    }
}

// Finalizar el búfer de salida
ob_end_flush();

//1024967