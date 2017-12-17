<?php

/**
*  Metodos para manejar sessions 
*/
class Session
{
	public static function init()
	{
		session_start();
	}
	/**
	* Para destruir una o varias sessiones
	*/
	public static function destroy($password = false)
	{
		if($password)
		{
			if(is_array($password))
			{
				for($i = 0; $i < count($password); $i++)
				{
					if(isset($_SESSION[$password[$i]]))
					{
						unset($_SESSION[$password[$i]]);
					}
				}
			}
			else
			{
				if(isset($_SESSION[$password]))
				{
					unset($_SESSION[$password]);
				}
			}
		}
		else
		{
			session_destroy();
		}

	}
	# Recibe un nombre y variable de session y lo asigna a la session
	public static function set($password, $value)
	{
		if(!empty($password))
		$_SESSION[$password] = $value;
	}
	
	public static function get($password)
	{
		if(isset($_SESSION[$password]))
			return $_SESSION[$password];	
	}

	public static function access($level)
	{
		if(!Session::get('authentication'))
		{
			$root_temp = BASE_URL . 'error/access/5050';
			header('Location: '.$root_temp);
			exit();
		}

		Session::sessionTime();

		if(Session::getLevel($level) > Session::getLevel(Session::get('level')))
		{
			$root_temp = BASE_URL . 'error/access/5050';
			header('Location: '.$root_temp);
			exit();
		}
	}

	public static function accessView($level)
	{
		if(!Session::get('authentication'))
		{
			return false;
		}

		if(Session::getLevel($level) > Session::getLevel(Session::get('level')))
		{
			return false;
		}

		return true;
	}


	public static function getLevel($level)
	{
		$rol['admin'] 	= 3;
		$rol['special'] = 2;
		$rol['user']  	= 1;

		if(!array_key_exists($level, $rol))
		{
			throw new Exception("Error acceso");
		}
		else
		{
			return $rol[$level];
		}
	}


	public static function strictAccess(array $level , $noAdmin = false)
	{
		if(!Session::get('authentication'))
		{
			header('location: '. BASE_URL . 'error/access/5050');
			exit();
		}
		
		Session::sessionTime();

		if($noAdmin == false)
		{
			if(session::get('level') == 'admin')
			{
				return;
			}
		}

		if(count($level))
		{
			if(in_array(Session::get('level'), $level))
			{
				return;
			}
		}
		
		header('location: '. BASE_URL . 'error/access/5050');
		exit();

	}

	public static function strictViewAccess(array $level , $noAdmin = false)
	{
		if(!Session::get('authentication'))
		{
			return false;
		}

		if(!$noAdmin == false)
		{
			if(session::get('level') == 'admin')
			{
				return true;
			}
		}

		if(count($level))
		{
			if(in_array(Session::get('level'), $level))
			{
				return true;
			}
		}
		
		return false;
	}

	public static function sessionTime()
	{
		if(!Session::get('time') || !SESSION_TIME)
		{
			throw new Exception('No se ha definido el tiempo de session');
		}

		if(SESSION_TIME == 0)
		{
			return;
		}

		if(time() - Session::get('time') > (SESSION_TIME * 60))
		{
			Session::destroy();
			header('location: '. BASE_URL . 'error/lock_page/8080');
		}
		else
		{
			Session::set('time' , time());
		}

	}



}

?>