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
        if(!isset($_POST)) {
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
            // Prepare and execute statement
            $stmt = $conn->prepare("DELETE FROM works WHERE work_id=?");
            $stmt->bind_param("i", $_POST["id"]);
            $stmt->execute();

            // Redirect back
            header("Location: ./admin.php");
        }
    }

?>