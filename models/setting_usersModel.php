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


	public function deleteUsers($id_user)
	{
		$sql  = "DELETE FROM mb_users WHERE id_user = :id_user;";
		
		$this->_db->query($sql);
		$this->_db->bind('id_user', $id_user);
		$this->_db->execute();

	}

	public function deleteUsersRol($id_client, $id_user)
	{
		$sql  = "DELETE FROM mb_user_rol WHERE id_client = :id_client AND id_user = :id_user;";
		
		$this->_db->query($sql);
		$this->_db->bind('id_client', $id_client);
		$this->_db->bind('id_user', $id_user);
		$this->_db->execute();

	}

	public function updateUsersRolStatus($id_client, $id_user, $status = 'A')
	{
		$sql  = "UPDATE mb_user_rol SET status = :status WHERE id_client = :id_client AND id_user = :id_user;";
		
		$this->_db->query($sql);
		$this->_db->bind('status', $status);
		$this->_db->bind('id_client', $id_client);
		$this->_db->bind('id_user', $id_user);
		$this->_db->execute();

	}

	public function updateUsersStatus($id_user, $status = 'A')
	{

		$sql  = "UPDATE mb_users SET status = :status WHERE id_user = :id_user;";
		echo $sql;
		$this->_db->query($sql);
		$this->_db->bind('status', $status);
		$this->_db->bind('id_user', $id_user);
		$this->_db->execute();

	}
	


}

?>