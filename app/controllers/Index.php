<?php

    class Index extends Controller{
        protected $pageAmount = 5; //por default

        public function __construct(){
            $this->bookModel = $this->model('BookModel');
            $this->authorModel = $this->model('AuthorModel');
            $this->opModel = $this->model('OperationModel');
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

            //agregar columnas con numero de prestados y reservados
            foreach ($books as &$row) {
                $aux = $this->opModel->getStateTotalByBookID($row['id']);
                $row['reservados'] = $aux['reservado'];
                $row['prestados'] = $aux['prestado'];    
            }
            //pages total
            $pageTotal = ceil($this->bookModel->getTotal($authorFilter, $titleFilter, $this->pageAmount) / $this->pageAmount); 

            //paramentros para la vista
            $params = [
                'books' => $books,
                'author_filter' => $authorFilter,
                'title_filter' => $titleFilter,
                'current_page' => $page_number,
                'pages' => $pageTotal,
                'userInfo' => $this->sessionInfo()
            ];
            $this->view('index',$params);
        }

        private function sessionInfo(){
            $userInfo = [
                'logged' => false,
                'id' => "",
                'name' => ""
            ];

            $session = new Session;
            if($session->is_logged()){
                $userInfo['logged'] = true;
                $userInfo['id'] = $session->getID();
                $userModel = $this->model('UserModel');
                $userInfo['name'] = $userModel->getName($session->getID());
            }

            return $userInfo;
        }

    }
?>