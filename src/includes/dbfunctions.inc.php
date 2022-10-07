<?php

    // Connect to database
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

?>