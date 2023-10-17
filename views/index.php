<?php 

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']);

include 'templates/header.php';
?>

 

<h1>User Registration System</h1>

<ul>
    <?php if ($loggedIn) : ?>
        <li><a href="profile">Profile</a></li>
        <li><a href="logout">Logout</a></li>
    <?php else: ?>
        <li><a href="register">Register</a></li>
        <li><a href="login">Login</a></li>
    <?php endif; ?>
</ul>

<?php include 'templates/footer.php'; ?>
