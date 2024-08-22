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

//Inicializar la varible alertas
$alertas =[];

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si el formulario es para registrar
    if (isset($_POST['tipo']) && $_POST['tipo'] === 'registroEnModuloUsuario') {
        // Verificar si los campos no están vacíos
        if (
            !empty(trim($_POST['nombre'])) &&
            !empty(trim($_POST['apellidoPaterno'])) &&
            !empty(trim($_POST['apellidoMaterno'])) &&
            !empty(trim($_POST['usuario'])) &&
            !empty(trim($_POST['sexo'])) &&
            !empty(trim($_POST['fechaNacimiento'])) &&
            !empty(trim($_POST['correoElectronico'])) &&
            //!empty(trim($_POST['privilegio'])) &&
            !empty(trim($_POST['pass']))
        ) {
            // Asignar los valores de los campos a las variables
            $nombre = trim($_POST['nombre']);
            $apellido_paterno = trim($_POST['apellidoPaterno']);
            $apellido_materno = trim($_POST['apellidoMaterno']);
            $usuario = trim($_POST['usuario']);
            $sexo = trim($_POST['sexo']);
            $fecha_nacimiento = trim($_POST['fechaNacimiento']);
            $email = trim($_POST['correoElectronico']);
            //$privilegio = trim($_POST['privilegio']);
            $pass = trim($_POST['pass']);
            $priv ="Cliente";


            // Validar la longitud de la contraseña
            if(strlen($pass) < 8 || !preg_match('/^[a-zA-Z0-9]+$/', $pass)){
                $alertas[] ="La contraseña debe tener mínimo 8 caracteres y solo letras y números.";
            } else {
                // Validar la longitud y formato del nombre de usuario
                if(strlen($usuario) > 13 || !preg_match('/^[a-zA-Z0-9]+$/', $usuario)){
                    $alertas[]="El nombre de usuario no debe exceder de 13 caracteres y solo debe contener letras y números.";
                } else {
                    // Verificar la fecha de nacimiento
                    if (!validarFechaNacimiento($fecha_nacimiento)) {
                        $alertas[]="Fecha de nacimiento inválida o es una fecha futura. Por favor ingresa una fecha válida.";
                    } else {
                        // Verificar si el correo ya fue registrado
                        $query = "SELECT id FROM usuarios WHERE email = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $stmt->store_result();

                        if ($stmt->num_rows > 0) {
                            $alertas[]="El correo ya se encuentra registrado, por favor intenta con uno diferente.";
                        } else {
                            $stmt->close();

                            // Preparar y ejecutar SQL para insertar usuario
                            $sql = "INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, usuario, sexo, fecha_nacimiento, email, pass, privilegio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                            $stmt = $conn->prepare($sql);
                            $hashed_password = password_hash($pass, PASSWORD_DEFAULT); // Hashear la contraseña
                            $stmt->bind_param("sssssssss", $nombre, $apellido_paterno, $apellido_materno, $usuario, $sexo, $fecha_nacimiento, $email, $hashed_password, $privilegio);

                            // Ejecutar la consulta y manejar el resultado
                            if ($stmt->execute()) {
                                $stmt->close();
                                $conn->close();
                               // header("Location: usuarios.php");
                                exit();
                            } else {
                                $alertas[]="Registro incorrecto, por favor intenta nuevamente.";
                            }
                        }
                    }
                }
            }
        } else {
            $alertas[]="Todos los campos son requeridos.";
        }
    }
}
    // Finalizar el búfer de salida
ob_end_flush();
