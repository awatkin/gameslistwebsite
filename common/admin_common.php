<?php

function admin_error(&$session){
    if(isset($session["ERROR"])){
        $message = "<p id='error'> ERROR".$session["ERROR"]."</p>";
        unset($session["ERROR"]);
        return $message;
    }
    if(isset($session["SUCCESS"])){
        $message = "<p id='success'> SUCCESS".$session["SUCCESS"]."</p>";
        unset($session["SUCCESS"]);
        return $message;
    }
}

function super_checker($conn){
    try {
        $sql = "SELECT priv FROM admin WHERE priv = 'SUPER'"; //set up the sql statement
        $stmt = $conn->prepare($sql); //prepares
        $stmt->execute(); //run the sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    catch (PDOException $e) { //catch error
        // Log the error (crucial!)
        error_log("Database error in super_checker: " . $e->getMessage());
        // Throw the exception
        throw $e; // Re-throw the exception
    }
}

function reg_admin($conn, $post){
    if (!isset($post['username'], $post['priv'])) {
        throw new Exception("Missing required fields.");
    } else{
        try {
            // Prepare and execute the SQL query
            $sql = "INSERT INTO admin (username, password, priv, date_added) VALUES (?, ?, ?, ?)";  //prepare the sql to be sent
            $stmt = $conn->prepare($sql); //prepare to sql

            $stmt->bindParam(1, $post['username']);  //bind parameters for security
            if(!isset($post['password'])){
                $stmt->bindValue(2, "REQUEST");
            } else {
                // Hash the password
                $hpswd = password_hash($post['password'], PASSWORD_DEFAULT);  //has the password
                $stmt->bindParam(2, $hpswd);
            }
            $stmt->bindParam(3, $post['priv']);
            $timenow = time();
            $stmt->bindParam(4, $timenow);

            $stmt->execute();  //run the query to insert
            $conn = null;  // closes the connection so cant be abused.
            return true; // Registration successful
        }  catch (PDOException $e) {
            // Handle database errors
            error_log("Database error: " . $e->getMessage()); // Log the error
            throw new Exception("Database error". $e); //Throw exception for calling script to handle.
        } catch (Exception $e) {
            // Handle validation or other errors
            error_log("Registration error: " . $e->getMessage()); //Log the error
            throw new Exception("Registration error: " . $e->getMessage()); //Throw exception for calling script to handle.
        }
    }
}

function only_user($conn, $username){
    try {
        $sql = "SELECT username FROM admin WHERE username = ?"; //set up the sql statement
        $stmt = $conn->prepare($sql); //prepares
        $stmt->bindParam(1, $username);
        $stmt->execute(); //run the sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
        $conn = null;
        if ($result) {
            return false;
        } else {
            return true;
        }
    }
    catch (PDOException $e) { //catch error
        // Log the error (crucial!)
        error_log("Database error in only_user: " . $e->getMessage());
        // Throw the exception
        throw $e; // Re-throw the exception
    }
}

function get_requests_num($conn){
    try {
        $sql = "SELECT COUNT(*) FROM request WHERE status = 'unresolved'";
        $stmt = $conn->prepare($sql);
        // Execute the query
        $stmt->execute();

        // Fetch the result (the count)
        $count = $stmt->fetchColumn();
        if($count){
            return $count;
        } else {
            return 0;
        }
    }

    catch (PDOException $e) { //catch error
        // Log the error (crucial!)
        error_log("Database error in get_requests_num: " . $e->getMessage());
        // Throw the exception
        throw $e; // Re-throw the exception
    }
}