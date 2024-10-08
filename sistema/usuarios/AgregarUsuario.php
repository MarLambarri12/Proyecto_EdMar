<?php 
include 'RegistrarUsuariosTabla.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="..\img\Logo1.png">
    <title>EdMar</title>
    <?php include '../../dependencias.php';?>
</head>
<body>

<div class="alert-container">
  <?php
  //Mostrar alertas
  foreach ($alertas as $alerta){
    echo "<div class='alert alert-danger'>$alerta</div>";
  }
  ?>
</div>

<div class="alert-container">
        <!-- Aquí se imprimirán las alertas PHP -->
        <?php if (isset($mensaje_alerta)) echo $mensaje_alerta; ?>
    </div>


<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="background-color: #E8E1EF;">
      <form id="formusuarios" method="POST">
        <input type="hidden" name="tipo" value="registroEnModuloUsuario">
  <div class="row mb-3">
    <div class="col">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
    </div>
    <div class="col">
      <label for="apellidoPaterno" class="form-label">Apellido Paterno</label>
      <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" placeholder="Paterno" aria-label="Last name" required>
    </div>
    <div class="col">
      <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
      <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" placeholder="Materno" aria-label="Last name" required>
    </div>
  </div>
  
  <div class="row mb-3">
    <div class="col">
      <label for="usuario" class="form-label">Usuario</label>
      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" aria-label="Usuario" required>
    </div>
    <div class="col">
      <label for="sexo" class="form-label">Sexo</label>
      <select class="form-select" id="sexo" name="sexo" aria-label="Sexo" required>
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
          <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento">
        </div>

        <div class="col">
      <label for="correoElectronico" class="form-label">Correo Electrónico</label>
      <input type="email" class="form-control" id="correoElectronico" name="correoElectronico" placeholder="Email" aria-describedby="emailHelp">
    </div>

   </div>     
  <div class="row mb-3">
  <div class="col">
      <label for="privilegio" class="form-label">privilegio</label>
      <select class="form-select" id="privilegio" name="privilegio" aria-label="privilegio" required>
        <option value="" disable selected> seleccionar</option>
        <option value="Admin">Administrador</option>
        <option value="Cliente">Clinte</option>
      </select>
    </div>
    <div class="col">
      <label for="pass" class="form-label">Contraseña</label>
      <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
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


<script>
document.querySelector('#formusuarios').addEventListener('submit', function(e) {
    e.preventDefault(); // Evita el envío del formulario para hacer validaciones

    var valid = true;
    var emptyFields = [];
    var inputs = document.querySelectorAll('#formusuarios input, #formusuarios select');

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

    document.querySelector('#formusuarios').submit();
});
</script>
</body>
</html>