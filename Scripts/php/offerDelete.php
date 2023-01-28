<?php
    if (isset($_GET['id'])) {

        $ID = $_GET['id'];

        require_once "connect.php";
        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $result = mysqli_query($link, "DELETE FROM rentalprices WHERE ID='$ID'");
        $result = mysqli_query($link, "DELETE FROM cars WHERE ID='$ID'");

        unlink('../../Images/Offers/offer'.$ID.'.png');

        mysqli_close($link);
        header('Location: ../../Zarządzanie');

    } else {
        header('Location: ../../Zarządzanie');
    }
?>