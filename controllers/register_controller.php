<?php
    require_once("db.php");

    function registerWithFeedback(){
        if(!empty($_POST)){
            //se hizo un intento de registro, chequeo los datos
            $errores = NULL;
            //nombre
            if(!isset($_POST['name']) || empty($_POST['name'])){
                $errores = $errores . "Nombre no puede ser vacio<br>";
            }else if(!ctype_alpha($_POST['name'])){
                $errores = $errores . "Nombre solo puede contener caracteres<br>";
            }
    
            //Apellido
            if(!isset($_POST['lastname']) || empty($_POST['lastname'])){
                $errores = $errores . "Apellido no puede ser vacio<br>";
            }else if(!ctype_alpha($_POST['lastname'])){
                $errores = $errores . "Apellido solo puede contener caracteres<br>";
            }
    
            //Email
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errores = $errores . "Formato de email invalido<br>"; 
            }else{
                //chequear que no exista ya en la BBDD
                $conn = connect_db();
                $result = mysqli_query($conn, "SELECT email FROM usuarios WHERE email='" . $_POST['email'] . "'");
                if(0 != mysqli_num_rows($result))
                    $errores = $errores . "Ya hay un usuario registrado con el mismo email ingresado<br>";
                mysqli_close($conn);              
            }
    
            //Clave
            $ok = true;
            if(!isset($_POST['password']) || empty($_POST['password'])){
                $errores = $errores . "Contrasenia no puede ser vacia<br>";
                $ok = false;
            }else{
                if(!preg_match('/[a-z]/', $_POST['password'])){
                    $errores = $errores . "Contrasenia debe conter al menos una minuscula<br>";
                    $ok = false;
                }            
                if(!preg_match('/[A-Z]/', $_POST['password'])){
                    $errores = $errores . "Contrasenia debe conter al menos una mayuscula<br>";
                    $ok = false;
                }
                if(!preg_match('/[0-9.!@#$%^&*()_+=]/', $_POST['password'])){
                    $errores = $errores . "Contrasenia debe conter al menos un numero o simbolo !@#$%^&*()_=+<br>";
                    $ok = false;
                }
                if(strlen($_POST['password']) < 6){
                    $errores = $errores . "Contrasenia debe conter al 6 caracteres<br>";
                    $ok = false;
                }
            }
    
            //Confirmacion de clave
            if(!isset($_POST['password_confirmation']) || empty($_POST['password_confirmation'])){
                $errores = $errores . "Contrasenia no puede ser vacia<br>";
            }else if($ok && (0 != strcmp($_POST['password'],$_POST['password_confirmation']))){
                 $errores = $errores . "Las contrasenias no coinciden<br>";
            }
    
            //Foto            
            //extensiones permitidas
	        $extsAllowed = array( 'jpg', 'jpeg', 'png');
            //extension del archivo subido
	        $extUploaded = strtolower( substr( strrchr($_FILES['pic']['name'], '.') ,1) ) ;
            //permitido?
	        if (!in_array($extUploaded, $extsAllowed) )
                $errores = $errores . "Archivo no valido, extensiones permitidas jpeg, jpg, png.<br>"; 

            //veredicto
            if(is_null($errores)){
                echo "<div class='row'><div class='col'><div class='alert alert-success alert-dismisable fade show' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span></button>
                <strong>Todo OK!</strong> Lograste registrarte a esta super pagina</div></div></div>";
                
                addUserToDB();
            }else{
                echo "<div class='row'><div class='col'><div class='alert alert-danger alert-dismisable fade show' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span></button>
                <strong>ERROR!</strong> <p>". $errores ."</p></div></div></div>";
            }
        }
    }

    function addUserToDB(){
        $conn = connect_db();
        $imagetmp=addslashes (file_get_contents($_FILES['pic']['tmp_name']));
        $query = "INSERT INTO usuarios (id, email, nombre, apellido, clave, rol, foto) VALUES 
        (NULL, 
        '" . $_POST['email'] . "', 
        '" . $_POST['name'] . "', 
        '" . $_POST['lastname'] . "', 
        '" . $_POST['password'] . "', 
        'LECTOR', 
        '$imagetmp')";        
        mysqli_query($conn, $query);
        mysqli_close($conn);
    }
   
?>