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
            $filters = [];
            if(isset($_POST['author']) && !empty($_POST['author'])){
                $filters['author'] = $_POST['author'];
            }
            if(isset($_POST['title']) && !empty($_POST['title'])){
                $filters['title'] = $_POST['title'];
            }
            if(isset($_POST['user']) && !empty($_POST['user'])){
                $filters['user'] = $_POST['user'];
            }
            if(isset($_POST['date_from']) && !empty($_POST['date_from'])){
                $filters['date_from'] = $_POST['date_from'];
            }
            if(isset($_POST['date_until']) && !empty($_POST['date_until'])){
                $filters['date_until'] = $_POST['date_until'];
            }

            $params = [
                'userInfo' => $this->sessionInfo(),
                'list' => $this->opModel->getListForAdmin($filters),
                'filters' => $filters,
            ];
            if(isset($this->lastOp))
                $params['lastOp'] = $this->lastOp;

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
            $this->lastOp = true;
            $this->index();
        }

        public function devolver(){
            $this->opModel->devolver($_POST['op_id']);
            $this->lastOp = true;
            $this->index();
        }
    }
    
?>