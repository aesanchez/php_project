<?php
    class AuthorModel{
        private $db;

        public function __construct(){
            $this->db = new DataBase;
        }

        public function getName($id){
            $result = $this->db->query("SELECT nombre, apellido FROM autores WHERE id=$id");
            $row = $result[0];
            return $row['nombre'] . " " . $row['apellido'];
        }
        
        public function getAuthor($id){
            return ($this->db->query("SELECT * FROM autores WHERE id=$id"))[0];
        }

    }
?>