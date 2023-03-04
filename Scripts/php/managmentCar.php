<?php
    if (isset($_POST["Mark"]) && isset($_POST["Model"]) && isset($_FILES["Picture"]) && !empty($_POST["Mark"]) && !empty($_POST["Model"]) && !empty($_FILES["Picture"])) {

        $markArr = $_POST["Mark"];
        $modelArr = $_POST["Model"];
        $pictureArr = $_FILES["Picture"];

        if (isset($_POST['ID'])) {
            $idArr = $_POST["ID"];
        }

        if (isset($_POST["checkbox"])) {
            $checkboxArr = $_POST["checkbox"];
        }

        var_dump($checkboxArr);

        require_once "connect.php";
        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $result1 = mysqli_query($link, "SELECT * FROM cars");
        $num_rows = mysqli_num_rows($result1);

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

            while ($row = mysqli_fetch_assoc($result1)) {
                if ($i <= $num_rows && !empty($mark) && !empty($model) && $mark !== $row['Mark'] || $model !== $row['Model']) {
                    $result2 = mysqli_query($link, "UPDATE $type SET `Mark`='$mark',`Model`='$model' WHERE ID='$id'");
                }

                if ($i <= $num_rows && isset($pictureArr['name'][$i])) {
                    $file_name = "offer".$id.".png";
                    $temp_name = $pictureArr['tmp_name'][$i];
                    $file_store = "../../Images/Offers/".$file_name;
                    move_uploaded_file($temp_name, $file_store);
                }
            }

            if (($num_rows == 0 || $num_rows-1 < $i) && !empty($mark) && !empty($model) && isset($pictureArr['name'][$i])) {

                $file_name = "offer".$id.".png";
                $temp_name = $pictureArr['tmp_name'][$i];
                $file_store = "../../Images/Offers/".$file_name;
                move_uploaded_file($temp_name, $file_store);

                $result2 = mysqli_query($link, "INSERT INTO cars(`ID`, `Mark`, `Model`, `Picture`) VALUES ('$id','$mark','$model','$file_name')");
            }

            if (isset($checkboxArr[$i]) && !empty($checkboxArr[$i])) {
                $file_name = "../../Images/Offers/offer".$id.".png";

                if (file_exists($file_name)) {
                    unlink($file_name);
                }

                $result2 = mysqli_query($link, "DELETE FROM cars WHERE ID='$id'");
            }
        }

        mysqli_close($link);
        header('Location: ../../Zarządzanie');

    } else {
        header('Location: ../../Zarządzanie');
    }
?>