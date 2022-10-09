<?php 
    // Start Session
    session_start();

    // Include DBFunctions
    require_once 'includes/dbfunctions.inc.php';

    $page = "./reviews.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>

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
    <link rel="stylesheet" type="text/css" href="./css/reviews.css">

    <!-- Script to Store Carousel Data -->
    <script type="text/javascript">
        let pictures = [];
    </script>

    <!-- Carousel Script -->
    <script type="text/javascript" src="./js/cards.js" defer>
    </script>

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

    <header>
        <article class="section-title">
            <span></span>
            <h5 class="title">Reviews</h5>
            <img src="./images/Icons/Reviews.png" height="48" />
        </article>
        <h2 class="heading">Check out the reviews by former clients!</h2>
    </header>

    <section class="reviews">
        <?php

            $result = SelectReviews();
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<article class='reviews-card' id='".$row["review_id"]."'>";
                    echo     "<img src='".$row["thumbnail"]."' class='thumbnail'>";
                    echo     "<div class='card-footer'>";
                    echo         "<h3 class='subheading blue'>".$row["rating"]."</h3>";
                    echo         "<h2 class='heading'>".$row["name"]."</h2>";
                    echo         "<p class='paragraph'>".$row["description"]."</p>";
                    echo         "<div class='carousel-container hidden'>";
                    echo             "<input class='carousel-item' hidden value='".$row["thumbnail"]."' />";
                    if($row["images"] != "") { 
                        $splitImages = explode(",", $row["images"]);
                        for($index = 0; $index < count($splitImages); $index++) {
                            echo         "<input class='carousel-item' hidden value='".$splitImages[$index]."' />";
                        }
                    }
                    echo         "</div>";
                    echo     "</div>";
                    echo "</article>";
                }
            } else {
                echo "0 results";
            }
            
            $conn->close();
        ?>
    </section>

    <section class="carousel-viewer">
        <button id="button-left" class="carousel-controls"><span class="material-symbols-outlined carousel-controls">arrow_back</span></button>
        <img src="" class="carousel-controls" />
        <button id="button-right" class="carousel-controls"><span class="material-symbols-outlined carousel-controls">arrow_forward</span></button>
    </section>

    <footer>
        <h2>Aidann &#174; 2022</h2>
        <p>All rights reserved</p>
    </footer>
</body>

</html>