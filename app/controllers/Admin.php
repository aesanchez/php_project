<?php

    class Admin extends Controller{

        public function __construct(){
            $this->session = new Session;
            $this->userModel = $this->model('UserModel');
            if(!$this->session->is_logged() || !$this->userModel->isAdmin($this->session->getID())){
                // no deberia porque poder acceder aca si es que no se es admin
                header("Location: ". URL_PATH,true, 301);
                exit();
            }
            $this->opModel = $this->model('OperationModel');
        }

        public function index(){

            $params = [
                'userInfo' => $this->sessionInfo(),
                'list' => $this->opModel->getListForAdmin()
            ];

            $this->view('admin', $params);             
        }

        private function sessionInfo(){
            $userInfo = [
                'logged' => false,
                'id' => "",
                'name' => ""
            ];

            $session = $this->session;
            if($session->is_logged()){
                $userInfo['logged'] = true;
                $userInfo['id'] = $session->getID();
                $userModel = $this->model('UserModel');
                $userInfo['name'] = $userModel->getName($session->getID());
                $userInfo['admin'] = $userModel->isAdmin($session->getID());
            }

            return $userInfo;
        }

        public function prestar(){
            $this->opModel->prestar($_POST['op_id']);
            header("Location: " . URL_PATH . "/admin", true, 301);
            exit();
        }

        public function devolver(){
            $this->opModel->devolver($_POST['op_id']);
            header("Location: " . URL_PATH . "/admin", true, 301);
            exit();
        }
    }
    
?>