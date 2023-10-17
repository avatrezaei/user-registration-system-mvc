<?php

session_start();

require_once './config.php';
require_once './Autoloader.php';

// Register the autoloader
Autoloader::register();

// Now you can use your classes normally
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\UserController;

$auth = new AuthController();
$home = new HomeController();
$user = new UserController();


$action = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

switch ($action) {
    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->login($_POST);
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $auth->showLoginForm();
        } else {
            header('Location: /');
        }
        break;
    case '/register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->register($_POST);
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $auth->showRegisterForm();
        } else {
            header('Location: /');
        }
        break;
    case '/profile':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $user->profile();
        } else {
            header('Location: /');
        }
        break;
    case '/logout':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $auth->logout();
        } else {
            header('Location: /');
        }
        break;
    case '/update-avatar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->updateAvatar();
        } else {
            header('Location: /');
        }
        break;
    case '/manage_roles':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $user->manageRoles();
        } else {
            header('Location: /');
        }
        break;
    case '/store_role':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->storeRole($_POST);
        } else {
            header('Location: /');
        }
        break;
    case '/store_permission':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->storePermission($_POST);
        } else {
            header('Location: /');
        }
        break;
    case '/add_permission_to_role':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->addPermissionToRole($_POST);
        } else {
            header('Location: /');
        }
        break;
    case '/add_role_to_user':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->addRoleToUser($_POST);
        } else {
            header('Location: /');
        }
        break;
    case '/subscribe':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $user->subscribe();
        } else {
            header('Location: /');
        }
        break;
    case '/unsubscribe':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $user->unsubscribe();
        } else {
            header('Location: /');
        }
        break;
    default:
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $home->index();
        } else {
            header('Location: /');
        }
        break;
}
