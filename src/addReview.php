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
            
            for($index = 0; $index < count($_POST["id"]); $index++) {
                $sortedPostData[$index]["id"] = $_POST["id"][$index];
                $sortedPostData[$index]["rating"] = $_POST["rating"][$index];
                $sortedPostData[$index]["name"] = $_POST["name"][$index];
                $sortedPostData[$index]["description"] = $_POST["description"][$index];
                $sortedPostData[$index]["thumbnail"] = $_POST["thumbnail"][$index];
                $sortedPostData[$index]["images"] = $_POST["images"][$index];
            }

            // Testing KVP Assignment
            foreach($sortedPostData as $review) {
                if ($review["id"] != "NULL") {
                    // Update data
                    UpdateReview($review);
                } else {
                    InsertReview($review);
                }
            }
                    
            // Redirect back
            header("Location: ./admin.php");
        }
    }

?>