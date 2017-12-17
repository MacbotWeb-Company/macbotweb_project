<?php
date_default_timezone_set('America/Guayaquil');
class GooglePlusAPI{
	private $userdId 	= NULL;
	private $gp_token	= NULL;
	public	$version 	= NULL;
	private $results;
	public function __construct() {
		$this->gp_token = 'AIzaSyBsWLEQDgCq_7hQcpVxbSjBg9SCis4WuEU';
		$this->version	= 'v1';
		
	}
	function getDataProfile($userdId = NULL){
		$arr_gaplus = array();
		try {
			$this->user_id 		= $userdId;
			$this->url			= "https://www.googleapis.com/plus/".$this->version."/people/" . $this->user_id . '?key=' . $this->gp_token;
			
			$ga_place_curl		= curl_init();   
			curl_setopt($ga_place_curl, CURLOPT_URL, $this->url);
			curl_setopt($ga_place_curl,CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ga_place_curl, CURLOPT_RETURNTRANSFER, true);
			$gp_results 		= curl_exec($ga_place_curl);

			curl_close ($ga_place_curl);
			
			$this->results 		= json_decode($gp_results,true);
			if(isset($this->results["error"])) { 
				throw new Exception($this->results["error"]["message"]);
			}
			
			
			if(is_array($this->results)){
				$arr_gaplus['id'] 			= $this->results['id'];
				$arr_gaplus['displayName']  = $this->results['displayName'];
				$arr_gaplus['nickname'] 	= (isset($this->results['nickname'])) ? $this->results['nickname'] : NULL;
				$arr_gaplus['objectType']	= $this->results['objectType'];
				$arr_gaplus['gender']		= (isset($this->results['gender'])) ? $this->results['gender'] : NULL;
				$arr_gaplus['url']			= $this->results['url'];
				$arr_gaplus['url_website']	= (isset($this->results['urls'][0]['value'])) ? $this->results['urls'][0]['value'] : '';;
				$arr_gaplus['url_label']	= (isset($this->results['urls'][0]['label'])) ? $this->results['urls'][0]['label'] : '';
				$arr_gaplus['image']		= $this->results['image']['url'] ;
				$arr_gaplus['followers']	= (isset($this->results['circledByCount'])) ? $this->results['circledByCount'] : 0;
				$arr_gaplus['plusOneCount']	= (isset($this->results['plusOneCount'])) ? $this->results['plusOneCount'] : 0;
				$arr_gaplus['organizations_name']	= (isset($this->results['organizations'])) ? $this->results['organizations'][0]['name'] : NULL;
				$arr_gaplus['organizations_type']	= (isset($this->results['organizations'])) ? $this->results['organizations'][0]['type'] : NULL;
				$arr_gaplus['tagline']				= (isset($this->results['tagline'])) ? $this->results['tagline'] : NULL;
				$arr_gaplus['aboutMe']				= (isset($this->results['aboutMe'])) ? $this->results['aboutMe'] : NULL;

			}
			
			return $arr_gaplus;
			
		} catch(Exception $e) {
			return $arr_gaplus;
			//echo "Message Google+: " . $e->getMessage();	
		}
	}
	function getActivities($start_date = NULL, $end_date = NULL){
		$arr_gaplus = array();
		try {
			$start_year		= date("Y", strtotime($start_date));
			$start_month	= date("F", strtotime($start_date));
			
			$day			= date("d", strtotime($end_date));
			
			
			$this->url		= "https://www.googleapis.com/plus/".$this->version."/people/" . $this->user_id . '/activities/public?';
			$this->url	   .= 'maxResults=100&orderBy=recent';
			$this->url	   .= 'fields=items(access(description,items),actor(clientSpecificActorInfo,displayName,id),id,object(actor(clientSpecificActorInfo,displayName,id),attachments/id,id,objectType,plusoners/totalItems,replies/totalItems,resharers/totalItems),provider,published,title,updated,url,verb)&';
			$this->url	   .= 'key=' . $this->gp_token;
		

			$ga_place_curl		= curl_init();   
			curl_setopt($ga_place_curl, CURLOPT_URL, $this->url);
			curl_setopt($ga_place_curl,CURLOPT_SSL_VERIFYPEER, false);
			
			curl_setopt($ga_place_curl, CURLOPT_RETURNTRANSFER, true);
			$gp_results 		= curl_exec($ga_place_curl);
			curl_close ($ga_place_curl);
			
			$this->results 		= json_decode($gp_results,true);
			
			$x 				= 0;
			$replies 		= 0;
			$plusoners		= 0;
			$resharers		= 0;
			$public_post	= 0;
			$arr_provider	= array();
			$arr_replies	= array();
			$arr_plusoners	= array();
			$arr_resharers	= array();
			$day_replies 	= array();
			$day_plusoners 	= array();
			$day_resharers 	= array();
			if(isset($this->results['items']) && is_array($this->results['items'])){
				foreach($this->results['items'] as $val_activity){
					$month_api	= date("F", strtotime($val_activity['published']));
					$year_api	= date("Y", strtotime($val_activity['published']));
					if($month_api == $start_month && $year_api == $start_year){
						$arr_gaplus['post_list'][$x]['title'] 		= $val_activity['title'];
						$arr_gaplus['post_list'][$x]['published']	= $val_activity['published'];
						$arr_gaplus['post_list'][$x]['updated']		= $val_activity['updated'];
						$arr_gaplus['post_list'][$x]['id']			= $val_activity['id'];
						$arr_gaplus['post_list'][$x]['url']			= $val_activity['url'];
						$arr_gaplus['post_list'][$x]['provider']	= $val_activity['provider']['title'];
						$arr_gaplus['post_list'][$x]['type']		= $val_activity['access']['items'][0]['type'];
						
						$arr_gaplus['post_list'][$x]['total_replies']	= $val_activity['object']['replies']['totalItems'];
						$arr_gaplus['post_list'][$x]['total_plusoners']	= $val_activity['object']['plusoners']['totalItems'];
						$arr_gaplus['post_list'][$x]['total_resharers']	= $val_activity['object']['resharers']['totalItems'];
						
						$replies	 += $val_activity['object']['replies']['totalItems'];
						$plusoners	 += $val_activity['object']['plusoners']['totalItems'];
						$resharers	 += $val_activity['object']['resharers']['totalItems'];
						
						if($val_activity['object']['replies']['totalItems']){
							$day_replies[date("d" , strtotime($val_activity['published']))]		= $val_activity['object']['replies']['totalItems'];
						}
						if($val_activity['object']['plusoners']['totalItems']){
							$day_plusoners[date("d" , strtotime($val_activity['published']))]	= $val_activity['object']['plusoners']['totalItems'];
						}
						if($val_activity['object']['resharers']['totalItems']){
							$day_replies[date("d" , strtotime($val_activity['published']))]		= $val_activity['object']['resharers']['totalItems'];
						}
						
						if($val_activity['access']['items'][0]['type'] === 'public'){
							$public_post += 1;
						}
						$arr_provider[] = $val_activity['provider']['title'];
						
						$x++;
					}				
				}
				for($i=1; $i <= $day; $i++){
					$arr_replies[$i] 	= (isset($day_replies[$i]))		? $day_replies[$i]		: 0 ;
					$arr_plusoners[$i]	= (isset($day_plusoners[$i]))	? $day_plusoners[$i]	: 0 ;
					$arr_resharers[$i]	= (isset($day_resharers[$i]))	? $day_resharers[$i]	: 0 ;
				}
			}
			
			
			
			$arr_provider_tmp = array_count_values($arr_provider);
			
			$arr_gaplus['totals']['total_replies'] 	= $replies;
			$arr_gaplus['totals']['total_plusoners'] 	= $plusoners;
			$arr_gaplus['totals']['total_resharers'] 	= $resharers;
			$arr_gaplus['totals']['total_public_post'] 	= $public_post;
			$arr_gaplus['totals']['total_provider'] 	= $arr_provider_tmp;
			$arr_gaplus['day_replies'] 					= $arr_replies;
			$arr_gaplus['day_plusoners'] 				= $arr_plusoners;
			$arr_gaplus['day_resharers'] 				= $arr_resharers;
			
			if(isset($this->results["error"])) { 
				throw new Exception($this->results["message"].". Error Type: ".$this->results["message"]);
			}

			return $arr_gaplus;
			
		} catch(Exception $e) {
			echo "Message Google+: " . $e->getMessage().'<br>';	
		}
	}
	public function __destruct() {    
        unset($this->user_id);
        unset($this->url);
    }
}

?>
