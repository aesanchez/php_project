<?php

    class Login extends Controller{

        public function __construct(){
            $this->userModel = $this->model('UserModel');
        }

        public function index(){
            $params = [];
            //chequeo si se hizo un intento de login
            if(!empty($_POST)){
                if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) ){
                    //validar en la base de datos
                    if($this->userModel->validateUser($_POST['email'], $_POST['password'])){
                        //si esta bien re redirecciona al index
                        header("Location: " . URL_PATH, true, 301);
                        exit();
                    }else{
                        //Email o contrasenia incorrectos
                        $params = [
                            'authentication' => false
                        ];               
                    }
                }
            }
            $this->view('login', $params);
        }
    }

?>