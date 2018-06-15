<?php

    class User extends Controller{

        public function __construct(){
            $this->userModel = $this->model('UserModel');
        }

        public function index(){
            //mostrar al usuario que esta logueado en el momento
            //caso contrario volver al index
            $this->view('user');             
        }

        public function photo($id){
            $photo = $this->userModel->getPhoto($id);       
            header("Content-type: jpeg");
            echo $photo;
        }

        public function logout(){
            $session = new Session;
            $session->log_out();
            header("Location: " . URL_PATH, true, 301);
            exit();
        }
    }
    
?>