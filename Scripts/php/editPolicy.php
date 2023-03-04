<?php
    if (isset($_POST['text'])) {

        $text = $_POST['text'];

        require_once "connect.php";
        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $result = mysqli_query($link, "UPDATE `policy` SET `Text`='$text'");

        mysqli_close($link);
        header('Location: ../../Regulamin');
        
    } else {
        header('Location: ../../Regulamin');
    }
?>