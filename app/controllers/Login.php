<?php

    class Login extends Controller{

        public function __construct(){
            $session = new Session;
            if($session->is_logged()){
                // no deberia porque poder acceder aca si es que esta logueado
                header("Location: ". URL_PATH,true, 301);
                exit();
            }
            $this->userModel = $this->model('UserModel');
        }

        public function index(){
            $params = [];
            //chequeo si se hizo un intento de login
            if(!empty($_POST)){
                if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) ){
                    //validar en la base de datos
                    try{
                        $user_id = $this->userModel->getUserID($_POST['email'], $_POST['password']);
                        $session = new Session;
                        $session->log_in($user_id);
                        //Se redireccion al index
                        header("Location: " . URL_PATH, true, 301);
                        exit();
                    }catch (Exception $e){
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