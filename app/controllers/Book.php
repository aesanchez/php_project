<?php

    class Book extends Controller{

        public function __construct(){
            $this->bookModel = $this->model('BookModel');
            $this->authorModel = $this->model('AuthorModel');
        }

        public function display($id){
            $aux = $this->bookModel->getBook($id);
            $params = [
                'title' => $aux['titulo'],
                'author' => $this->authorModel->getName($aux['autores_id']),
                'description' => $aux['descripcion'],
                'amount' => $aux['cantidad'],
                'book_id' => $aux['id']
            ];
            $this->view('book',$params);
        }

        public function photo($id){
            $photo = $this->bookModel->getPhoto($id);       
            header("Content-type: jpeg");
            echo $photo;
        }
    }
    
?>