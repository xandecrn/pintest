<?php

/**
 * Class instaScrape: allows to get a specific user items,specific tag items from Instagram
 * @author Mohammed Atef
 * @link http://www.deandev.com
 * @version 1.2 
 * @date 8 April
 * Copy Rights 2016-2018
 */
  
Class InstaScrape{

	
	public $ch;
	public $debug;
	
	/**
	 * @param curl handler $ch
	 */
	function __construct($ch , $sess , $debug   ){
		 
		$this->ch = $ch ;
		$this->debug = $debug ;
		
		//session required starting from 8 April 2018
		curl_setopt($this->ch,CURLOPT_COOKIE, 'sessionid='.$sess.'; csrftoken=eqYUPd3nV0gDSWw43IYZjydziMndrn4l;' );
		
		
	}
	
	/**
	 * Get instagram pics for a specific user using his numeric ID
	 * 
	 * @param string $usrID : the user id
	 * @$itemsCount integer: number of items to return default to 12
	 * @param number $index : the start index of reurned items (id of the first item) by default starts from the first image
	 * 
	 * @return: array of items 
	 */
	function getUserItems($usrID,$itemsCount = 12,$index = 0){
		
		  if($debug) echo 'index'.$index;
		
		
		if($index === 0) {
			
			$after = "" ;
		}else{
		 
			$after = "&after=".urlencode( trim($index) ) ;
		}
		
		$url = "https://www.instagram.com/graphql/query/?query_id=17880160963012870&id=$usrID&first=12" . $after;
	
		if( $this->debug ) echo '<br>URL:'.$url;
		 
		curl_setopt($this->ch, CURLOPT_URL, $url);
		$exec = curl_exec($this->ch);
		$x=curl_error($this->ch);
		
		
		// Curl error check
		if(trim($exec) == ''){
			throw new Exception('Empty results from instagram call with possible curl error:'.$x);
		}
		
	 
		// Verify returned result
		if(! ( stristr($exec, 'status": "ok') || stristr( $exec ,'status":"ok' ) ) ){
			
			echo $exec;
			exit;
			
			throw new Exception('Unexpected page content from instagram'.$x);
		}
		
		$jsonArr = json_decode( $exec );
		
		if(isset( $jsonArr->status )){
			return $jsonArr;
		}else{
			throw new Exception('Can not get valid array from instagram'.$x);
		}
		
	}
	
	/**
	 * Get Instagram pics by a specific hashtag
	 * 
	 * @param string $hashTag Instagram Hashtag
	 * @param integer $itemsCount Number of items to return
	 * @param string $index Last cursor from a previous request for the same hashtag 
	 */
	function getItemsByHashtag($hashTag,$itemsCount,$index = 0){
		  
		// Build after prameter
		if($index === 0){
			
			$after= "" ;
			 
		}else{
		 
			$after = "&after=" . urlencode(trim($index)) ; 
			 
		}
		
		$url = "https://www.instagram.com/graphql/query/?query_id=17882293912014529&tag_name=". urlencode(trim($hashTag)) ."&first=11" . $after;
		curl_setopt($this->ch, CURLOPT_URL, $url);
		
		if( $this->debug ) echo '<br>URL:'.$url;

		$exec = curl_exec($this->ch);
		$x=curl_error($this->ch);
		
		 
		// Curl error check
		if(trim($exec) == ''){
			throw new Exception('Empty results from instagram call with possible curl error:'.$x);
		}
			
		// Verify returned result
		if(! stristr($exec, 'status": "ok') && ! stristr($exec, 'media"')){
			throw new Exception('Unexpected page content from instagram, Visit the plugin settings page and renew the Session ID Cookie'.$x);
		}
		
		$jsonArr = json_decode( $exec );
		
		if(isset( $jsonArr->status )){
			
			//when no new items let's get the first page
			if(count( $jsonArr->data->hashtag->edge_hashtag_to_media->edges) == 0 ){
				
				if($index === 0){
					
				}else{
					// index used let's return first page
					return $this->getItemsByHashtag($hashTag,$itemsCount);
				}
				
			}
			
			return $jsonArr;
			
		}else{
			throw new Exception('Can not get valid array from instagram'.$x);
		}
		
		
	}
	
	/**
	 * @param string $name the name of instagram user for example "cnn"
	 * @return: numeric id of the user
	 */
 	function getUserIDFromName($name){
 		
 		// Curl get
 		$x='error';
 		$url='https://www.instagram.com/'.trim($name);
 		curl_setopt($this->ch, CURLOPT_HTTPGET, 1);
 		curl_setopt($this->ch, CURLOPT_URL, trim($url));
 		$exec   =   curl_exec($this->ch);
 		$cuinfo =   curl_getinfo($this->ch);
 		$http_code = $cuinfo['http_code'];
 		$x=curl_error($this->ch);
 		
 		 
 		// Curl error check
 		if(trim($exec) == ''){
 			throw new Exception('Empty results from instagram call with possible curl error:'.$x);
 		}
 		
 		// If not found 
 		if($http_code == '404'){
 			throw new Exception('Instagram returned 404 make sure you have added a correct id. for example add "cnn" for instagram.com/cnn user');
 		};
 		
 		// Verify returned result 
 		if(! stristr($exec, 'id')){
 			throw new Exception('Unexpected page content from instagram'.$x);
 		}
 		
 		// Extract the id
		//preg_match('{id":\s?"(.*?)"}', $exec,$matchs);
 		preg_match('{profilePage_(.*?)"}', $exec,$matchs);
		
		$possibleID = $matchs[1];
		
		// Validate extracted id
		if(! is_numeric($possibleID) || trim($possibleID) == ''){
			throw new Exception('Can not extract the id from instagram page'.$x);
		}
		
		// Return ID
		return $possibleID;
 		
 		
 	}
 	
 	/**
 	 * 
 	 * @param string $itmID id of the item for example "BGUTAhbtLrA" for https://www.instagram.com/p/BGUTAhbtLrA/
 	 */
 	function getItemByID($itmID){
		
 		// Preparing uri
 		$url = "https://www.instagram.com/p/".trim($itmID)."/?__a=1";
 		
 		//curl get
 		$x='error';
 		 
 		curl_setopt($this->ch, CURLOPT_HTTPGET, 1);
 		curl_setopt($this->ch, CURLOPT_URL, trim($url));
 		 
 		$exec=curl_exec($this->ch);
 		$x=curl_error($this->ch);
 		
 		return json_decode( $exec ) ;
 		 
 		
 	}
	
}

  