<?php
    require_once('db.php');
    if(isset($_GET['book_id']) && !empty($_GET['book_id'])){
        $id = $_GET['book_id'];
        $conn = connect_db();
        $query = "SELECT portada FROM libros WHERE id=$id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        mysqli_close($conn);
        header("Content-type: jpeg");
        echo $row['portada'];
        
    }else if(isset($_GET['user_id']) && !empty($_GET['user_id'])){
        $id = $_GET['user_id'];
        $conn = connect_db();
        $query = "SELECT foto FROM usuarios WHERE id=$id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        mysqli_close($conn);
        header("Content-type: jpg");
        echo $row['foto'];
    }
?>