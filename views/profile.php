<?php
// Import necessary classes
require_once '../controllers/UserController.php';

// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

// Create a new instance of the UserController
$userController = new UserController();

// Get the username from the session
$username = $_SESSION['user_id'];

// Fetch the user's profile data
$profile_data = $userController->getProfile($username);

// Check if profile data is successfully fetched
if (!$profile_data) {
    // Handle error (e.g., display an error message or redirect to an error page)
    die('Error fetching profile data.');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>

<h1>User Profile</h1>

<ul>
    <li>Username: <?php echo htmlspecialchars($profile_data['username']); ?></li>
    <li>Email: <?php echo htmlspecialchars($profile_data['email']); ?></li>
</ul>

<a href="logout.php">Logout</a>

</body>
</html>
