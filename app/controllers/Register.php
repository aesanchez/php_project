<?php

    class Register extends Controller{

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
            if(!empty($_POST)){
                //se hizo un intento de registro, chequeo los datos
                $errores = $this->checkForErrors();
                //veredicto
                if(empty($errores)){
                    $imagetmp=addslashes (file_get_contents($_FILES['pic']['tmp_name']));
                    $ok = $this->userModel->addUser($_POST['email'], $_POST['name'], $_POST['lastname'], $_POST['password'], $imagetmp);
                    if(!$ok){
                        array_push($errors, "Error al registrar usuario");
                        $params = [
                            'errores' => $errors
                        ];
                    }else{
                        $params = [
                            'ok' => true
                        ];
                    }
                }else{
                    $params = [
                        'errores' => $errores
                    ];
                }
                
            }
            $this->view('register',$params);
        }

        private function checkForErrors(){
            $errores = [];
            //nombre
            if(!isset($_POST['name']) || empty($_POST['name'])){
                array_push($errores, "Nombre no puede ser vacio");
            }else if(!ctype_alpha($_POST['name'])){
                array_push($errores, "Nombre solo puede contener caracteres");
            }
    
            //Apellido
            if(!isset($_POST['lastname']) || empty($_POST['lastname'])){
                array_push($errores, "Apellido no puede ser vacio");
            }else if(!ctype_alpha($_POST['lastname'])){
                array_push($errores, "Apellido solo puede contener caracteres");
            }
    
            //Email
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                array_push($errores, "Formato de email invalido"); 
            }else if($this->userModel->checkEmail($_POST['email'])){
                //chequear que no exista ya en la BBDD                    
                array_push($errores, "Ya hay un usuario registrado con el mismo email ingresado");          
            }
    
            //Clave
            $ok = true;
            if(!isset($_POST['password']) || empty($_POST['password'])){
                array_push($errores, "Contrasenia no puede ser vacia");
                $ok = false;
            }else{
                if(!preg_match('/[a-z]/', $_POST['password'])){
                    array_push($errores, "Contrasenia debe conter al menos una minuscula");
                    $ok = false;
                }            
                if(!preg_match('/[A-Z]/', $_POST['password'])){
                    array_push($errores, "Contrasenia debe conter al menos una mayuscula");
                    $ok = false;
                }
                if(!preg_match('/[0-9.!@#$%^&*()_+=]/', $_POST['password'])){
                    array_push($errores, "Contrasenia debe conter al menos un numero o simbolo !@#$%^&*()_=+");
                    $ok = false;
                }
                if(strlen($_POST['password']) < 6){
                    array_push($errores, "Contrasenia debe conter al 6 caracteres");
                    $ok = false;
                }
            }
    
            //Confirmacion de clave
            if(!isset($_POST['password_confirmation']) || empty($_POST['password_confirmation'])){
                array_push($errores, "Contrasenia no puede ser vacia");
            }else if($ok && (0 != strcmp($_POST['password'],$_POST['password_confirmation']))){
                array_push($errores, "Las contrasenias no coinciden");
            }
    
            //Foto            
            //extensiones permitidas
            $extsAllowed = array( 'jpg', 'jpeg', 'png');
            //extension del archivo subido
            $extUploaded = strtolower( substr( strrchr($_FILES['pic']['name'], '.') ,1) ) ;
            //permitido?
            if (!in_array($extUploaded, $extsAllowed))
                array_push($errores, "Archivo no valido, extensiones permitidas jpeg, jpg, png."); 

            return $errores;
        }

    }
    
?>