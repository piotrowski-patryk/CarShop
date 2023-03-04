<?php
    if (isset($_GET['type']) && isset($_GET['car_id']) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["title"]) && isset($_POST["description"])) {

        $type = $_GET['type'];
        $car_id = $_GET['car_id'];

        $idArr = $_POST["id"];
        $titleArr = $_POST["title"];
        $descriptionArr = $_POST["description"];

        if (isset($_POST["checkbox"])) {
            $checkboxArr = $_POST["checkbox"];
        }

        require_once "connect.php";
        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $result1 = mysqli_query($link, "SELECT * FROM $type WHERE Car_ID='$car_id'");
        $num_rows = mysqli_num_rows($result1);

        for ($i=0; $i<count($idArr); $i++) {
                
            $id = $idArr[$i];
            $title = $titleArr[$i];
            $description = $descriptionArr[$i];

            if (isset($checkboxArr)) {
                $checkbox = $checkboxArr[$i];
            }

            while ($row = mysqli_fetch_assoc($result1)) {
                if ($i <= $num_rows && !empty($title) && !empty($description) && $title !== $row['Title'] || $description !== $row['Description']) {
                    $result2 = mysqli_query($link, "UPDATE $type SET `Title`='$title',`Description`='$description' WHERE ID='$id'");
                }
            }

            if (($num_rows == 0 || $num_rows-1 < $i) && !empty($title) && !empty($description)) {
                $result2 = mysqli_query($link, "INSERT INTO $type(`Car_ID`, `Title`, `Description`) VALUES ('$car_id','$title','$description')");
            }

            if (isset($checkbox) && !empty($checkbox)) {
                $result2 = mysqli_query($link, "DELETE FROM $type WHERE ID='$id'");
            }
        }

        mysqli_close($link);
        header('Location: ../../Oferta?id='.$car_id.'');

    } else {
        header('Location: ../../404');
    }
?>