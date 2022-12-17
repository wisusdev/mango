<?php
namespace App\core;

class Kernel
{
	// Propiedades del framework
	private $framework = 'molly';

	// Funcion principal al instanciar la clase
	function __construct() {
		$this->init();
	}

	/**
	 * Metodo para ejecutar otros metodos de forma subsecuente
	 * @return void
	 */
	private function init() {
		// Todos los metodos que se ejecutaran consecutivamente
		Whoops::run();
		$this->init_session();
		new Csrf();
        new Routes();
	}

	/**
	 * Metodo para iniciar la sesión en el sistema
	 * @return void
	 */
	private function init_session(): void
    {
		if (session_status() == PHP_SESSION_NONE){
			session_start();
		}
	}

	/*
	* Corre nuestro kernel
	*/
	public static function fly(): void
    {
		new Kernel();
	}
}