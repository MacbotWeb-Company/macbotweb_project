<?php

class usersInfoModel extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getUsersInfo($id_client, $id_user)
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
				        AND ur.id_client = :id_client
				        AND u.id_user = :id_user ; ";
		$this->_db->query($sql);
		$this->_db->bind('id_client', $id_client);
		$this->_db->bind('id_user', $id_user);
		$this->_db->execute();
		$data =  $this->_db->single();

		return $data;
	}

	public function getUsersExist($id_client, $id_user)
	{
		$sql  = "SELECT id_user_rol 
				 FROM mb_user_rol 
				 WHERE id_client = :id_client 
				 AND id_user = :id_user;";
				 
		$this->_db->query($sql);
		$this->_db->bind('id_client', $id_client);
		$this->_db->bind('id_user', $id_user);
		$this->_db->execute();
		$data =  $this->_db->rowCount();

		return $data;
	}


}

?>