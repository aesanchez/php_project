<?php
    class OperationModel{
        private $db;
        //reservado prestado devuelvo

        public function __construct(){
            $this->db = new DataBase;
        }

        public function getStateTotalByBookID($id){
            //me importa el listado de los estados
            //los devueltos no me deberian importar porque significa que los tengo ya para usar
            $stateTotals = [
                'reservado' => 0,
                'prestado' => 0
            ];
            $result = $this->db->query("SELECT ultimo_estado FROM operaciones WHERE libros_id=$id");
            foreach($result as $row){
                if(strcmp($row['ultimo_estado'], "RESERVADO") == 0){
                    $stateTotals['reservado']++;
                }else if(strcmp($row['ultimo_estado'], "PRESTADO") == 0){
                    $stateTotals['prestado']++;
                }
            }
            return $stateTotals;
        }

        public function getOperationsByUser($id){
            return $this->db->query("SELECT ultimo_estado, fecha_ultima_modificacion, libros_id FROM operaciones WHERE lector_id=$id");
        }

        public function totalActiveOperations($user_id){
            $total = 0;
            $result = $this->db->query("SELECT ultimo_estado FROM operaciones WHERE lector_id=$user_id");
            foreach($result as $row){
                if(strcmp($row['ultimo_estado'], "RESERVADO") == 0 || strcmp($row['ultimo_estado'], "PRESTADO") == 0){
                    $total++;
                }
            }
            return $total;
        }

        public function getListForAdmin(){
            return $this->db->query("
            SELECT l.titulo, a.nombre as a_nombre, a.apellido as a_apellido, u.nombre as u_nombre, u.apellido as u_apellido, o.ultimo_estado, o.fecha_ultima_modificacion 
            FROM operaciones o INNER JOIN libros l ON o.libros_id = l.id 
            INNER JOIN usuarios u ON o.lector_id = u.id
            INNER JOIN autores a ON a.id = l.autores_id");
        }

        public function isAvailable($book_id, $user_id){
            if(count($this->db->query("SELECT * FROM operaciones WHERE lector_id=$user_id AND libros_id=$book_id AND (ultimo_estado='RESERVADO' OR ultimo_estado='PRESTADO')")) == 0)//
                return true;
            return false;
        }

    }
?>