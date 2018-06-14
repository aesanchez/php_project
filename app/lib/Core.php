<?php

    class Core{
        protected $currentController = 'Index';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){     
            $url = $this->getUrl();
            //verificar si controlador existe y setearlo como actual
            if(isset($url[0])){
                if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
                    $this->currentController = ucwords($url[0]);
                }else{
                    header("Location: " . URL_PATH, true, 301);
                    exit();
                }
            }

            //levantar el controlador
            require_once '../app/controllers/' . $this->currentController . '.php';
            $this->currentController = new $this->currentController;

            //verificar metodo
            if(isset($url[1])){
                //verificar que exista
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    //parametros
                    if(isset($url[2])){
                        unset($url[0]);
                        unset($url[1]);
                        $this->params = $url ? array_values($url) : [];
                    }
                }else{
                    header("Location: " . URL_PATH, true, 301);
                    exit();
                }
            }else if(!method_exists($this->currentController, 'index')){
                //si tampoco tiene index
                header("Location: " . URL_PATH, true, 301);
                exit();
            }
            //llamar al metodo del controllador correspondiente, con los parametros adecuados
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl(){
            if(isset($_GET['url'])){
                //traducir url
                $url = rtrim($_GET['url'],'/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/',$url);
                return $url;
            }
        }
    }