<?php
require_once './config/database.php';
require_once 'validation.php';

function add_product($name, $price, $description, $username) {
    global $conn;

    if (!validate_product_name($name) || !validate_price($price) || empty($description)) {
        return "Invalid input data";
    }

    $stmt = $conn->prepare("INSERT INTO products_list (name, price, description, username) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $name, $price, $description, $username);

    if ($stmt->execute()) {
        return true; 
    } else {
        return "Error: " . $stmt->error;
    }
}

function get_products() {
    global $conn;
    $result = $conn->query("SELECT * FROM products_list ORDER BY created_at DESC");
    return $result->fetch_all(MYSQLI_ASSOC);
}



// update product
function update_product($id, $name, $price, $description) {
    global $conn;

    if (!validate_product_name($name) || !validate_price($price) || empty($description)) {
        return "Invalid input data";
    }

    $stmt = $conn->prepare("UPDATE products_list SET name = ?, price = ?, description = ? WHERE id = ?");
    $stmt->bind_param("sdsi", $name, $price, $description, $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return "Error: " . $stmt->error;
    }
}

// delete product
function delete_product($id) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM products_list WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return "Error: " . $stmt->error;
    }
}

?>
