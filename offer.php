<?php
    session_start();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: 404');
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
    <link rel="stylesheet" href="CSS/offer.css">
    <link rel="stylesheet" href="CSS/components/nav.css">
    <link rel="stylesheet" href="CSS/components/footer.css">

    <!-----------------| Scripts |----------------->
    <script defer src="Scripts/JS/mobileMenu.js"></script>
    <script defer src="Scripts/JS/offerInfo.js"></script>

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
        <section class="offer_top">
            <?php
                require_once "Scripts/php/connect.php";
                $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                $result = mysqli_query($link, "SELECT * FROM cars WHERE id='$id'");

                foreach ($result as $row) {
                    echo '
                    <img src="Images/Offers/'.$row['Picture'].'" alt="" class="offer_top_img">

                    <div class="offer_top_data">
                        <div class="offer_top_data_item" id="offerInfo-1" data-id="1" onclick="offerInfo(this)">
                            <h1>Dane pojazdu</h1>
                            <div class="data_item_icon">
                                <i class="bi bi-chevron-up"></i>
                            </div>

                            <div class="data_item_content">
                                <div>
                                    <span>MARKA:</span>
                                    <H1>'.$row['Mark'].'</H1>
                                </div>

                                <div>
                                    <span>MODEL:</span>
                                    <H1>'.$row['Model'].'</H1>
                                </div>

                                <div>
                                    <span>PALIWO:</span>
                                    <H1>'.$row['Fuel'].'</H1>
                                </div>

                                <div>
                                    <span>NADWOZIE:</span>
                                    <H1>'.$row['Body'].'</H1>
                                </div>

                                <div>
                                    <span>SKRZYNIA BIEGÓW:</span>
                                    <H1>'.$row['Gearbox'].'</H1>
                                </div>
                            </div>
                        </div>

                        <div class="offer_top_data_item" id="offerInfo-2" data-id="2" onclick="offerInfo(this)">
                            <h1>Wyposażenie</h1>
                            <div class="data_item_icon">
                                <i class="bi bi-chevron-down"></i>
                            </div>

                            <div class="data_item_content">
                                <div>
                                    <span>KLIMATYZACJA:</span>
                                    <H1>'.$row['AirConditioning'].'</H1>
                                </div>
                            </div>
                        </div>

                        <div class="offer_top_data_item" id="offerInfo-3" data-id="3" onclick="offerInfo(this)">
                            <h1>Inne</h1>
                            <div class="data_item_icon">
                                <i class="bi bi-chevron-down"></i>
                            </div>

                            <div class="data_item_content">
                                <div>
                                    <span>DOSTĘPNE MIEJSCE:</span>
                                    <H1>'.$row['Space'].'</H1>
                                </div>
                            </div>
                        </div>
                    </div>';
                }

                mysqli_free_result($result);
                mysqli_close($link);
            ?>
        </section>

        <section class="offer_bottom">
            <?php
                require_once "Scripts/php/connect.php";
                $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                $result = mysqli_query($link, "SELECT * FROM rentalprices WHERE ID='$id'");

                foreach ($result as $row) {
                    if (!isset($_SESSION['login'])) { echo '
                        <table>
                            <tr class="offerTable-dark">
                                <th>Limit km.</th>
                                <th>1 - 3 dni</th>
                                <th>4 - 14 dni</th>
                                <th>15 - 29 dni</th>
                                <th>30 - <i class="fa-solid fa-infinity"></i> dni</th>
                            </tr>

                            <tr>
                                <th>200 km./doba</th>
                                <td>'.$row['Unlimited-1'].'</td>
                                <td>'.$row['Unlimited-2'].'</td>
                                <td>'.$row['Unlimited-3'].'</td>
                                <td>'.$row['Unlimited-4'].'</td>
                            </tr>

                            <tr class="offerTable-dark">
                                <th>Bez limitu km.</th>
                                <td>'.$row['Limited-1'].'</td>
                                <td>'.$row['Limited-2'].'</td>
                                <td>'.$row['Limited-3'].'</td>
                                <td>'.$row['Limited-4'].'</td>
                            </tr>
                        </table>';

                    } else { echo '
                        <form action="Scripts/php/editPrice.php?id='.$id.'" method="post" autocomplete="off">
                            <table>
                                <tr class="offerTable-dark">
                                    <th>Limit km.</th>
                                    <th>1 - 3 dni</th>
                                    <th>4 - 14 dni</th>
                                    <th>15 - 29 dni</th>
                                    <th>30 - <i class="fa-solid fa-infinity"></i> dni</th>
                                </tr>

                                <tr>
                                    <th>200 km./doba</th>
                                    <td><input type="text" value="'.$row['Unlimited-1'].'" name="Unlimited-1"></td>
                                    <td><input type="text" value="'.$row['Unlimited-2'].'" name="Unlimited-2"></td>
                                    <td><input type="text" value="'.$row['Unlimited-3'].'" name="Unlimited-3"></td>
                                    <td><input type="text" value="'.$row['Unlimited-4'].'" name="Unlimited-4"></td>
                                </tr>

                                <tr class="offerTable-dark">
                                    <th>Bez limitu km.</th>
                                    <td><input type="text" value="'.$row['Limited-1'].'" name="Limited-1"></td>
                                    <td><input type="text" value="'.$row['Limited-2'].'" name="Limited-2"></td>
                                    <td><input type="text" value="'.$row['Limited-3'].'" name="Limited-3"></td>
                                    <td><input type="text" value="'.$row['Limited-4'].'" name="Limited-4"></td>
                                </tr>
                            </table>
                            <button><i class="fa-solid fa-pen-to-square"></i> EDYTUJ</button>
                        </form>';
                    }
                }

                mysqli_free_result($result);
                mysqli_close($link);
            ?>
        </section>
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