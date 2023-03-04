<?php
    if (isset($_POST["Mark"]) && isset($_POST["Model"])) {

        $markArr = $_POST["Mark"];
        $modelArr = $_POST["Model"];

        if (isset($_POST['ID'])) {
            $idArr = $_POST["ID"];
        }

        if (isset($_FILES["Picture"])) {
            $pictureArr = $_FILES["Picture"];
        }

        if (isset($_POST["checkbox"])) {
            $checkboxArr = $_POST["checkbox"];
        }

        require_once "connect.php";
        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $result1 = mysqli_query($link, "SELECT * FROM cars");
        $num_rows = mysqli_num_rows($result1);

        echo 'Baza danych: '.$num_rows.'<br>';

        for ($i=0; $i<count($idArr); $i++) {
                
            $mark = $markArr[$i];
            $model = $modelArr[$i];

            if (isset($idArr)) {
                $id = $idArr[$i];
            }

            if (isset($picture)) {
                $picture = $pictureArr[$i];
            }

            if (isset($checkboxArr)) {
                $checkbox = $checkboxArr[$i];
            }

            echo ''

            // while ($row = mysqli_fetch_assoc($result1)) {
            //     if ($i <= $num_rows && !empty($title) && !empty($description) && $title !== $row['Title'] || $description !== $row['Description']) {
            //         $result2 = mysqli_query($link, "UPDATE $type SET `Title`='$title',`Description`='$description' WHERE ID='$id'");
            //     }
            // }

            if (($num_rows == 0 || $num_rows-1 < $i) && !empty($mark) && !empty($model) && !empty($picture)) {

                $file_name = "offer".$id.".png";
                $temp_name = $picture["tmp_name"];
                move_uploaded_file($temp_name, $file_name);

                $result2 = mysqli_query($link, "INSERT INTO cars(`Mark`, `Model`, `Picture`) VALUES ('$mark','$model','$file_name')");
            }

            // if (isset($checkbox) && !empty($checkbox)) {
            //     $result2 = mysqli_query($link, "DELETE FROM $type WHERE ID='$id'");
            // }
        }

        mysqli_close($link);

    } else {
        header('Location: ../../Zarządzanie');
    }
?>