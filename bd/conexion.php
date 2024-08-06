<?php
$servername ="localhost";
$username ="root";
$password="";
$dbname= "bd_tiendaonline";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Error:".$conn->connect_error);
}
