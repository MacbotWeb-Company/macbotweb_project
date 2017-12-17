<?php

class configuserModel extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getUsers($id_docente, $id_institucion)
	{
		$sql = "select * from pl_docentes where id_docente = $id_docente and id_institucion = $id_institucion; ";
		$data = $this->_db->query($sql);
		return $data->fetch(PDO::FETCH_ASSOC);
	}

	public function updateUsers($id_user, $id_institucion, $firstName, $lastName, $user, $email,  $phone1, $phone2, $address1, $address2)
	{
		$sql = "update pl_docentes set nombres = '$firstName', apellidos = '$lastName' , 
				user = '$user', email = '$email' ,
				direccion_1 = '$address1', direccion_2 = '$address2', telefono_1 = '$phone1', telefono_2 = '$phone2'
				where id_docente = $id_user and id_institucion = $id_institucion ";
		$data = $this->_db->query($sql);
		return $data;
	}

	public function updateUsersPassword($id_user, $id_institucion, $password)
	{
		$sql = "update pl_docentes set  password = '" . $password . "'
				where id_docente = $id_user and id_institucion = $id_institucion ";
		$data = $this->_db->query($sql);
		return $data;
	}

}

?>