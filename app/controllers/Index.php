<?php

    class Index extends Controller{
        protected $pageAmount = 5; //por default

        public function __construct(){
            $this->bookModel = $this->model('BookModel');
            $this->authorModel = $this->model('AuthorModel');
        }

        public function index(){
            //check filters
            $authorFilter = NULL;
            $titleFilter = NULL;
            if(isset($_POST['author']) && !empty($_POST['author'])){
                $authorFilter = $_POST['author'];
            }
            if(isset($_POST['title']) && !empty($_POST['title'])){
                $titleFilter = $_POST['title'];
            }

            //check page
            $page_number = 1;
            if(isset($_GET["page"]) && !empty($_GET["page"]) && is_numeric($_GET["page"])){
                $page_number = $_GET["page"];
            }

            //check oreder rule
            $order = NULL; //TODO: el criterio

            //get books
            $books = $this->bookModel->getBooksFiltered($authorFilter, $titleFilter, $order, $this->pageAmount, $page_number);

            //agregar una columna con el nombre y apellido del autor
            foreach ($books as &$row) {
                $row['nombre_autor'] = $this->authorModel->getName($row['autores_id']);                
            }
            //pages total
            $pageTotal = intdiv($this->bookModel->getTotal($authorFilter, $titleFilter, $this->pageAmount),$this->pageAmount) + 1; 

            //paramentros para la vista
            $params = [
                'books' => $books,
                'author_filter' => $authorFilter,
                'title_filter' => $titleFilter,
                'current_page' => $page_number,
                'pages' => $pageTotal
            ];
            $this->view('index',$params);
        }

    }
?>