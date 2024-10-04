<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';

//Obtener a los usuarios
$sql = "SELECT id, CONCAT_WS(' ', nombre, apellido_paterno, apellido_materno) AS nombreApellidos, nombre, apellido_paterno, apellido_materno, usuario, sexo, fecha_nacimiento, email, privilegio FROM usuarios";
// Ejecutar la consulta
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios</title>
  <script src="../../bootstrap/js/jquery-3.7.1.min.js"></script>
  <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../bootstrap/alertifyjs/css/alertify.css">
  <script src="../../bootstrap/alertifyjs/alertify.js"></script>
  <link rel="stylesheet" href="../../codigo/css/modal.css">
</head>

<body>
  <!-- Inicio de la tabla -->
  <table class="table table-bordered table-hover" style="text-align: center;">
    <thead class="table-dark">
      <tr>
        <td>id</td>
        <td>Nombre</td>
        <td>Usuario</td>
        <td>Sexo</td>
        <td>Fecha de nacimiento</td>
        <td>Email</td>
        <td>Privilegio</td>
        <td>Editar</td>
        <td>Eliminar</td>
      </tr>
    </thead>
    <tbody id="tabla-body" >
      <?php
      if ($result->num_rows > 0) {
        $row = [];
        while ($row = $result->fetch_assoc()) {
          //escapar los datos para prevenir XSS
          $id = htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8');
          $nombreApellidos = htmlspecialchars($row["nombreApellidos"], ENT_QUOTES, 'UTF-8');
          $usuario = htmlspecialchars($row["usuario"], ENT_QUOTES, 'UTF-8');
          $sexo = htmlspecialchars($row["sexo"], ENT_QUOTES, 'UTF-8');
          $fecha_nacimiento = htmlspecialchars($row["fecha_nacimiento"], ENT_QUOTES, 'UTF-8');
          $email = htmlspecialchars($row["email"], ENT_QUOTES, 'UTF-8');
          $privilegio = htmlspecialchars($row["privilegio"], ENT_QUOTES, 'UTF-8');
          //Construir la fila de las tablas
          $rows[] = "<tr>
                <td>{$id}</td>
                <td>{$nombreApellidos}</td>
                <td>{$usuario}</td>
                <td>{$sexo}</td>
                <td>{$fecha_nacimiento}</td>
                <td>{$email}</td>
                <td>{$privilegio}</td>
                <td>
            <button class='btn btn-warning btn-sm edit-btn bi bi-pencil-fill'
                    data-bs-toggle='modal'
                    data-bs-target='#editModal'
                    data-idmodal='{$id}'
                    data-nombremodal='{$row['nombre']}'
                    data-apaternomodal='{$row['apellido_paterno']}'
                    data-amaternomodal='{$row['apellido_materno']}'
                    data-usuariomodal='{$usuario}'
                    data-sexomodal='{$sexo}'
                    data-fechamodal='{$fecha_nacimiento}'
                    data-emailmodal='{$email}'
                    data-privilegiomodal='{$privilegio}'>
            </button>
        </td>
        <td>
            <button class='btn btn-danger btn-sm delete-btn  bi bi-backspace-fill' data-id='{$id}'>
                            </button>
        </td>
                </tr>";
        }
        //Mostrar todas las filas
        echo implode("\n", $rows);
      } else {
        echo "<tr><td colspan='6' class='text-center'>No hay clientes registrados</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <!-- Modal de edición -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Editar Usuarios</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form id="formusuariosModal" method="POST" action="guardar_modal.php">
            <input type="hidden" id="usuarioId" name="usuarioId">
            <div class="row mb-3">
              <div class="col">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombreId" name="nombre" placeholder="Nombre" required>
              </div>
              <div class="col">
                <label for="apellidoPaterno" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellidoPaternoId" name="apellidoPaterno"
                  placeholder="Paterno" aria-label="Last name" required>
              </div>
              <div class="col">
                <label for="apellidoMaterno" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellidoMaternoId" name="apellidoMaterno"
                  placeholder="Materno" aria-label="Last name" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuariosId" name="usuario" placeholder="Usuario"
                  aria-label="Usuario" required>
              </div>
              <div class="col">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" id="sexoId" name="sexo" aria-label="Sexo" required>
                  <option value="" disable selected> seleccionar</option>
                  <option value="1">Masculino</option>
                  <option value="2">Femenino</option>
                  <option value="3">Diferente</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fechaNacimientoId" name="fechaNacimiento">
              </div>
              <div class="col">
                  <label for="correoElectronico" class="form-label">Correo Electrónico</label>
                  <input type="email" class="form-control" id="correoElectronicoId" name="correoElectronico"
                    placeholder="Email" aria-describedby="emailHelp">
                </div>
                </div>
              <div class="row mb-3">
              <div class="col">
                <label for="privilegio" class="form-label">Privilegio</label>
                <select class="form-select" id="privilegioId" name="privilegio" aria-label="Sexo" required>
                  <option value="" disable selected> seleccionar</option>
                  <option value="Admin">Admin</option>
                  <option value="Cliente">Cliente</option>
                </select>
              </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<!-- Script para hacer accionarl botón de guardar -->
  <script>
document.querySelector('#formusuariosModal').addEventListener('submit', function(e) {
    e.preventDefault(); // Evita el envío del formulario para hacer validaciones

    var valid = true;
    var emptyFields = [];
    var inputs = document.querySelectorAll('#formusuariosModal input, #formusuariosModal select');

    inputs.forEach(function(input) {
        if (!input.value.trim()) {
            valid = false;
            emptyFields.push(input.getAttribute('id')); // Guarda el id del campo vacío
        }
    });

    if (!valid) { 
        alert('Por favor, completa todos los campos requeridos. Campos vacíos: ' + emptyFields.join(', '));
        return; // Salir si hay campos vacíos
    }

    document.querySelector('#formusuariosModal').submit();
});
</script>
<script>
    //Llenar el modal con los datos del usuario
    $(document).on('click', '.edit-btn', function () {
      //obtener el elemento actual
      const $this = $(this);
      
      //Extraer datos del botón clicado --- el const es un nombre cualquiera que se asigna --- y los del .data son las de las llaves del botón editar
      const idVar = $(this).data('idmodal');
      const nombreVar = $(this).data('nombremodal');
      const apaternoVar = $($this).data('apaternomodal');
      const amaternoVar = $($this).data('amaternomodal');
      const usuarioVar = $(this).data('usuariomodal');
      const sexoVar = $(this).data('sexomodal');
      const fechanacimientoVar = $(this).data('fechamodal');
      const emailVar = $(this).data('emailmodal');
      const privilegioVar = $(this).data('privilegiomodal');
      const contraVar = $(this).data('contramodal');

      //Llenar el modal con los datos del usuario. Lo que se encuentra en # es el nombre que se le puso al id del formulario y lo que está en el .val es el nombre que se le puso a las const para trael los datos del botón
      $('#usuarioId').val(idVar);
      $('#nombreId').val(nombreVar);
      $('#apellidoPaternoId').val(apaternoVar);
      $('#apellidoMaternoId').val(amaternoVar);
      $('#usuariosId').val(usuarioVar);
      let sexoValue;
      if (sexoVar === 'Masculino') {
        sexoValue = '1';
      } else if (sexoVar === 'Femenino') {
        sexoValue = '2';
      } else if (sexoVar === 'Diferente') {
        sexoValue = '3';
      } else {
        sexoValue = ''; // Por si no hay coincidencia
      }
      $('#sexoId').val(sexoValue);
      $('#fechaNacimientoId').val(fechanacimientoVar);
      $('#correoElectronicoId').val(emailVar);

      let privilegioValue;
      if(privilegioVar === 'Cliente'){
        privilegioValue = 'Cliente';
      }else if(privilegioVar==='Admin'){
        privilegioValue = 'Admin';
      }else{
        privilegioValue = '';
      }
      $('#privilegioId').val(privilegioValue);
      $('#passId').val(contraVar);
    });

    //Botón de eliminar
    $(document).on('click', '.delete-btn', function () {
      //obtener el id del usuario
      const id = $(this).data('id');
      const $btn = (this);

      //Confirmación de eliminación
      alertify.confirm('Confirmar eliminación','¿Está seguro que desea eliminar este usuario?',
function(){
        $.ajax({
          url: 'EliminarUsuario.php',
          type: 'POST',
          data: { id: id },
          success: function (response) {
            if(response.trim()==='success'){
              alertify.success('usuario eliminado con éxito.');
              $btn.closest('tr').remove(); //Elimina la fila correspondiente
              location.reload();
            }else{
              alertify.error('Error:'+ response);
            }
          },
          error: function (xhr, status, error){
            alertify.error('Error al eliminar el usuario');
            console.error('Error:', status, error);
          }
        });
      },
    function(){
      alertify.error('Cancelado');
    }
  );
});
  </script>
</body>
</html>