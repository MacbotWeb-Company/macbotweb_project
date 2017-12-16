<?php

class irm_overviewController extends Controller
{
	private $_googleplus; # Instanciar todo el modelo para utilizar todos los controller
	
	public function __construct()
	{
		parent::__construct();
		$this->_googleplus = $this->loadModel('google_plus');
		Session::strictAccess(array('admin'));

	}
	public function index()
	{
		//Session::strictAccess(array('admin'));

		$this->_view->title			= 'IRM - Overview';
		$this->_view->page_title	= 'GOOGLE PLUS';
		

		// START CALENDAR 
		if($this->getInt('send_calendar') == 1)
		{			
			$date_monthly 				= $this->getDateMonthAndYear('democalendar');
			$date_monthly_graph			= $date_monthly;
			$date_calendar				= $this->getDayDiff('democalendar');
		}else
		{	
			$date_monthly 				= $this->getDateByDefault(0);
			$date_monthly_graph			= $this->getDateByDefault(3);
			
			$date_calendar				= $this->getDayDiff();
		}
		$this->_view->widgetmonth 		= $this->getStringMonth($date_monthly);
		$this->_view->widgetmonthGraph	= $this->getStringMonth($date_monthly_graph, 'ALL');
		$this->_view->date_calendar		= $date_calendar;
		// END CALENDAR 

		// GET DATA BY MONTH ACCUMULATED
		$arr_comments	= array();
		$arr_sum_widgets= array();
		foreach($date_monthly as $val){
			$arr_comments[]		= $this->_googleplus->getDataPostList(1,1, $val['month'], $val['year']);
			$arr_sum_widgets[]	= $this->_googleplus->getGooglePostGraph(1,1, $val['month'], $val['year']);
		}
		// GET TO GRAPH 
		$arr_graph_post	= array();
		foreach($date_monthly_graph as $val){
			$arr_graph_post[]		= $this->_googleplus->getGooglePostGraph(1,1, $val['month'], $val['year']);
		}

		$dataprofiles 	= $this->_googleplus->getDataProfile(1,1);
		$followers		= 0;
		if(isset($dataprofiles[0]['circledByCount']))
		{
			$followers	= $this->filterInt($dataprofiles[0]['circledByCount']);
		}
		



		$dataprofile['displayName'] = $this->getTextValue($dataprofiles[0]['displayName']);
		$dataprofile['tagline']		= $this->getTextValue($dataprofiles[0]['tagline']);
		$dataprofile['url_gplus']	= $this->getTextValue($dataprofiles[0]['url_gplus']);
		$dataprofile['img']			= $this->getTextValue($dataprofiles[0]['img']);
		
		// START GET DATA LAST LINE GRAPH
		$arr_graph_post_last[]		= $this->_googleplus->getLastDataPost(1,1, $this->getMonth("F"), $this->getYear(), 7);
		$last_data_widget			= array();
		$arr_graph_post_last 		= $this->lastArray($arr_graph_post_last);
		krsort($arr_graph_post_last);
		$arr_graph_post_last 		= $this->getDataGraphGeneral($arr_graph_post_last);
		$last_data_widget['total_public_post'] = $this->getLineGraphWidget(0);
		if(isset($arr_graph_post_last['total_public_post']))
		{
			$last_data_widget['total_public_post'] = $this->getLineGraphWidget($arr_graph_post_last['total_public_post']);
		}

		$last_data_widget['total_replies'] = $this->getLineGraphWidget(0);
		if(isset($arr_graph_post_last['total_replies']))
		{
			$last_data_widget['total_replies'] = $this->getLineGraphWidget($arr_graph_post_last['total_replies']);
		}
		
		$last_data_widget['total_plusoners'] = $this->getLineGraphWidget(0);
		if(isset($arr_graph_post_last['total_plusoners']))
		{
			$last_data_widget['total_plusoners'] = $this->getLineGraphWidget($arr_graph_post_last['total_plusoners']);
		}

		$last_data_widget['total_resharers'] = $this->getLineGraphWidget(0);
		if(isset($arr_graph_post_last['total_resharers']))
		{
			$last_data_widget['total_resharers'] = $this->getLineGraphWidget($arr_graph_post_last['total_resharers']);
		}
		// END GET DATA LAST LINE GRAPH



		// CREATED ARRAY GRAPH HG
		$this->_view->datagraph		= $this->getDataGraphGeneral($arr_graph_post);
		// CREATED ACCUMULATED DATA
		$this->_view->datasum 		= $this->getDataSumGeneral($arr_sum_widgets);
		//CREATED DATA FOR GAUGE GRAPH
		$this->_view->followers 	= $this->getGauge($followers);
		// CREATED DATA PROFILE
		$this->_view->dataprofile   = $dataprofile;
		// CREATED REPORT POST LIST
		$this->_view->datapostlist  = $arr_comments;
		//CREATED DATA FOR LINE GRAPH
		$this->_view->lastdData 	= $last_data_widget;

		#RETURN DATA VIEWS
		$this->_view->render('index', 'menu-irm');
	}


}

?>
