<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';

// Verificar si existen los valores de POST
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
$subcategoria = isset($_POST['subcategoria']) ? $_POST['subcategoria'] : '';

// Preparar la consulta SQL
$sql = "SELECT productos.id_productos, 
               categorias.nombre_categoria, 
               subcategorias.nombre_subcategoria,  
               productos.descripcion, 
               productos.precio 
        FROM productos 
        INNER JOIN categorias
        ON productos.id_categoria = categorias.id_categoria
        INNER JOIN subcategorias
        ON productos.id_subcategoria = subcategorias.id_subcategoria
        WHERE 1=1";

if (!empty($categoria)) {
    $sql .= " AND categorias.nombre_categoria LIKE ?";
}
if (!empty($subcategoria)) {
    $sql .= " AND subcategorias.nombre_subcategoria LIKE ?";
}

$stmt = mysqli_prepare($conn, $sql);

// Enlazar los parámetros si hay valores
if (!empty($categoria) && !empty($subcategoria)) {
    $categoria = '%' . $categoria . '%';
    $subcategoria = '%' . $subcategoria . '%';
    mysqli_stmt_bind_param($stmt, "ss", $categoria, $subcategoria);
} elseif (!empty($categoria)) {
    $categoria = '%' . $categoria . '%';
    mysqli_stmt_bind_param($stmt, "s", $categoria);
} elseif (!empty($subcategoria)) {
    $subcategoria = '%' . $subcategoria . '%';
    mysqli_stmt_bind_param($stmt, "s", $subcategoria);
}

// Ejecutar la consulta
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Mostrar los resultados en la tabla
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_productos'] . "</td>";
        echo "<td>" . $row['nombre_categoria'] . "</td>";
        echo "<td>" . $row['nombre_subcategoria'] . "</td>";
        echo "<td>" . $row['descripcion'] . "</td>";
        echo "<td>" . ' $ ' . $row['precio'] . "</td>";
        echo "<td style=background-color:#2A2928;>
        <button class='btn btn-outline-warning btn-sm' data-bs-toggle='modal'
                        data-bs-target='#ProductosEditModal' onclick='editarProducto(" . $row['id_productos'] .")'
                        title='Editar'>
                        <i class='fa fa-pencil'></i>
                    </button>

                    <button class='btn btn-outline-danger btn-sm' onclick='eliminarProducto(" . $row['id_productos'] .")'>
                        <i class='fa fa-trash'></i>
                    </button>

                    <button class='btn btn-outline-warning btn-sm' onclick='visualizarProducto(" . $row['id_productos'] .")'>
                        <i class='bi bi-eye'></i>
                    </button>
                  </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No se encontraron productos</td></tr>";
}

// Cerrar la conexión
mysqli_close($conn);

