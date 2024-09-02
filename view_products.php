<?php
session_start();
require_once 'include/product.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['edit'])) {
        $id = intval($_POST['id']);
        $name = trim($_POST['name']);
        $price = trim($_POST['price']);
        $description = trim($_POST['description']);

        $result = update_product($id, $name, $price, $description);
        if ($result === true) {
            header("Location: view_products.php");
            exit();
        } else {
            $error = $result;
        }
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $result = delete_product($id);
    if ($result === true) {
        header("Location: view_products.php");
        exit();
    } else {
        $error = $result;
    }
}

$products = get_products();
include 'include/header.php';
?>
<link rel="stylesheet" href="./style/product.css">

<h2>Product List</h2>
<?php if (isset($error)): ?>
<p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<div class="table-container">
    <table>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Date Added</th>
            <th>Username</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td><?php echo htmlspecialchars($product['price']); ?></td>
            <td><?php echo htmlspecialchars($product['description']); ?></td>
            <td><?php echo htmlspecialchars($product['created_at']); ?></td>
            <td><?php echo htmlspecialchars($product['username']); ?></td>
            <td><button onclick="openEditModal(<?php echo htmlspecialchars(json_encode($product)); ?>)">Edit</button>
            </td>
            <td><button onclick="confirmDelete(<?php echo $product['id']; ?>)">Delete</button></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<!-- Edit Product Modal -->
<div id="editProductModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Edit Product</h2>
        <form id="editProductForm" method="post">
            <input type="hidden" name="id" id="productId">
            <label>Product Name:</label>
            <input type="text" name="name" id="productName" required><br>

            <label>Price:</label>
            <input type="number" name="price" id="productPrice" step="0.01" required><br>

            <label>Description:</label>
            <textarea name="description" id="productDescription" required></textarea><br>

            <input type="submit" name="edit" value="Update Product">
        </form>
    </div>
</div>

<!-- Confirmation Modal for Deletion -->
<div id="confirmDeleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeConfirmDeleteModal()">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this product?</p>
        <button id="confirmDeleteBtn">Yes, Delete</button>
        <button style="background-color: green;" id="confirmDeleteBtn" onclick="closeConfirmDeleteModal()">Cancel</button>
    </div>
</div>

<!-- JavaScript for Modal and Form Validation -->
<script>
let deleteProductId = null;

function openEditModal(product) {
    document.getElementById('productId').value = product.id;
    document.getElementById('productName').value = product.name;
    document.getElementById('productPrice').value = product.price;
    document.getElementById('productDescription').value = product.description;
    document.getElementById('editProductModal').style.display = 'block';
}

function closeEditModal() {
    document.getElementById('editProductModal').style.display = 'none';
}

function confirmDelete(id) {
    deleteProductId = id;
    document.getElementById('confirmDeleteModal').style.display = 'block';
}

function closeConfirmDeleteModal() {
    document.getElementById('confirmDeleteModal').style.display = 'none';
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (deleteProductId !== null) {
        window.location.href = 'view_products.php?delete=' + deleteProductId;
    }
});

document.getElementById('editProductForm').addEventListener('submit', function(event) {
    const name = document.getElementById('productName').value.trim();
    const price = document.getElementById('productPrice').value.trim();
    const description = document.getElementById('productDescription').value.trim();

    if (name === '' || price === '' || description === '') {
        alert('All fields are required.');
        event.preventDefault(); 
        return;
    }

    if (isNaN(price) || parseFloat(price) <= 0) {
        alert('Please enter a valid price.');
        event.preventDefault(); 
        return;
    }
});
</script>


<?php include 'include/footer.php'; ?>