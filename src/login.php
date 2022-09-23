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
                <li><a href="./login.php" class="active"><img src="./images/Icons/Profile.png" /></a></li>
            </ul>
        </section>
    </nav>

    <section class="login-container">
        <h1 class="heading light">Login</h1>
        <form>
            <div class="input-container">
                <img src="./images/Icons/User.png" />
                <input type="text" placeholder="Username" class="heading" />
            </div>
            <div class="input-container">
                <img src="./images/Icons/Password.png" />
                <input type="password" placeholder="Password" class="heading" />
            </div>
            <button type="submit" class="heading">Login</button>
        </form>
    </section>
</body>

</html>