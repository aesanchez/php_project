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
                <?php
                    if($params['userInfo']['logged'] && !$params['userInfo']['admin'] && strcmp($params['books'][0]['user_op'], "MAX") == 0){
                ?>
                <div class='d-flex justify-content-center'>
                <div class="alert alert-warning alert-dismissible fade show col-6" role="alert">
                    <strong>Atencion!</strong> Ya se alcanzo el maximo(3) de reservas.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                </div>

                <?php
                }
                ?>
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Portada</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Ejemplares</th>
                            <?php if($params['userInfo']['logged'] && !$params['userInfo']['admin'] && strcmp($params['books'][0]['user_op'], "MAX") != 0){?>
                            <th scope="col">Accion</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($params['books'] as $row){?>
                            <tr>
                                <td>
                                    <a href="<?php echo URL_PATH . "/book/display/" . $row["id"]?>">
                                        <img src="<?php echo URL_PATH . "/book/photo/" . $row["id"]?>" style='height: 10em'>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo URL_PATH . "/book/display/" . $row["id"]?>">
                                        <?php echo $row["titulo"]?>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo URL_PATH . "/author/display/" . $row["autores_id"]?>">
                                        <?php echo $row["nombre_autor"]?>
                                    </a>
                                </td>
                                <td>
                                    Total: <?php echo $row['cantidad']?></br>
                                    Disponibles: <?php echo ($row['cantidad'] - $row['prestados'] - $row['reservados'])?></br>
                                    Prestados: <?php echo $row['prestados']?></br>
                                    Reservados: <?php echo $row['reservados']?></br>
                                </td>
                                <?php if($params['userInfo']['logged'] && !$params['userInfo']['admin']){
                                    if(strcmp($row['user_op'], "AVAILABLE") == 0){?>
                                        <td>
                                            <form method='post' action="<?php echo URL_PATH . "/user/reservar"?>" style='display: inline'>
                                            <input type='hidden' name='book_id' value=<?php echo $row['id']?>>
                                            <button type='submit' class='btn btn-success'>
                                                Reservar
                                            </button></form>
                                        </td>
                                    <?php }else if(strcmp($row['user_op'], "GOT_IT") == 0){?>
                                        <td class='text-warning'>
                                            Ya posee un<br>ejemplar en tramite
                                        </td>
                                    <?php }else if(strcmp($row['user_op'], "NONE_LEFT") == 0){?>
                                        <td class='text-danger'>
                                                No hay<br>ejemplares disponibles
                                        </td>
                                    <?php }?> 
                                <?php }?>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
                </div>
                <div class="text-center">
                <!-- Paginacion -->
                    <?php
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