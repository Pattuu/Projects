<?php 
    session_start();
    include '../../inc/incfiles/dblink.php';

    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
        $type = $_SESSION['type'];
    }else{
        $type = "member";
    }

    if(!isset($_GET['id'])){
        header('location: guestbook.php');
    } else {
        $id = intval($_GET['id']);
    }

    if($id >= 0){
        $delete = "DELETE FROM guestbook WHERE id = $id";
        if(mysqli_query($link, $delete)){
            header('location: guestbook.php');
        }
    }

?>


