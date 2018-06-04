<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biblioteca Info-UNLP</title>
    <!-- Bootstrap -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/my_styles.css">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
</head>

<body>
    <?php
        require_once("../controllers/register_controller.php");
    ?>

    <nav class="navbar navbar-dark bg-dark navbar-expand-sm mb-3">
        <a class="navbar-brand" href="/">Biblioteca UNLP</a>
    </nav>

    <div class="container">


        <!-- Registro-->
        <?php registerWithFeedback()?>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Registro de lector
                    </div>
                    <div class="card-body">
                        <form action="register.php" name="register_form" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
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
        <script src="../assets/jquery/jquery.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>