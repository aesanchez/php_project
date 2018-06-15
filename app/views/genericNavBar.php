<nav class="navbar navbar-dark bg-dark navbar-expand-sm mb-3">
        <a class="navbar-brand" href='<?php echo URL_PATH;?>'>Biblioteca UNLP</a>

        <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
            aria-controls="navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse justify-content-end" id="navbar">
            <ul class="nav navbar-nav">
        <?php
            if($params['userInfo']['logged']){
        ?>
                <li class="nav-item">                    
                    <a href="<?php echo URL_PATH?>/user" class="nav-link">
                        <img src="<?php echo URL_PATH?>/user/photo/<?php echo $params['userInfo']['id']?>" alt="Avatar" style="height: 25px; width: 25px; border-radius: 50%;">
                        <?php echo $params['userInfo']['name'] ?>
                    </a>
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