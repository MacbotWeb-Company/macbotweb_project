<?php

class integrationsController extends Controller
{
	private $_integration; # Instanciar todo el modelo para utilizar todos los controller

	public function __construct()
	{
		parent::__construct();
		$this->_integration = $this->loadModel('integrationsapp');
	}
	public function index()
	{
		$this->_view->title      = 'Integrations - APP';
		$this->_view->page_title = 'INTEGRATIONS APP';
	
		#RETURN DATA VIEWS
		$this->_view->data_analytics_app	= $this->_integration->getIntegrationsApp('ANALYTICS');
		$this->_view->data_social_app		= $this->_integration->getIntegrationsApp('SOCIAL');
		$this->_view->data_seo_app			= $this->_integration->getIntegrationsApp('SEO');
		$this->_view->render('index', 'menu-integrations');
	}
	
}

?>