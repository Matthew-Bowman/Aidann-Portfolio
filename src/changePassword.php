<?php
    // Start Session
    session_start();

    // Include DBFunctions
    require_once 'includes/dbfunctions.inc.php';

    // Check Session
    if(!isset($_SESSION["username"]))
    {
        header("Location: ./index.html");
        die();
    } 
    else 
    {
        // Check for Form Post
        if(!isset($_POST["submit"])) {
            header("Location: ./admin.php");
            die();
        } else {
            // Parse for data into array of KVP
            $pwd = $_POST["password"];

            // Testing KVP Assignment
            ChangePassword(password_hash($pwd, PASSWORD_BCRYPT));

            // Delete All Sessions
            shell_exec("rm -rf ".session_save_path());
                    
            // Redirect to logout endpoint
            header("Location: ./logout.php");
        }
    }

?>