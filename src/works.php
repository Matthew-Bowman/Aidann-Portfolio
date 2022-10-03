<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Works</title>

    <!-- Import Fonts -->
    <link rel="stylesheet" type="text/css" href="./css/ECB.css">
    <link rel="stylesheet" type="text/css" href="./css/typography.css">
    <!-- Imported Nav & Footer Styles -->
    <link rel="stylesheet" type="text/css" href="./css/nav.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <!-- Imported Global Styles -->
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <!-- Imported Page Specific Styles -->
    <link rel="stylesheet" type="text/css" href="./css/works.css">

    <!-- Import JavaScript -->
    <script src="./js/cards.js" defer></script>
    
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
                <li><a href="./index.php" class="paragraph">Home</a></li>
                <li><a href="./works.php" class="paragraph active">Works</a></li>
                <li><a href="./reviews.php" class="paragraph">Reviews</a></li>
                <li><a href="./status.php" class="paragraph">Status</a></li>
                <li><a href="./login.html"><img src="./images/Icons/Profile.png" /></a></li>
            </ul>
        </section>
    </nav>

    <header>
        <article class="section-title">
            <span></span>
            <h5 class="title">Works</h5>
            <img src="./images/Icons/Works.png" height="48"/>
        </article>
        <h2 class="heading">Check out the previous works I've done here!</h2>
    </header>

    <section class="projects">
        <?php
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

            $sql = "SELECT * FROM works;";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<article class='project-card' id='".$row["work_id"]."'>";
                    echo     "<img class='thumbnail' src='".$row["thumbnail"]."'>";
                    echo     "<div class='card-footer'>";
                    echo         "<h3 class='subheading blue'>".$row["type"]."</h3>";
                    echo         "<h2 class='heading'>".$row["name"]."</h2>";
                    echo         "<p class='paragraph'>".$row["description"]."</p>";
                    echo         "<div class='carousel-container hidden'>";
                    echo         "<span class='material-symbols-outlined move-left' style='font-size: 64px'>arrow_left</span>";
                    echo             "<img class='carousel-item' src='".$row["thumbnail"]."' />";
                    $splitImages = explode(",", $row["images"]);
                    for($index = 0; $index < count($splitImages); $index++) {
                        echo         "<img class='carousel-item hidden' src='".$splitImages[$index]."' />";
                    }
                    echo             "<span class='material-symbols-outlined move-right' style='font-size: 64px'>arrow_right</span>";
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

    

    <footer>
        <h2>Aidann &#174; 2022</h2>
        <p>All rights reserved</p>
    </footer>
</body>

</html>