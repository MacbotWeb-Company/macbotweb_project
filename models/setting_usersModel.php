<?php

class setting_usersModel extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getUsersList($id_client)
	{
		$sql  = "SELECT 
					u.nick_name,
				    u.id_user,
				    u.user_name as email,
				    u.first_name , 
				    u.last_name,
				    r.name as rol_name,
				    r.acronym,
				    u.status
				FROM
				    mb_users u,
				    mb_user_rol ur,
				    mb_rol r
				WHERE
				    u.id_user = ur.id_user
				    AND ur.id_rol = r.id_rol
				    AND ur.id_client = :id_client; ";

		 $this->_db->query($sql);
		 $this->_db->bind('id_client', $id_client);
		 $this->_db->execute();
		 $data =  $this->_db->resultset();

		return $data;
	}

	public function deleteSettingUsers($id_client, $id_store)
	{

	}


}

?>