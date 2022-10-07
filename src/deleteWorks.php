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
        if(!isset($_POST)) {
            header("Location: ./admin.php");
            die();
        } else {     
            RemoveWork($_POST["id"]);

            // Redirect back
            header("Location: ./admin.php");
        }
    }

?>