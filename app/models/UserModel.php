<?php
    class UserModel{
        private $db;

        public function __construct(){
            $this->db = new DataBase;
        }
        
        public function getUser($id){
            return ($this->db->query("SELECT nombre, apellido, email FROM usuarios WHERE id=$id"))[0];
        }

        public function getID($email){
            return ($this->db->query("SELECT id FROM usuarios WHERE email='$email'"))[0]['id'];
        }

        public function checkEmail($email){
            if(count($this->db->query("SELECT * FROM usuarios WHERE email='$email'"))==0)
                return false;
            return true;
        }

        public function getName($id){
            $result = $this->db->query("SELECT nombre, apellido FROM usuarios WHERE id=$id");
            $row = $result[0];
            return $row['nombre'] . " " . $row['apellido'];
        }

        public function isAdmin($user_id){
            if(strcmp(($this->db->query("SELECT rol FROM usuarios WHERE id=$user_id"))[0]['rol'], "BIBLIOTECARIO") == 0)
                return true;
            return false;
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
            if(empty($result))
                return NULL;
            $row = $result[0];
            return $row['foto'];
        }

        public function validateUser($email, $password){
            if(!empty($this->db->query("SELECT nombre FROM usuarios WHERE email='$email' AND clave='$password'")))
                return;
            throw new Exception("Email o contrasenia incorrectos");
        }

    }
?>