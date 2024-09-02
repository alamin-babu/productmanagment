<?php
session_start();
require_once 'include/auth.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

$username = $email = $password = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Server-side validation
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        $result = signup($username, $email, $password);
        if ($result === true) {
            header("Location: login.php");
            exit();
        } else {
            $error = $result;
        }
    }
}
?>


<?php include 'include/header.php'; ?>
<div class="signup-container">
    <div class="signup-form">
        <h2>Signup</h2>
        <form id="signupForm" method="post" onsubmit="validateSignupForm(event)">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>"><br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br>

            <span id="error-message" style="color: red;"><?php echo $error; ?></span><br>
            <input type="submit" value="Signup">
        </form>
    </div>
</div>



<?php include 'include/footer.php'; ?>