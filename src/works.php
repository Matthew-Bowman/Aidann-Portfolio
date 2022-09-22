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
</head>

<body>
    <nav>
        <section class="nav-brand">
            <a href="./index.html"><img src="./images/Logo.png" /></a>
        </section>
        <section class="nav-items">
            <ul>
                <li><a href="./index.html" class="paragraph">Home</a></li>
                <li><a href="./works.php" class="paragraph active">Works</a></li>
                <li><a href="./reviews.html" class="paragraph">Reviews</a></li>
                <li><a href="#" class="paragraph">Status</a></li>
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
            
            // Create connection
            $conn = new mysqli($servername, $username, "", $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM works";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<article class='project-card' id='".$row["work_id"]."'>";
                    echo     "<img src='".$row["thumbnail"]."' width='540px' height='375px'>";
                    echo     "<div class='card-footer'>";
                    echo         "<h3 class='subheading blue'>".$row["type"]."</h3>";
                    echo         "<h2 class='heading'>".$row["name"]."</h2>";
                    echo         "<p class='paragraph'>".$row["description"]."</p>";
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