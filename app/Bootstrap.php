<?php

class Bootstrap
{
	public static function run(Request $petition)
	{
		//$controller = $petition->getController() . 'Controller';
		$controller = $petition->getController() . 'Controller';
		# NAME CONTROLLER
		$rootController = ROOT . 'controllers'. DS . $controller . '.php';
		# NAME METHOD
		$method = str_replace(".php" , "", $petition->getMethod());
		# NAME ARGUNMENTS
		$args = str_replace(".php" , "", $petition->getArgs());
		# VERIFICA SI EXISTE Y ES LEGIBLE EL ARCHIVO LO IMPORTA
		if(is_readable($rootController))
		{
			require_once $rootController;
			$controller = new $controller;
		
			if(is_callable(array($controller, $method)))
			{
				$method = str_replace(".php" , "", $petition->getMethod());
			}
			else
			{
				$method = 'index';
			}

			if(isset($args))
			{
				# INVOCA EL NOMBRE DEL METODO Y LE PASA LOS DATOS
				call_user_func_array(array($controller, $method), $args);
			}
			else
			{
				# SI NO EXISTE ARGUMENTOS LLAMA LA CLASE DEL CONTROLADOR E INVOCA EL METODO
				call_user_func(array($controller, $method));
			}
		}
		else
		{
			//throw new Exception("Error controller not found");
			header('location: '. BASE_URL . 'error/lock_page/5050');
			exit();
		}
	}	
}

?>