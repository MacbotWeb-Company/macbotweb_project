<?php

class google_plus_settingController extends Controller
{
	private $_integrations; # Instanciar todo el modelo para utilizar todos los controller
	private $_gplusapi;
	private $_googleplus;

	public function __construct()
	{
		$this->getLibrary('Google/autoload');
		$this->getLibrary('class.google_plus');

		parent::__construct();
		$this->_integrations			= $this->loadModel('integrationsapp');
		$this->_googleplus 				= $this->loadModel('google_plus');
		$this->_gplusapi 				= new GooglePlusAPI();
		$this->_view->data_credentials 	= self::getDataCredencials();
		$this->_view->title   			= 'Integrations - APP';
		$this->_view->page_title		= 'GOOGLE PLUS';
		
		
	}
	public function index()
	{
		if($this->isArray($this->_view->data_credentials)){
			$this->_view->btn_add_display = false;
		}else{
			$this->_view->btn_add_display = true;
		}
		
		//$this->_view->data_credentials = $this->_view->data_credentials;
		if(!$this->isArray($this->_view->data_credentials)){
			$this->redirect('google_plus_setting/add');
			exit;
		}
		
		$this->_view->dataprofile = $this->_googleplus->getDataProfile(1,1);
		
		
		#RETURN DATA VIEWS
		$this->_view->render('index', 'menu-integrations');
	}
	
	public function add(){
		
		if($this->isArray($this->_view->data_credentials)){
			$this->redirect('google_plus_setting');
			exit;
		}

		

		$client_id = '1037102833655-o6ba0ema1qd5i3eaqc2v7ro1ojh7cn7l.apps.googleusercontent.com'; 
		$client_secret = 'yY41wA7JsNwRTR1DSxmzGBOE';
		$redirect_uri = 'https://www.macbotweb.com/app/google_plus_setting/add';



		//incase of logout request, just unset the session var
		if (isset($_GET['logout'])) {
		  unset($_SESSION['access_token']);
		}

		

		$client = new Google_Client();
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->addScope("email");
		$client->addScope("profile");
		
		$service = new Google_Service_Oauth2($client);

	
		if (isset($_GET['code'])) {
		  $client->authenticate($_GET['code']);
		  $_SESSION['access_token'] = $client->getAccessToken();
		  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
		  exit;
		}

		
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		  $client->setAccessToken($_SESSION['access_token']);
		} else {
		  $authUrl = $client->createAuthUrl();
		}


		
		if (isset($authUrl)){ 
			//show login url
			/*echo '<div align="center">';
			echo '<h3>Login with Google -- Demo</h3>';
			echo '<div>Please click login button to connect to Google.</div>';
			echo '<a class="login" href="' . $authUrl . '"><img src="images/google-login-button.png" /></a>';
			echo '</div>';*/
			
		} else {
			
			$user = $service->userinfo->get(); //get user info 
			
			//print user details
			
		}


		if($this->getInt('saved_gp') == 1){
			
			$this->_view->data_credentials = $_POST;
			
			if(!$this->getText('google_plus_name')){
				$this->_view->error = "The name is required";
				$this->_view->render('add', 'menu-integrations');
				exit;
				
			}
			if(!$this->getText('google_plus_provider_id')){
				$this->_view->error = "The provider id is required";
				$this->_view->render('add', 'menu-integrations');
				exit;
				
			}
			$start_date  = date("Ym01");
			$end_date	 = date("Ymd");


			$gp_profile  = $this->_gplusapi->getDataProfile($this->getText('google_plus_provider_id'));
			$gp_activity = $this->_gplusapi->getActivities($start_date, $end_date);


			if($this->isArray($gp_profile)){
				/*if($this->getText('google_plus_provider_id') != $this->getTextValue($gp_profile['id'])){
					$this->_view->error = "The Provider ID is incorrect";
					$this->_view->render('add', 'menu-integrations');
					exit;
				}*/
				if($this->getText('google_plus_name') != $this->getTextValue($gp_profile['displayName'])){
					$this->_view->error = "The name is incorrect";
					$this->_view->render('add', 'menu-integrations');
					exit;
				}	
				
				
				$this->_googleplus->insertProfileGooglePus(
						1,
						1,
						$this->getDateTime("Y-m-d"),
						$this->getTextValue($gp_profile['id']),
						$this->getTextValue($gp_profile['displayName']),
						$this->getTextValue($gp_profile['nickname']),
						$this->getTextValue($gp_profile['gender']),
						$this->getTextValue($gp_profile['url']),
						$this->getTextValue($gp_profile['url_website']),
						$this->getTextValue($gp_profile['url_label']),
						$this->getTextValue($gp_profile['image']),
						$this->getTextValue($gp_profile['followers']),
						$this->getTextValue($gp_profile['plusOneCount']),
						$this->getTextValue($gp_profile['organizations_name']),
						$this->getTextValue($gp_profile['organizations_type']),
						$this->getTextValue($gp_profile['tagline']),
						$this->getTextValue($gp_profile['aboutMe'])
				);	
				
				if($this->isArray($gp_activity)){
					foreach($gp_activity['post_list'] as $acti){
						$exist_acivity = $this->_googleplus->getActivityByID(1,1, $acti['id']);
						if($exist_acivity)
						{
							$this->_googleplus->updatedActivityGooglePus(
								$this->getTextValue($acti['title']),
								$this->getTextValue($acti['published']),
								$this->getTextValue($acti['updated']),
								$this->getTextValue($acti['id']),
								$this->getTextValue($acti['url']),
								$this->getTextValue($acti['provider']),
								$this->getTextValue($acti['type']),
								$this->getTextValue($acti['total_replies']),
								$this->getTextValue($acti['total_plusoners']),
								$this->getTextValue($acti['total_resharers'])
							);
						}
						else
						{
							$this->_googleplus->insertActivityGooglePus(
								1,
								1,
								$this->getMonth("F"),
								$this->getYear(),
								$this->getTextValue($acti['title']),
								$this->getTextValue($acti['published']),
								$this->getTextValue($acti['updated']),
								$this->getTextValue($acti['id']),
								$this->getTextValue($acti['url']),
								$this->getTextValue($acti['provider']),
								$this->getTextValue($acti['type']),
								$this->getTextValue($acti['total_replies']),
								$this->getTextValue($acti['total_plusoners']),
								$this->getTextValue($acti['total_resharers'])
							);
						}
						
						
					}
				}
					
				$this->_integrations->insertCredentialsAPP(
					1,
					1,
					'Google Plus APP',
					'google_plus_name',
					$this->getText('google_plus_name')
				);
				$this->_integrations->insertCredentialsAPP(
					1,
					1,
					'Google Plus APP',
					'google_plus_provider_id',
					$this->getText('google_plus_provider_id')
				);
				$this->_view->iscorrect = 'The Google+ has been enabled correctly';
				$this->_view->render('add', 'menu-integrations');
				//$this->redirect('google_plus_setting');
			}else{
				$this->_view->error = "Ops! The parameters is incorrect!";
				$this->_view->render('add', 'menu-integrations');
				exit;
			}
				
		}
		
		
		$this->_view->render('add', 'menu-integrations');
	}
	public function edit(){
		
		$this->_view->render('edit', 'menu-integrations');
	}
	
	public function getDataCredencials(){
		$arr_gp_credentials = array();
		$rs_gp = $this->_integrations->getWebSIteCredentials('Google Plus APP');
		
		if($this->isArray($rs_gp)){
			foreach($rs_gp as $value){
				$arr_gp_credentials[$value['app_prefix']] = $value['app_value'];
			}
		}
		
		return $arr_gp_credentials;
	}
	
	
	
	
}

?>