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
                if ($num_rows-1 < $i) {
                    $id++;
                }
    
                if ($num_rows==0 && $i==0) {
                    $id = 1;
                }
            }

            if (isset($checkboxArr[$i])) {
                $checkbox = $checkboxArr[$i];
            }

            // while ($row = mysqli_fetch_assoc($result1)) {
            //     if ($i <= $num_rows && !empty($title) && !empty($description) && $title !== $row['Title'] || $description !== $row['Description']) {
            //         $result2 = mysqli_query($link, "UPDATE $type SET `Title`='$title',`Description`='$description' WHERE ID='$id'");
            //     }
            // }

            if (($num_rows == 0 || $num_rows-1 < $i) && !empty($mark) && !empty($model) && isset($pictureArr['name'][$i])) {

                $file_name = "offer".$id.".png";
                $temp_name = $pictureArr['tmp_name'][$i];
                $file_store = "../../Images/Offers/".$file_name;
                move_uploaded_file($temp_name, $file_store);

                $result2 = mysqli_query($link, "INSERT INTO cars(`ID`, `Mark`, `Model`, `Picture`) VALUES ('$id','$mark','$model','$file_name')");
            }

            // if (isset($checkbox) && !empty($checkbox)) {
            //     $result2 = mysqli_query($link, "DELETE FROM $type WHERE ID='$id'");
            // }
        }

        mysqli_close($link);
        header('Location: ../../Zarządzanie');

    } else {
        header('Location: ../../Zarządzanie');
    }
?>