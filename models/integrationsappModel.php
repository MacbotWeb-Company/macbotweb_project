<?php

class integrationsappModel extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getIntegrationsApp($type)
	{
		$sql  = "SELECT id_integration_app, name, legend1, legend2, url, logo FROM mb_integrations_app where legend1 = '$type' and status = 'A' order by order_app; ";
		$data = $this->_db->query($sql);

		return $data->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function insertCredentialsAPP($idclient, $id_website, $app_name, $app_prefix, $app_value){
		try {

			// create SQL
			$sql = "INSERT INTO mb_websites_credentials VALUES (null, :id_client, :id_website, :app_name, :app_prefix, :app_value)";
			
			// prepare the statement
			$stmt = $this->_db->prepare($sql);		
			// bind the parameters and execute the statement
			$stmt->bindValue(':id_client', $idclient);
			$stmt->bindValue(':id_website', $id_website);
			$stmt->bindValue(':app_name', $app_name);
			$stmt->bindValue(':app_prefix', $app_prefix);
			$stmt->bindValue(':app_value', $app_value);
			// execute the statement
			
			$stmt->execute();
			
			} 
			catch (Exception $e) 
			{ 
				echo $e->getMessage(); 
			} 
			
	}
	
	public function updatedCredentialsAPP($idclient, $id_website, $app_name, $app_prefix, $app_value){
		$sql = "UPDATE INTO mb_websites_credentials VALUES (null, :id_client, :id_website, :app_name, :app_prefix, :app_value)";
	}
	
	public function getWebSIteCredentials($app){
		$sql  = "SELECT app_name, app_prefix, app_value FROM mb_websites_credentials WHERE app_name = '$app';";
		$data = $this->_db->query($sql);

		return $data->fetchAll(PDO::FETCH_ASSOC);
	}

}

?>