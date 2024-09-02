<?php
require_once 'include/auth.php';

session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

$username = $password = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $result = login($username, $password);
    if ($result === true) {
        header("Location: index.php");
        exit();
    } else {
        $error = $result;
    }
}
?>

<?php include 'include/header.php'; ?>
<div class="login-container">
    <div class="login-form">
        <h2>Login</h2>

        <form id="loginForm" method="post" onsubmit="validateLoginForm(event)">
            <label for="user-email">Username or Email:</label>
            <input type="text" id="user-email" name="username" value="<?php echo htmlspecialchars($username); ?>"><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br>

            <span id="error-message" style="color: red;"><?php echo $error; ?></span><br>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="signUp.php">Register here</a></p>
    </div>
</div>
<?php include 'include/footer.php'; ?>