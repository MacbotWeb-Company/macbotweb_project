<?php

class indexController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
	
		Session::strictAccess(array('NU'));
		
		$this->_view->title 		= 'Dashboard - Inicio';
		$this->_view->page_title	= 'Dashboard123';
		$id_user		= Session::get('id_user');
		$id_institucion	= Session::get('id_institucion');

		#RETURN DATA VIEWS
		$this->_view->render('index', 'menu-dashboard');

	}

}

?>
