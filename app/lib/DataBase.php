<?php

class DataBase{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $db_name = DB_NAME;
    
    private $connection;

    public function __construct(){
        $con = mysqli_connect(
            $this->host,
            $this->user,
            $this->password,
            $this->db_name);
        if (!$con) {
            die("Conexion fallida: " . mysqli_connect_error());
        }
        $this->connection = $con;
    }

    function __destruct() {
        mysqli_close($this->connection);
    }

    public function query($query){
        $result = mysqli_query($this->connection, $query);
        if($result == false)//si no se pudo hacer la consulta
            return NULL;
        //devuelve arreglo de filas
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
    }

    public function queryAdd($query){
        $result = mysqli_query($this->connection, $query);
        return $result;
    }
}

?>