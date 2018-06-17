<?php
    //config DB
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'php_project');

    //config ruta "url global"
    $server = "http://$_SERVER[HTTP_HOST]";
    /*
        cambiar este valor al nombre de la carpeta del projecto dentro de el directorio "htdocs"
        Por ejemplo si tengo .../htdocs/nombreCarpetaProyecto/...
        $subFolder = "/nombreCarpetaProyecto";
    */
   
    $subFolder = "/php_project";

    define('URL_PATH', $server . $subFolder);
?>