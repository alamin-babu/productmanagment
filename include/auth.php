<?php
require_once './config/database.php';
require_once 'validation.php';

function signup($username, $email, $password) {
    global $conn;

    if (!validate_username($username) || !validate_email($email) || !validate_password($password)) {
        return "Invalid input data";
    }

    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        return "Username or email already exists";
    } else {
        // Hashhing
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // inserting into database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            return true; 
        } else {
            return "Error: " . $stmt->error;
        }
    }
}

function login($usernameOrEmail, $password) {
    global $conn;

    // gun :) 
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $hashed_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            // Setting the session and cookie
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username; 
            setcookie("user_id", $id, [
                'expires' => time() + (86400 * 30),
                'path' => '/',
                'secure' => true,   
                'samesite' => 'Strict' 
            ]);
            setcookie("username", $username, [
                'expires' => time() + (86400 * 30),
                'path' => '/',
                'secure' => true,
                'samesite' => 'Strict'
            ]);
            return true; 
        } else {
            return "Invalid password";
        }
    } else {
        return "No user found with that username/email";
    }
}

?>
