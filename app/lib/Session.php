<?php

    class Session{
        public function __construct(){
            session_start();
        }

        public function is_logged(){            
            if(isset($_SESSION['id']))
                return true;
            return false;    
        }

        public function getID(){
            if(isset($_SESSION['id']))
                return $_SESSION['id'];
            return NULL;
        }
    
        public function log_in($id){             
            $_SESSION['id'] = $id;
        }
        
        public function log_out(){
            session_unset();
            session_destroy();
        }

    }
    
?>
