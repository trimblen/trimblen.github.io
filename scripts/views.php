<?php
    abstract class GameInfoUpdater {                   
        //tracing array    
        abstract public function Trace($arr);        
        //tracing array         
        abstract public function WriteInfo($tr_array);          
    }

    class PlayersInfoUpdater extends GameInfoUpdater {     
		function __construct() {} 

        public function Trace($arr) {			
		   foreach ($arr as $key => $value){				   
				if (is_array($value)) {                            
					$this->trace($value);                           
				}        
				else {                        
					echo "<tr>";
					//временная затычка
				   // $print_value = iconv("utf-8","windows-1251", $value);                     
					echo "<td> $key </td>";                        
					echo "<td> $value </td>";                              
					// $print_value<br />\n";                        
					echo '</tr>';                        
				}    
			}
        }
            
        public function WriteInfo($tr_array){      
            echo '<table border="1">';
            
            foreach ($tr_array as $key => $value){               
                $this -> Trace($value);               
            }    
            echo '</table>';
        }

        function __destruct() {}   
    }
    
    
    class PlacesInformationUpdater extends GameInfoUpdater {          
		function __construct() {}	
		  
        public function trace($arr) {                   
		   foreach ($arr as $key => $value){                
				if (is_array($value)) {                        
					$this->trace($value);  
				}            
				else {
					echo '<table border="5">';                        
					echo "<tr>";
					//временная затычка
				   // $print_value = iconv("utf-8","windows-1251", $value);                     
					echo "<td> $key </td>";                                    
					echo "<td> $value </td>";                              
					// $print_value<br />\n";                        
					echo '</tr>';                        
					echo '</table>';
				}    
			}
        }

        public function WriteInfo($tr_array){
			
             foreach ($tr_array as $key => $value)   {                           
                $this -> Trace($value);                
            }    
        }
		
        function __destruct() {}       
    }
    
    class MastersInformationUpdater extends GameInfoUpdater {        
        function __construct() {}
               
        public function trace($arr) {                   
		   foreach ($arr as $key => $value){                
				if (is_array($value)) {                        
					$this->trace($value);   
				}  else {                    
					echo "<tr>";
					//временная затычка
				   // $print_value = iconv("utf-8","windows-1251", $value);                     
					echo "<td> $key </td>";                        
					echo "<td> $value </td>";                              
					// $print_value<br />\n";                        
					echo '</tr>';
				}   
			}
        }

        public function WriteInfo($tr_array){      
            echo '<table border="1">';
			
            foreach ($tr_array as $key => $value){               
                $this -> Trace($value); 
            }    
            echo '</table>';
        }    
            
        function __destruct() {}
    }
?>     