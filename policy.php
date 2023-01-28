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
        <h1>Polityka prywatności</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut fuga porro nulla quae labore atque, earum corrupti quo officia consequatur ipsa, non explicabo ex excepturi nemo similique at iure maxime. Ad, veritatis nulla! Quidem, fugit. Deserunt ipsa facere, officia maxime saepe autem dolores asperiores deleniti minus quasi ad voluptatum ullam?</p>
        <ol>
            <li>
                <b>Lorem, ipsum dolor</b><br>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corporis obcaecati explicabo voluptatibus autem eius. Ea, dicta illum iste necessitatibus modi, culpa reprehenderit a officiis, pariatur voluptatem cumque ratione quasi eos quaerat magnam eius corporis! Temporibus deleniti animi excepturi ex blanditiis eligendi consequuntur distinctio quidem cupiditate dolor cumque, officia rerum vero.
            </li>

            <li>
                <b>Lorem, ipsum dolor</b><br>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corporis obcaecati explicabo voluptatibus autem eius. Ea, dicta illum iste necessitatibus modi, culpa reprehenderit a officiis, pariatur voluptatem cumque ratione quasi eos quaerat magnam eius corporis! Temporibus deleniti animi excepturi ex blanditiis eligendi consequuntur distinctio quidem cupiditate dolor cumque, officia rerum vero.
            </li>

            <li>
                <b>Lorem, ipsum dolor</b><br>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corporis obcaecati explicabo voluptatibus autem eius. Ea, dicta illum iste necessitatibus modi, culpa reprehenderit a officiis, pariatur voluptatem cumque ratione quasi eos quaerat magnam eius corporis! Temporibus deleniti animi excepturi ex blanditiis eligendi consequuntur distinctio quidem cupiditate dolor cumque, officia rerum vero.
            </li>

            <li>
                <b>Lorem, ipsum dolor</b><br>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corporis obcaecati explicabo voluptatibus autem eius. Ea, dicta illum iste necessitatibus modi, culpa reprehenderit a officiis, pariatur voluptatem cumque ratione quasi eos quaerat magnam eius corporis! Temporibus deleniti animi excepturi ex blanditiis eligendi consequuntur distinctio quidem cupiditate dolor cumque, officia rerum vero.
            </li>

            <li>
                <b>Lorem, ipsum dolor</b><br>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corporis obcaecati explicabo voluptatibus autem eius. Ea, dicta illum iste necessitatibus modi, culpa reprehenderit a officiis, pariatur voluptatem cumque ratione quasi eos quaerat magnam eius corporis! Temporibus deleniti animi excepturi ex blanditiis eligendi consequuntur distinctio quidem cupiditate dolor cumque, officia rerum vero.
            </li>

            <li>
                <b>Lorem, ipsum dolor</b><br>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corporis obcaecati explicabo voluptatibus autem eius. Ea, dicta illum iste necessitatibus modi, culpa reprehenderit a officiis, pariatur voluptatem cumque ratione quasi eos quaerat magnam eius corporis! Temporibus deleniti animi excepturi ex blanditiis eligendi consequuntur distinctio quidem cupiditate dolor cumque, officia rerum vero.
            </li>

            <li>
                <b>Lorem, ipsum dolor</b><br>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corporis obcaecati explicabo voluptatibus autem eius. Ea, dicta illum iste necessitatibus modi, culpa reprehenderit a officiis, pariatur voluptatem cumque ratione quasi eos quaerat magnam eius corporis! Temporibus deleniti animi excepturi ex blanditiis eligendi consequuntur distinctio quidem cupiditate dolor cumque, officia rerum vero.
            </li>
        </ol>
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