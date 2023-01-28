<?php
    if (isset($_GET['id'])) {
        $ID = $_GET['id'];
        $Unlimited1 = $_POST['Unlimited-1'];
        $Unlimited2 = $_POST['Unlimited-2'];
        $Unlimited3 = $_POST['Unlimited-3'];
        $Unlimited4 = $_POST['Unlimited-4'];
        $Limited1 = $_POST['Limited-1'];
        $Limited2 = $_POST['Limited-2'];
        $Limited3 = $_POST['Limited-3'];
        $Limited4 = $_POST['Limited-4'];

        require_once "connect.php";
        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $result = mysqli_query($link, "UPDATE rentalprices SET `Unlimited-1`='$Unlimited1',`Unlimited-2`='$Unlimited2',`Unlimited-3`='$Unlimited3',`Unlimited-4`='$Unlimited4',`Limited-1`='$Limited1',`Limited-2`='$Limited2',`Limited-3`='$Limited3',`Limited-4`='$Limited4' WHERE ID='$ID'");

        mysqli_close($link);
        header('Location: ../../Oferta?id='.$ID);

    } else {
        header('Location: ../../Oferta?id='.$ID);
    }
?>