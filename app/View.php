<?php

class View
{
	private $_controller;

	public function __construct(Request $petition)
	{
		$this->_controller = $petition->getController();
	}

	public function render($view, $item = false, $item1 = false)
	{
		# ARREGLO MENU
		# Agregar arreglo para un nuevo menu de cabecera
		$menu_left = array();
		if(Session::get('level') == 'AD' || Session::get('level') == 'MU'){ 

			$menu_left = array(
				"APLICATIONS" => array(
					array(
						'id'	=> 'menu-dashboard',
						'title'	=> 'Dashboard',
						'icon'	=> 'icon-tile-four',
						'url'	=> BASE_URL . 'index'
					),
					array(
						'id'	=> 'menu-irm',
						'title'	=> 'Integrations',
						'icon'	=> 'icon-settings',
						'url'	=> BASE_URL . 'irm_overview'
					),
					array(
						'id' 	=> array('analytics-overview', 'analytics-audience'),
						'title' => 'Social',
						'icon'	=> 'icon-tile-four',
						'url'	=> 'javascript:;',
						'sub-menu' => array(
							array('id' => 'analytics-overview', 'title' => 'Overview', 'url' => BASE_URL . 'analytics_overview'),
							array('id' => 'analytics-audience', 'title' => 'Audince', 'url' => BASE_URL . 'analytics_auidicene'))
					)
				),
				
				"USERS" => array(
					array(
						'id' 	=> array('setting_users', 'analytics-audience'),
						'title' => 'Setting Users',
						'icon'	=> 'icon-account-settings-variant',
						'url'	=> 'javascript:;',
						'sub-menu' => array(
							array('id' => 'setting_users', 'title' => 'Users List', 'url' => BASE_URL . 'setting_users'),
							)
					)
				)
			);
		}elseif(Session::get('level') == 'NU'){
			$menu_left = array(
				"APLICATIONS" => array(
					array(
						'id'	=> 'menu-dashboard',
						'title'	=> 'Dashboard',
						'icon'	=> 'icon-tile-four',
						'url'	=> BASE_URL . 'index'
					),
					array(
						'id'	=> 'menu-irm',
						'title'	=> 'Integrations',
						'icon'	=> 'icon-settings',
						'url'	=> BASE_URL . 'irm_overview'
					),
					array(
						'id' 	=> array('analytics-overview', 'analytics-audience'),
						'title' => 'Social',
						'icon'	=> 'icon-tile-four',
						'url'	=> 'javascript:;',
						'sub-menu' => array(
							array('id' => 'analytics-overview', 'title' => 'Overview', 'url' => BASE_URL . 'analytics_overview'),
							array('id' => 'analytics-audience', 'title' => 'Audince', 'url' => BASE_URL . 'analytics_auidicene'))
					)
				)
			);
		}

		# START MENU RIGTH 
		# Agregar arreglo para un nuevo menu lateral
		$menu_rigth = array(
			array(
				'id' => 'menu-materias',
				'title' => 'MATERIAS',
				'icon' => 'icon-area-chart',
				'url' => BASE_URL . 'materias'
			),
			array(
				'id' => 'menu-cursos',
				'title' => 'CURSOS',
				'icon' => 'icon-area-chart',
				'url' => BASE_URL . 'cursosR'
			),
			array(
				'id' => 'menu-observaciones',
				'title' => 'OBSERVACIONES',
				'icon' => 'icon-area-chart',
				'url' => BASE_URL . 'cursosR'
			),
			array(
				'id' => 'menu-cursos2',
				'title' => 'CURSOS',
				'icon' => 'icon-area-chart',
				'url' => BASE_URL . 'cursosR'
			),
			array(
				'id' => 'menu-cursos3',
				'title' => 'CURSOS',
				'icon' => 'icon-area-chart',
				'url' => BASE_URL . 'cursosR'
			)
		);
		$arr_menu_rigth = array('materias');
		# END MENU RIGTH 

		# ARREGLO DE ARCHHIVOS STATICOS CSS, JS, IMG
		$_layoutParams = array(
			'root_css'	=> BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
			'root_img'	=> BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/images/',
			'root_js'	=> BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
			'menu_left' => $menu_left,
			'menu_rigth'=> $menu_rigth 
		);


		$rootView = ROOT . 'views' . DS . $this->_controller . DS . $view . '.phtml';
		if(is_readable($rootView) && $this->_controller == 'login')
		{
			include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
			include_once $rootView;
		}elseif(is_readable($rootView) && $this->_controller == 'error')
		{
			include_once $rootView;
		}
		elseif(is_readable($rootView))
		{
			include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
			include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'menu_left.php';
			include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'menu_notifications.php';
			
			include_once $rootView;
			# CONDICION PARA IMPORTAR MENU DEPENDIENDO DEL ARREGLO
			//if(in_array($this->_controller, $arr_menu_rigth)){
				//include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'menu_rigth.php';
			//}
			include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
		}
		else
		{
			throw new Exception("Error: Views");	
		}
	}
}













?>