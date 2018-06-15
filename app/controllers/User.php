<?php

    class User extends Controller{

        public function __construct(){
            $this->session = new Session;
            if(!$this->session->is_logged()){
                // no deberia porque poder acceder aca si es que esta logueado
                header("Location: ". URL_PATH,true, 301);
                exit();
            }
            $this->userModel = $this->model('UserModel');
        }

        public function index(){
            //mostrar al usuario que esta logueado en el momento
            $id = $this->session->getID();
            $user = $this->userModel->getUser($id);
            $params = [
                'id' => $id,
                'name' => $user['nombre'],
                'lastname' => $user['apellido'],
                'email' => $user['email']
            ];
            $this->view('user', $params);             
        }

        public function photo($id){
            $photo = $this->userModel->getPhoto($id);       
            header("Content-type: jpeg");
            echo $photo;
        }

        public function logout(){
            $this->session->log_out();
            header("Location: " . URL_PATH, true, 301);
            exit();
        }
    }
    
?>