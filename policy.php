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
    <link rel="stylesheet" href="CSS/policy.css">
    <link rel="stylesheet" href="CSS/components/nav.css">
    <link rel="stylesheet" href="CSS/components/footer.css">

    <!-----------------| Scripts |----------------->
    <script defer src="Scripts/JS/mobileMenu.js"></script>
    <script defer src="Scripts/JS/editPolicy.js"></script>

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
        </header>
    </div>

    <main>
        <h1>
            Regulamin / Polityka prywatności
            <?php
                if (isset($_SESSION['login'])) {
                    echo '<i class="fa-solid fa-pen-to-square" id="btn-openForm"></i>';
                }
            ?>
        </h1>
        <p id="policyText">
            <?php
                require_once "Scripts/php/connect.php";
                $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                $result = mysqli_query($link, "SELECT `Text` FROM `policy`");

                $row = mysqli_fetch_row($result);
                $policy = $row[0];
                echo nl2br($policy);
                
                mysqli_close($link);
            ?>
        </p>

        <form action="Scripts/php/editPolicy.php" method="post" id="policyForm">
            <textarea name="text" placeholder="Treść regulaminu"><?php echo $policy; ?></textarea>
            <button id="btn-save">ZAPISZ</button>
            <input type="button" value="ANULUJ" id="btn-closeForm">
        </form>
    </main>

    <footer id="Kontakt">
        <div class="footer_top">
            <div class="footer_top_left">
                <h1>
                    BMS rent
                    <a href="https://carforyou.com.pl" target="_blank"><img src="Images/logo2.webp" alt=""></a>
                </h1>
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
                        biuro@mbsrent.pl
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer_bottom">
            <a href="https://websidev.pl">© 2023 Patryk Piotrowski | Website by websidev.pl</a>
            <a href="Regulamin">Regulamin / Polityka prywatności</a>
        </div>
    </footer>
</body>
</html>