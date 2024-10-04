<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
mysqli_query($conn,"SET NAMES 'utf8'");

$sql= "SELECT subcategorias.id_subcategoria, categorias.nombre_categoria, subcategorias.nombre_subcategoria
FROM subcategorias
INNER JOIN categorias ON subcategorias.id_categoria = categorias.id_categoria";
$result= $conn->query($sql)
?>
    <table class="table table-bordered" style="text-align: center;">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Categoría</th>
                <th>Subcategoría</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <?php while($ver=mysqli_fetch_row($result)): ?>
            <tr>
                <td><?php echo $ver[0]; ?></td>
                <td><?php echo $ver[1]; ?></td>
                <td><?php echo $ver[2]; ?></td>

                <!-- Botón de editar -->
                 <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#SubcategoriaEditModal" onclick="editarSubcategoria('<?php echo $ver[0]?>')">
                        <i class="fa fa-pencil"></i>
                    </button>
                 </td>

                 <td>
                    <button class="btn btn-danger btn-sm" onclick="EliminarSubcategoria('<?php echo $ver[0] ?>')">
                        <i class="fa fa-trash"></i>
                    </button>
                 </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>