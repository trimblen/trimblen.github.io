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
                        
                        
                                                     
                        $Curlget         = new DataModelGetInfoByURL();                    
                        $arrCurlget      = $Curlget -> getinformation($url);   
                         
                        unset($Curlget);  
                            
                        $ShowInformation = new  PlayersInfoUpdater();
                            
                        $ShowInformation  -> Trace($arrCurlget);
                        
                        unset($ShowInformation);  


                    }       
                        
                    else  {
                        
                        
                        
                        $Curlget            = new DataModelGetInfoByURL();  
                        $ShowInformation    = new  PlayersInfoUpdater();                          
                        $res_result         = array();

                        foreach ($array_of_ids as $key => $value){
                                            
                            $repl_url       = str_replace("<player>", $value , $url);                                                  
                            $arrCurlget     = $Curlget -> getinformation($repl_url);   
                           
                            array_push($res_result, $arrCurlget);                            
                            
                            
                
                        }  
                        
                       $ShowInformation -> WriteInfo($res_result);  
                       
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
                         
                        unset($Curlget);  
                            
                        $ShowInformation = new  PlacesInformationUpdater();
                            
                        $ShowInformation  -> Trace($arrCurlget);
                        
                        unset($ShowInformation);   


                    }            
                            
                    else    {
                        
                        
                        
                        $Curlget            = new DataModelGetInfoByURL();  
                        $ShowInformation    = new PlacesInformationUpdater();                          
                        $res_result         = array();
                                          

                        foreach ($array_of_ids as $key => $value){
                            
                            
                
                            $cur_id         = $value;
                            $arrCurlget     = $Curlget -> getinformation($url);   
                           
                            array_push($res_result, $arrCurlget);                            
                            
                            
                
                        }  
                        
                       $ShowInformation -> WriteInfo($res_result);  
                       
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
                      
                      
                                                         
                            $Curlget         = new DataModelGetInfoByURL();                    
                            $arrCurlget      = $Curlget -> getinformation($url);   
                             
                            unset($Curlget);  
                                
                            $ShowInformation = new  MastersInformationUpdate();
                                
                            $ShowInformation  -> Trace($arrCurlget);
                            
                            unset($ShowInformation);    
                            
                          

                  }         
                    
                    
                  else    {
                            
                        $Curlget            = new DataModelGetInfoByURL();  
                        $ShowInformation    = new MastersInformationUpdater();                          
                        $res_result         = array();

                        foreach ($array_of_ids as $key => $value){                            
                            
                
                            $repl_url            = str_replace("<masters>", $value , $url);                                 
                            $arrCurlget          = $Curlget -> getinformation($repl_url);   
                           
                            array_push($res_result, $arrCurlget);                 
                      
                                       
                        }  
                        
                       $ShowInformation -> WriteInfo($res_result);  
                       
                       unset($Curlget); 
                        
                       unset($ShowInformation); 
                           
                           
                    }
                            
                    
                }  
                
                              
            function __destruct() {
                   
                       
     
                                  
            } 
                        
                
       } 

              
                 
             
?>                