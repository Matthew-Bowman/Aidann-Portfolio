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
            $sortedPostData = array();
            
            for($index = 0; $index < count($_POST["type"]); $index++) {
                $sortedPostData[$index]["type"] = $_POST["type"][$index];
                $sortedPostData[$index]["content"] = $_POST["content"][$index];
                $sortedPostData[$index]["destination"] = $_POST["destination"][$index];
            }

            // Reset table
            DeleteNavbar();

            // Testing KVP Assignment
            foreach($sortedPostData as $element) {
                // Update data
                InsertNavbar($element);                
            }
            // Redirect back
            header("Location: ./admin.php");
        }
    }

?>