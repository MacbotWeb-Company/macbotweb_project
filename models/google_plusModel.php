<?php

class google_plusModel extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function insertProfileGooglePus($idclient, $id_website, $datetime, $user_id, $display_name, $nickname, $gender, $url, $url_website_label, $url_website,  $img, $follower, $plusonecount, $org_name, $org_type, $tagline, $aboutMe){
		try {

			// create SQL
			$sql = "INSERT INTO mb_google_plus_overviews VALUES (null, 
			:id_client, 
			:id_website,
			:date_created,
			:user_id, 
			:displayName, 
			:nickname, 
			:gender, 
			:url,
			:url_website_label,
			:url_website, 
			:img,
			:circlebyCount, 
			:plusOneCount, 
			:organizations_name, 
			:organizations_type, 
			:tagline, 
			:aboutMe);";
			
			// prepare the statement
			$stmt = $this->_db->prepare($sql);		
			// bind the parameters and execute the statement
			$stmt->bindValue(':id_client', $idclient);
			$stmt->bindValue(':id_website', $id_website);
			$stmt->bindValue(':date_created', $datetime);
			$stmt->bindValue(':user_id', $user_id);
			$stmt->bindValue(':displayName', $display_name);
			$stmt->bindValue(':nickname', $nickname);
			$stmt->bindValue(':gender', $gender);
			$stmt->bindValue(':url', $url);
			$stmt->bindValue(':url_website_label', $url_website_label);
			$stmt->bindValue(':url_website', $url_website);
			$stmt->bindValue(':img', $img);
			$stmt->bindValue(':circlebyCount', $follower);
			$stmt->bindValue(':plusOneCount', $plusonecount);
			$stmt->bindValue(':organizations_name', $org_name);
			$stmt->bindValue(':organizations_type', $org_type);
			$stmt->bindValue(':tagline', $tagline);
			$stmt->bindValue(':aboutMe', $aboutMe);
			// execute the statement
			
			$stmt->execute();
			
			} 
			catch (Exception $e) 
			{ 
				echo $e->getMessage(); 
			} 
			
	}
	
	public function insertActivityGooglePus($idclient, $id_website, $month, $year, $title, $published, $updated, $id, $url, $provider, $type, $total_replies, $total_plusoners, $total_resharers){
		try {
			

			// create SQL
			$sql = "INSERT INTO mb_google_plus_activity VALUES (null, 
			:id_client, 
			:id_website,
			:month, 
			:year, 
			:title,
			:published, 
			:updated,  
			:id,
			:url,
			:provider,
			:type,  
			:total_replies, 
			:total_plusoners,
			:total_resharers);";
			
			// prepare the statement
			$stmt = $this->_db->prepare($sql);		
			// bind the parameters and execute the statement
			$stmt->bindValue(':id_client', $idclient);
			$stmt->bindValue(':id_website', $id_website);
			$stmt->bindValue(':month', $month);
			$stmt->bindValue(':year', $year);
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':published', $published);
			$stmt->bindValue(':updated', $updated);
			$stmt->bindValue(':id', $id);
			$stmt->bindValue(':url', $url);
			$stmt->bindValue(':provider', $provider);
			$stmt->bindValue(':type', $type);
			$stmt->bindValue(':total_replies', $total_replies);
			$stmt->bindValue(':total_plusoners', $total_plusoners);
			$stmt->bindValue(':total_resharers', $total_resharers);
			// execute the statement
			
			$stmt->execute();
			
			
			} 
			catch (Exception $e) 
			{ 
				echo $e->getMessage(); 
			} 
			
	}
	public function updatedActivityGooglePus($title, $published, $updated, $id, $url, $provider, $type, $total_replies, $total_plusoners, $total_resharers){
		try {
			

			// create SQL
			$sql = "UPDATE mb_google_plus_activity SET  
			title=:title,
			published=:published, 
			updated=:updated,  
			id=:id,
			url=:url,
			provider=:provider,
			type=:type,  
			total_replies=:total_replies, 
			total_plusoners=:total_plusoners,
			total_resharers=:total_resharers 
			WHERE id=:id";
			
			// prepare the statement
			$stmt = $this->_db->prepare($sql);		
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':published', $published);
			$stmt->bindValue(':updated', $updated);
			$stmt->bindValue(':id', $id);
			$stmt->bindValue(':url', $url);
			$stmt->bindValue(':provider', $provider);
			$stmt->bindValue(':type', $type);
			$stmt->bindValue(':total_replies', $total_replies);
			$stmt->bindValue(':total_plusoners', $total_plusoners);
			$stmt->bindValue(':total_resharers', $total_resharers);
			// execute the statement
			
			$stmt->execute();
			
			
			} 
			catch (Exception $e) 
			{ 
				echo $e->getMessage(); 
			} 
			
	}
	public function getActivityByID($id_client, $id_website, $id_activity){
		try 
		{
			$sql = "SELECT
						id
					FROM
						mb_google_plus_activity
					WHERE
						id_client = $id_client 
					AND id_website = $id_website
					AND id =  '$id_activity'";
			$data 	= $this->_db->query($sql);
 			$result = $data->fetch(PDO::FETCH_ASSOC);
			
			return $result;
			
		} 
		catch (Exception $e) 
		{ 
			echo $e->getMessage(); 
		} 
	}
	public function getDataProfile($id_client, $id_website){
		try {
			$sql = "SELECT
						id_client,
						id_website,
						date_created,
						user_id,
						displayName,
						url_gplus,
						img,
						circledByCount,
						plusOneCount,
						tagline,
						aboutMe
					FROM
						mb_google_plus_overviews
					WHERE
						id_client = $id_client AND id_website = $id_website;";
						
			
			$data 	= $this->_db->query($sql);
 			$result = $data->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		} 
		catch (Exception $e) 
		{ 
			echo $e->getMessage(); 
		} 
	}
	public function getDataPostList($id_client, $id_website, $month, $year){
		try {
			$sql = "SELECT
						title,
						published,
						id,
						url,
						provider,
						type,
						total_replies,
						total_plusoners,
						total_resharers
					FROM
						mb_google_plus_activity
					WHERE
						id_client = $id_client 
						AND id_website = $id_website 
						AND month = '$month'
						AND year = $year";
						
			$data   = $this->_db->query($sql);
			$result = $data->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
		} 
		catch (Exception $e) 
		{ 
			echo $e->getMessage(); 
		} 
	}
	public function getGooglePostGraph($id_client, $id_website, $month, $year){
		try {
			$sql = "SELECT 
					    SUM(total_replies) AS total_replies,
					    SUM(total_plusoners) AS total_plusoners,
					    SUM(total_resharers) AS total_resharers,
					    COUNT(type) AS total_public_post
					FROM
					    mb_google_plus_activity
					WHERE
					    id_client = $id_client AND id_website = $id_website
					        AND month = '$month'
					        AND year = $year
					        AND type = 'public';";
						
			$data   = $this->_db->query($sql);
			$result = $data->fetchAll(PDO::FETCH_ASSOC);
			
			$result[0]['month'] = $month;
			$result[0]['year']  = $year;
			if( isset($result[0]) ){
				return $result[0];
			}else{
				return $result[0];
			}
			
		} 
		catch (Exception $e) 
		{ 
			echo $e->getMessage(); 
		} 
	}
	public function getLastDataPost($id_client, $id_website, $month, $year, $limit = 7){
		try {
			$sql = "SELECT 
					    DATE(published) as published ,
					    SUM(total_replies) AS total_replies,
					    SUM(total_plusoners) AS total_plusoners,
					    SUM(total_resharers) AS total_resharers,
					    COUNT(type) AS total_public_post
					FROM
					    mb_google_plus_activity
					WHERE
					    id_client = $id_client AND id_website = $id_website
					        AND month = '$month'
					        AND year = $year
					        AND type = 'public'
					GROUP BY DATE(published)
					ORDER BY DATE(published) DESC
					LIMIT 0, $limit ";
						
			$data   = $this->_db->query($sql);
			$result = $data->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
		} 
		catch (Exception $e) 
		{ 
			echo $e->getMessage(); 
		} 
	}
	
}

?>