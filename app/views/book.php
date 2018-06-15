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
        <!-- Info del libro-->
        <div class="row">
                <div class="card flex-md-row">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h2 class="mb-0">
                            <?php echo $params['title']?>
                        </h2>
                        <div class="mb-0 text-muted">Autor: <?php echo $params['author']?></div>
                        <div class="mb-2 text-muted">Cantidad: <?php echo $params['amount']?></div>
                        <h5 class="mb-2">
                            Descripcion
                        </h5>
                        <p class="card-text mb-auto"><?php echo $params['description']?></p>
                    </div>
                    <div class="flex-auto d-none d-lg-block d-md-block">
                    <img src="<?php echo URL_PATH;?>/book/photo/<?php echo $params['book_id']?>" style="width: auto; height: 15em;">
                    </div>
                </div>
            
        </div>
    </div>

    <!-- Bootstrap -->
    <script src='<?php echo URL_PATH;?>/js/jquery.min.js' type='text/javascript'></script>
    <script src='<?php echo URL_PATH;?>/js/bootstrap.min.js' type='text/javascript'></script>
</body>