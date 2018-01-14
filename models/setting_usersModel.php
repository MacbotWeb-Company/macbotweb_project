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

	public function insertUser($user_name, $password, $nick_name, $first_name, $middle_name, $last_name, $mobile_phone, $work_phone, $address, $address2, $status){
		
		$sql = "INSERT INTO mb_users (id_user, user_name, password, nick_name, first_name, middle_name, last_name, mobile_number, work_number, address, address2, status) VALUES (null, :user_name, :password, :nick_name, :first_name, :middle_name, :last_name, :mobile_number, :work_number, :address, :address2, :status)";
		
		$this->_db->query($sql);
		$this->_db->bind('user_name', $user_name);
		$this->_db->bind('password', $password);
		$this->_db->bind('nick_name', $nick_name);
		$this->_db->bind('first_name', $first_name);
		$this->_db->bind('middle_name', $middle_name);
		$this->_db->bind('last_name', $last_name);
		$this->_db->bind('mobile_number', $mobile_phone);
		$this->_db->bind('work_number', $work_phone);
		$this->_db->bind('address', $address);
		$this->_db->bind('address2', $address2);
		$this->_db->bind('status', $status);
		$this->_db->execute();
	
	}

	public function insertUserRol($id_client, $id_user, $id_rol, $date_created, $status){
		
		$sql = "INSERT INTO mb_user_rol (id_user_rol, id_client, id_user, id_rol, date_created, status) VALUES (null, :id_client, :id_user, :id_rol, :date_created, :status)";
		$this->_db->query($sql);
		$this->_db->bind('id_client', $id_client);
		$this->_db->bind('id_user', $id_user);
		$this->_db->bind('id_rol', $id_rol);
		$this->_db->bind('date_created', $date_created);
		$this->_db->bind('status', $status);

		$this->_db->execute();
	
	}


	public function lastInsert()
	{
		$last_insert = $this->_db->lastInsertId();

		return $last_insert;
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