<?php
include '../Vistas/MenuAdmin.php';
include '../dependencias.php';
include '../bd/conexion.php'
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subcategorias</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="../bootstrap/js/jquery-3.7.1.min.js"></script> -->
    <script src="../bootstrap/alertifyjs/alertify.js"></script>
    <link rel="stylesheet" href="../codigo/css/modal.css">
</head>

<body style="background-color: #C9D1EE;" >
    <div class="container-fluid">
        <div row g-0 text-center><br>
            <!-- Iniciamos con la columna -->
            <div class="col-sm-12 col-md-12">
                <!-- Iniciamos con la targeta -->
                <div class="card" style="overflow-x: auto;">
                    <div class="card-header d-flex justify-content-between align-items-center"
                        style="background-color: #f1a208;">
                        <form class="d-flex mx-auto w-50" id="formSubcategoria">
                            <select class="form-control me-3" name="catForm" id="catId" required>
                                <option value="">Selecciona una categoria</option>
                                <?php
                                $sql = "SELECT id_categoria, nombre_categoria FROM categorias";
                                $result = mysqli_query($conn, $sql);
                                while ($Micategoria = mysqli_fetch_row($result)):
                                    ?>
                                    <option value="<?php echo $Micategoria[0]; ?>"><?php echo $Micategoria[1]; ?></option>
                                <?php endwhile; ?>
                            </select>

                            <input type="text" class="form-control me-3" id="nombreId" name="nombreForm"
                                placeholder="Ingresar el nombre de la subcategoría" required>
                            <button class="btn btn-outline-light" type="submit" style="background-color: aliceblue; color: black;"
                                id="btnAñadirSubcategoria">
                                <i class="bi bi-check-circle-fill" background-color="red"> <strong>Añadir</strong></i>
                            </button>
                        </form>
                    </div>
                    <div id="tablaProductosLoad" class="card-body table-responsive" style="background-color: white;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para editar las subcategorías -->
        <div class="modal fade" id="SubcategoriaEditModal" tabindex="-1" aria-labelledby="SubcategoriaEditModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="SubcategoriaEditModalLabel">Editar Datos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="FormSubcategoriaEdit" enctype="multipart/form-data">
                            <input type="text" id="id" hidden name="id">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="selectCategoria" class="form-label">Categoría</label>
                                    <select class="form-control me-3" name="CatFormModal" id="catIdModal" required>
                                        <option value="">Selecciona una categoria</option>
                                        <?php
                                        $sql = "SELECT id_categoria, nombre_categoria FROM categorias";
                                        $result = mysqli_query($conn, $sql);
                                        while ($Micategoria = mysqli_fetch_row($result)):
                                            ?>
                                            <option value="<?php echo $Micategoria[0]; ?>"><?php echo $Micategoria[1]; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="nombresub" class="form-label">Subcategoría</label>
                                    <input type="text" class="form-control me-3" id="nombresubIdModal"
                                        name="nombreSubFormModal" placeholder="Ingresar el nombre de la subcategoría"
                                        required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="btnActualizar">Actualizar</button>
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
        $('#tablaProductosLoad').load('Categorias/TSubcategorias.php');

        //Activar el botón añadir subcategoria
        $('#btnAñadirSubcategoria').click(function () {
            datos = $('#formSubcategoria').serialize();
            $.ajax({
                type: "POST",
                data: datos,
                url: "../procesos/Subcategorias/agregarSubcategorias.php",
                success: function (r) {
                    if (r == 1) {
                        $('#tablaProductosLoad').load('Categorias/TSubcategorias.php');
                        alertify.success("Dato agregado Correctamennte");
                    } else {
                        alert(r);
                        alertify.error("Error" + r);
                    }
                }
            });
        });

        //Activar el botón guardar del modal Editar
        $('#btnActualizar').click(function () {
            datos = $('#FormSubcategoriaEdit').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/Subcategorias/actualizarSubcategoria.php",
                    success: function (r) {
                        alert(r);
                        if (r == 1) {
                            $('#tablaProductosLoad').load('Categorias/TSubcategorias.php');
                            alertify.success("Actualizado correctamente");
                        }else{
                            alert(r);
                            alertify.error("Error");
                        }
                    }
                });
        });
    });
    // Visualizar los datos que hay en la tabla en el modal de Editar
    function editarSubcategoria(id) {
        $.ajax({
            type: "POST",
            data: "id=" + id,
            url: "../procesos/Subcategorias/datosSubcategoria.php",
            success: function (r) {
                dato = jQuery.parseJSON(r);
                //En el # van los id del formulario en el .val cualquier nombre
                $('#id').val(dato['id']);
                $('#catIdModal').val(dato['SelectCategoriaModal']);
                $('#nombresubIdModal').val(dato['nombreSubcategoriaModal']);
            }
        });
    }

    function EliminarSubcategoria(id){
        alertify.confirm('Deseas eliminar esta subcategoria?', function(){
            $.ajax({
                type: "POST",
                data: "id=" + id,
                url: "../procesos/Subcategorias/EliminarSubcategoria.php",
                success:function(r){
                    if(r==1){
                        $('#tablaProductosLoad').load('Categorias/TSubcategorias.php');
                        alertify.success("Subcategoria agregada correctamente");
                    }else{
                        alert(r);
                        alertify.error("Error al eliminar");
                    }
                }
            });   
            }
        )};
    

</script>