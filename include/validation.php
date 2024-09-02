<?php
function validate_username($username) {
    if (empty($username)) {
        return "Username is required.";
    }
    if (!preg_match('/^[a-zA-Z0-9_]{3,}$/', $username)) {
        return "Username must be at least 3 characters long and contain only letters, numbers, and underscores.";
    }
    return true;
}

function validate_email($email) {
    if (empty($email)) {
        return "Email is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }
    return true;
}

function validate_password($password) {
    if (empty($password)) {
        return "Password is required.";
    }
    if (strlen($password) < 6) {
        return "Password must be at least 6 characters long.";
    }
    return true;
}


function validate_product_name($name) {
    return !empty($name) && preg_match('/^[a-zA-Z0-9\s]{3,}$/', $name);
}

function validate_price($price) {
    return !empty($price) && is_numeric($price) && $price > 0;
}
?>
