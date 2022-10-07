<?php
    require_once 'includes/dbfunctions.inc.php';
    $usr = $_POST["username"];
    $pwd = $_POST["password"];  

    if(isset($_POST["submit"])) {
        $result = GetUser($usr);

        // Checks if username is in database
        if($result->num_rows > 0){
            $firstrow = $result->fetch_row();
            
            $uid = $firstrow[0];
            $fetchedUsername = $firstrow[1];
            $hashedPwd = $firstrow[2];

            if(password_verify($pwd, $hashedPwd)) {
                session_start();
                $_SESSION["username"] = $fetchedUsername;

                header("Location: ./admin.php");
                die();
            } else {
                header("Location: ./login.php");
                die();
            }
        } else {
            header("Location: ./login.php");
            die();
        }

    } else {
        header("Location: ./login.php");
        die();
    }
?>