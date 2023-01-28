<?php
    if (!empty($_POST['infoEdit'])) {
        $text = $_POST['infoEdit'];

        require_once "connect.php";
        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $result = mysqli_query($link, "UPDATE allert SET text='$text'");

        mysqli_close($link);
        header('Location: ../../Zarządzanie');
    } else {
        header('Location: ../../Zarządzanie');
    }
?>