<?php 
    // Start Session
    session_start();

    // Include DBFunctions
    require_once 'includes/dbfunctions.inc.php';

    $page = "./status.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aidann</title>

    <!-- Favicon -->
    <?php 
        echo "<link rel=\"icon\" href=\"".GetFavicon()->fetch_row()[1]."\" />";
    ?>

    <!-- Import Fonts -->
    <link rel="stylesheet" type="text/css" href="./css/ECB.css">
    <link rel="stylesheet" type="text/css" href="./css/typography.css">
    <!-- Imported Nav & Footer Styles -->
    <link rel="stylesheet" type="text/css" href="./css/nav.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <!-- Imported Global Styles -->
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <!-- Imported Page Specific Styles -->
    <link rel="stylesheet" type="text/css" href="./css/status.css">

    <!-- Import Google Font Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,0" rel="stylesheet">
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
                    $result = SelectNavbar();
                    
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

    <?php

    $result = SelectOrderedStatus();
    
    if ($result->num_rows > 0) {
        // Initialise Variables
        $sectionCounter = 0;
        $previousType = null;
        
        // output data of each row
        while($row = $result->fetch_assoc()) {
            // Assign Variables
            $type = $row["type"];
            $content = $row["content"];

            // Write Subtitles
            if($type == "subtitle"){
                $sectionCounter++;
                if($sectionCounter > 1)
                    echo"</article></section>";
                echo "<section id='scrollable-".$sectionCounter."'>";

                echo "<article class='section-title'>";
                echo "<span></span>";
                echo "<h5 class='subheading'>".$row["content"]."</h5>";
            }

            if($type == "icon-google" and $previousType == "subtitle") {
                echo "<span class='material-symbols-outlined' style='font-size: 48px'>".$content."</span>";
            } elseif ($type == "icon-url" and $previousType == "subtitle") {
                echo "<span><img src='".$content."' class='icon' /></span>";
            }

            if ($previousType == "subtitle")
                echo "</article><article>";

            // Write Content
            if($type == "list-item" and $previousType != "list-item")
                echo "<ul class='paragraph'>";
            if($type == "list-item")
                echo "<li>".$content."</li>";;
            if($type != "list-item" and $previousType == "list-item")
                echo "</ul>";

            if($type == "title")
                echo "<h2 class='title'>".$content."</h2>";
            if($type == "heading")
                echo "<h4 class='heading'>".$content."</h4>";
            if($type == "inline-subheading")
                echo "<h5 class='subheading inline'>".$content."</h5></span>";
            if($type == "paragraph-heading")
                echo "<p class='heading'>".$content."</p>";
            if($type == "paragraph")
                echo "<p class='paragraph'>".$content."</p>";

            if($type == "icon-url" and $previousType != "subtitle")
                echo "<span class='contact-handle'><img src='".$content."' class='icon' />";
            if($type == "icon-google" and $previousType != "subtitle")
                echo "<span class='contact-handle'><span class='material-symbols-outlined' style='font-size: 32px'>".$content."</span>";

            $previousType = $row["type"];
        }

        if($previousType == "list-type")
            echo "</ul>";

        echo "</article></section>";
    }
    
    $conn->close();
    
    ?>

    <footer>
        <h2>Aidann &#174; 2022</h2>
        <p>All rights reserved</p>
    </footer>
</body>
</html>