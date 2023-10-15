<?php
// Import the necessary classes
require_once '../controllers/UserController.php';

// Create a new instance of the UserController
$userController = new UserController();

// Define variables to hold error messages or success message
$error_message = '';
$success_message = '';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize input
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Validate input (this is a very basic validation, you might want to expand on this)
    if (empty($username) || empty($email) || empty($password)) {
        $error_message = 'All fields are required.';
    } else {
        // Attempt to register the user using the UserController
        $result = $userController->register($username, $email, $password);

        if ($result['success']) {
            $success_message = $result['message'];
        } else {
            $error_message = $result['message'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>

<h1>User Registration</h1>

<!-- Display error or success message -->
<?php if (!empty($error_message)) : ?>
    <div class="error-message"><?php echo $error_message; ?></div>
<?php endif; ?>
<?php if (!empty($success_message)) : ?>
    <div class="success-message"><?php echo $success_message; ?></div>
<?php endif; ?>

<!-- Registration Form -->
<form method="post" action="register.php">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    
    <input type="submit" value="Register">
</form>

</body>
</html>
