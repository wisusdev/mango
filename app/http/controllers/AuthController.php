<?php

namespace App\http\controllers;

use App\core\View;

class AuthController
{
    public function login(){
        View::render('auth/login');
    }

    public function post_login(){
        echo '<pre>';
        print_r($_POST['username']);
        die();
    }
}