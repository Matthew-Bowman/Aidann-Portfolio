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
            $dbpass = getenv("db_pass");
            
            // Create connection
            $conn = new mysqli($servername, $username, $dbpass, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }    
            
            // Parse for data into array of KVP
            $sortedPostData = array();
            
            for($index = 0; $index < count($_POST["type"]); $index++) {
                $sortedPostData[$index]["type"] = $_POST["type"][$index];
            }
            for($index = 0; $index < count($_POST["content"]); $index++) {
                $sortedPostData[$index]["content"] = $_POST["content"][$index];
            }
            for($index = 0; $index < count($_POST["destination"]); $index++) {
                $sortedPostData[$index]["destination"] = $_POST["destination"][$index];
            }

            // Reset table
            $stmt = $conn->prepare("DELETE FROM navbar");
            $stmt->execute();

            // Testing KVP Assignment
            foreach($sortedPostData as $element) {
                // Update data
                $stmt = $conn->prepare("INSERT INTO navbar (type, content, destination) VALUES (?, ?, ?);");
                $stmt->bind_param("sss", $element["type"], $element["content"], $element["destination"]);
                $stmt->execute();
                
                // Redirect back
                header("Location: ./admin.php");
                
            }
        }
    }

?>