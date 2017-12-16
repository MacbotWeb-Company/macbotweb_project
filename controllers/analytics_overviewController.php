<?php

class analytics_overviewController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
	
		Session::strictAccess(array('user'));
		$analytics = $this->loadModel('analytic');
		
		$this->_view->title 	 = 'Analytics - Overviews';
		$this->_view->page_title = 'ANALYTICS  OVERVIEW';
		#RETURN DATA VIEWS
		$this->_view->render('index', 'analytics-overview');

	}
}

?>
