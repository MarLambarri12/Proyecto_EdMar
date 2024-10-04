<?php
header("Content-Type: text/html;charset=utf-8");
class Subcategorias
{ // Incluir la conexión a la base de datos
    public function AgregarSubcategoria($d)
    {
        // Incluir la conexión a la base de datos
        include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';

        // Evitar problemas con caracteres especiales
        mysqli_query($conn, "SET NAMES 'utf8'");

        // Validar que los datos no estén vacíos
        if (!empty($d[0]) && !empty($d[1])) {
            // Consulta SQL corregida
            $sql = "INSERT INTO subcategorias (nombre_subcategoria, id_categoria) VALUES ('$d[0]', '$d[1]')";

            // Ejecutar la consulta y retornar el resultado
            if (mysqli_query($conn, $sql)) {
                return 1;  // Éxito
            } else {
                return "Error: " . mysqli_error($conn);  // Error en la consulta
            }
        } else {
            return "Datos incompletos";  // Error por datos vacíos
        }
    }

    public function DatosSubcategorias($id)
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
        mysqli_query($conn, "SET NAMES 'utf8'");

        $sql = "SELECT * FROM subcategorias WHERE id_subcategoria='$id'";
        $result = mysqli_query($conn, $sql);
        //Aqui se ponen los nombres que se genearon con los campos id en el archivo pricipal en la función de editar
        $row = mysqli_fetch_row($result);
        $datos = array(
            "id" => $row[0],
            "SelectCategoriaModal" => $row[1],
            "nombreSubcategoriaModal" => $row[2]
        );
        return $datos;
    }

   public function ActualizarSubcategoria($d)
{
    include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
    mysqli_query($conn, "SET NAMES 'utf8'");

    // Consulta SQL
    $sql = "UPDATE subcategorias 
            SET id_categoria = ?, nombre_subcategoria = ?
            WHERE id_subcategoria = ?";

    // Prepara la consulta
    if ($stmt = $conn->prepare($sql)) {
        // Vincular parámetros (s para string, i para entero)
        $stmt->bind_param("isi", $d[1], $d[2], $d[0]);

        // Ejecuta la consulta
        $stmt->execute();

        // Retorna el número de filas afectadas
        return $stmt->affected_rows;
    }
}

public function EliminarMiCategoria($d){
    include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
    mysqli_query($conn, "SET NAMES 'utf8'");

    $sql = "DELETE  FROM subcategorias WHERE id_subcategoria = '$d'";
    return mysqli_query($conn,$sql);
}

}
