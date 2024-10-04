<?php 

include '../../dependencias.php';
include '../../Vistas/MenuAdmin.php';  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>
<body style="background-color: #D4E8E9;">

<div class="container-fluid">
    <br>
<div class="row g-0 text-center">
    <!-- Inicia la primera columna -->
  <div class="col-sm-12 col-md-12">

  <div class="card" style="overflow-x: auto;">
  <div class="card-header d-flex justify-content-start align-items-center" style="background-color:#f1a208">
                    <form class="d-flex mx-auto w-50" id="searchForm">

                    <input class="form-control me-2" type="search" placeholder="Buscar usuario" id="searchInput" aria-label="Search">

                    <input class="form-control me-3" type="search" placeholder="Buscar solo por nombre de usuario" id="buscarUsuario" aria-label="Search">

                        <button class="btn btn-outline-light" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <button class="btn btn-dark btn-sm ms-3" type="button" data-bs-toggle="modal" data-bs-target="#userModal">
    <i class="bi bi-person-fill-add"></i>&nbsp;<strong>Añadir Usuario</strong>
</button>
</div>


  <div class="card-body" style="background-color: #F5FDC6;">

  <div class="card-body" style="background-color: white;">

  <?php include 'TUsuarios.php' ?>
  </div>
</div>
  </div>
<?php include 'AgregarUsuario.php';?>

  <script>
    $(document).ready(function(){
      function buscarUsuarios(){

        // Obtener el valor de búsqueda
        var buscarUsuario = $('#buscarUsuario').val();

        //Envía la consulta al servidor
        $.ajax({
          url:'buscarUsuario.php',
          type: 'POST',
          data:{ 
            usuario: buscarUsuario
          },
          success:function(response){
            //Actualiza la tabla de usuarios con los resultados
            $('#tabla-body').html(response);
          }
        });
      }

      $('#buscarUsuario').on('keyup', function(){
        buscarUsuarios();
      });
    });
  </script>
</body>
</html>