<?php
    if (isset($_GET['id']) && !empty($_POST['Fuel']) && !empty($_POST['Space']) && !empty($_POST['Body']) && !empty($_POST['Gearbox']) && !empty($_POST['AirConditioning']) && isset($_FILES['Picture'])) {

        $ID = $_GET['id'];
        $Mark = $_POST['Mark'];
        $Model = $_POST['Model'];
        $Fuel = $_POST['Fuel'];
        $Space = $_POST['Space'];
        $Body = $_POST['Body'];
        $Gearbox = $_POST['Gearbox'];
        $AirConditioning = $_POST['AirConditioning'];

        $file_name = 'offer'.$ID.'.png';
        $file_type = $_FILES['Picture']['type'];
        $file_size = $_FILES['Picture']['size'];
        $file_tem_loc = $_FILES['Picture']['tmp_name'];
        $file_store = "../../Images/Offers/".$file_name;

        move_uploaded_file($file_tem_loc, $file_store);

        require_once "connect.php";
        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $result = mysqli_query($link, "UPDATE cars SET Mark='$Mark', Model='$Model', Fuel='$Fuel', Space='$Space', Body='$Body', Gearbox='$Gearbox', AirConditioning='$AirConditioning', Picture='$file_name' WHERE ID='$ID'");

        mysqli_close($link);
        header('Location: ../../Zarządzanie');

    } elseif (!empty($_POST['Fuel']) && !empty($_POST['Space']) && !empty($_POST['Body']) && !empty($_POST['Gearbox']) && !empty($_POST['AirConditioning']) && isset($_FILES['Picture'])) {
        
        $Mark = $_POST['Mark'];
        $Model = $_POST['Model'];
        $Fuel = $_POST['Fuel'];
        $Space = $_POST['Space'];
        $Body = $_POST['Body'];
        $Gearbox = $_POST['Gearbox'];
        $AirConditioning = $_POST['AirConditioning'];

        require_once "connect.php";
        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $result = mysqli_query($link, "SELECT ID FROM cars ORDER BY ID DESC LIMIT 1");

        $row = mysqli_fetch_row($result);
        $ID = $row[0];
        $ID++;

        $file_name = 'offer'.$ID.'.png';
        $file_type = $_FILES['Picture']['type'];
        $file_size = $_FILES['Picture']['size'];
        $file_tem_loc = $_FILES['Picture']['tmp_name'];
        $file_store = "../../Images/Offers/".$file_name;

        move_uploaded_file($file_tem_loc, $file_store);

        $result = mysqli_query($link, "INSERT INTO cars(ID, Mark, Model, Fuel, Space, Body, Gearbox, AirConditioning, Picture) VALUES ('$ID', '$Mark','$Model','$Fuel','$Space','$Body','$Gearbox','$AirConditioning','$file_name')");
        $result = mysqli_query($link, "INSERT INTO rentalprices(`ID`, `Unlimited-1`, `Unlimited-2`, `Unlimited-3`, `Unlimited-4`, `Limited-1`, `Limited-2`, `Limited-3`, `Limited-4`) VALUES ('$ID','--','--','--','--','--','--','--','--')");

        mysqli_close($link);
        header('Location: ../../Zarządzanie');

    } else {
        header('Location: ../../Zarządzanie');
    }
?>