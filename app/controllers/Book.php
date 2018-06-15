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
                'book_id' => $aux['id'],
                'userInfo' => $this->sessionInfo()
            ];
            $this->view('book',$params);
        }

        public function photo($id){
            $photo = $this->bookModel->getPhoto($id);       
            header("Content-type: jpeg");
            echo $photo;
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