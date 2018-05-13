<?php
    require_once("db.php");
    define("PAGE_AMOUNT", 5);

    function printBooks(){        
        $query = buildFilteredQuery();

        //orden por titulo ascendente
        $query = $query . " ORDER BY titulo";

        //mostrar maximo 5
        $query = $query . " LIMIT " . PAGE_AMOUNT;

        //mostrar dependiendo que pagina es
        if(isset($_GET["page"]) && !empty($_GET["page"]) && is_numeric($_GET["page"])){
            $query = $query . " OFFSET " . ($_GET["page"] - 1) * PAGE_AMOUNT;
        }

        $conn = connect_db();
        $books = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($books)) {
            echo "<tr>";
            echo "<td><img src=\"controllers/image_display.php?book_id=",$row["id"],"\" style='height: 10em'></td>";
            echo "<td><a href=\"views/book.php?id=" . $row["id"] . "\">". $row["titulo"] ."</a></td>";
            $author_id = $row["autores_id"];
            $result = mysqli_query($conn, "SELECT * FROM autores WHERE id=$author_id");
            $author_row = mysqli_fetch_array($result);
            echo "<td><a href=\"views/author.php?id=$author_id\">",$author_row["nombre"], " ", $author_row["apellido"],"</a></td>";
            echo "<td>",$row["cantidad"],"</td>";
            echo "</tr>";
        }
        mysqli_close($conn);
    }

    function printBooksLegend(){
        $author = NULL;
        $title = NULL;
        if (isset($_POST['author']) && isset($_POST['title']))
        {
            $author = $_POST['author'];
            $title = $_POST['title'];
            if(!is_null($author) && !empty($author)){
                echo "<p style='text-align: center'><small>Busqueda por:</small><br>";
                echo "<small>Autor: $author</small>";
                if(!is_null($title) && !empty($title)){
                    echo "<br><small>Titulo: $title</small>";
                }
                echo "</P>";
            }else{
                if(!is_null($title) && !empty($title)){
                    echo "<p style='text-align: center'><small>Busqueda por:</small><br>"; 
                    echo "<small>Titulo: $title</small></p>";
                }
            }
        }
    }

    function buildFilteredQuery(){
        $query = "SELECT l.id, l.titulo, l.portada, l.descripcion, l.autores_id, l.cantidad FROM libros l";
        $query_a = NULL;
        $query_t = NULL;
        if(isset($_POST['title']) && !empty($_POST['title'])){
            $query = $query . " INNER JOIN autores a ON l.autores_id = a.id AND l.titulo LIKE '%" . $_POST['title'] . "%'";
            if(isset($_POST['author']) && !empty($_POST['author'])){
                $query = $query . " AND (a.nombre LIKE '%" . $_POST['author'] . "%' OR a.apellido LIKE '%" . $_POST['author'] . "%')";
            }
        }else{           
            if(isset($_POST['author']) && !empty($_POST['author'])){
                $query = $query . " INNER JOIN autores a ON l.autores_id = a.id AND (a.nombre LIKE '%" . $_POST['author'] . "%' OR a.apellido LIKE '%" . $_POST['author'] . "%')";
            }
        }
        return $query;
    }

    function printPagesNumertion(){
        $query = buildFilteredQuery();        
        $page_number = 1;
        if(isset($_GET["page"]) && !empty($_GET["page"]) && is_numeric($_GET["page"])){
            $page_number = $_GET["page"];
        }
        $conn = connect_db();
        $books = mysqli_query($conn, $query);        
        mysqli_close($conn);
        $total = mysqli_num_rows($books);
        $aux = 0;
        while(($aux * PAGE_AMOUNT) < $total){
            if($aux == $page_number-1){
                echo " " . ($aux+1) . " ";
            }else{
                echo "<form method='post' action='?page=" . ($aux+1) . "' style='display: inline'>";
                if(isset($_POST['title']))
                    echo "<input type='hidden' name='title' value=" . $_POST['title'] . ">";
                if(isset($_POST['author']))
                    echo "<input type='hidden' name='author' value=" . $_POST['author'] . ">";
                echo "<button type='submit' name='submit_param' value='submit_value' class='link-button'>";
                echo ($aux+1);
                echo "</button></form>";
            }            
            $aux++;
        }        
    }
?>