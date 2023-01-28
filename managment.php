<?php
    session_start();

    if (isset($_SESSION['login'])) {
        $login = $_SESSION['login'];

        require_once "Scripts/php/connect.php";
        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $result = mysqli_query($link, "SELECT count(*) FROM users WHERE Email='$login'");

        if (mysqli_num_rows($result) == 0) {
            unset($_SESSION['login']);
            mysqli_free_result($result);
            mysqli_close($link);
            header('Location: Logowanie');
        }

        mysqli_free_result($result);
        mysqli_close($link);
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!------------------| Icons |------------------>
    <script src="https://kit.fontawesome.com/44e0ed08c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-----------------| Favicon |----------------->
    <link rel="icon" type="svg" sizes="16x16"  href="Images/logo.svg">

    <!------------------| Fonts |------------------>
    <link href="https://fonts.googleapis.com/css2?family=Saira+Condensed:wght@300;500;700&display=swap" rel="stylesheet">

    <!-------------------| CSS |------------------->
    <link rel="stylesheet" href="CSS/general.css">
    <link rel="stylesheet" href="CSS/managment.css">
    <link rel="stylesheet" href="CSS/components/nav.css">
    <link rel="stylesheet" href="CSS/components/footer.css">

    <!-----------------| Scripts |----------------->
    <script defer src="Scripts/JS/mobileMenu.js"></script>

    <title>MBS rent</title>
</head>
<body>
    <header>
        <nav>
            <a href="StronaGłówna">MBS rent</a>

            <ul class="nav_menu">
                <li><a href="StronaGłówna#Oferta">OFERTA</a></li>
                <li><a href="StronaGłówna#Lokalizacja">LOKALIZACJA</a></li>
                <li><a href="StronaGłówna#Kontakt">KONTAKT</a></li>
                <?php
                    if (!isset($_SESSION['login'])) {
                        echo '<li><a href="Logowanie">ZALOGUJ</a></li>';
                    } else {
                        echo '<li><a href="Scripts/php/logout.php">WYLOGUJ</a></li>';
                        echo '<li><a href="Zarządzanie"><i class="fa-solid fa-gear"></i></a></li>';
                    }
                ?>
            </ul>

            <button id="burgerIcon">
                <div class="burgerIcon_bar1"></div>
                <div class="burgerIcon_bar2"></div>
                <div class="burgerIcon_bar1"></div>
            </button>
        </nav>
    </header>

    <main>
        <div class="managment_left">
            <form action="Scripts/php/infoEdit.php" method="post" id="managment_infoEdit" autocomplete="off">
                <i class="fa-solid fa-pen-to-square"></i>

                <?php
                    require_once "Scripts/php/connect.php";
                    $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                    $result = mysqli_query($link, "SELECT text FROM allert");
                    $row = mysqli_fetch_row($result);

                    echo '<input type="text" maxlength="45" name="infoEdit" value="'.$row[0].'">';

                    mysqli_free_result($result);
                    mysqli_close($link);
                ?>
                <button>Edytuj</button>
            </form>

            <div id="managment_users">
                <div class="users-tableTitle">
                    <span style="width: 20%">ID<i class="fa-solid fa-caret-down"></i></span>
                    <span style="width: 33%">E-MAIL<i class="fa-solid fa-caret-down"></i></span>
                    <span style="width: 25%">STATUS<i class="fa-solid fa-caret-down"></i></span>
                    <span>ZARZĄDZANIE<i class="fa-solid fa-caret-down"></i></span>
                </div>

                <?php
                    require_once "Scripts/php/connect.php";
                    $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                    $result = mysqli_query($link, "SELECT ID, Email, EmailVerification FROM users");

                    foreach ($result as $row) {
                        echo '<div class="users-item">';
                            echo '<span style="width: 20%">#'.$row['ID'].'</span>';
                            echo '<span style="width: 33%">'.$row['Email'].'</span>';
                            if ($row['EmailVerification'] == 'no') {
                                echo '<span class="users-item_inactive">Nieaktywne</span>';
                            } else {
                                echo '<span class="users-item_active">Aktywne</span>';
                            }
                            echo '<a href="Scripts/php/deleteUser.php?id='.$row['ID'].'&login='.$row['Email'].'">USUŃ<i class="fa-solid fa-user-xmark"></i></a>';
                        echo '</div>';
                    }

                    mysqli_free_result($result);
                    mysqli_close($link);
                ?>

                <form action="Scripts/php/accountActiv.php" method="post" autocomplete="off" class="users-item">
                    <input type="email" placeholder="E-MAIL" name="email" require>
                    <button>DODAJ<i class="fa-solid fa-user-plus"></i></button>
                </form>
            </div>
        </div>

        <div class="managment_right">
            <form action="Scripts/php/offerEdit.php" method="post" autocomplete="off" class="managment_right_item" enctype="multipart/form-data">
                <h1>#0 - <input type="text" placeholder="Marka" name="Mark"> <input type="text" placeholder="Model" name="Model"></h1>
                <button id="editOffer"><i class="fa-solid fa-file-circle-plus"></i></button>
                <div class="right_item_content">
                    <div class="input-Fuel">
                        <i class="fa-solid fa-gas-pump"></i> <input type="text" placeholder="Paliwo" name="Fuel">
                    </div>

                    <div class="input-Space">
                        <i class="fa-solid fa-person"></i> <input type="text" placeholder="0" name="Space">
                    </div>

                    <div class="input-Body">
                        <i class="fa-solid fa-car-side"></i> <input type="text" placeholder="Nadwozie" name="Body">
                    </div>

                    <div class="input-Gearbox">
                        <i class="fa-solid fa-gears"></i> <input type="text" placeholder="Skrzynia bieg..." name="Gearbox">
                    </div>

                    <div class="input-AirConditioning">
                        <i class="fa-solid fa-fan"></i>
                        <select name="AirConditioning">
                            <option value="Nie">Nie</option>
                            <option value="Tak">Tak</option>
                        </select>
                    </div>

                    <div class="input-Picture">
                        <i class="fa-solid fa-image"></i> <label><span id="inputFileName">Dodaj plik</span> <input type="file" name="Picture" id="inputFile"></label>
                    </div>
                </div>
            </form>

            <?php
                require_once "Scripts/php/connect.php";
                $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                $result = mysqli_query($link, "SELECT * FROM cars");

                foreach ($result as $row) {
                    echo '<form action="Scripts/php/offerEdit.php?id='.$row['ID'].'" method="post" autocomplete="off" class="managment_right_item" enctype="multipart/form-data">';
                        echo '<h1>#'.$row['ID'].' - <input type="text" placeholder="Marka" name="Mark" value="'.$row['Mark'].'"> <input type="text" placeholder="Model" name="Model" value="'.$row['Model'].'"></h1>';
                        echo '<button id="editOffer"><i class="fa-solid fa-file-pen"></i></button>';
                        echo '<a href="Scripts/php/offerDelete.php?id='.$row['ID'].'" id="deleteOffer"><i class="fa-solid fa-delete-left"></i></a>';
                        echo '<div class="right_item_content">';
                            echo '<div class="input-Fuel">';
                                echo '<i class="fa-solid fa-gas-pump"></i> <input type="text" placeholder="Paliwo" name="Fuel" value="'.$row['Fuel'].'">';
                            echo '</div>';

                            echo '<div class="input-Space">';
                                echo '<i class="fa-solid fa-person"></i> <input type="text" placeholder="0" name="Space" value="'.$row['Space'].'">';
                            echo '</div>';

                            echo '<div class="input-Body">';
                                echo '<i class="fa-solid fa-car-side"></i> <input type="text" placeholder="Nadwozie" name="Body" value="'.$row['Body'].'">';
                            echo '</div>';

                            echo '<div class="input-Gearbox">';
                                echo '<i class="fa-solid fa-gears"></i> <input type="text" placeholder="Skrzynia bieg..." name="Gearbox" value="'.$row['Gearbox'].'">';
                            echo '</div>';

                            echo '<div class="input-AirConditioning">';
                                echo '<i class="fa-solid fa-fan"></i>';
                                echo '<select name="AirConditioning">';
                                    if ($row['AirConditioning'] == 'Tak') {
                                        echo '<option value="Nie">Nie</option>';
                                        echo '<option value="Tak" selected>Tak</option>';
                                    } else {
                                        echo '<option value="Nie" selected>Nie</option>';
                                        echo '<option value="Tak">Tak</option>';
                                    }
                                echo '</select>';
                            echo '</div>';

                            echo '<div class="input-Picture">';
                                echo '<i class="fa-solid fa-image"></i> <label><span id="inputFileName">Dodaj plik</span> <input type="file" name="Picture" id="inputFile"></label>';
                            echo '</div>';
                        echo '</div>';
                    echo '</form>';
                }
            ?>
        </div>
    </main>

    <footer id="Kontakt">
        <div class="footer_top">
            <div class="footer_top_left">
                <h1>BMS rent</h1>
                <p>MBS rent to wypożyczania samochodów w Warszawie z atrakcyjną i elastyczną ofertą dopasowaną do potrzeb Klientów indywidualnych i przedsiębiorców.</p>
            </div>

            <div class="footer_top_right">
                <ul>
                    <li><b>Strona Główna</b></li>
                    <li><b>-</b> <a href="StronaGłówna#DlaczegoMy">Dlaczego my?</a></li>
                    <li><b>-</b> <a href="StronaGłówna#Oferta">Oferty</a></li>
                    <li><b>-</b> <a href="StronaGłówna#Lokalizacja">Lokalizacja</a></li>
                    <li><b>-</b> <a href="StronaGłówna#Kontakt">Kontakt</a></li>
                </ul>

                <ul>
                    <li><b>Kontakt z nami</b></li>
                    <li>
                        <i class="fa-solid fa-phone"></i>
                        517 773 999
                    </li>
                    <li>
                        <i class="fa-solid fa-envelope"></i>
                        email@domena.com
                    </li>
                    <li>
                        <i class="fa-solid fa-envelope"></i>
                        email@domena.com
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer_bottom">
            <h1>© Patryk Piotrowski. All right reserved</h1>
            <a href="Polityka">Polityka prywatności</a>
        </div>
    </footer>
</body>
</html>