<?php
    // Start Session
    session_start();

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
            // CONNECT to database
            // Assign Variables
            $servername = getenv("db_host");
            $username = getenv("db_user");
            $dbname = getenv("db_name");
            
            // Create connection
            $conn = new mysqli($servername, $username, "", $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }    
            
            // Parse for data into array of KVP
            $sortedPostData = array();
            
            for($index = 0; $index < count($_POST["type"]); $index++) {
                $sortedPostData[$index]["type"] = $_POST["type"][$index];
                $sortedPostData[$index]["position"] = $index;
            }
            for($index = 0; $index < count($_POST["content"]); $index++) {
                $sortedPostData[$index]["content"] = $_POST["content"][$index];
            }

            // Reset table
            $stmt = $conn->prepare("DELETE FROM homepage");
            $stmt->execute();

            // Testing KVP Assignment
            foreach($sortedPostData as $element) {
                // Update data
                $stmt = $conn->prepare("INSERT INTO homepage (position, type, content) VALUES (?, ?, ?);");
                $stmt->bind_param("iss", $element["position"], $element["type"], $element["content"]);
                $stmt->execute();
                
                // Redirect back
                header("Location: ./admin.php");
                
            }
        }
    }

?>