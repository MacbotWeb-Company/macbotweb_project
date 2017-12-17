<?php

class loginModel extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getUser($user, $password)
	{
		
		$sql = "SELECT 
				    r.id_rol,
				    r.acronym AS rol,
				    u.id_user AS id_user,
				    u.user_name AS user,
				    c.id_client AS id_client,
				    c.nombre_negocio,
				    c.nombre_comercial,
				    u.status,
				    u.nick_name,
				    u.first_name,
				    u.last_name
				FROM
				    mb_user_rol ur,
				    mb_rol r,
				    mb_users u,
				    mb_clients c
				WHERE
				    ur.id_rol = r.id_rol
				        AND ur.id_client = c.id_client
				        AND ur.id_user = u.id_user
				        AND u.user_name = :user
				        AND u.password = :password
				        AND u.status = 'A' ";
		$this->_db->query($sql);
		$this->_db->bind('user', $user);
		$this->_db->bind('password', md5($password));
		$this->_db->execute();
		$data =  $this->_db->single();

		return $data;
	}
}

?>