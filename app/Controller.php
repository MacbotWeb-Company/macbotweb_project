<?php
# Metodo abstract obliga a que siempre haya un metodo index asi no exista el codigo
abstract class Controller
{
	protected $_view;
	public function __construct()
	{
		$this->_view = new View(new Request);
	}
	abstract public function index();

	protected function loadModel($model)
	{
		$model = $model . 'Model';
		$rootModel = ROOT . 'models' . DS . $model . '.php';
		# SI EXISTE EL MODELO LO INSTANCIA
		if(is_readable($rootModel))
		{
			require_once $rootModel;
			$model = new $model;
			return $model;
		}
		else
		{
			throw new Exception("Error Models");
			
		}
	}

	protected function redirect($root = false)
	{

		if($root == FALSE)
		{
			$root_temp = BASE_URL . 'index';
			header('Location: '. $root_temp);
			exit();
		}
		else
		{
			$root_temp = BASE_URL . $root;
			header('Location: '. $root_temp);
			exit();
		}
	}

	public function filterInt($int)
	{
		$int = (int) $int;

		if(isset($int) && !empty($int)  && is_int($int))
		{
			return $int;
		}
		else
		{
			return 0;
		}
	}

	public function getInt($clave)
	{	
		if(isset($_POST[$clave]) && !empty($_POST[$clave]))
		{
			$_POST[$clave] = filter_input(INPUT_POST , $clave);
			return $_POST[$clave];
		}

		return 0;

	}

	protected function getSql($clave)
	{
		if(isset($_POST[$clave]) && !empty($_POST[$clave]))
		{
			$_POST[$clave] = strip_tags($_POST[$clave]);

			if(!get_magic_quotes_gpc())
			{
				$_POST[$clave] = mysql_escape_string($_POST[$clave]);
			}

			return trim($_POST[$clave]);
		}
	}

	protected function getAlphaNum($clave)
	{
		if(isset($_POST[$clave]) && !empty($_POST[$clave]))
		{
			$_POST[$clave] = (string) preg_replace('/[^A-Z0-9]/i', '', $_POST[$clave]);
			return trim($_POST[$clave]);
		}
	}

	protected function getEmailValidated($clave)
	{
		if(isset($_POST[$clave]) && !empty($_POST[$clave]))
		{
			if (filter_var($_POST[$clave], FILTER_VALIDATE_EMAIL)) {
			    return trim($_POST[$clave]);
			}
		}
	}

	protected function getDateFormat($date, $format)
	{
		if(isset($date) && !empty($date))
		{
			$date = date($format, strtotime($date));
			return $date;
		}

	}
	
	protected function getConfirmSQL($token)
	{
		if($token == md5('ec_planificador2229*')){
			return 1;
		}else{
			return 0;
		}
	}
	protected function getCompareString($clave){
		if(isset($_POST[$clave]))
		{ 
			return trim(mysql_escape_string($_POST[$clave]));
		}

	}
	protected function getText($clave){
		if(isset($_POST[$clave]) && !empty($_POST[$clave]))
		{ 
			$_POST[$clave] = htmlspecialchars($_POST[$clave], ENT_QUOTES);
			return $_POST[$clave];
		}else{
			return '';
		}

	}
	protected function getTextValue($clave = NULL){
		if(isset($clave) && !empty($clave))
		{ 
			$clave = htmlspecialchars($clave, ENT_QUOTES);
			return $clave;
		}else{
			return '';
		}

	}

	protected function isArray($clave){
		if(isset($clave) && !empty($clave) && is_array($clave) && count($clave) >= 0)
		{ 
			return 1;
		}else{
			return 0;
		}

	}
	protected function lastArray($clave){
		if(isset($clave) && !empty($clave) && is_array($clave) && count($clave) >= 0)
		{
			return $clave[count($clave)-1];;
		}else{
			return 0;
		}

	}
	protected function getLibrary($library){
		$root_library = ROOT . 'libs' . DS . $library . '.php';
		if(is_readable($root_library)){
			require_once $root_library;	
		}else{
			throw new Exception("Error Processing Library");
			
		}
	}
	protected function get_json_encode($clave){
		if(isset($clave) && !empty($clave)){
			return json_encode($clave);
		}else{
			return '';
			
		}
	}
	protected function get_json_decode($clave){
		if(isset($clave) && !empty($clave)){
			return json_decode($clave,true);
		}else{
			return '';
			
		}
	}
	protected function getDatetime($format = "Ymd"){
		$datetime = date($format . " H:i:s");
		return $datetime;
	}
	
	protected function getMonth($format = "M"){
		$month = date($format);
		return $month;
	}
	
	protected function getYear(){
		$month = date("Y");
		return $month;
	}
	
	protected function getNumberFormat($clave){
		return number_format((float)$clave, 2, '.', '');
	}
	
	protected function getStringMonth($months, $cont = NULL){
		if(isset($months) && !empty($months))
		{
			if($cont != 'ALL')
			{
				if(count($months) === 1)
				{
					return $months[0]['month'] . " " . $months[0]['year'];
				}
				if(count($months) > 1)
				{
					return count($months) . " MONTHS";
				}
			}
			else
			{
				$string_s = (count($months) > 1) ? 'S' : ''; 
				
				return count($months) . " MONTH" . $string_s;
				
			}
		}
	}
	
	protected function getDateMonthAndYear($clave = NULL){
		if(isset($_POST[$clave]) && !empty($_POST[$clave]))
		{ 
			$explode_date	= explode("-",$_POST[$clave]);
			$start_date 	= date("Y-m-01", strtotime($explode_date[0]));
			$end_date 		= date("Y-m-d", strtotime($explode_date[1]));
			$start    		= new DateTime($start_date);
			$end      		= new DateTime($end_date);
			$interval 		= DateInterval::createFromDateString('1 month');
			$period   		= new DatePeriod($start, $interval, $end);

			$date			= array();
			$x 				= 0;
			foreach ($period as $dt) {
				$date[$x]['month']	= $dt->format("F");
				$date[$x]['year']	= $dt->format("Y");
				$x++; 
				
			}	
			return $date;
			
		}else{
			
			return $date;
				
		}
	}
	
	protected function getDateByDefault($months = NULL){
		
		$start_date 	= date("Y-m-01", strtotime("-$months month"));
		$end_date 		= date("Y-m-d", strtotime("-1 day"));
		$start    		= new DateTime($start_date);
		$end      		= new DateTime($end_date);
		$interval 		= DateInterval::createFromDateString('1 month');
		$period   		= new DatePeriod($start, $interval, $end);
		$date			= array();
		$x 				= 0;
		foreach ($period as $dt) {
			$date[$x]['month']	= $dt->format("F");
			$date[$x]['year']	= $dt->format("Y");
			$x++; 
			
		}	
	
		return $date;
		
	}
	
	
	protected function getDataGraphGeneral($data){
		
		$arr_allkey = array();
		foreach($data as $key => $val)
		{ 
			foreach($val as $key1 => $val1)
			{
				$arr_allkey[$key1] = $key1;
			}
		}
		$arr_allkey = array_unique($arr_allkey);
		unset($arr_allkey['month'], $arr_allkey['year']);
	
		$arr_x = array();
		foreach($arr_allkey as $val)
		{
			$arr_x[$val] = '';
		}
		$arr_x['months'] = '';
		foreach($data as $key => $val)
		{ 
			if(isset($data[$key]['month']) && isset($data[$key]['year']))
			{
				$arr_x['months'] .= "'" . substr($data[$key]['month'], 0, 3) . "  " . $data[$key]['year'] . "',";
			}
			foreach($arr_allkey as $key_graph => $val_graph)
			{
				$arr_x[$key_graph] .=  isset($data[$key][$val_graph]) ? $data[$key][$val_graph] . "," : '0,';	
			}
		}
		
		return $arr_x;
		
	}
	
	protected function getDataSumGeneral($data){
		
		$arr_allkey = array();
		foreach($data as $key => $val)
		{ 
			foreach($val as $key1 => $val1)
			{
				$arr_allkey[$key1] = $key1;
			}
		}
		$arr_allkey = array_unique($arr_allkey);
		unset($arr_allkey['month'], $arr_allkey['year']);
	
		$arr_x = array();
		foreach($arr_allkey as $val)
		{
			$arr_x[$val] = '';
		}
		
		foreach($data as $key => $val)
		{ 
			foreach($arr_allkey as $key_graph => $val_graph)
			{
				$arr_x[$key_graph] +=  isset($data[$key][$val_graph]) ? $data[$key][$val_graph] : '0';	
			}
		}
		
		return $arr_x;
		
	}
	protected function getGauge($value = NULL, $maxvalue = NULL ){
		$result = array();
		if(isset($value) && !empty($value))
		{

			$maxValue =  $value * 5;
			$result['value'] 	= $value;
			$result['maxvalue'] = $maxValue;

			return $result;
		}else{

			$result['value'] 	= 0;
			$result['maxvalue'] = 100;

			return $result;
		}

	}

	protected function getDayDiff($clave = NULL){
		$result = array();
		if(isset($_POST[$clave]) && !empty($_POST[$clave]))
		{ 

			$explode_date	= explode("-",$_POST[$clave]);
			$start_date 	= date("Y-m-d", strtotime($explode_date[0]));
			$end_date 		= date("Y-m-d", strtotime($explode_date[1]));

			$datetime_start = new DateTime($start_date);
			$datetime_end   = new DateTime($end_date);
			$datetime_now	= new DateTime('NOW');
			$datetime_now	= $datetime_now->modify('-1 day');
			$interval_start = $datetime_start->diff($datetime_now);
			$interval_end	= $datetime_end->diff($datetime_now);
			
			$result['start_date']	= $interval_start->format('%a');
			$result['end_date']		= $interval_end->format('%a');

			return $result;
			
		}
		else
		{
			
			$result['start_date']	= 30;
			$result['end_date']		= 1;

			return $result;
				
		}
	}


	protected function getLineGraphWidget($clave)
	{
		$clave = trim($clave, ',');
		$clave = "[" . $clave . "]";
		return $clave;	
	}

	protected function printVarDump($clave)
	{
		echo "<pre>";
		var_dump($clave);
		echo "</pre>";
		//return $clave;	
	}


}

?>