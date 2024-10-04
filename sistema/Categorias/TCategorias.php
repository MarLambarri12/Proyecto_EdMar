<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
mysqli_query($conn,"SET NAMES 'utf8'");

$sql = "SELECT id_categoria, nombre_categoria FROM `categorias`";
$result= $conn->query($sql)
?>

<body>
    <table class="table table-bordered" style="text-align:center;">
        <thead class="table-dark">
        <tr>
        <th>ID</th>
        <th>Nombre de categoría</th>
        <th>Editar</th>
        <th>Eliminar</th>
        </tr>
        </thead>

       <?php while($ver=mysqli_fetch_row($result)): ?>

    <tr>
        <td><?php echo $ver[0]; ?></td>
        <td><?php echo $ver[1]; ?></td>
        <td>
            <!-- Es importante declarar la función en la parte de categorías -->
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#CategoriaEditModal" onclick="editarCategoria('<?php echo $ver[0]?>')">
                <i class="fa fa-pencil"></i>
            </button>
        </td>
        <td>
            <!-- La función de eliminar se encuentra en la parte de categorias -->
            <button class="btn btn-danger btn-sm" onclick="eliminarCategoria('<?php echo $ver[0]?>')">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
