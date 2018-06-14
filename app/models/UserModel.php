<?php
    class UserModel{
        private $db;

        public function __construct(){
            $this->db = new DataBase;
        }
        
        public function getUser($id){
            return ($this->db->query("SELECT * FROM usuarios WHERE id=$id"))[0];
        }

        public function checkEmail($email){
            if(count($this->db->query("SELECT * FROM usuarios WHERE email='$email'"))==0)
                return false;
            return true;
        }

        public function addUser($email, $name, $lastname, $password, $img){
            $query = "INSERT INTO usuarios (id, email, nombre, apellido, clave, rol, foto) VALUES 
            (NULL, 
            '" . $email . "', 
            '" . $name . "', 
            '" . $lastname . "', 
            '" . $password . "', 
            'LECTOR', 
            '$img')";      
            return $this->db->queryAdd($query);
        }

        public function getPhoto($id){
            $result = $this->db->query("SELECT foto FROM usuarios WHERE id=$id");
            $row = $result[0]   ;
            return $row['foto'];
        }

    }
?>