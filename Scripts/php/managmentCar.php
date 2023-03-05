<?php
    if (isset($_POST["Mark"]) && isset($_POST["Model"]) && isset($_FILES["Picture"]) && !empty($_POST["Mark"]) && !empty($_POST["Model"]) && !empty($_FILES["Picture"])) {

        $markArr = $_POST["Mark"];
        $modelArr = $_POST["Model"];

        if (isset($_POST['ID'])) {
            $idArr = $_POST["ID"];
        }

        require_once "connect.php";
        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $result1 = mysqli_query($link, "SELECT * FROM cars");
        $num_rows = mysqli_num_rows($result1);
        $rows = mysqli_fetch_all($result1, MYSQLI_ASSOC);


        for ($i=0; $i<count($markArr); $i++) {
            
            $mark = $markArr[$i];
            $model = $modelArr[$i];

            if (isset($idArr[$i])) {
                $id = $idArr[$i];
            } else {

                if ($num_rows==0 && $i==0) {
                    $id = 1;
                } elseif ($num_rows-1 < $i) {
                    $id++;
                }
            }

            if ($num_rows > 0 && $i < $num_rows) {
                if (!empty($mark) && !empty($model) && $mark !== $rows[$i]['Mark'] || $model !== $rows[$i]['Model']) {
                    $result2 = mysqli_query($link, "UPDATE cars SET `Mark`='$mark',`Model`='$model' WHERE ID='$id'");
                }

                if (isset($_FILES["Picture"]['name'][$i]) && !empty($_FILES["Picture"]['name'][$i])) {
                    $file_name = "offer".$_POST["ID"][$i].".png";
                    $temp_name = $_FILES["Picture"]['tmp_name'][$i];
                    $file_store = "../../Images/Offers/".$file_name;
                    move_uploaded_file($temp_name, $file_store);
                }
            }

            if (($num_rows == 0 || $num_rows-1 < $i) && !empty($mark) && !empty($model) && isset($_FILES["Picture"]['name'][$i])) {

                $file_name = "offer".$id.".png";
                $temp_name = $_FILES["Picture"]['tmp_name'][$i];
                $file_store = "../../Images/Offers/".$file_name;
                move_uploaded_file($temp_name, $file_store);

                $result2 = mysqli_query($link, "INSERT INTO cars(`ID`, `Mark`, `Model`, `Picture`) VALUES ('$id','$mark','$model','$file_name')");
            }
        }

        if(isset($_POST['checkbox'])) {
            $checkbox = $_POST['checkbox'];

            foreach($checkbox as $checked_id) {
                $file_name = "../../Images/Offers/offer".$checked_id.".png";

                if (file_exists($file_name)) {
                    unlink($file_name);
                }

                $result2 = mysqli_query($link, "DELETE FROM cars WHERE ID='$checked_id'");
            }
        }

        mysqli_close($link);
        header('Location: ../../Zarządzanie');

    } else {
        header('Location: ../../Zarządzanie');
    }
?>