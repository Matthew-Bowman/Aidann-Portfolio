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

    /*************** REVIEWS METHODS ***************/

    /**
     * METHOD: Updates reviews table
     */
    function UpdateReview($data) {
        // SET conn Variable to Global
        global $conn;
        // PREPARE SQL Statement
        $sql = $conn->prepare("UPDATE reviews SET rating=?, name=?, description=?, thumbnail=?, images=? WHERE review_id = ?;");
        $sql->bind_param("sssssi", $data["rating"], $data["name"], $data["description"], $data["thumbnail"], $data["images"], $data["id"]);
        // EXECUTE SQL Statement
        $sql->execute();
    }

    /**
     * METHOD: Inserts data into reviews table
     */
    function InsertReview($data) {
        // SET conn Variable to Global
        global $conn;
        // PREPARE SQL Statement
        $stmt = $conn->prepare("INSERT INTO reviews (rating, name, description, thumbnail, images) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data["rating"], $data["name"], $data["description"], $data["thumbnail"], $data["images"]);
        // EXECUTE SQL Statement
        $stmt->execute();
    }

    /**
     * METHOD: Selects all from reviews table
     */
    function SelectReviews() {
        // SET conn Variable to Global
        global $conn;
        // PREPARE SQL Statement
        $sql = "SELECT * FROM reviews;";
        // EXECUTE SQL Statement
        return $conn->query($sql);
    }

    /**
     * METHOD: Removes a review at a given id from reviews table
     */
    function RemoveReview($id) {
        // SET conn Variable to Global
        global $conn;
        // PREPARE SQL Statement
        $sql = $conn->prepare("DELETE FROM reviews WHERE review_id=?");
        $sql->bind_param("i", $id);
        // PERFORM SQL Query
        $sql->execute();
    }

    /*************** WORK METHODS ***************/

    /**
     * METHOD: Updates works table
     */
    function UpdateWork($data) {
        // SET conn Variable to Global
        global $conn;
        // PREPARE SQL Statement
        $sql = $conn->prepare("UPDATE works SET type=?, name=?, description=?, thumbnail=?, images=? WHERE work_id = ?;");
        $sql->bind_param("sssssi", $data["type"], $data["name"], $data["description"], $data["thumbnail"], $data["images"], $data["id"]);
        // EXECUTE SQL Statement
        $sql->execute();
    }

    /**
     * METHOD: Inserts data into works table
     */
    function InsertWork($data) {
        // SET conn Variable to Global
        global $conn;
        // PREPARE SQL Statement
        $sql = $conn->prepare("INSERT INTO works (type, name, description, thumbnail, images) VALUES (?, ?, ?, ?, ?)");
        $sql->bind_param("sssss", $data["type"], $data["name"], $data["description"], $data["thumbnail"], $data["images"]);
        // EXECUTE SQL Statement
        $sql->execute();
    }

    /**
     * METHOD: Selects all from works table
     */
    function SelectWorks() {
        // SET conn Variable to Global
        global $conn;
        // PREPARE SQL Statement
        $sql = "SELECT * FROM works;";
        // EXECUTE SQL Statement
        return $conn->query($sql);
    }

    /**
     * METHOD: Removes a work at a given id from works table
     */
    function RemoveWork($id) {
        // SET conn Variable to Global
        global $conn;
        // PREPARE SQL Statement
        $sql = $conn->prepare("DELETE FROM works WHERE work_id=?");
        $sql->bind_param("i", $id);
        // PERFORM SQL Query
        $sql->execute();
    }

    /*************** NAVBAR METHODS ***************/

    /**
     * METHOD: Selects all from navbar table
     */
    function SelectNavbar() {
        // SET conn Variable to Global
        global $conn;
        // PREPARE SQL Statement
        $sql = "SELECT * FROM navbar;";
        // EXECUTE SQL Statement
        return $conn->query($sql);
    }

    /**
     * METHOD: Deletes all records inside of navbar table
     */
    function DeleteNavbar() {
        // SET conn Variable to Global
        global $conn;
        // PREPARE Query
        $stmt = $conn->prepare("DELETE FROM navbar");
        // EXECUTE Query
        $stmt->execute();
    }

    /**
     * METHOD: Inserts data into navbar table
     */
    function InsertNavbar($data) {
        // SET conn Variable to Global
        global $conn;
        // PREPARE Query
        $stmt = $conn->prepare("INSERT INTO navbar (type, content, destination) VALUES (?, ?, ?);");
        $stmt->bind_param("sss", $data["type"], $data["content"], $data["destination"]);
        // EXECUTE Query
        $stmt->execute();
    }

    /*************** HOMEPAGE METHODS ***************/

    /**
     * METHOD: Selects all data from homepage table ordered by position ascending
     */
    function SelectOrderedHomepage() {
        // SET conn Variable to Global
        global $conn;
        // PREPARE SQL Statement
        $sql = "SELECT * FROM homepage ORDER BY position";
        // RETURN Result of Query
        return $conn->query($sql);
    }

    /**
     * METHOD: Deletes all data from homepage table
     */
    function DeleteHomepage() {
        // SET conn Variable to Global
        global $conn;
        // PREPARE Query
        $stmt = $conn->prepare("DELETE FROM homepage");
        // EXECUTE Query
        $stmt->execute();
    }

    /**
     * METHOD: Inserts data into the homepage table
     */
    function InsertHomepage($data) {
        // SET conn Variable to Global
        global $conn;
        // PREPARE Query
        $stmt = $conn->prepare("INSERT INTO homepage (position, type, content) VALUES (?, ?, ?);");
        $stmt->bind_param("iss", $data["position"], $data["type"], $data["content"]);
        // EXECUTE Query
        $stmt->execute();
    }

    /*************** STATUS METHODS ***************/

    /**
     * METHOD: Selects all data from status table ordered by position ascending
     */
    function SelectOrderedStatus() {
        // SET conn Variable to Global
        global $conn;
        // PREPARE SQL Statement
        $sql = "SELECT * FROM status ORDER BY position";
        // RETURN Executed Query
        return $conn->query($sql);
    }

    /**
     * METHOD: Deletes all data from status table
     */
    function DeleteStatus() {
        // SET conn Variable to Global
        global $conn;
        // PREPARE Query
        $stmt = $conn->prepare("DELETE FROM status");
        // EXECUTE Query
        $stmt->execute();
    }

    /**
     * METHOD: Inserts data into the status table
     */
    function InsertStatus($data) {
        // SET conn Variable to Global
        global $conn;
        // PREPARE Query
        $stmt = $conn->prepare("INSERT INTO status (position, type, content) VALUES (?, ?, ?);");
        $stmt->bind_param("iss", $data["position"], $data["type"], $data["content"]);
        // EXECUTE Query
        $stmt->execute();
    }

    /*************** USER METHODS ***************/

    /**
     * METHOD: Gets user by username from users table
     */
    function GetUser($username) {
        // SET conn Variable to Global
        global $conn;
        // PREPARE SQL Statement
        $sql = $conn->prepare("SELECT * FROM users WHERE username = ?;");
        $sql->bind_param("s", $username);
        // EXECUTE Query
        $sql->execute();
        // RETURN Result
        return $sql->get_result();
    }

    /**
     * METHOD: Changes the password of the admin user (aidann)
     */
    function ChangePassword($password) {
        // SET conn Variable to Global
        global $conn;
        // PREPARE SQL Statement
        $sql = $conn->prepare("UPDATE users SET password=? WHERE username='aidann'");
        $sql->bind_param("s", $password);
        // EXECUTE Query
        $sql->execute();
    }
?>