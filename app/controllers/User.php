<?php

    class User extends Controller{

        public function __construct(){
            $this->userModel = $this->model('UserModel');
        }

        public function display($id){
            //
        }

        public function photo($id){
            $photo = $this->userModel->getPhoto($id);       
            header("Content-type: jpeg");
            echo $photo;
        }
    }
    
?>