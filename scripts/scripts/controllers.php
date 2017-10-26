<?php
      

     include( "./models.php" );         
     include( "./views.php" );  
     
    abstract class InfoController
    
    {
               
        //getting array to parse and trace    
        abstract public function GetArrayToParse($arr, $array_of_ids = null);
          
    }
     
     class GetPlayersInfoController extends InfoController  {
            
                   
                         
            function __construct() {
                
               
                    
     
                                  
            }
            		
            
            public function GetArrayToParse($url, $array_of_ids = null){
                
                    if ($array_of_ids == null)  {
                                                                                                     
/*                         $Curlget         = new DataModelGetInfoByURL();                    
                        $arrCurlget      = $Curlget -> getinformation($url);   
                         
                        unset($Curlget);  
                            
                        $ShowInformation = new  PlayersInfoUpdater();
                            
                        $ShowInformation  -> Trace($arrCurlget);
                        
                        unset($ShowInformation);   */

                    }       
                        
                    else  {
                                                
                        
                        $Curlget            = new DataModelGetInfoByURL();  
                        $ShowInformation    = new  PlayersInfoUpdater();                              
      
                        $array_of_hero_info = array();       
                        
                        foreach ($array_of_ids as $key => $value){
												
                            $repl_url       = str_replace("<account_id>", $value, $url);                           
                            $arrCurlget     = $Curlget -> getinformation($repl_url);   
														
                            $player_array = $ShowInformation -> CreateInfoArray($arrCurlget);  
													
                            if (isset($player_array['player_id']) && $player_array['player_id'] == $value)   {
                            
                                array_push($array_of_hero_info,  $player_array);
						
                            }
                                                    
                        }  
    	
                        if (count($array_of_hero_info) > 0) {
                            
                            $ShowInformation ->	WriteTableHeader();	
						
                            for($i = 0; $i < count($array_of_hero_info); $i++) {
                            
                                $ShowInformation ->	WriteInfo($array_of_hero_info[$i]);
                                                            
                            }
                            
                            $ShowInformation ->	WriteTableFooter();							
                           
                           unset($Curlget); 
                                
                           unset($ShowInformation); 
                           
                        } else{
                            
                            
                           echo "<h1>NO HEROES DATA IS AVAIABLE.</h1>"; 
                            
                             
                        }   
                           
                       
                    }
                    
                    
                }   
                
                
                  
                
            
            function __destruct() {
                   
                       
     
                                  
            }
            
            
        }
        
        
        class GetPlacesInfoController extends InfoController {
            
                    
            function __construct() {
                   
                       
     
                                  
            }
             
			 
            public function GetArrayToParse($url, $array_of_ids = null){
                
                                    
                    if ($array_of_ids == null)  {
                                               
                                                         
                        $Curlget         = new DataModelGetInfoByURL();     
                        
                        $arrCurlget      = $Curlget -> getinformation($url); 	
                        
                        $ShowInformation = new  PlacesInformationUpdater();
						
						$array_of_places_info  = $ShowInformation -> PrepareArrayWhenHasNoIds($arrCurlget);  
												
						
                                               
                        if (count($array_of_places_info)>0) {
                            
                            $ShowInformation ->	WriteTableHeader();	
                            
                            for($i = 0; $i < count($array_of_places_info); $i++) {
                            
                                $tmp_url                  = "http://the-tale.org/game/places/{$array_of_places_info[$i]['place_id']}/api/show?api_version=2&api_client=1-0.3.22";
                                
                                $arr_pl_add_info          = $Curlget -> getinformation($tmp_url); 
                                                       
                                $array_for_print = $ShowInformation ->  ParseAdditionalInfo($arr_pl_add_info, $array_of_places_info[$i]);
                                            
                                $ShowInformation ->	WriteInfo($array_for_print);
														
                            }
                        
                            $ShowInformation ->	WriteTableFooter();		
                            
                        } else{
                            
                            echo "<h1>NO PLACES DATA IS AVAIABLE.</h1>";  
                                                         
                        }
                        

						
                        unset($Curlget);
                        unset($ShowInformation);  						

                    }            
                            
                    else    {
                                                
                        
                        $Curlget                     = new DataModelGetInfoByURL();  
                        $ShowInformation             = new PlacesInformationUpdater();                          
                        $array_of_places_info        = array();
                         
                        $base_url        = "http://the-tale.org/game/places/<place>/api/show?api_version=2&api_client=1-0.3.22";  
         
                        foreach ($array_of_ids as $key => $value){
                                            
                            $correct_url    =  str_replace("<place>", $value, $base_url);   
                            
                            $arrCurlget     = $Curlget -> getinformation($correct_url);  

                            $place_array    = $ShowInformation -> CreateInfoArray($arrCurlget);    
                           
                            if (isset($place_array['place_id']) && $place_array['place_id']<>"-")   {
                            
                                array_push($array_of_places_info,  $place_array);
						
                            }                        
               
                        }  
                        
                        if (count($array_of_places_info)>0) {
                            
                             $ShowInformation ->	WriteTableHeader();	 
                            
                            for($i = 0; $i < count($array_of_places_info); $i++) {
						
                                $ShowInformation ->	WriteInfo($array_of_places_info[$i]);
														
                            } 
                        
                             $ShowInformation ->	WriteTableFooter();	
                            
                        } else{
                            
                            echo "<h1>NO PLACES DATA IS AVAIABLE.</h1>";  
                                                         
                        }
                   
                        
                       unset($Curlget); 
                        
                       unset($ShowInformation);    
                    }
                            
                    
                }    
            
            
            function __destruct() {
                   
                       
     
                                  
            }
            
            
        }
        
        class GetMastersInfoController extends InfoController  {
            
                    
            function __construct() {
                   
                       
     
                                  
            }
            
            
            public function GetArrayToParse($url, $array_of_ids = null){
                
                
                  if ($array_of_ids == null)  {
                                                                              
/* 						$Curlget         = new DataModelGetInfoByURL();                    
						$arrCurlget      = $Curlget -> getinformation($url);   
						 
						unset($Curlget);  
							
						$ShowInformation = new  MastersInformationUpdate();
							
						$ShowInformation  -> Trace($arrCurlget);
						
						unset($ShowInformation);     */
                    
                  }         
                    
                    
                  else    {
                            
                        $Curlget                = new DataModelGetInfoByURL();  
                        $ShowInformation        = new MastersInformationUpdater();  
                                         
                        $array_of_masters_info  = array();  

                        foreach ($array_of_ids as $key => $value){                          
                            							
                            $repl_url            = str_replace("<masters>", $value , $url);                                 
                            $arrCurlget          = $Curlget -> getinformation($repl_url);   
                                               
                            $masters_array = $ShowInformation -> CreateInfoArray($arrCurlget);  
							
                            if (isset($masters_array['master_id'])&& $masters_array['master_id']<>"-")   {
                            
                                array_push($array_of_masters_info,  $masters_array);
                						
                            }              
                      
                                       
                        }  
                 			
                        if (count($array_of_masters_info)>0) {                         
                                  
                            $ShowInformation ->	WriteTableHeader();	   
                       
                            for($i = 0; $i < count($array_of_masters_info); $i++) {
						
                                $ShowInformation ->	WriteInfo($array_of_masters_info[$i]);
														
                            }
                           
                            $ShowInformation ->	WriteTableFooter();	
                       
                       }else{
                           
                           echo "<h1>NO MASTERS DATA IS AVAIABLE.</h1>";                            
                           
                       }    
                
                     //  var_dump($array_of_masters_info);
                        
                       unset($Curlget); 
                        
                       unset($ShowInformation); 
                           
                           
                    }
                            
                    
                }  
                
                              
            function __destruct() {
                   
                       
     
                                  
            } 
                        
                
       } 

              
                 
             
?>                