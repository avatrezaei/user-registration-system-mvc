<?php
 
require_once '../controllers/UserController.php';

 
$userController = new UserController();

 
$error_message = '';

 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    
    if (empty($username) || empty($password)) {
        $error_message = 'All fields are required.';
    } else {
         
        $result = $userController->login($username, $password);

        if ($result['success']) { 
            header('Location: profile.php');
            exit;
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
    <title>User Login</title>
</head>
<body>

<h1>User Login</h1>

 
<?php if (!empty($error_message)) : ?>
    <div class="error-message"><?php echo $error_message; ?></div>
<?php endif; ?>

 
<form method="post" action="login.php">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    
    <input type="submit" value="Login">
</form>

</body>
</html>
