<?php
header("Content-Type: text/html;charset=utf-8");

class Productos
{
    public function guardarImagen($datos)
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
        mysqli_query($conn, "SET NAMES 'utf8'");

        $fecha = date('Y-m-d');
        $sql = "INSERT INTO imagenes (ruta_imagen,
                                nombre,
                                fecha_subida)
                        VALUES ('$datos[0]',
                                '$datos[1]',
                                '$fecha')";
        $result = mysqli_query($conn, $sql);
        return mysqli_insert_id($conn);
        //
    }

    public function guardarProducto($datos)
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
        mysqli_query($conn, "SET NAMES 'utf8'");

        $sql = "INSERT INTO productos    (id_categoria,
										id_subcategoria,
										id_imagen,
										descripcion,
										precio) 
							values ('$datos[0]',
									'$datos[1]',
									'$datos[2]',
									'$datos[3]',
									'$datos[4]')";
        return mysqli_query($conn, $sql);
    }

    public function DatosProductos($id)
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
        mysqli_query($conn, "SET NAMES 'utf8'");

        $sql = "SELECT productos.id_productos, productos.id_categoria, productos.id_subcategoria, productos.descripcion, productos.precio
        FROM productos 
        INNER JOIN categorias ON categorias.id_categoria = productos.id_categoria
        INNER JOIN subcategorias ON subcategorias.id_subcategoria = productos.id_subcategoria
        WHERE productos.id_productos = $id";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo json_encode(array("error" => "Error en la consulta:" . mysqli_error($conn)));
            return;
        }

        $row = mysqli_fetch_array($result);
        if ($row) {
            $datos = array(
                "id" => $row[0],
                "idCategoria" => $row[1],
                "idSubcategoria" => $row[2],
                "descripcion" => $row[3],
                "precio" => $row[4]
            );
            return $datos;
        } else {
            echo json_encode(array("error" => "No se encuentran datos"));
            return;
        }
    }

    public function eliminarProducto($d)
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
        mysqli_query($conn, "SET NAMES 'utf8'");

        $sql = "DELETE FROM productos WHERE id_productos='$d'";
        return mysqli_query($conn, $sql);
    }
    public function ActualizarProducto($d)
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
        mysqli_query($conn, "SET NAMES 'utf8'");

        $sql = "UPDATE productos SET id_categoria = '$d[1]', id_subcategoria = '$d[2]', descripcion = '$d[3]', precio = '$d[4]' WHERE id_productos ='$d[0]'";
        return mysqli_query($conn, $sql);
    }

}