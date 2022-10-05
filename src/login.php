<?php 
    // Start Session
    session_start();
    $page = "./login.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Import Fonts -->
    <link rel="stylesheet" type="text/css" href="./css/ECB.css">
    <link rel="stylesheet" type="text/css" href="./css/typography.css">
    <!-- Imported Nav & Footer Styles -->
    <link rel="stylesheet" type="text/css" href="./css/nav.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <!-- Imported Global Styles -->
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <!-- Imported Page Specific Styles -->
    <link rel="stylesheet" type="text/css" href="./css/login.css">

    <!-- Import Google Font Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,0" rel="stylesheet">


    <!-- Connect to database -->
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
</head>

<body>
<nav>
        <section class="nav-brand">
            <a href="./index.php"><img src="./images/Logo.png" /></a>
        </section>
        <section class="nav-items">
            <ul>
                <?php 

                    // Perform Query
                    $sql = "SELECT * FROM navbar;";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {   
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo    "<li>";
                            // Write anchor
                            if($row['destination'] != "PROFILE")
                                echo    "<a href='".$row['destination']."'";
                            else {
                                // Check Session
                                if(!isset($_SESSION["username"]))
                                    echo"<a href='./login.php'";
                                else 
                                    echo"<a href='./admin.php'";
                            }

                            // Set Anchor Class & CLOSE ANCHOR OPENING TAG
                            if($row['destination'] == $page)
                                echo        " class='paragraph active'>";
                            else
                                echo        " class='paragraph'>";
                            
                            // Write Content
                            if($row['type'] == 'text')
                                echo            $row['content'];
                            elseif($row['type'] == 'icon')
                                echo            "<span class='material-symbols-outlined'>".$row['content']."</span>";

                            // Close Tags
                            echo        "</a>";
                            echo    "</li>";
                        }
                    }
                ?>
            </ul>
        </section>
    </nav>

    <section class="login-container">
        <h1 class="heading light">Login</h1>
        <form action="authenticate.php" method="post">
            <div class="input-container">
                <img src="./images/Icons/User.png" />
                <input type="text" name="username" placeholder="Username" class="heading" autocomplete="off" />
            </div>
            <div class="input-container">
                <img src="./images/Icons/Password.png" />
                <input type="password" name="password" placeholder="Password" class="heading" autocomplete="off" />
            </div>
            <button type="submit" name="submit" class="heading">Login</button>
        </form>
    </section>
</body>

</html>