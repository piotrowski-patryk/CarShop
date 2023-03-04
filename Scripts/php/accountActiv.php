<?php
    session_start();

    if (!isset($_GET['id']) && !isset($_GET['email']) && !isset($_GET['code'])) {
        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            $code = bin2hex(random_bytes(32));
    
            require_once "connect.php";
            $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            $result = mysqli_query($link, "INSERT INTO users(Email, EmailVerification, Code) VALUES ('$email','no','$code')");
    
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
                        <p>Aktywacja konta w MBS rent:</p>
                        <a href='https://localhost/carshop/EdycjaHasła?code=".$code."' class='activBtn'>AKTYWUJ</a>
                    </div>

                    <p>Jeśli nie podawałeś tego e-maila, zignoruj tą wiadomość.</p>
                </main>
            ";

            sendMail($email, 'Aktywacja konta MBS rent:', $message);
    
            mysqli_close($link);
            header('Location: ../../Zarządzanie');
    
        } else {
            header('Location: ../../Zarządzanie');
        }

    } else {
        if (!empty($_POST['password'])) {
            $id = $_GET['id'];
            $email = $_GET['email'];
            $password = $_POST['password'];
            $passwordReap = $_POST['passwordReap'];

            if ((PassFormula($password) == true) && ($password == $passwordReap)) {
                $password = password_hash($password, PASSWORD_DEFAULT);

                require_once "connect.php";
                $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                $result = mysqli_query($link, "UPDATE users SET Pass='$password', EmailVerification='yes', Code='' WHERE ID='$id'");
                
                mysqli_close($link);

                $_SESSION['login'] = $email;
                header('Location: ../../StronaGłówna');
                
            } else {
                $_SESSION['login-error'] = '<i class="bi bi-exclamation-diamond login_error"></i>';
                header('Location: ../../EdycjaHasła?code='.$_GET['code']);
            }

        } else {
            $_SESSION['login-error'] = '<i class="bi bi-exclamation-diamond login_error"></i>';
            header('Location: ../../EdycjaHasła?code='.$_GET['code']);
        }
    }

    //Function - Formula password
    function PassFormula($password) {
            
        $FormulaPass = "@^[a-zA-Z0-9'#''_''-''.''$']+$@";

        if (preg_match($FormulaPass, $password) && (strlen($password) >= 5) && (strlen($password) <= 32)) {
            return true;
        } else {
            return false;
        }
    }
?>