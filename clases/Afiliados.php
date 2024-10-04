<?php
header("Content-Type: text/html;charset=utf-8"); 

class Afiliados{
    public function EliminaEmpresa($d){
        include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
        mysqli_query($conn,"SET NAMES 'utf8'");

        $sql = "DELETE FROM empresas_afi WHERE id_empresa ='$d'";

        return mysqli_query($conn,$sql);
    }

    public function AgregarEmpresa($d){
        include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
        mysqli_query($conn,"SET NAMES 'utf8'");

        $sql = "INSERT INTO empresas_afi (nombre_empresa, RFC, Localizacion, Email, Telefono) 
                VALUES ('$d[0]','$d[1]','$d[2]','$d[3]','$d[4]');";

        return mysqli_query($conn,$sql);
    }

    public function DatosEmpresa($id){
        include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
        mysqli_query($conn,"SET NAMES 'utf8'");

        $sql = "SELECT * FROM empresas_afi WHERE id_empresa = '$id'";
        
        $result = mysqli_query($conn,$sql);

        $row = mysqli_fetch_array($result);

        $datos = array(
            "id" => $row[0],
            "nombreEmpresa"=> $row[1],
            "RFC" => $row[2],
            "Loc" => $row[3],
            "Email" => $row[4],
            "Telefono" => $row[5]
        );

        return $datos;
    }

    public function ActualizarEmpresa($d){
        include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
        mysqli_query($conn,"SET NAMES 'utf8'");

        $sql = "UPDATE empresas_afi SET 
                nombre_empresa = '$d[1]', 
                RFC = '$d[2]', 
                Localizacion = '$d[3]', 
                Email = '$d[4]', 
                Telefono = '$d[5]' 
                WHERE id_empresa = '$d[0]'";

        return mysqli_query($conn,$sql);      
    }
}
?>