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
    <!-- NavBar -->
    <?php require_once('genericNavBar.php');?>

    <div class="container">
        
        <!-- Busqueda-->
        <div class="row mb-3">
            <div class="col-4 d-none d-md-block" style="position: relative;">
                    <img src="<?php echo URL_PATH;?>/img/logo-info.png" style="position: absolute;top: 0;bottom: 0;left: 0;right: 0;width: 85%;height: auto;margin: auto;"/>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-dark">
                        Refinar busqueda
                    </div>
                    <div class="card-body">
                        <form action="<?php echo URL_PATH;?>/" method="post">
                            <div class="form-group">
                                <label>Titulo</label>
                                <input type="text" class="form-control" name="title" placeholder="Ingrese el titulo aqui..."
                                <?php
                                    if(!is_null($params['title_filter']))
                                        echo " value='$params[title_filter]'";
                                ?>
                                >
                            </div>
                            <div class="form-group">
                                <label>Autor</label>
                                <input type="text" class="form-control" name="author" placeholder="Ingrese el autor aqui..."
                                <?php
                                    if(!is_null($params['author_filter']))
                                        echo " value='$params[author_filter]'";
                                ?>
                                >
                            </div>
                            <div align="right">
                                <input type="button" class="btn btn-danger" value="Limpiar" onclick="location.href = '<?php echo URL_PATH?>';">
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
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Portada</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Ejemplares</th>
                            <?php if($params['userInfo']['logged'] && !$params['userInfo']['admin']){?>
                            <th scope="col">Accion</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($params['books'] as $row){
                                echo "<tr>";
                                echo "<td><a href=\"" . URL_PATH . "/book/display/" . $row["id"] . "\"><img src=\"" . URL_PATH . "/book/photo/" . $row["id"] . "\" style='height: 10em'></a></td>";
                                echo "<td><a href=\"" . URL_PATH . "/book/display/" . $row["id"] . "\">" . $row["titulo"] ."</a></td>";
                                echo "<td><a href=\"" . URL_PATH . "/author/display/" . $row["autores_id"] . "\">" . $row["nombre_autor"] ."</a></td>";
                                echo "<td>";
                                echo "Total: " . $row['cantidad'] . "</br>";
                                echo "Disponibles: " . ($row['cantidad'] - $row['prestados'] - $row['reservados']) . "</br>";
                                echo "Prestados: " . $row['prestados'] . "</br>";
                                echo "Reservados: " . $row['reservados'] . "</br>";
                                echo "</td>";
                                if($params['userInfo']['logged'] && !$params['userInfo']['admin']){
                                    echo "<td>";
                                    if($row['reservar']){//puedo reservar
                                        echo "<form method='post' action='" . URL_PATH . "/user/reservar" . "' style='display: inline'>";
                                        echo "<input type='hidden' name='book_id' value=" . $row['id'] . ">";
                                        echo "<button type='submit' class='btn btn-success'>";
                                        echo "Reservar";
                                        echo "</button></form>";
                                    }
                                    echo "</td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
                </div>
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