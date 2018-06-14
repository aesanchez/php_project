<?php

    class Author extends Controller{

        public function __construct(){
            $this->authorModel = $this->model('AuthorModel');
            $this->bookModel = $this->model('BookModel');
        }

        public function display($id){
            $params = [
                'nombre' => $this->authorModel->getName($id),
                'books' => $this->bookModel->getBooksFromAuthor($id)
            ];
            $this->view('author',$params);
        }
    }
    
?>