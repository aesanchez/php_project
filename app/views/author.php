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
        <?php
            $session = new Session;
            if($session->is_logged()){
        ?>
                <li class="nav-item">
                    <a href="<?php echo URL_PATH?>/user" class="nav-link">
                        <i class="far fa-user"></i> Mi perfil</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo URL_PATH?>/login/logout" class="nav-link">
                        <i class="far fa-times-circle"></i> Salir</a>
                </li>
        <?php }else{?>
                <li class="nav-item">
                    <a href="<?php echo URL_PATH?>/register" class="nav-link">
                        <i class="far fa-edit"></i> Registrarse</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo URL_PATH?>/login" class="nav-link">
                        <i class="far fa-user"></i> Iniciar Sesion</a>
                </li>
        <?php } ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Libros del autor -->        
        <div class="row">
            <div class="col">
                <h4 class="text-center">Libros de <?php echo $params['nombre']?></h4>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Portada</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Ejemplares</th>
                            <?php
                                foreach($params['books'] as $row){
                                    echo "<tr>";
                                    echo "<td><a href=\"" . URL_PATH . "/book/display/" . $row["id"] . "\"><img src=\"" . URL_PATH . "/book/photo/" . $row["id"] . "\" style='height: 10em'></a></td>";
                                    echo "<td><a href=\"" . URL_PATH . "/book/display/" . $row["id"] . "\">" . $row["titulo"] ."</a></td>";
                                    echo "<td>";
                                    echo "Total: " . $row['cantidad'] . "</br>";
                                    echo "Prestados: " . $row['prestados'] . "</br>";
                                    echo "Reservados: " . $row['reservados'] . "</br>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src='<?php echo URL_PATH;?>/js/jquery.min.js' type='text/javascript'></script>
    <script src='<?php echo URL_PATH;?>/js/bootstrap.min.js' type='text/javascript'></script>
</body>