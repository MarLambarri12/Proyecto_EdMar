<?php
include '../Vistas/MenuAdmin.php';
include '../dependencias.php';
require_once "../bd/conexion.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../codigo/css/modal.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../bootstrap/alertifyjs/alertify.js"></script>
</head>

<body style="background-color: #C9D1EE;">
    <div class="container-fluid"> <br>
        <div row g-0 text-center>
            <!-- Iniciamos con la columna -->
            <div class="col-sm-12 col-md-12">
                <!-- Iniciamos con la targeta -->
                <div class="card" style="overflow-x: auto;">
                    <div class="card-header d-flex justify-content-between align-items-center"
                        style="background-color: #f1a208;">
                        <h4 class="fst-italic mx-auto">Visualización de Productos</h4>
                        <button class="btn btn-success" style="background-color: aliceblue; color: black;"
                            id="btnAgregarProducto" data-bs-toggle="modal" data-bs-target="#ProductosModal">
                            <i class="bi bi-check-circle-fill"></i> <strong>Agregar Nuevo Producto</strong></button>
                    </div>
                    <div id="tablaProductosLoad" class="card-body table-responsive" style="background-color: white;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar producto -->
    <div class="modal fade" id="ProductosModal" tabindex="-1" aria-labelledby="ProductosModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ProductosModalLabel">Agregar un nuevo producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="FormProductos" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="categoria" class="form-label">Seleccionar catgoría</label>
                                <select class="form-control input-sm" id="selectCategoriaId" name="selectForm">
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $sql = "SELECT id_categoria, nombre_categoria FROM categorias";
                                    $result = mysqli_query($conn, $sql);
                                    while ($categorias = mysqli_fetch_row($result)):
                                        ?>
                                        <option value="<?php echo $categorias[0]; ?>"><?php echo $categorias[1]; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="subcategoria" class="form-label">Selecciona la subcategoria
                                    correspondiente</label>
                                <select class="form-control input-sm" name="selectSubForm" id="selectSubId">
                                    <option value="">Selecciona la subcategoria</option>
                                </select>
                            </div>
                        </div>

                        <div id="FormcorrespondienteId" name="Formcorrespondiente" style="display:none;"></div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcionId" name="descripcionForm"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="text" class="form-control" id="precioId" name="precioForm"
                                    placeholder="$00.00.00" required>
                            </div>
                        </div>

                        <div class="col">
                            <label for="imagen" class="form-label"> Agregar Imagen</label>
                            <input type="file" class="form-control" id="imagen" name="imagen">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success" id="btnGuardar"
                                data-bs-dismiss="modal">Guardar</button>
                        </div>
                    </form>
                </div>
                <div id="tablaProductosLoad" class="card-body table-responsive" style="background-color: white;"></div>
            </div>
        </div>
    </div>

    <!-- Modal para editar producto -->
    <div class="modal fade" id="ProductosEditModal" tabindex="-1" aria-labelledby="ProductosEditModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ProductosModalLabel">Editar producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="FormProductosEdit" enctype="multipart/form-data">
                        <input type="text" id="id" hidden name="id">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="categoria" class="form-label">Seleccionar catgoría</label>
                                <select class="form-control input-sm" id="selectCategoriaIdModal"
                                    name="selectCategoriaM">
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $sql = "SELECT id_categoria, nombre_categoria FROM categorias";
                                    $result = mysqli_query($conn, $sql);
                                    while ($categorias = mysqli_fetch_row($result)):
                                        ?>
                                        <option value="<?php echo $categorias[0]; ?>"><?php echo $categorias[1]; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="subcategoria" class="form-label">Selecciona la subcategoria
                                    correspondiente</label>
                                <select class="form-control input-sm" name="selectSubM" id="selectSubIdModal">
                                    <option value="">Selecciona la subcategoria</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcionIdModal" name="descripcionM"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="text" class="form-control" id="precioIdModal" name="precioM"
                                    placeholder="$00.00.00" required>
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

    <!-- Modal para visualizar el producto -->
    <div class="modal fade" id="ProductosVistaModal" tabindex="-1" aria-labelledby="ProductosVistaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ProductosVistaModalLabel">Vista del producto general</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-start">
                        <div class="col-6">
                            <figure class="figure">
                                <img src="/Proyecto_EdMar/sistema/img/refri.jpeg" class="figure-img img-fluid rounded"
                                    alt="...">
                                <figcaption class="figure-caption">A caption for the above image.</figcaption>
                            </figure>
                        </div>
                        <div class="col-4">
                            <form>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="marca" class="form-label">Marca</label>
                                        <input type="text" class="form-control" id="marcaIdForm" name="marcaForm">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="almacenamiento" class="form-label">Capacidad de
                                            almacenamiento</label>
                                        <input type="text" class="form-control" id="almacenamiendoId"
                                            name="almacenamientoForm">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="RAM" class="form-label">Memoria RAM</label>
                                        <input type="text" class="form-control" id="RAMId" name="RAMForm">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="procesador" class="form-label">Procesador</label>
                                        <input type="text" class="form-control" id="procesadorId" name="procesadorForm">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="pulgadas" class="form-label">Pulgadas de la pantalla</label>
                                        <input type="text" class="form-control" id="pulgadasId" name="pulgadasForm">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="conectividad" class="form-label">Conectividad</label>
                                        <input type="text" class="form-control" id="conectividadId"
                                            name="conectividadName">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="so" class="form-label">Sistema Operativo</label>
                                        <input type="text" class="form-control" id="soId" name="soForm">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btnActualizarVer"
                            data-bs-dismiss="modal">Actualizar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!-- Scrip para formatear el precio del formulario -->
<script>
    const precioInput = document.getElementById('precioId');
    precioInput.addEventListener('input', function () {
        // Eliminar todo excepto números
        let valor = this.value.replace(/[^0-9]/g, '');
        // Si hay un valor, se aplica el formato con separadores de miles
        if (valor) {
            valor = '$' + new Intl.NumberFormat('en-US').format(valor);
        }
        // Asignar el valor formateado al campo de entrada
        this.value = valor;
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        //Visualizar la tabla de productos
        $('#tablaProductosLoad').load("Productos/TProductos.php");
        //Llamamos el id del select para obtener el valor de la categoria seleccionada
        $('#selectCategoriaId').change(function () { //.changue se utiliza para detectar cuando hay un cambio de categoria
            var categoriaId = $(this).val();
            if (categoriaId != '') {
                $.ajax({
                    url: '../procesos/Productos/ObtenerSubcategorias.php',
                    method: 'POST',
                    data: { id_categoria: categoriaId },
                    success: function (response) {
                        $('#selectSubId').html(response); //Actualizar el select de ObtenerSubcategorias
                    }
                });
            } else {
                $('#selectSubId').html('<option value="> selecciona la subcategoria</option>')
            }
        });
        //Mostrar atributos adicionales segun la subcategoria seleccionada
        $('#selectSubId').change(function () {
            var subcategoriaId = $(this).val();
            if (subcategoriaId != '') {
                $.ajax({
                    url: '../procesos/Productos/obtenerFormCorrespondiente.php',
                    method: 'POST', //Metodo de petición ya que se enviaron datos al servidor para procesar
                    data: { id_subcategoria: subcategoriaId }, //Se envía el ID de la subcategoria como un parametro al servidor
                    success: function (response) { //Aqui se define que hacer con la respuesta
                        $('#FormcorrespondienteId').html(response);

                        if (response.trim() == '') {
                            $('#FormcorrespondienteId').hide();
                        } else {
                            $('#FormcorrespondienteId').show();
                        }
                    }
                });
            }
        });

        $('#btnGuardar').click(function () {
            //Es importante quitar el formato del precio de entrada para poder capturarlo en el sistema. 
            //Eliminar el simbolo del dolar y separar el valor númerico
            const precioSinFormato = precioInput.value.replace(/[^0-9.]/g, '');
            //Asignar el valor sin formato al campo de entrada antes de enviarlo
            precioInput.value = precioSinFormato;

            var formData = new FormData(document.getElementById("FormProductos"));
            datos = $('#FormProductos').serialize();
            $.ajax({
                url: "../procesos/Productos/agregarProductos.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                success: function (r) {
                    if (r == 1) {
                        $('#FormProductos')[0].reset();
                        $('#tablaProductosLoad').load("Productos/TProductos.php");
                        alertify.success("Productos agragados correctamente");
                    } else {
                        alert(r);
                        alertify.error("Error");
                    }
                }
            });
        });

        $('#btnActualizar').click(function () {
            datos = $('#FormProductosEdit').serialize();
            $.ajax({
                type: "POST",
                data: datos,
                url: "../procesos/Productos/actualizarProducto.php",
                success: function (r) {
                    if (r == 1) {
                        alert(r);
                        $('#tablaProductosLoad').load("Productos/TProductos.php");
                        alertify.success("Actualizado correctamente");
                    } else {
                        alertify.error("Error");
                    }
                }
            });
        });
    });

    function editarProducto(id) {
        $.ajax({
            type: "POST",
            data: "id=" + id,
            url: "../procesos/Productos/datosProductos.php",
            success: function (r) {
                dato = jQuery.parseJSON(r);
                // En los # son los datos del formulario del otro lado cualquier nombre
                $('#id').val(dato['id']);
                $('#selectCategoriaIdModal').val(dato['idCategoria']);
                $('#selectSubIdModal').val(dato['idSubcategoria']);
                $('#descripcionIdModal').val(dato['descripcion']);
                $('#precioIdModal').val(dato['precio']);

                var categoriaId = dato['idCategoria'];
                if (categoriaId != '') {
                    $.ajax({
                        url: "../procesos/Productos/obtenerSubcategorias.php",
                        method: "POST",
                        data: { id_categoria: categoriaId }, // Se envía el ID de la categoria seleccionada
                        success: function (response) {
                            $('#selectSubIdModal').html(response);
                            $('#selectSubIdModal').val(dato['idSubcategoria']);
                        }
                    });
                }
            }
        });
    }

    function eliminarProducto(id) {
        alertify.confirm('Deseas elimiar este producto?', function () {
            $.ajax({
                type: "POST",
                data: "idproducto=" + id,
                url: "../procesos/Productos/eliminarProductos.php",
                success: function (r) {
                    if (r == 1) {
                        $('#tablaProductosLoad').load("Productos/TProductos.php");
                        alertify.success("Productos Eliminados");
                    } else {
                        alert(r);
                        alertify.error("Error al eliminar");
                    }
                }
            })
        });
    }

    function visualizarProducto(id) {

    }
</script>