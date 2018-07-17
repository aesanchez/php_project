<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biblioteca Info-UNLP</title>
    <!-- Bootstrap -->
    <link href='<?php echo URL_PATH;?>/css/bootstrap/bootstrap.min.css' type='text/css' rel="stylesheet">
    <link href='<?php echo URL_PATH;?>/css/my_styles.css' type='text/css' rel="stylesheet">
    <!-- Font Awesome-->
    <link href='<?php echo URL_PATH;?>/css/fontawesome/css/fontawesome-all.css' rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-sm mb-3">
        <a class="navbar-brand" href='<?php echo URL_PATH;?>'>Biblioteca UNLP</a>

        <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
            aria-controls="navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse justify-content-end" id="navbar">
        <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a href="<?php echo URL_PATH?>/login" class="nav-link">
                        <i class="far fa-user"></i> Iniciar Sesion</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Registro-->
        <!-- Veredicto -->
        <?php if(isset($params['ok'])){?>
            <!-- se logro agregarlo a la base de datos -->
            <div class='row'>
                <div class='col'>
                    <div class='alert alert-success alert-dismisable fade show' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                        <strong>Todo OK!</strong> Lograste registrarte a esta super pagina
                    </div>
                </div>
            </div>
        <?php }else if(isset($params['errores']) && !empty($params['errores'])){?>
                <!-- imprimer errors -->
                <div class='row'>
                    <div class='col'>
                        <div class='alert alert-danger alert-dismisable fade show' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                            <strong>ERROR!</strong>
                            <p>
                                <?php foreach($params['errores'] as $e){
                                    echo $e . "<br>";
                                }?>
                            </p>
                        </div>
                    </div>
                </div>
        <?php }?>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Registro de lector
                    </div>
                    <div class="card-body">
                        <form action="<?php echo URL_PATH?>/register" name="register_form" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Ingrese su nombre..." required>
                            </div>
                            <div class="form-group">
                                <label>Apellido</label>
                                <input type="text" class="form-control" name="lastname" placeholder="Ingrese su apellido..." required>
                            </div>
                            <div class="form-group">
                                <label>Foto de perfil</label>
                                <input type="file" class="form-control-file" accept="image/*" name="pic" id="pic" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Ingrese su email..." required>
                            </div>
                            <div class="form-group">
                                <label>Clave</label>
                                <input type="password" class="form-control" name="password" placeholder="Ingrese su clave..." required>
                            </div>
                            <div class="form-group">
                                <label>Confirmacion de clave</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirme su clave..." required>
                            </div>
                            <div align="middle">
                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
        function validateForm() {
            //todas las validaciones de que esten llenos se hacen con required
            
            //nombre y apellido
            var name = document.forms["register_form"]["name"].value;
            var lastname = document.forms["register_form"]["lastname"].value;
            if (!/^[a-zA-Z]+$/.test(name) || !/^[a-zA-Z]+$/.test(lastname)) {
                alert("Los campos nombre y apellido solo pueden contenter letras");
                return false;
            }
            //email chequeado por input type=email
            var email = document.forms["register_form"]["email"].value;
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(!re.test(email)){
                alert("El email no tiene un formato valido");
                return false;
            }
            

            //validacion de imagen se hace con que solo acepte image/*

            //clave
            var password = document.forms["register_form"]["password"].value;
            if(password.length <6){
                alert("La clave debe tener al menos 6 caracteres");
                return false;
            }else if (!/[A-Z]/.test(password)){
                alert("La clave debe tener al menos una mayuscula");
                return false;
            }else if (!/[a-z]/.test(password)){
                alert("La clave debe tener al menos una minuscula");
                return false;
            }else if (!/[0-9.!@#$%^&*()_+=]/.test(password)){
                alert("La clave debe tener al un numero o simbolo !@#$%^&*()_+=");
                return false;
            }
            
            //confirmacion clave
            if(0 != document.forms["register_form"]["password"].value.localeCompare(document.forms["register_form"]["password_confirmation"].value)){
                alert("Las confirmacion de la clave no coincide");
                return false;
            }           
        }
        </script>

        <!-- Bootstrap -->
        <script src='<?php echo URL_PATH;?>/js/jquery.min.js' type='text/javascript'></script>
        <script src='<?php echo URL_PATH;?>/js/bootstrap.min.js' type='text/javascript'></script>
</body>