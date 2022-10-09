<?php 
    session_start();
    if(!isset($_SESSION["username"])) {
        header("Location: ./login.html");
        die();
    }

    require_once 'includes/dbfunctions.inc.php';

    $page = "./admin.php";
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

    <!-- Import Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,200" />
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
                <li class="panel-option active" id="selecetor-home"><img src="./images/Icons/Pencil.png" width="32" />Home</li>
                <li class="panel-option" id="selecetor-works"><img src="./images/Icons/Pencil.png" width="32" />Works</li>
                <li class="panel-option" id="selecetor-reviews"><img src="./images/Icons/Pencil.png" width="32" />Reviews</li>
                <li class="panel-option" id="selecetor-status"><img src="./images/Icons/Pencil.png" width="32" />Status</li>
                <li class="panel-subtitle subheading bold"><span></span>Website</li>
                <li class="panel-option" id="selecetor-webstatus"><img src="./images/Icons/Pencil.png" width="32" />Navigation</li>
                <li class="panel-subtitle subheading bold"><span></span>Account</li>
                <li class="panel-option" id="selecetor-pass"><img src="./images/Icons/CircleLock.png" width="32" />Reset Pass</li>
                <!-- <li class="panel-option" id="selecetor-auth">
                    <div><img src="./images/Icons/Lock.png" width="24" /></div>2-Step Auth
                </li> -->
            </ul>
        </article>

        <article class="content">
            <section id="option-home">
                <h1 class="heading">Home</h1>
                <form action="./updateHomepage.php" method="post">
                    <?php 
                    
                        $result = SelectOrderedHomepage();

                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $type = $row["type"];
                                $content = $row["content"];
                                
                                echo "<fieldset class='homepage-fieldset "; if($type!="subtitle") echo "indent"; echo "'>";
                                echo    "<select name='type[]' class='type-select subheading homepage-selector'>";
                                echo        "<option value='title'"; if($type=="title") echo "selected"; echo ">Title</option>";
                                echo        "<option value='subtitle'"; if($type=="subtitle") echo "selected"; echo ">Subtitle</option>";
                                echo        "<option value='heading'"; if($type=="heading") echo "selected"; echo ">Heading</option>";
                                echo        "<option value='inline-subheading'"; if($type=="inline-subheading") echo "selected"; echo ">Inline Subheading</option>";
                                echo        "<option value='paragraph-headinng'"; if($type=="paragraph-heading") echo "selected"; echo ">Paragraph Heading</option>";
                                echo        "<option value='paragraph'"; if($type=="paragraph") echo "selected"; echo ">Paragraph</option>";
                                echo        "<option value='list-item'"; if($type=="list-item") echo "selected"; echo ">List Item</option>";
                                echo        "<option value='icon-google'"; if($type=="icon-google") echo "selected"; echo ">Google Icon</option>";
                                echo        "<option value='icon-url'"; if($type=="icon-url") echo "selected"; echo ">Icon URL</option>";
                                echo    "</select>";
                                echo    "<textarea name='content[]' class='paragraph homepage-textarea auto-resize' maxlength='255'>".$content."</textarea>";
                                echo    "<div class='homepage-button-container'>";
                                echo        "<button class='homepage-button' id='up'><span class='material-symbols-outlined'>arrow_upward</span></button>";
                                echo        "<button class='homepage-button' id='delete'><span class='material-symbols-outlined'>delete</span></button>";
                                echo        "<button class='homepage-button' id='down'><span class='material-symbols-outlined'>arrow_downward</span></button>";
                                echo    "</div>";
                                echo "</fieldset>";
                            }
                        }
                    
                    ?>

                    <button class="form-submit-button subheading" id="homepage-add">Add new</button>
                    <input Type="submit" name="submit" class="form-submit-button heading" />
                </form>
            </section>
            <section id="option-works">
                <h1 class="heading">Works</h1>
                <form action="./addWorks.php" method="post">
                    <?php
                    
                        $result = SelectWorks();
                        
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<fieldset class='option-card' id='".$row["work_id"]."'>";
                                echo     "<img src='".$row["thumbnail"]."' width='540px' height='375px'>";
                                echo     "<div class='card-footer'>";
                                echo         "<input name='id[]' value='".$row["work_id"]."' type='hidden' />";
                                echo         "<input name='thumbnail[]' class='paragraph img-url' value='".$row["thumbnail"]."'  maxlength='255' />";
                                echo         "<input name='type[]' class='subheading blue' value='".$row["type"]."' maxlength='255' />";
                                echo         "<input name='name[]' class='heading' value='".$row["name"]."' maxlength='255' />";
                                echo         "<textarea name='description[]' class='paragraph auto-resize' maxlength='255'>".$row["description"]."</textarea>";
                                echo         "<textarea name='images[]' class='paragraph auto-resize' max-length='255'>".$row["images"]."</textarea>";
                                echo         "<button class='subheading delete-button' id='delete-work' data-id='".$row["work_id"]."'>Delete</button>";
                                echo     "</div>";
                                echo "</fieldset>";
                            }
                        }
                    ?>
                    <div class="option-card card-placeholder" id="placeholder-work">
                        <div class="img-placeholder">
                            <h2 class="title">Placeholder</h2>
                            <p class="paragraph">Click to create card</p>
                        </div>
                        <div class="card-footer">
                            <h3 class="subeading blue">Type</h3>
                            <h2 class="heading">Name</h2>
                            <p class="paragraph">Description</p>
                        </div>
                    </div>
                    <button class="form-submit-button works-submit subheading" name="submit" type="submit">Submit</button>
                </form>
            </section>
            <section id="option-reviews">
                <h1 class="heading">Reviews</h1>
                <form action="./addReview.php" method="post">
                    <?php
                    
                        $result = SelectReviews();
                        
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<fieldset class='option-card' id='".$row["review_id"]."'>";
                                echo     "<img src='".$row["thumbnail"]."' width='540px' height='375px'>";
                                echo     "<div class='card-footer'>";
                                echo         "<input name='id[]' value='".$row["review_id"]."' type='hidden' />";
                                echo         "<input name='thumbnail[]' class='paragraph img-url' value='".$row["thumbnail"]."'  maxlength='255' />";
                                echo         "<input name='rating[]' class='subheading blue' value='".$row["rating"]."' maxlength='255' />";
                                echo         "<input name='name[]' class='heading' value='".$row["name"]."' maxlength='255' />";
                                echo         "<textarea name='description[]' class='paragraph auto-resize' maxlength='255'>".$row["description"]."</textarea>";
                                echo         "<textarea name='images[]' class='paragraph auto-resize' max-length='255'>".$row["images"]."</textarea>";
                                echo         "<button class='subheading delete-button' id='delete-review' data-id='".$row["review_id"]."'>Delete</button>";
                                echo     "</div>";
                                echo "</fieldset>";
                            }
                        }
                    ?>
                    <div class="option-card card-placeholder" id="placeholder-review">
                        <div class="img-placeholder">
                            <h2 class="title">Placeholder</h2>
                            <p class="paragraph">Click to create card</p>
                        </div>
                        <div class="card-footer">
                            <h3 class="subeading blue">Type</h3>
                            <h2 class="heading">Name</h2>
                            <p class="paragraph">Description</p>
                        </div>
                    </div>
                    <button class="form-submit-button reviews-submit subheading" name="submit" type="submit">Submit</button>
                </form>
            </section>
            <section id="option-status">
                <h1 class="heading">Status</h1>
                <form action="./updateStatus.php" method="post">
                    <?php 
                        $result = SelectOrderedStatus();

                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $type = $row["type"];
                                $content = $row["content"];
                                
                                echo "<fieldset class='homepage-fieldset "; if($type!="subtitle") echo "indent"; echo "'>";
                                echo    "<select name='type[]' class='type-select subheading homepage-selector'>";
                                echo        "<option value='title'"; if($type=="title") echo "selected"; echo ">Title</option>";
                                echo        "<option value='subtitle'"; if($type=="subtitle") echo "selected"; echo ">Subtitle</option>";
                                echo        "<option value='heading'"; if($type=="heading") echo "selected"; echo ">Heading</option>";
                                echo        "<option value='inline-subheading'"; if($type=="inline-subheading") echo "selected"; echo ">Inline Subheading</option>";
                                echo        "<option value='paragraph-headinng'"; if($type=="paragraph-heading") echo "selected"; echo ">Paragraph Heading</option>";
                                echo        "<option value='paragraph'"; if($type=="paragraph") echo "selected"; echo ">Paragraph</option>";
                                echo        "<option value='list-item'"; if($type=="list-item") echo "selected"; echo ">List Item</option>";
                                echo        "<option value='icon-google'"; if($type=="icon-google") echo "selected"; echo ">Google Icon</option>";
                                echo        "<option value='icon-url'"; if($type=="icon-url") echo "selected"; echo ">Icon URL</option>";
                                echo    "</select>";
                                echo    "<textarea name='content[]' class='paragraph homepage-textarea auto-resize' maxlength='255'>".$content."</textarea>";
                                echo    "<div class='homepage-button-container'>";
                                echo        "<button class='homepage-button' id='up'><span class='material-symbols-outlined'>arrow_upward</span></button>";
                                echo        "<button class='homepage-button' id='delete'><span class='material-symbols-outlined'>delete</span></button>";
                                echo        "<button class='homepage-button' id='down'><span class='material-symbols-outlined'>arrow_downward</span></button>";
                                echo    "</div>";
                                echo "</fieldset>";
                            }
                        }
                    
                    ?>

                    <button class="form-submit-button subheading" id="homepage-add">Add new</button>
                    <input Type="submit" name="submit" class="form-submit-button heading" />
                </form>
            </section>
            <section id="option-webstatus">
                <h1 class='heading navigation-heading'>Navigation</h1>
                <form action="./updateNavigation.php" method="post">
                    <?php
                    
                    $result = SelectNavbar();

                    if($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo  "<fieldset class='homepage-fieldset'>";
                            echo    "<select name='type[]' class='type-select paragraph'>";
                            echo      "<option value='text'"; if($row['type']=="text") echo "selected"; echo ">Text</option>";
                            echo      "<option value='icon'"; if($row['type']=="icon") echo "selected"; echo ">Icon</option>";
                            echo    "</select>";
                            echo    "<input name='content[]' type='text' value='".$row['content']."' class='navigation-input paragraph' maxlength='255' />";
                            echo    "<input name='destination[]' type='text' value='".$row['destination']."' class='navigation-input paragraph' maxlength='255' />";
                            echo  "</fieldset>";
                        }
                    }

                    ?>
                    <input type="submit" name="submit" class="form-submit-button subheading" />
                </form> 
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