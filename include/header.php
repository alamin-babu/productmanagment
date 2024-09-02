<?php 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Management</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="shortcut icon" href="./media/products.png" type="image/x-icon">
</head>

<body>
    <section>
        <nav class="navbar">
            <a title="GO to Home" href="./index.php"><img src="./media/home-button.png" alt="home"></a>
            <?php if(!isset($_SESSION['username'])): ?>
            <a title="user" href=""><img src="./media/user.png" alt="user"></a>
            <?php else: ?>
            <a title="<?php echo $_SESSION['username']; ?>:View profile" href="profile.php"><img  src="./media/user.png"
                    alt="user"></a>
            <?php endif; ?>
            <a title="Logout" href="./include/logout.php"><img  src="./media/logout.png" alt="logout img"></a>
        </nav>
    </section>
    <br>