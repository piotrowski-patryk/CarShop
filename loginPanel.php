<?php
    session_start();
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
    <link rel="stylesheet" href="CSS/login.css">
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
        </header>
    </div>

    <form action="Scripts/php/login.php" method="post">
        <div>
            <i class="fa-solid fa-user"></i>
        </div>
        <h1>ADMIN PANEL</h1>

        <label>
            <i class="fa-solid fa-user login_icon"></i>
            <input type="login" name="login" placeholder="Email">
            <?php
                if (isset($_SESSION['login-error'])) {
                    echo $_SESSION['login-error'];
                }
            ?>
        </label>

        <label>
            <i class="fa-solid fa-lock login_icon"></i>
            <input type="password" name="password" placeholder="Hasło">
            <?php
                if (isset($_SESSION['login-error'])) {
                    echo $_SESSION['login-error'];
                    unset($_SESSION['login-error']);
                }
            ?>
        </label>

        <a href="ZmianaHasła">Zapomniałem hasła</a>
        <button>ZALOGUJ</button>
    </form>

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