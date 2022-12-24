<?php
namespace App\core;

class Kernel
{
	function __construct() {
		$this->init();
	}

	private function init() {
		Whoops::run();
		$this->init_session();
		new Csrf();
        new Routes();
	}

	private function init_session(): void
    {
		if (session_status() == PHP_SESSION_NONE){
			session_start();
		}
	}

	public static function fly(): void
    {
		new Kernel();
	}
}