<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biblioteca Info-UNLP</title>
    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/my_styles.css">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
</head>

<body>
    <?php
        require_once("controllers/index_controller.php");
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
                    <a href="views/register.php" class="nav-link">
                        <i class="far fa-edit"></i> Registrarse</a>
                </li>
                <li class="nav-item">
                    <a href="views/login.php" class="nav-link">
                        <i class="far fa-user"></i> Iniciar Sesion</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">

        <!-- Busqueda-->
        <div class="row mb-3">
            <div class="col-4" style="display: flex;flex-direction: column;justify-content: center">
                    <img src="assets/img/logo-info.png" style="width: 100%; height: auto;"/>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Refinar busqueda
                    </div>
                    <div class="card-body">
                        <form action="index.php" method="post">
                            <div class="form-group">
                                <label>Titulo</label>
                                <input type="text" class="form-control" name="title" placeholder="Ingrese el titulo aqui...">
                            </div>
                            <div class="form-group">
                                <label>Autor</label>
                                <input type="text" class="form-control" name="author" placeholder="Ingrese el nombre del autor aqui...">
                            </div>
                            <div align="right">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Catalogo-->
        <div class="row">
            <div class="col">
                <h2 class="text-center">Catalogo de libros</h2>
                <?php printBooksLegend()?>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Portada</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Ejemplares</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            printBooks();
                        ?>
                    </tbody>
                </table>
                <div class="text-center">
                    <?php printPagesNumertion()?>
                </div>                
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>