<?php

    // Połączenie z bazą danych
    require_once "connect.php";
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Nieudane połączenie z bazą danych: " . $conn->connect_error);
    }
    
    // Pobranie danych z tabeli cars
    $cars = array();
    $sql = "SELECT * FROM cars";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $cars[] = $row;
        }
    }
    
    // Pobranie danych z tabeli cars_data
    $cars_data = array();
    $sql = "SELECT * FROM cars_data";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $cars_data[] = $row;
        }
    }
    
    // Pobranie danych z tabeli cars_equipment
    $cars_equipment = array();
    $sql = "SELECT * FROM cars_equipment";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $cars_equipment[] = $row;
        }
    }
    
    // Pobranie danych z tabeli cars_other
    $cars_other = array();
    $sql = "SELECT * FROM cars_other";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $cars_other[] = $row;
        }
    }
    
    // Zapisanie danych do pliku .json
    $data = array(
        "cars" => $cars,
        "cars_data" => $cars_data,
        "cars_equipment" => $cars_equipment,
        "cars_other" => $cars_other
    );
    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    $file_name = "Scripts/dataCars.json";
    $file = fopen($file_name, "w");
    fwrite($file, $json_data);
    fclose($file);

?>