<?php
    class BookModel{
        private $db;

        public function __construct(){
            $this->db = new DataBase;
        }

        public function getBooksFiltered($authorFilter, $titleFilter, $orderRule, $limit, $page){
            //query base
            $query = "SELECT l.id, l.titulo, l.autores_id, l.cantidad FROM libros l";
            //filtros
            if(!is_null($titleFilter)){
                $query = $query . " INNER JOIN autores a ON l.autores_id = a.id AND l.titulo LIKE '%" . $titleFilter . "%'";
                if(!is_null($authorFilter)){
                    $query = $query . " AND (a.nombre LIKE '%" . $authorFilter . "%' OR a.apellido LIKE '%" . $authorFilter . "%')";
                }
            }else if(!is_null($authorFilter)){
                    $query = $query . " INNER JOIN autores a ON l.autores_id = a.id AND (a.nombre LIKE '%" . $authorFilter . "%' OR a.apellido LIKE '%" . $authorFilter . "%')";
            }
            //criterio de orden
            //TODO
            //Limite
            $query = $query . " LIMIT $limit";
            //mostrar dependiendo que pagina es
            if(!is_null($page) && is_numeric($page)){
                $query = $query . " OFFSET " . ($page - 1) * $limit;
            }
            return $this->db->query($query);  
        }

        public function getTotal($authorFilter, $titleFilter){
            //query base
            $query = "SELECT l.id, l.titulo, l.autores_id, l.cantidad FROM libros l";
            //filtros
            if(!is_null($titleFilter)){
                $query = $query . " INNER JOIN autores a ON l.autores_id = a.id AND l.titulo LIKE '%" . $titleFilter . "%'";
                if(!is_null($authorFilter)){
                    $query = $query . " AND (a.nombre LIKE '%" . $authorFilter . "%' OR a.apellido LIKE '%" . $authorFilter . "%')";
                }
            }else if(!is_null($authorFilter)){
                    $query = $query . " INNER JOIN autores a ON l.autores_id = a.id AND (a.nombre LIKE '%" . $authorFilter . "%' OR a.apellido LIKE '%" . $authorFilter . "%')";
            }

            return count($this->db->query($query));
        }

        public function getBooksFromAuthor($authorID){
            return $this->db->query("SELECT id, titulo, cantidad FROM libros WHERE autores_id=$authorID");
        }

        public function getBook($id){
            return ($this->db->query("SELECT * FROM libros WHERE id=$id"))[0];
        }

        public function getPhoto($id){
            $result = $this->db->query("SELECT portada FROM libros WHERE id=$id");
            if(empty($result))
                return NULL;
            $row = $result[0];
            return $row['portada'];
        }
    }
?>