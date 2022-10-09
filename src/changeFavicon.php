<?php
    // Start Session
    session_start();

    // Include DBFunctions
    require_once 'includes/dbfunctions.inc.php';

    // Check Session
    if(!isset($_SESSION["username"]))
    {
        header("Location: ./index.php");
        die();
    } 
    else 
    {
        // Check for Form Post
        if(!isset($_POST["submit"])) {
            header("Location: ./admin.php");
            die();
        } else {
            // Delete Favicon Record
            DeleteFavicon();

            // Set Favicon
            SetFavicon($_POST["url"]);
                    
            // Redirect to logout endpoint
            header("Location: ./admin.php");
        }
    }

?>