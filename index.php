<?php

//init_set('display_errors' , 1);

define('DS', DIRECTORY_SEPARATOR);
# IF IS SO CHANGED ROOT/
define('ROOT', realpath(dirname(__FILE__)) . DS); # BASE ROOT
define('APP_PATH', ROOT . 'app'. DS);

try {
	require_once APP_PATH . 'Bootstrap.php';
	require_once APP_PATH . 'Config.php';
	require_once APP_PATH . 'Controller.php';
	require_once APP_PATH . 'Model.php';
	require_once APP_PATH . 'Register.php';
	require_once APP_PATH . 'Request.php';
	require_once APP_PATH . 'View.php';
	require_once APP_PATH . 'Database.php';
	require_once APP_PATH . 'Session.php';

	Session::init();
	Bootstrap::run(new Request);	

} catch (Exception $e) {
	echo $e->getMessage();
}


?>