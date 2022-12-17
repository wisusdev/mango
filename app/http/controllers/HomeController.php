<?php 

namespace App\http\controllers;

use App\core\View;

class HomeController {
	public function index(): void
    {
		View::render('welcome');
	}
}