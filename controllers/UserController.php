<?php
require_once '../models/User.php';

class UserController
{

    public function register($username, $email, $password)
    {
        $user = new User();

        if ($user->doesUsernameExist($username)) {
            return ['success' => false, 'message' => 'Username already exists.'];
        }

        if ($user->doesEmailExist($email)) {
            return ['success' => false, 'message' => 'Email already in use.'];
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $result = $user->register($username, $email, $hashedPassword);

        if ($result) {
            return ['success' => true, 'message' => 'Registration successful!'];
        } else {
            return ['success' => false, 'message' => 'Registration failed. Please try again.'];
        }
    }

    public function login($username, $password)
    {
        $user = new User();


        $userData = $user->getUserByUsername($username);

        if ($userData && password_verify($password, $userData['password'])) {
            session_start();
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['username'] = $userData['username'];
            return ['success' => true, 'message' => 'Login successful!'];
        } else {
            return ['success' => false, 'message' => 'Invalid username or password.'];
        }
    }

    public function getProfile($userId) {
        $user = new User();
        $userData = $user->getUserById($userId);
        return $userData;
    }
}

 
