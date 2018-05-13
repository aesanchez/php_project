<?php
    require_once("db.php");

    class Libro
    {
        private $book;

        function __construct($id){
            $conn = connect_db();
            $result = mysqli_query($conn, "SELECT * FROM libros WHERE id=$id");
            $this->book = mysqli_fetch_array($result);   
            mysqli_close($conn);
        }

        public function getTitle() {

            return $this->book['titulo'];
        }

        public function getAuthor() {
            $conn = connect_db();
            $id = $this->book['autores_id'];
            $result = mysqli_query($conn, "SELECT * FROM autores WHERE id=$id");
            $author_row = mysqli_fetch_array($result);
            mysqli_close($conn);
            return $author_row["nombre"] . " " . $author_row["apellido"];
        }

        public function getDescription() {
            return $this->book['descripcion'];
        }

        public function getAmount() {
            return $this->book['cantidad'];
        }
    }

    $book = new Libro($_GET['id']);

    function getTitle(){
        global $book;
        echo $book->getTitle();
    }

    function getAuthor(){
        global $book;
        echo $book->getAuthor();
    }

    function getAmount(){
        global $book;
        echo $book->getAmount();
    }

    function getDescription(){
        global $book;
        echo $book->getDescription();
    }
?>