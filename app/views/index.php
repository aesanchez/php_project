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
                        <i class="far fa-edit"></i> Registrarse</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo URL_PATH?>/login" class="nav-link">
                        <i class="far fa-user"></i> Iniciar Sesion</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">

        <!-- Busqueda-->
        <div class="row mb-3">
            <div class="col-4" style="display: flex;flex-direction: column;justify-content: center">
                    <img src="<?php echo URL_PATH;?>/img/logo-info.png" style="width: 100%; height: auto;"/>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Refinar busqueda
                    </div>
                    <div class="card-body">
                        <form action="<?php echo URL_PATH;?>/" method="post">
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
                <?php
                    if(!is_null($params['author_filter']) || !is_null($params['title_filter'])){
                        echo "<p style='text-align: center'><small>Busqueda filtrada por:</small><br>";
                        if(!is_null($params['title_filter']))
                            echo "<small>Titulo: " . $params['title_filter'] . "</small><br>";
                        if(!is_null($params['author_filter']))
                            echo "<small>Autor: " . $params['author_filter'] . "</small><br>";                        
                        echo "</p>";
                    }
                ?>
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
                            foreach($params['books'] as $row){
                                echo "<tr>";
                                echo "<td><a href=\"" . URL_PATH . "/book/display/" . $row["id"] . "\"><img src=\"" . URL_PATH . "/book/photo/" . $row["id"] . "\" style='height: 10em'></a></td>";
                                echo "<td><a href=\"" . URL_PATH . "/book/display/" . $row["id"] . "\">" . $row["titulo"] ."</a></td>";
                                echo "<td><a href=\"" . URL_PATH . "/author/display/" . $row["autores_id"] . "\">" . $row["nombre_autor"] ."</a></td>";
                                echo "<td>" . $row["cantidad"] ."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <div class="text-center">
                    <?php
                        //paginacion
                        $aux = 0;
                        while($aux < $params['pages']){
                            if($aux+1 == $params['current_page']){
                                echo " " . ($aux+1) . " ";
                            }else{
                                echo "<form method='post' action='" . URL_PATH . "/?page=" . ($aux+1) . "' style='display: inline'>";
                                if(isset($params['title_filter']))
                                    echo "<input type='hidden' name='title' value=" . $params['title_filter'] . ">";
                                if(isset($params['author_filter']))
                                    echo "<input type='hidden' name='author' value=" . $params['author_filter'] . ">";
                                echo "<button type='submit' name='submit_param' value='submit_value' class='link-button'>";
                                echo ($aux+1);
                                echo "</button></form>";
                            }            
                            $aux++;
                        }
                    ?>
                </div>                
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src='<?php echo URL_PATH;?>/js/jquery.min.js' type='text/javascript'></script>
    <script src='<?php echo URL_PATH;?>/js/bootstrap.min.js' type='text/javascript'></script>
</body>