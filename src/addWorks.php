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
            
            for($index = 0; $index < count($_POST["id"]); $index++) {
                $sortedPostData[$index]["id"] = $_POST["id"][$index];
            }
            for($index = 0; $index < count($_POST["type"]); $index++) {
                $sortedPostData[$index]["type"] = $_POST["type"][$index];
            }
            for($index = 0; $index < count($_POST["name"]); $index++) {
                $sortedPostData[$index]["name"] = $_POST["name"][$index];
            }
            for($index = 0; $index < count($_POST["description"]); $index++) {
                $sortedPostData[$index]["description"] = $_POST["description"][$index];
            }
            for($index = 0; $index < count($_POST["thumbnail"]); $index++) {
                $sortedPostData[$index]["thumbnail"] = $_POST["thumbnail"][$index];
            }

            // Testing KVP Assignment
            foreach($sortedPostData as $work) {
                if ($work["id"] != "NULL") {
                    // Update data
                    $stmt = $conn->prepare("UPDATE works SET type=?, name=?, description=?, thumbnail=? WHERE work_id = ?;");
                    $stmt->bind_param("ssssi", $work["type"], $work["name"], $work["description"], $work["thumbnail"], $work["id"]);
                    $stmt->execute();
                    
                    // Redirect back
                    header("Location: ./admin.php");
                } else {
                    // Insert Data
                    $stmt = $conn->prepare("INSERT INTO works (type, name, description, thumbnail) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $work["type"], $work["name"], $work["description"], $work["thumbnail"]);
                    $stmt->execute();
                    
                    // Redirect back
                    header("Location: ./admin.php");
                }
            }
        }
    }

?>