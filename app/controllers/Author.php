<?php

    class Author extends Controller{

        public function __construct(){
            $this->authorModel = $this->model('AuthorModel');
            $this->bookModel = $this->model('BookModel');
            $this->opModel = $this->model('OperationModel');
        }

        public function display($id){
            $books = $this->bookModel->getBooksFromAuthor($id);
            //agregar columnas con numero de prestados y reservados
            foreach ($books as &$row) {
                $aux = $this->opModel->getStateTotalByBookID($row['id']);
                $row['reservados'] = $aux['reservado'];
                $row['prestados'] = $aux['prestado'];    
            }
            $params = [
                'nombre' => $this->authorModel->getName($id),
                'books' => $books
            ];
            $this->view('author',$params);
        }
    }
    
?>