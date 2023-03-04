<?php
    session_start();

    require_once "Scripts/php/carsData.php";

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
    <link rel="stylesheet" href="CSS/components/nav.css">
    <link rel="stylesheet" href="CSS/components/header.css">
    <link rel="stylesheet" href="CSS/components/whyUs.css">
    <link rel="stylesheet" href="CSS/components/offers.css">
    <link rel="stylesheet" href="CSS/components/location.css">
    <link rel="stylesheet" href="CSS/components/footer.css">

    <!-----------------| Scripts |----------------->
    <script defer src="Scripts/JS/mobileMenu.js"></script>
    <script defer src="Scripts/JS/scrollingOffers.js"></script>

    <title>MBS rent</title>
</head>
<body>
    <header>
        <div>
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
        
            <div id="header_left">
                <h2>
                    <span>Nowość</span>
                    <?php
                        require_once "Scripts/php/connect.php";
                        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                        $result = mysqli_query($link, "SELECT text FROM allert");
                        $row = mysqli_fetch_row($result);

                        echo $row[0];

                        mysqli_free_result($result);
                        mysqli_close($link);
                    ?>
                </h2>
                <h1>Wypożyczalnia samochodów</h1>
                <p>MBS rent to wypożyczania samochodów w Warszawie z atrakcyjną i elastyczną ofertą dopasowaną do potrzeb Klientów indywidualnych i przedsiębiorców.</p>
                <a href="index.html#DlaczegoMy">
                    <i class="bi bi-chevron-down"></i>
                </a>
                <img src="Images/dots.svg" alt="">
            </div>

            <div id="header_right">
                <img src="Images/orbit.svg" alt="" id="header_orbit">
                <i class="bi bi-triangle-fill"></i>
                <img src="Images/nissan.png" alt="" id="header_car">
            </div>
        </div>
    </header>

    <section class="whyUs" id="DlaczegoMy">
        <div>
            <div class="whyUs_left">
                <h1>Dlaczego właśnie my?</h1>

                <div>
                    <div class="whyUs_left_punkts">
                        <div>1</div>
                        <div>2</div>
                        <div>3</div>
                        <div>4</div>
                    </div>

                    <div class="whyUs_left_text">
                        <p>Możliwy odbiór auta w każdym miejscu na terenie Warszawy.</p>
                        <p>Możliwe dostarczenie auta na terenie województwa mazowieckiego .</p>
                        <p>Niskie ceny, przejrzyste umowy, minimum formalności.</p>
                        <p>Najem krótkoterminowy, średnioterminowy, długoterminowy.</p>
                    </div>
                </div>
            </div>

            <div class="whyUs_right">
                <i class="bi bi-triangle-fill" id="whyUs_right_triangle"></i>
                <img src="Images/dots.svg" alt="" id="whyUs_right_dots">
                <img src="Images/graphic_whyUs.png" alt="" id="whyUs_right_graphic">
            </div>
        </div>
    </section>

    <section class="offers" id="Oferta">
        <div>
            <img src="Images/dots.svg" alt="">
            <i class="bi bi-triangle-fill"></i>

            <div class="offers_text">
                <h1>Nasze oferty</h1>

                <div>
                    <button id="OffersBtnLeft">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button id="OffersBtnRight">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
    
            <div class="offers_pictures"></div>
        </div>
    </section>

    <section class="location" id="Lokalizacja">
        <h1>Chcesz nas znaleźć?<br>Ten przycisk rozwiąże twój problem.</h1>
        <a href="https://www.google.pl/maps/place/Warszawa/@52.2328546,20.9207698,11z/data=!3m1!4b1!4m5!3m4!1s0x471ecc669a869f01:0x72f0be2a88ead3fc!8m2!3d52.2296756!4d21.0122287" target="_blank">
            <i class="fa-solid fa-location-dot"></i>
            ZLOKALIZUJ
        </a>
    </section>

    <main>
        
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