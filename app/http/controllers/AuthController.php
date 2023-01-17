<?php

namespace App\http\controllers;

use App\core\Redirect;
use App\core\View;
use App\models\User;

class AuthController
{
    public function login(){
        View::render('auth/login');
    }

    public function postLogin(){
        echo '<pre>';
        print_r($_POST['email']);
        die();
    }

    public function register(){
        View::render('auth/register');
    }

    public function postRegister(){
        $data = [
			'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];

        $user = new User();
        $create = $user->create($data);

		Redirect::to('auth/login');
    }
}