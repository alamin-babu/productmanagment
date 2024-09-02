<?php
// index.php
session_start();
require_once 'include/auth.php';
require_once 'include/product.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $username = $_SESSION['username']; 

    $result = add_product($name, $price, $description, $username);
    if ($result === true) {
        $_SESSION['success'] = "Product added successfully!";
        header("Location: index.php");
        exit();
    } else {
        $error = $result;
    }
}

if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}
?>

<?php include 'include/header.php'; ?>
<h2 style="text-align:center">Product Management</h2> <hr>
<div class="menu-container" style=" ">
   

    <button id="addProductBtn"><img src="media/delivery-box.png" alt=""><br> Add Product</button>
    <button onclick="window.location.href='view_products.php'"><img src="media/quality-control.png" alt=""> <br> View
        Products</button>

</div>
<!-- Modal Popup -->
<div id="productModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Add Product</h2>
        <form id="productForm" method="post">
            <label>Product Name:</label>
            <input type="text" name="name" required><br>

            <label>Price:</label>
            <input type="text" name="price" required><br>

            <label>Description:</label>
            <textarea name="description" required></textarea><br>

            <span class="error-message"><?php echo $error; ?></span><br>
            <input type="submit" value="Add Product">
        </form>
    </div>
</div>

<!-- Success Modal Popup -->
<?php if ($success): ?>
<div id="successModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeSuccessModal()">&times;</span>
        <h2>Success</h2>
        <p><?php echo $success; ?></p>
        <button onclick="closeSuccessModal()">OK</button>
    </div>
</div>
<?php endif; ?>

<style>

#successModal button {
    background-color: #45a049;
    width: 45px;
    height: 35px;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
    max-width: 600px;
    border-radius: 8px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

form {
    display: flex;
    flex-direction: column;
}

form input,
form textarea {
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

form input[type="submit"]:hover {
    background-color: #45a049;
}
</style>

<script>
// Modal functionality
document.getElementById('addProductBtn').onclick = function() {
    document.getElementById('productModal').style.display = 'block';
};

function closeModal() {
    document.getElementById('productModal').style.display = 'none';
}

function closeSuccessModal() {
    document.getElementById('successModal').style.display = 'none';
}

// validation
document.getElementById('productForm').onsubmit = function() {
    let name = document.forms["productForm"]["name"].value.trim();
    let price = document.forms["productForm"]["price"].value.trim();
    let description = document.forms["productForm"]["description"].value.trim();

    if (name === "" || price === "" || description === "") {
        alert("All fields must be filled out");
        return false;
    }
    if (!/^[a-zA-Z0-9\s]{3,}$/.test(name)) {
        alert("Product name must be at least 3 characters long.");
        return false;
    }
    if (isNaN(price) || price <= 0) {
        alert("Please enter a valid price.");
        return false;
    }
    return true;
};

// Show success modal if success message is set
window.onload = function() {
    const successModal = document.getElementById('successModal');
    if (successModal) {
        successModal.style.display = 'block';
    }
};
</script>

<?php include 'include/footer.php'; ?>