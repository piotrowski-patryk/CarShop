<?php
    session_start();

    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
        $code = bin2hex(random_bytes(32));

        require_once "connect.php";
        $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $result = mysqli_query($link, "SELECT Email FROM users WHERE Email='$email'");

        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_query($link, "UPDATE users SET Code='$code' WHERE Email='$email'");

            require_once "sendMail.php";
            $message = "
                <link href='https://fonts.googleapis.com/css2?family=Righteous&display=swap' rel='stylesheet'>
                <style>
                    body {
                        background: whitesmoke;
                        border-radius: 8px;
                    }

                    header {
                        width: 100%;
                        height: 90px;
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        border-bottom: 2px solid #e02021;
                    }

                    header h1 {
                        font-size: 38px;
                        font-weight: bold;
                        margin-left: 17px;
                        color: #e02021;
                    }

                    header div {
                        margin-right: 17px;
                        display: flex;
                        flex-direction: column;
                        align-items: flex-end;
                        justify-content: space-evenly;
                    }

                    header div p {
                        color: #343444;
                        font-size: 15px;
                        margin-top: 5px;
                        margin-bottom: 5px;
                    }

                    main {
                        width: 100%;
                        min-height: 300px;
                        max-height: max-content;
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: center;
                    }

                    main div {
                        height: 70px;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                        align-items: center;
                        margin-bottom: 60px;
                    }

                    main div p {
                        color: #343444;
                        font-size: 18px;
                        text-align: center;
                    }

                    .activBtn {
                        font-size: 18px;
                        background-color: #e02021;
                        border-radius: 10px;
                        padding: 12px 30px 12px 30px;
                        text-decoration: none;
                        color: whitesmoke;
                    }

                    .activBtn:hover {
                        cursor: pointer;
                        margin-top: 0.5px;
                        padding: 11px 33px 11px 33px;
                    }

                    main p {
                        color: gray;
                        font-size: 15px;
                        text-align: center;
                    }
                </style>
                
                <header>
                    <h1>MBS rent</h1>
                    <div>
                        <p>517 773 999</p>
                        <p>Wypożyczalnia samochodów</p>
                    </div>
                </header>

                <main>
                    <div>
                        <p>Zmiana hasła w MBS rent:</p>
                        <a href='https://localhost/carshop/EdycjaHasła?code=".$code."' class='activBtn'>ZMIEŃ</a>
                    </div>

                    <p>Jeśli nie podawałeś tego e-maila, zignoruj tą wiadomość.</p>
                </main>
            ";

            sendMail($email, 'Zmiana hasła MBS rent:', $message);

            mysqli_close($link);

            $_SESSION['login-error'] = '<i class="fa-solid fa-check login_error-correct"></i>';
            header('Location: ../../ZmianaHasła');

        } else {
            mysqli_close($link);

            $_SESSION['login-error'] = '<i class="bi bi-exclamation-diamond login_error"></i>';
            header('Location: ../../ZmianaHasła');
        }

    } else {
        $_SESSION['login-error'] = '<i class="bi bi-exclamation-diamond login_error"></i>';
        header('Location: ../../ZmianaHasła');
    }
?>