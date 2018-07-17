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
                    <a href="<?php echo URL_PATH?>/register" class="nav-link">
                        <i class="far fa-user"></i> Registrarse</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?php if(isset($params['authentication'])){ ?>
            <div class='row'>
                <div class='col'>
                    <div class='alert alert-danger alert-dismisable fade show' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                        <strong>ERROR!</strong><p> Email o contrasenia incorrectos </p>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- Registro-->
        <div class="row justify-content-center">
            <div class="col col-lg-8 col-md-8">
                <div class="card">
                    <div class="card-header">
                        Iniciar Sesion
                    </div>
                    <div class="card-body">
                        <form action="<?php echo URL_PATH?>/login" method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Ingrese su email..." required>
                            </div>
                            <div class="form-group">
                                <label>Clave</label>
                                <input type="password" class="form-control" name="password" placeholder="Ingrese su clave..." required>
                            </div>
                            <div align="middle">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap -->
        <script src='<?php echo URL_PATH;?>/js/jquery.min.js' type='text/javascript'></script>
        <script src='<?php echo URL_PATH;?>/js/bootstrap.min.js' type='text/javascript'></script>
</body>