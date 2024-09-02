<?php
session_start();
require_once 'include/auth.php';
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$error = '';
$success = '';

// Fetch user details
$stmt = $conn->prepare("SELECT username, email, password FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $current_password_hash);
$stmt->fetch();
$stmt->close();

// Handle email update form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_email'])) {
    $new_email = trim($_POST['email']);
    
    // Validate email
    if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } else {
        // Update email
        $stmt = $conn->prepare("UPDATE users SET email = ? WHERE id = ?");
        $stmt->bind_param("si", $new_email, $user_id);
        $stmt->execute();
        $stmt->close();
        
        $success = "Email updated successfully!";
    }
}

// Handle password change form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    
    // Validate current password
    if (!password_verify($current_password, $current_password_hash)) {
        $error = "Current password is incorrect.";
    }
    // Validate new password
    elseif (strlen($new_password) > 0) {
        if (strlen($new_password) < 8) {
            $error = "New password must be at least 8 characters long.";
        } elseif (!preg_match('/[A-Z]/', $new_password) || !preg_match('/[a-z]/', $new_password) || !preg_match('/[0-9]/', $new_password) || !preg_match('/[@$!%*?&#]/', $new_password)) {
            $error = "New password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
        } elseif ($new_password !== $confirm_password) {
            $error = "New password and confirmation password do not match.";
        } elseif (password_verify($new_password, $current_password_hash)) {
            $error = "New password cannot be the same as the current password.";
        } else {
            // Update password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $hashed_password, $user_id);
            $stmt->execute();
            $stmt->close();
            
            $success = "Password changed successfully!";
        }
    }
}
?>

<?php include 'include/header.php'; ?>
<h2 style="text-align:center;">Your Profile</h2>

<?php if ($error): ?>
<div class="error"><?php echo $error; ?></div>
<?php elseif ($success): ?>
<div class="success"><?php echo $success; ?></div>
<?php endif; ?>



<div class="update-container">
    <div class="update-form">
        <form id="emailForm" method="post">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $username; ?>" readonly><br>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>"><br>

            <input type="submit" name="update_email" value="Update Email">
        </form>
    </div>


    <!-- Form to Change Password -->
    <div class="update-form">
        <form id="passwordForm" method="post">
            <label>Current Password:</label>
            <input type="password" name="current_password" placeholder="Enter current password" required><br>

            <label>New Password:</label>
            <input type="password" name="new_password" placeholder="Enter new password"><br>

            <label>Confirm New Password:</label>
            <input type="password" name="confirm_password" placeholder="Confirm new password"><br>

            <input type="submit" name="change_password" value="Change Password">
        </form>
    </div>

</div>




<script>
if (document.querySelector('.success')) {
    setTimeout(function() {
        document.querySelector('.success').style.display = 'none';
    }, 3000);
}
</script>

<?php include 'include/footer.php'; ?>