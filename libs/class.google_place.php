<?php
date_default_timezone_set('America/Guayaquil');
class GooglePlaceAPI{
	private $placeid 	= NULL;
	private $name 		= NULL;
	private $address 	= NULL;
	private $lon 		= NULL;
	private $lat 		= NULL;
	private $token		= 'AIzaSyCkuwy0jyg-cqNgGdfVIPWdtfGpqRH8mEQ';
	private $results;
	public function __construct($placeid, $lon = NULL, $lat = NULL, $name = NULL, $address = NULL) {
		try {
			$this->placeid 		= $placeid;
			$this->url			= "https://maps.googleapis.com/maps/api/place/details/json?placeid=".$this->placeid. '&key=' . $this->token;
			$ga_place_curl		= curl_init();   
			curl_setopt($ga_place_curl, CURLOPT_URL, $this->url);
			curl_setopt($ga_place_curl,CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ga_place_curl, CURLOPT_RETURNTRANSFER, true);
			$gp_results 		= curl_exec($ga_place_curl);
			curl_close ($ga_place_curl);
			$this->results 		= json_decode($gp_results,true);
			
			if(isset($this->results["error"])) { 
				throw new Exception($this->metric["error"]["message"].". Error Type: ".$this->metric["error"]["message"]);
			}
		} catch(Exception $e) {
			echo "Message Google+: " . $e->getMessage().'<br>';	
		}
	}
	function getData(){
		$arr_gaplace = array();
		try {
			if(is_array($this->results)){
				foreach($this->results as $val_place){
					//$arr_gaplace['rating'] = $val_place['rating'];
					echo "<pre>";
					var_dump($val_place['rating']);
					echo "</pre>";
				}
				//$arr_gaplace['rating'] = $this->results['rating'];
				
			}
			
			return $arr_gaplace;
			
		} catch(Exception $e) {
			echo "Message Google+: " . $e->getMessage().'<br>';	
		}
	}
	
	public function __destruct() {    
        unset($this->user_id);
        unset($this->url);
    }


}
$placeid	= 'ChIJcTgq53luLZAR2NC32RustnU';
$lat		= '';
$log		= '';
$name 		= "Revista Vistazo";
$address 	= "Store in Guayaquil, Ecuador";

$ga_place 	= new GooglePlaceAPI($placeid, $lat, $log, $name, $address);
$rs_profile = $ga_place->getData();
echo "<pre>";
var_dump($rs_profile);
echo "</pre>";

/*

echo "<pre>";
var_dump($rs_profile);
var_dump($rs_activity);
echo "</pre>";
$name = "Revista Vistazo";
$city = "Store in Guayaquil, Ecuador";
$countrySearch = "";
$url= "http://www.google.com/maps/search/". urlencode($name) ."+". urlencode($city). "".$countrySearch."";	
$file = file($url);
$arr=NULL;
foreach($file as $linenum => $line){
    //echo "<b>Line #{$linenum}</b> ".htmlspecialchars($line).' <br>';
	htmlspecialchars($line);
	$pattern = '/[0-9]+(\.)+[0-9]+(\,")+[0-9]+ reviews/';
	if(preg_match($pattern, $line, $matches)){
		$arr = $matches;
	}
}
if(is_array($arr)){
	$explode = explode(',"',$arr[0]);
	$rating = number_format($explode[0],1);
	$review = str_replace("reviews","",$explode[1]);
	echo $name . " -> Rating: " . $rating . " Reviews: " . $review;
}else{
	echo "no data";
}
*/
?>
