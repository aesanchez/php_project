<?php

    class Login extends Controller{

        public function __construct(){
            $this->userModel = $this->model('UserModel');
        }

        public function index(){
            $this->view('login');
        }
    }
    
    
    // //chequeo si se hizo post
    // if(!empty($_POST)){
    //     if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) ){
    //         //Tengo emial y password
    //         require_once("db.php");
    //         //chequear existencia en la db
    //         $conn = connect_db();
    //         $result = mysqli_query($conn, "SELECT email FROM usuarios WHERE email='" . $_POST['email'] . "'");
    //         if(0 == mysqli_num_rows($result))
    //             echo "No existe el email en la base de datos";
    //         else{
    //             //chequear la contrasenia
    //             $result = mysqli_query($conn, "SELECT clave FROM usuarios WHERE email='" . $_POST['email'] . "'");
    //         }
    //         mysqli_close($conn);  
    //     }else{
    //         //error
    //     }
    // }

?>