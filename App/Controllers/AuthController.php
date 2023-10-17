<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends BaseController
{

    public function showLoginForm()
    {
        return $this->view('login');
    }


    public function login($request)
    {
        $username = htmlspecialchars($request['username']);
        $password = htmlspecialchars($request['password']);

        $user = $this->attemptLogin($username, $password);

        if ($user) {
            $this->startUserSession($user);
            $this->setSessionSuccess("Login successful.");
            $this->redirect('/profile');
        } else {
            $this->setSessionError("Invalid username or password.");
            $this->redirect('/login');
        }
    }

    protected function attemptLogin($username, $password)
    {
        $user = User::query()->where('username', $username)->first();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }

    public function showRegisterForm()
    {
        return $this->view('register');
    }

    public function register($request)
    {
        $username = htmlspecialchars($request['username']);
        $email = htmlspecialchars($request['email']);
        $password = htmlspecialchars($request['password']);

        if ($this->usernameExists($username)) {
            $this->setSessionError("Username already exists.");
            $this->redirect('/register');
        }

        if ($this->emailExists($email)) {
            $this->setSessionError("Email already exists.");
            $this->redirect('/register');
        }

        $this->createUser($username, $email, $password);
        $this->setSessionSuccess("Registration successful. Please login.");
        $this->redirect('/login');
    }

    protected function usernameExists($username)
    {
        return User::query()->where('username', $username)->first();
    }

    protected function emailExists($email)
    {
        return User::query()->where('email', $email)->first();
    }

    protected function createUser($username, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->password = $hashedPassword;
        $user->role_id = User::ROLE_USER;  
        $user->save();
    }

    //logout
    public function logout()
    {
        session_start();
        session_destroy();
        $this->redirect('/');
    }
}
