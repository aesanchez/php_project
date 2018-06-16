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

    }
?>