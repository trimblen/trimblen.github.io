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
      
						$ShowInformation ->	WriteTableHeader();	
                        
						$array_of_hero_info = array();       
                        
                        foreach ($array_of_ids as $key => $value){
                                            
                            $repl_url       = str_replace("<account_id>", $value, $url);                           
                            $arrCurlget     = $Curlget -> getinformation($repl_url);   
														
                            $player_array = $ShowInformation -> CreateInfoArray($arrCurlget);  
							
                            if (count($player_array) > 0)   {
                            
                                array_push($array_of_hero_info,  $player_array);
						
                            }
                                                    
                        }  
    	
						
						for($i = 0; $i < count($array_of_hero_info); $i++) {
						
							$ShowInformation ->	WriteInfo($array_of_hero_info[$i]);
														
						}
                        
                        $ShowInformation ->	WriteTableFooter();							
                       
                       unset($Curlget); 
                            
                       unset($ShowInformation); 
                       
                       
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
												
						$ShowInformation ->	WriteTableHeader();	
                        
		                for($i = 0; $i < count($array_of_places_info); $i++) {
                            
                            $tmp_url                  = "http://the-tale.org/game/places/{$array_of_places_info[$i]['place_id']}/api/show?api_version=2&api_client=1-0.3.22";
                            
                            $arr_pl_add_info          = $Curlget -> getinformation($tmp_url); 
                                                   
                            $array_for_print = $ShowInformation ->  ParseAdditionalInfo($arr_pl_add_info, $array_of_places_info[$i]);
                  						
							$ShowInformation ->	WriteInfo($array_for_print);
														
						}
																
						$ShowInformation ->	WriteTableFooter();		
						
                        unset($Curlget);
                        unset($ShowInformation);  						

                    }            
                            
                    else    {
                                                
                        
                        $Curlget                     = new DataModelGetInfoByURL();  
                        $ShowInformation             = new PlacesInformationUpdater();                          
                        $array_of_places_info        = array();
                         
                        $base_url        = "http://the-tale.org/game/places/<place>/api/show?api_version=2&api_client=1-0.3.22";  

                        $ShowInformation ->	WriteTableHeader();	    

                        foreach ($array_of_ids as $key => $value){
                                            
                            $correct_url    =  str_replace("<place>", $value, $base_url);   
                            
                            $arrCurlget     = $Curlget -> getinformation($correct_url);  

                            $place_array    = $ShowInformation -> CreateInfoArray($arrCurlget);    
                           
                            if (count($place_array ) > 0)   {
                            
                                array_push($array_of_places_info,  $place_array);
						
                            }                        
               
                        }  
                        
                       	for($i = 0; $i < count($array_of_places_info); $i++) {
						
							$ShowInformation ->	WriteInfo($array_of_places_info[$i]);
														
                        } 
                       
                       $ShowInformation ->	WriteTableFooter();	
                        
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
                        
                        $ShowInformation ->	WriteTableHeader();	    
                        
                        $array_of_masters_info  = array();  

                        foreach ($array_of_ids as $key => $value){                            
                            
                
                            $repl_url            = str_replace("<masters>", $value , $url);                                 
                            $arrCurlget          = $Curlget -> getinformation($repl_url);   
                                               
                            $masters_array = $ShowInformation -> CreateInfoArray($arrCurlget);  
							
                            if (count($masters_array) > 0)   {
                            
                                array_push($array_of_masters_info,  $masters_array);
                						
                            }              
                      
                                       
                        }  
                 						
                       for($i = 0; $i < count($array_of_masters_info); $i++) {
						
							$ShowInformation ->	WriteInfo($array_of_masters_info[$i]);
														
                       }
                        
                     //  var_dump($array_of_masters_info);
                        
                       $ShowInformation ->	WriteTableFooter();	
                       
                       unset($Curlget); 
                        
                       unset($ShowInformation); 
                           
                           
                    }
                            
                    
                }  
                
                              
            function __destruct() {
                   
                       
     
                                  
            } 
                        
                
       } 

              
                 
             
?>                