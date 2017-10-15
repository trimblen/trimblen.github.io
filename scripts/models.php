<?php

    class DataModelGetInfoByURL {
        
        
        
        function __construct() {
               
                   
 
                              
        }
        
        
        public function getinformation($url){   
                      
            
  		  	$curl = curl_init();	 
  		            
  			curl_setopt($curl, CURLOPT_URL, $url);  
  			curl_setopt($curl, CURLOPT_HEADER, 0);				
  			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
          
            	
 			$data       = curl_exec($curl);  

            //echo $data;             
			            
  	     	curl_close($curl);      
            
            $res_data   = json_decode($data, true);
            
			return $res_data;

		}	 


        function __destruct() {
               
                   
 
                              
        }     
        
        
    }

?>