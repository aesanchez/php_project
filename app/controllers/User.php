<?php

    class User extends Controller{

        public function __construct(){
            $this->session = new Session;
            if(!$this->session->is_logged()){
                // no deberia porque poder acceder aca si es que no se esta logueado
                header("Location: ". URL_PATH,true, 301);
                exit();
            }
            $this->userModel = $this->model('UserModel');
            $this->opModel = $this->model('OperationModel');
            $this->bookModel = $this->model('BookModel');
            $this->authorModel = $this->model('AuthorModel');
        }

        public function index(){
            //mostrar al usuario que esta logueado en el momento
            $id = $this->session->getID();
            $user = $this->userModel->getUser($id);

            //operaciones
            $ops = $this->opModel->getOperationsByUser($id);
            foreach ($ops as &$row) {
                //agregar titulo y autor
                $book = $this->bookModel->getBook($row['libros_id']);
                $row['author_id'] = $book['autores_id'];
                $row['author_name'] = $this->authorModel->getName($book['autores_id']);
                $row['title'] = $book['titulo'];
            }
            $params = [
                'id' => $id,
                'name' => $user['nombre'],
                'lastname' => $user['apellido'],
                'email' => $user['email'],
                'table' => $ops
            ];
            $this->view('user', $params);             
        }

        public function photo($id){
            $photo = $this->userModel->getPhoto($id);       
            header("Content-type: jpeg");
            echo $photo;
        }

        public function reservar(){
            $this->opModel->newReservation($this->session->getID(), $_POST['book_id']);
            header("Location: " . URL_PATH, true, 301);
            exit();
        }

        public function logout(){
            $this->session->log_out();
            header("Location: " . URL_PATH, true, 301);
            exit();
        }
    }
    
?>