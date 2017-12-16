<?php


class setting_usersController extends Controller
{
	private $_usersList;

	public function __construct()
	{
		parent::__construct();
		$this->_usersList = $this->loadModel('setting_users');
		Session::strictAccess(array('admin'));
		
	}

	public function index()
	{

		$this->_view->title			= 'Setting Users';
		$this->_view->page_title	= 'Setting Users';

		$arr_userList	= $this->_usersList->getUsersList(1);
		$rs_userList 	= array();
		if($this->isArray($arr_userList)){
			foreach($arr_userList as $key => $val){
				$icon_userType      = "icon-account";
                $icon_userDelete    = "icon-delete";
                $icon_userWebsite   = "icon-web";
                $tooltip_userWebsite = "Click to edit the website for a user";
                $tooltip_userDelete	 = "Click to delete a user";
				$tooltip_userType	 = "Normal user";

                if($val['acronym'] == 'admin'){
                    $icon_userType      = "icon-account-multiple";
                    $icon_userDelete    = "icon-lock";
                    $icon_userWebsite   = "icon-account-network";
                    $tooltip_userWebsite = "This user has all the websites enabled";
                    $tooltip_userDelete	 = "You can't delete this user";
                    $tooltip_userType	 = "Master user";
				}

				

                $rs_userList[$val['id_user']]['nick_name']	= $val['nick_name'];
                $rs_userList[$val['id_user']]['id_user'] 	= $val['id_user'];
                $rs_userList[$val['id_user']]['email'] 		= $val['email'];
                $rs_userList[$val['id_user']]['firstName']	= $val['first_name'];
                $rs_userList[$val['id_user']]['lastName']	= $val['last_name'];
				$rs_userList[$val['id_user']]['status']		= $val['status'];


                $rs_userList[$val['id_user']]['icon_userType']		= $icon_userType;
                $rs_userList[$val['id_user']]['icon_userDelete']	= $icon_userDelete;
                $rs_userList[$val['id_user']]['icon_userWebsite']	= $icon_userWebsite;

                $rs_userList[$val['id_user']]['tp_userWebsite']		= $tooltip_userWebsite;
                $rs_userList[$val['id_user']]['tp_userDelete']		= $tooltip_userDelete;
                $rs_userList[$val['id_user']]['tp_userType']		= $tooltip_userType;

			}
		}
		$this->_view->usersList = $rs_userList;

		$this->_view->render('index', 'setting_users');

	}

	public function delete_setting_users($id_store)
	{

		$this->_usersList->deleteSettingUsers(1, $id_store);
		$this->redirect('setting_users');
	}

}


?>