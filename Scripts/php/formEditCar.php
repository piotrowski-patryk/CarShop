<?php
    if (isset($_GET['type']) && isset($_GET['car_id']) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["title"]) && isset($_POST["description"])) {

        $type = $_GET['type'];
        $car_id = $_GET['car_id'];

        $titleArr = $_POST["title"];
        $descriptionArr = $_POST["description"];

        if (isset($_POST["id"])) {
            $idArr = $_POST["id"];
        }

        require_once "connect.php";
        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $result1 = mysqli_query($link, "SELECT * FROM $type WHERE Car_ID='$car_id'");
        $num_rows = mysqli_num_rows($result1);
        $rows = mysqli_fetch_all($result1, MYSQLI_ASSOC);

        for ($i=0; $i<count($titleArr); $i++) {
                
            $title = $titleArr[$i];
            $description = $descriptionArr[$i];
            $checkbox = $checkboxArr[$i];

            if (isset($idArr[$i])) {
                $id = $idArr[$i];
            } else {

                if ($num_rows==0 && $i==0) {
                    $id = 1;
                } elseif ($num_rows-1 < $i) {
                    $id++;
                }
            }

            if (($num_rows == 0 || $num_rows-1 < $i) && !empty($title) && !empty($description)) {
                $result2 = mysqli_query($link, "INSERT INTO $type(`Car_ID`, `Title`, `Description`) VALUES ('$car_id','$title','$description')");
            }

            if ($num_rows > 0 && $i < $num_rows) {
                if (!empty($title) && !empty($description) && $title !== $rows[$i]['Title'] || $description !== $rows[$i]['Description']) {
                    $result2 = mysqli_query($link, "UPDATE $type SET `Title`='$title',`Description`='$description' WHERE ID='$id'");
                }
            }
        }

        
        if(isset($_POST['checkbox'])) {
            $checkbox = $_POST['checkbox'];

            foreach($checkbox as $checked_id) {
                $result2 = mysqli_query($link, "DELETE FROM $type WHERE ID='$checked_id'");
            }
        }

        mysqli_close($link);
        header('Location: ../../Oferta?id='.$car_id.'');

    } else {
        header('Location: ../../404');
    }
?>