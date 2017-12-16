<?php


class loginController extends Controller
{
	private $_login;

	public function __construct()
	{
		parent::__construct();
		$this->_login = $this->loadModel('login');
	}

	public function index()
	{

		$this->_view->title = 'Inicia Session';
		if($this->getInt('send') == 1)
		{
			$this->_view->datos = $_POST;
			
			if(!$this->getEmailValidated('mb_user'))
			{
				$this->_view->error = 'Debe introducir su nombre de usuario';
				$this->_view->render('index', 'login');
				exit();
			}

			if(!$this->getSql('mb_password'))
			{
				$this->_view->error1 = 'Debe introducir su nombre de password';
				$this->_view->render('index', 'login');
				exit();
			}

			$row = $this->_login->getUser(
					$this->getEmailValidated('mb_user'),
					$this->getSql('mb_password'),
					$this->getAlphaNum('state')
					);

			if(!$row)
			{
				$this->_view->error = 'Usuario y/o password incorrectos';
				$this->_view->render('index', 'login');
				exit();
			}

			if($row['status'] != 'A')
			{
				$this->_view->error = 'Este usuario no esta habilitado';
				$this->_view->render('index', 'login');
				exit();
			}

			Session::set('authentication', true);
			Session::set('level', $row['rol']);
			Session::set('user', $row['user']);
			Session::set('id_user', $row['id_user']);
			Session::set('id_institucion', $row['id_client']);
			Session::set('time', time());
			Session::set('token', md5('ec_planificador2229*'));

			$this->redirect('index');

		}

		$this->_view->render('index', 'login');

	}

	public function close()
	{
		Session::destroy();
		$this->redirect('login');
	}
}


?>