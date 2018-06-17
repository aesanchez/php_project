# Proyecto PHP

Repositorio para el desarrollo del Trabajo Practico final de la materia Seminario de lenguajes(PHP) de la [UNLP](http://www.unlp.edu.ar/)

## Objetivo

Simular el sistema de prestamos de la biblioteca de la UNLP.

## MVC

Se opto por utilizar un patron de diseño MVC (Model-View-Controller).

## Pasos para correr el proyecto

### PATH

Se debe clonar el repositorio en el directorio `../lampp/htdocs/`.
Si se desea cambiar el nombre de la carpeta que contiene el proyecto, asegurarse de modificar con el nuevo nombre los siguientes archivos:
* [/app/config/Config.php](https://github.com/trorik23/php_project/blob/master/app/config/Config.php): cambiar el valor de la variable `$subFolder` .
* [/public/.htaccess](https://github.com/trorik23/php_project/blob/master/public/.htaccess):  cambiar la linea que dice `RewriteBase /php_project/public` por `RewriteBase /nuevoNombre/public`.

### Base de Datos

Para realizar la correcta conexion con su base de datos modificar el archivo  [/app/config/Config.php](https://github.com/trorik23/php_project/blob/master/app/config/Config.php) e ingrese sus datos en las siguientes lineas:

````php
define('DB_HOST', 'nombre_mi_host');
define('DB_USER', 'mi_usuario');
define('DB_PASSWORD', 'mi_contrasenia');
define('DB_NAME', 'mi_base_de_datos');
````

#### Tablas

Se provee el archivo [php_project.sql](https://github.com/trorik23/php_project/blob/master/php_project.sql) para poder generar las tablas dentro de su base de datos, ademas de tener ciertos datos precargados para ya poder realizar test sobre la aplicacion.

### Finalmente

Para correr la aplicacion asegurarse de levantar los servicios de Apache y MySQL e ingresar a [localhost/](http://localhost/).

## Tecnologias
Para el desarrollo y el diseño del sitio web se utilizara:
* PHP
* HTML
* JS
* MySQL
* Apache
