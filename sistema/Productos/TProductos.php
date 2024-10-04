<?php
require $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
mysqli_query($conn, "SET NAMES 'utf8'");

$sql = "SELECT productos.id_productos, 
               categorias.nombre_categoria, 
               subcategorias.nombre_subcategoria,  
               productos.descripcion, 
               productos.precio 
        FROM productos 
        INNER JOIN categorias
        ON productos.id_categoria = categorias.id_categoria
        INNER JOIN subcategorias
        ON productos.id_subcategoria = subcategorias.id_subcategoria";
$result = $conn->query($sql);
?>

<body>
    <script src="../bootstrap/js/jquery-3.7.1.min.js"></script>
    <table id="tablaProductos" class="table table-bordered table-hover" style="text-align:center;">
        <thead class="table-dark">
            <tr>
                <th class="text-center align-middle">ID</th>
                <th class="text-center align-middle"><input type="text" id="buscarCategoria" class="form-control"
                        placeholder="Buscar Categoría"></th>
                <th><input type="text" id="buscarSubcategoria" class="form-control" placeholder="Buscar Subcategoría">
                </th>
                <th class="text-center align-middle">Descripción</th>
                <th class="text-center align-middle">Precio</th>
                <th class="text-center align-middle">Acciones</th>
            </tr>
        </thead>
        <?php while ($ver = mysqli_fetch_row($result)): ?>
            <tr>
                <td><?php echo $ver[0] ?></td>
                <td><?php echo $ver[1] ?></td>
                <td><?php echo $ver[2]; ?></td>
                <td><?php echo $ver[3]; ?></td>
                <td><?php echo ' $ ' . $ver[4]; ?></td>
                <td style="background-color:#2A2928;">
                    <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                        data-bs-target="#ProductosEditModal" onclick="editarProducto('<?php echo $ver[0] ?>')"
                        title="Editar">
                        <i class="fa fa-pencil"></i>
                    </button>

                    <button class="btn btn-outline-danger btn-sm" onclick="eliminarProducto('<?php echo $ver[0] ?>')">
                        <i class="fa fa-trash"></i>
                    </button>

                    <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ProductosVistaModal" onclick="visualizarProducto('<?php echo $ver[0] ?>')">
                        <i class="bi bi-eye"></i>
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

<script>
    $(document).ready(function () {
        function buscarProductos() {
            var buscarCategoria = $('#buscarCategoria').val();
            var buscarSubcategoria = $('#buscarSubcategoria').val();

            //Realizar una solicitud Ajax
            $.ajax({
                url: '../procesos/Productos/buscarProductos.php',
                type: 'POST',
                data: {
                    categoria: buscarCategoria,
                    subcategoria: buscarSubcategoria
                },
                success: function (response) {
                    $('#tablaProductos tbody').html(response);
                }
            });
        }

        //Detectar cambios en los campos de busqueda y ejecutar la función de busqueda.
        $('#buscarCategoria, #buscarSubcategoria').on('keyup', function () {
            buscarProductos();
        });
    });
</script>