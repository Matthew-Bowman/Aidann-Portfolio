<?php
// echo password_hash("password", PASSWORD_DEFAULT);
    if(isset($_POST["submit"])) {
        // Assign Variables
        $servername = getenv("db_host");
        $username = getenv("db_user");
        $dbname = getenv("db_name");
        
        $usr = $_POST["username"];
        $pwd = $_POST["password"];

        // Create connection
        $conn = new mysqli($servername, $username, "", $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?;");
        $stmt->bind_param("s", $usr);
        $stmt->execute();
        $result = $stmt->get_result();

        // Checks if username is in database
        if($result->num_rows > 0){
            $firstrow = $result->fetch_row();
            
            $uid = $firstrow[0];
            $fetchedUsername = $firstrow[1];
            $hashedPwd = $firstrow[2];

            if(password_verify($pwd, $hashedPwd)) {
                session_start();
                $_SESSION["username"] = $fetchedUsername;
            } else {
                header("Location: ./login.html");
                die();
            }
        } else {
            header("Location: ./login.html");
            die();
        }

    } else {
        header("Location: ./login.html");
        die();
    }
?>