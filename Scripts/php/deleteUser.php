<?php
    session_start();

    if (isset($_GET['id']) && isset($_GET['login'])) {
        $id = $_GET['id'];
        $login = $_GET['login'];

        if ($_SESSION['login'] !== $login) {
            require_once "connect.php";
            $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            $result = mysqli_query($link, "DELETE FROM users WHERE ID='$id'");

            mysqli_close($link);
            header('Location: ../../Zarządzanie');
            
        } else {
            header('Location: ../../Zarządzanie');
        }
    } else {
        header('Location: ../../Zarządzanie');
    }
?>