<?php

    class Controller{

        public function model($model){
            //cargar modelo
            require_once '../app/models/' . $model . '.php';
            return new $model;
        }

        public function view($view, $params = []){
            //cargar vista
            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            }else{
                die('Vista no existe');
            }
        }
    }