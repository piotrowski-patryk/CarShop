<?php
    session_start();

    //Function - Formula login
    function LoginFormula($login, $password) {
            
        $FormulaEmail = "/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/";
        $FormulaPass = "@^[a-zA-Z0-9'#''_''-''.']+$@";

        if (preg_match($FormulaEmail, $login) && preg_match($FormulaPass, $password) && (strlen($password) >= 5) && (strlen($password) <= 32)) {
            return true;
        } else {
            return false;
        }
    }


    //Login system
    if (!empty($_POST['login']) && !empty($_POST['password'])) {

        $login = $_POST['login'];
        $password = $_POST['password'];

        if (LoginFormula($login, $password) == true) {

            require_once "connect.php";
            $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            $result = mysqli_query($link, "SELECT Email, Pass FROM users WHERE Email='$login'");

            if (mysqli_num_rows($result) > 0) {

                foreach( $result as $row ) {
                    $db_pass = $row["Pass"];

                    mysqli_free_result($result);
                    mysqli_close($link);

                    if (password_verify($password, $db_pass)) {

                        $_SESSION['login'] = $login;

                        unset($_SESSION['login-error']);
                        header('Location: ../../StronaGłówna');
                        exit();

                    } else {
                        $_SESSION['login-error'] = '<i class="bi bi-exclamation-diamond login_error"></i>';
                        header('Location: ../../Logowanie');
                        exit();
                    }
                }

            } else {
                mysqli_free_result($result);
                mysqli_close($link);

                $_SESSION['login-error'] = '<i class="bi bi-exclamation-diamond login_error"></i>';
                header('Location: ../../Logowanie');
                exit();
            }
            
        } else {
            $_SESSION['login-error'] = '<i class="bi bi-exclamation-diamond login_error"></i>';
            header('Location: ../../Logowanie');
            exit();
        }

    } else {
        $_SESSION['login-error'] = '<i class="bi bi-exclamation-diamond login_error"></i>';
        header('Location: ../../Logowanie');
        exit();
    }
?>