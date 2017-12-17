<?php
date_default_timezone_set('America/Guayaquil');
require_once ('Google/autoload.php');
class GoogleAuth{
	private $client_id 	= NULL;
	private $client_secret	= NULL;
	public	$redirect_uri 	= NULL;
	private $results;
	public function __construct() {
		$this->gp_token = 'AIzaSyCkuwy0jyg-cqNgGdfVIPWdtfGpqRH8mEQ';
		$this->version	= 'v1';
		
	}
	function getURL($client_id, $client_secret, $redirect_uri)
	{
		$arr_gaplus = array();
		try 
		{

			$client = new Google_Client();
			$client->setClientId($client_id);
			$client->setClientSecret($client_secret);
			$client->setRedirectUri($redirect_uri);
			$client->addScope("email");
			$client->addScope("profile");
			
			
			return $arr_gaplus;
			
		} catch(Exception $e) 
		{
			return $arr_gaplus;
		}
	}

	public function __destruct() {    
        unset($this->user_id);
        unset($this->url);
    }
}

?>
