<?php
    require_once("db.php");

    function printBooks($author_id){
        $conn = connect_db();
        $books = mysqli_query($conn, "SELECT * FROM libros WHERE autores_id=$author_id ORDER BY titulo");
        while($row = mysqli_fetch_assoc($books)) {
            echo "<tr>";
            echo "<td><img src=\"../controllers/image_display.php?book_id=",$row["id"],"\" style='height: 10em'></td>";
            echo "<td><a href=\"book.php?id=" . $row["id"] . "\">". $row["titulo"] ."</a></td>";
            echo "<td>",$row["cantidad"],"</td>";
            echo "</tr>";
        }
        mysqli_close($conn);

    }
    function getAuthorName($id){
        $conn = connect_db();
        $result = mysqli_query($conn, "SELECT * FROM autores WHERE id=$id");
        $author = mysqli_fetch_array($result);
        echo $author["nombre"], " ", $author["apellido"];
        mysqli_close($conn);
    }
?>