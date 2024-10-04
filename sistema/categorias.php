<?php
include '../dependencias.php';
include '../Vistas/MenuAdmin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categorias</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/alertifyjs/css/alertify.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- <script src="../bootstrap/js/jquery-3.7.1.min.js"></script> -->
  <script src="../bootstrap/alertifyjs/alertify.js"></script>
</head>

<body style="background-color: #C9D1EE;">
  <div class="container-fluid">
    <br>
    <div class="row g-0 text-center">
      <!-- Inicia la primera columna -->
      <div class="col-sm-12 col-md-12">
        <div class="card" style="overflow-x: auto;">
          <div class="card-header d-flex justify-content-start align-items-center" style="background-color:#f1a208">
            <!-- Inicio de la barra de busqueda por usuario -->
            <form class="d-flex mx-auto w-50" id="formCategoria">
              <input type="text" class="form-control me-3" id="nombreIdForm" name="nombreForm"
                placeholder="Ingresar el nombre de la categoría" required>
              <button class="btn btn-outline-light" type="submit" style="background-color: aliceblue; color: black;"
                id="btnAñadirCategoria">
                <i class="bi bi-check-circle-fill" background-color="red"> <strong>Añadir</strong></i>
              </button>
            </form>
          </div>
          <div id="tablaCategoriasLoad" class="card-body table-responsive" style="background-color: withe;">
          </div>
        </div>
      </div>
      <!-- Modal Edit -->
      <div class="modal fade" id="CategoriaEditModal" tabindex="-1" aria-labelledby="CategoriaEditModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="EmpresaModalLabel">Editar Datos</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="formCategoriaEdit" enctype="multipart/form-data">
                <input type="text" id="id" hidden name="id">
                <div class="row mb-3">
                  <div class="col">
                    <label for="nombre" class="form-label">Nombre de la categoria</label>
                    <input type="text" class="form-control" id="nombreIdModal" name="nombreM" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-success" id="btnActualizar"
                    data-bs-dismiss="modal">Actualizar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>

<script type="text/javascript">
  $(document).ready(function () {
    /* Muestra la tabla */
    $('#tablaCategoriasLoad').load("Categorias/TCategorias.php");
    /* Al hacer click en el botón de añadir */
    $('#btnAñadirCategoria').click(function () {
      datos = $('#formCategoria').serialize();
      $.ajax({
        type: "POST",
        data: datos,
        url: "../procesos/categorias/agregarCategorias.php",
        success: function (r) {
          if (r == 1) {
            $('#tablaCategoriasLoad').load("Categorias/TCategorias.php");
            alertify.success("Dato agregado correctamente");
          } else {
            alertify.error("Error");
          }
        }
      });
    });

    //Para hacer accionar el botón de agregar del modal
    $('#btnActualizar').click(function () {
      datos = $('#formCategoriaEdit').serialize();
      $.ajax({
        type: "POST",
        data: datos,
        url: "../procesos/Categorias/actualizarCategoria.php",
        success: function (r) {
          if (r == 1) {
            $('#tablaCategoriasLoad').load("Categorias/TCategorias.php");
            alertify.success("Actualizado Correctamente");
          } else {
            alert(r);
            alertify.error("Error");
          }
        }
      });
    });
  });

  //Visualizar los datos de la tabla en el modal de editar
  function editarCategoria(id) {
    $.ajax({
      type: "POST",
      data: "id=" + id,
      url: "../procesos/Categorias/datosCategoria.php",
      success: function (r) {
        dato = jQuery.parseJSON(r);
        /* en el # van los id del formulario del otro lado cualquier nombre*/
        $('#id').val(dato['id']);
        $('#nombreIdModal').val(dato['nombreCategoria']);
      }
    });
  }

  function eliminarCategoria(id) {
    alertify.confirm('¿Deseas eliminar esta categoria?', function () {
      $.ajax({
        type: "POST",
        //idcategorias es cualquier nombre que se pueda hacer
        data: "idcategorias=" + id,
        url: "../procesos/Categorias/eliminarCategoria.php",
        success: function (r) {
          if (r == 1) {
            $('#tablaCategoriasLoad').load("Categorias/TCategorias.php");
            alertify.success("Categoria eliminada correctamennte");
          } else {
            alert(r);
            alertify.error("Error al eliminar");
          }
        }
      });
    }, function () {
      alertify.error('cancelado')
    });
  }
</script>