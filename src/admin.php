<?php 
    session_start();
    if(!isset($_SESSION["username"])) {
        header("Location: ./login.html");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Import Fonts -->
    <link rel="stylesheet" type="text/css" href="./css/ECB.css">
    <link rel="stylesheet" type="text/css" href="./css/typography.css">
    <!-- Imported Nav & Footer Styles -->
    <link rel="stylesheet" type="text/css" href="./css/nav.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <!-- Imported Global Styles -->
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <!-- Imported Page Specific Styles -->
    <link rel="stylesheet" type="text/css" href="./css/admin.css">

    <!-- Import JavaScript -->
    <script src="./js/admin.js" type="text/javascript" defer></script>
</head>

<body>
    <nav>
        <section class="nav-brand">
            <a href="./index.html"><img src="./images/Logo.png" /></a>
        </section>
        <section class="nav-items">
            <ul>
                <li><a href="./index.html" class="paragraph">Home</a></li>
                <li><a href="./works.php" class="paragraph">Works</a></li>
                <li><a href="./reviews.php" class="paragraph">Reviews</a></li>
                <li><a href="#" class="paragraph">Status</a></li>
                <li><a href="./login.html" class="active"><img src="./images/Icons/Profile.png" /></a></li>
            </ul>
        </section>
    </nav>

    <header>
        <article class="section-title">
            <h5 class="title">Admin Panel</h5>
            <img src="./images/Icons/Admin.png" height="48" />
        </article>
        <article class="subheading">
            <?php 
                echo "<p>".$_SESSION["username"]."</p>";
            ?>
            <p>Admin</p>
        </article>
    </header>

    <section class="container">
        <article class="panel">
            <ul class="subheading medium">
                <li class="panel-subtitle subheading bold"><span></span>Edit</li>
                <li class="panel-option active" id="selecetor-home"><img src="./images/Icons/Pencil.png" width="32" />Edit Home</li>
                <li class="panel-option" id="selecetor-works"><img src="./images/Icons/Pencil.png" width="32" />Edit Works</li>
                <li class="panel-option" id="selecetor-reviews"><img src="./images/Icons/Pencil.png" width="32" />Edit Reviews</li>
                <li class="panel-option" id="selecetor-status"><img src="./images/Icons/Pencil.png" width="32" />Edit Status</li>
                <li class="panel-subtitle subheading bold"><span></span>Website</li>
                <li class="panel-option" id="selecetor-webstatus"><img src="./images/Icons/Pencil.png" width="32" />Edit Status</li>
                <li class="panel-subtitle subheading bold"><span></span>Account</li>
                <li class="panel-option" id="selecetor-pass"><img src="./images/Icons/CircleLock.png" width="32" />Reset Pass</li>
                <li class="panel-option" id="selecetor-auth">
                    <div><img src="./images/Icons/Lock.png" width="24" /></div>2-Step Auth
                </li>
            </ul>
        </article>

        <!-- Connect to Database -->
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
        
        ?>

        <article class="content">
            <section id="option-home">
                <h1>Home</h1>
            </section>
            <section id="option-works">
                <h1>Works</h1>
            </section>
            <section id="option-reviews">
                <h1>Reviews</h1>
            </section>
            <section id="option-status">
                <h1>Status</h1>
            </section>
            <section id="option-webstatus">
            <h1>Website Status</h1>
            </section>
            <section id="option-pass">
                <h1>Password</h1>
            </section>
            <section id="option-auth">
                <h1>2-Factor-Authentication</h1>
            </section>
        </article>
    </section>
</body>

</html>