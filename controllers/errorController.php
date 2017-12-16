<?php
/**
* 
*/
class errorController extends Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->_view->title   = 'Error';
		$this->_view->message = $this->_getError();
		$this->_view->render('index');

	}
	
	public function access($cod)
	{
		$this->_view->title   = 'Error';
		$this->_view->message = $this->_getError($cod);
		$this->_view->render('access');
	}


	# ATRIBUTOS O VARIABLES QUE SON PRIVATES
	public function _getError($cod = false)
	{

		# Asegurar que el codigo sea un int o sino que sea por default
		if($cod)
		{
			$cod = $this->filterInt($cod);
			if(is_int($cod))
				$cod = $cod;	
		}
		else
		{
			$cod = 'default';
		}

		$error['default']	= 'Sorry but we couldn’t find the page you are looking for';
		$error['5050']		= 'Acceso restringido';
		$error['8080']		= 'Tiempo de la session agotado';

		if(array_key_exists($cod, $error))
		{
			return $error[$cod];
		}
		else
		{
			return $error['default'];
		}

	}
}

?>