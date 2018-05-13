<?php

function connect_db(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mysql";

    $connection = mysqli_connect($servername, $username,$password,$dbname);

    if (!$connection) {
        die("Conexion fallida: " . mysqli_connect_error());
    }
    return $connection;
}

?>