<?php
	class DataModelGetInfoByURL {
		function __construct() {}
		
		public function getinformation($url){   
								
			$curl = curl_init();	 
					
			curl_setopt($curl, CURLOPT_URL, $url);  
			curl_setopt($curl, CURLOPT_HEADER, 0);				
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		  
			$data    = curl_exec($curl);          
			$res_arr = json_decode($data, true);

			echo "<br/>"; 

			curl_close($curl);                        

			return $res_arr;

		}	 

		function __destruct() {} 
	}
?>