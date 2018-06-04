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
        require_once("../controllers/author_controller.php");
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
        <!-- Libros del autor -->        
        <div class="row">
            <div class="col">
                <h4 class="text-center">Libros de <?php getAuthorName($_GET["id"])?></h4>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Portada</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Ejemplares</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php printBooks($_GET["id"]);?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="../assets/jquery/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>