<?php

namespace App\Controllers;

use App\Models\User;

class HomeController extends BaseController
{
    public function index()
    {
        $this->view('index',['name' => 'John Doe']);
    }
}