<?php

namespace App\Controllers;

class BaseController
{

    protected function redirect($location)
    {
        header("Location: $location");
        exit;
    }

    protected function setSessionError($message)
    {
        $_SESSION['error'] = $message;
    }

    protected function setSessionSuccess($message)
    {
        $_SESSION['success'] = $message;
    }

    protected function startUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['role'] = $user->role_id;
    }

    protected function getSessionError()
    {
        return $this->getSessionMessage('error');
    }

    protected function getSessionSuccess()
    {
        return $this->getSessionMessage('success');
    }

    protected function getSessionMessage($key)
    {
        $message = $_SESSION[$key] ?? null;
        unset($_SESSION[$key]);   
        return $message;
    }




    protected function view($view, $data = [])
    {
        $data['error'] = $this->getSessionError();
        $data['success'] = $this->getSessionSuccess();
        extract($data);
        include "views/$view.php";
    }
}
