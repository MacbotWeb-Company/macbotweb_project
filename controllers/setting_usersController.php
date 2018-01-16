<?php

class setting_usersController extends Controller
{
	private $_usersSett;
	private $_usersInfo;
	private $_sess_client;

	public function __construct()
	{
		parent::__construct();
		$this->_usersSett = $this->loadModel('setting_users');
		$this->_usersInfo = $this->loadModel('usersInfo');
		Session::strictAccess(array('AD','MU'));
		$this->_sess_client = Session::get('mb_id_client');
		$this->_sess_user   = Session::get('mb_id_user');
		$this->_view->icon_title	= 'icon-account-settings-variant';
		$this->_view->page_title	= 'Setting Users';
		$this->rs_UserSessioninfo = $this->_usersInfo->getUsersInfo(
			$this->_sess_client, 
			$this->_sess_user);
		
	}

	public function index()
	{

		$this->_view->icon	= 'icon-format-list-checks';
		$this->_view->title	= 'List of Users';

		$arr_userList	= $this->_usersSett->getUsersList($this->_sess_client);
		$rs_userList 	= array();
		if($this->isArray($arr_userList)){
			foreach($arr_userList as $key => $val){
				
				$icon 	 = $this->getIconByLevel($val['acronym']);
				$tooltip = $this->getTooltipByLevel($val['acronym']);

                $rs_userList[$val['id_user']]['nick_name']	= $val['nick_name'];
                $rs_userList[$val['id_user']]['id_user'] 	= $val['id_user'];
                $rs_userList[$val['id_user']]['email'] 		= $val['email'];
                $rs_userList[$val['id_user']]['firstName']	= $val['first_name'];
                $rs_userList[$val['id_user']]['lastName']	= $val['last_name'];
				$rs_userList[$val['id_user']]['status']		= $val['status'];

                $rs_userList[$val['id_user']]['icon_userType']		= $icon['type'];
                $rs_userList[$val['id_user']]['icon_userDelete']	= $icon['delete'];
                $rs_userList[$val['id_user']]['icon_userWebsite']	= $icon['website'];

                $rs_userList[$val['id_user']]['tp_userWebsite']		= $tooltip['user_website'];
                $rs_userList[$val['id_user']]['tp_userDelete']		= $tooltip['user_delete'];;
                $rs_userList[$val['id_user']]['tp_userType']		= $tooltip['user_type'];;

			}
		}
		$this->_view->usersList = $rs_userList;

		$this->_view->render('index', 'setting_users');

	}

	public function add_setting_users()
	{
		$this->_view->icon	= 'icon-account-plus';
		$this->_view->title	= 'Add Users';

		if($this->getInt('send') == 1)
		{
			$this->_view->datos = $_POST;
			$username = $this->getText('mb_User_1') . "@" .$this->getText('mb_User_2');
			if(!$this->getText('mb_FirstName'))
			{
				$this->_view->error = 'The first name is required';
				$this->_view->render('add_setting_users', 'add_users');
				exit();
			}
			
			if(!$this->getText('mb_LastName'))
			{
				$this->_view->error = 'The last name is required';
				$this->_view->render('add_setting_users', 'add_users');
				exit();
			}

			if(!$this->getEmailValidatedText($username))
			{
				$this->_view->error = 'The email is invalid';
				$this->_view->render('add_setting_users', 'add_users');
				exit();
			}
			if(!$this->getAlphaNum('mb_Password'))
			{
				$this->_view->error = 'The password is required';
				$this->_view->render('add_setting_users', 'add_users');
				exit();
			}
			if(!$this->getAlphaNum('mb_PasswordConfirmation'))
			{
				$this->_view->error = 'The password confirmation is required';
				$this->_view->render('add_setting_users', 'add_users');
				exit();
			}

			if($this->getAlphaNum('mb_Password') != $this->getAlphaNum('mb_PasswordConfirmation'))
			{
				$this->_view->error = 'The password not match';
				$this->_view->render('add_setting_users', 'add_users');
				exit();
			}


			$this->_usersSett->insertUser(
				$username, 
				md5($this->getAlphaNum('mb_Password')), 
				NULL, 
				$this->getText('mb_FirstName'), 
				$this->getText('mb_MiddleName'), 
				$this->getText('mb_LastName'), 
				$this->getInt('mb_Mobile'), 
				$this->getInt('mb_Phone'), 
				$this->getText('mb_Address'), 
				$this->getText('mb_Address2'), 
				'A');

			$iduser = $this->_usersSett->lastInsert();
			
			$this->_usersSett->insertUserRol(
				$this->filterInt($this->_sess_client), 
				$this->filterInt($iduser), 
				$this->getInt('mb_rolUser'), 
				$this->getDatetime(), 
				'A');
		}
		

		
		$this->_view->render('add_setting_users', 'add_users');
	}


	public function delete_setting_users($id_user)
	{
		$iduser = $this->filterInt($id_user);

		if(!$this->filterInt($id_user))
		{
			$this->redirect('setting_users');
		}
		
		if(!$this->_usersInfo->getUsersExist($this->_sess_client, $iduser))
		{
			$this->redirect('setting_users');
		}

		$rsUserRol =  $this->_usersInfo->getUsersInfo($this->_sess_client, $iduser);
		
		if($rsUserRol['acronym'] == 'MU')
		{
			$this->redirect('setting_users');
		}

		$this->_usersSett->deleteUsersRol($this->_sess_client, $iduser);
		$this->_usersSett->deleteUsers($iduser);
		

		$this->redirect('setting_users');

	}

}


?>