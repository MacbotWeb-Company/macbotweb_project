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

		$this->rs_UserSessioninfo = $this->_usersInfo->getUsersInfo(
			$this->_sess_client, 
			$this->_sess_user);
		
	}

	public function index()
	{

		$this->_view->title			= 'Setting Users';
		$this->_view->page_title	= 'Setting Users';

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