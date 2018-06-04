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
        require_once("../controllers/book_controller.php");
    ?>

    <nav class="navbar navbar-dark bg-dark navbar-expand-sm mb-3">
        <a class="navbar-brand" href="/">Biblioteca UNLP</a>

        <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
            aria-controls="navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse justify-content-end" id="navbar">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a href="register.php" class="nav-link">
                        <i class="far fa-edit"></i> Registrarse</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">
                        <i class="far fa-user"></i> Iniciar Sesion</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Info del libro-->
        <div class="row">
                <div class="card flex-md-row">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h2 class="mb-0">
                            <?php getTitle()?>
                        </h2>
                        <div class="mb-0 text-muted">Autor: <?php getAuthor()?></div>
                        <div class="mb-2 text-muted">Cantidad: <?php getAmount()?></div>
                        <h5 class="mb-2">
                            Descripcion
                        </h5>
                        <p class="card-text mb-auto"><?php getDescription()?></p>
                    </div>
                    <div class="flex-auto d-none d-lg-block d-md-block">
                    <img src="../controllers/image_display.php?book_id='<?php echo $_GET['id']?>'" style="width: auto; height: 15em;">
                    </div>
                </div>
            
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="../assets/jquery/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>