<!DOCTYPE html>

<html lang="ru">
<meta http-equiv="content-type" content="text/html; charset="UTF-8">

<head>
    
    <title>����� ��������� ������ �� ������ ���� The Tale</title>

</head>
	
	<body> 
		<?php
               
       
       //  include( "./views.php" );  
         //include( "./models.php" );  
    
               
			class RouterGetinfo			

		{
            
            public  $ids;
            private  $selected_info_type;                 
      
                                             
            function __construct( $player_log, $info_t) {
                                            
                            
                $this -> ids       = $player_log;                            
                $this -> selected_info_type = $info_t;     
                   
                $this -> printcredetials();
                
                              
            }
        
        	private	function Printcredetials() {

             
              if ($this -> selected_info_type == "heroes") {
                  
                    echo "������: ";
		
                    echo "<br/>"; 

                    foreach ($this -> ids as $value) {
                       
                       echo "<br/>"; 
                       
                       echo $value;

                    }        

                      //echo $this -> player_login;	
            
                    echo "<br/>";
                    
                    echo "<br/>";
              
                    echo "��� ����������: ";  
                      
                    echo "<br/>";
          
                    echo "<br/>";
          
                    echo "���������� �� �������";  
                  
                                              
            
              } 
              
              if ($this -> selected_info_type == "places"){
                  
          
                      echo "<br/>";
              
                      echo "��� ����������: ";  
                      
                      echo "<br/>";
                  
                  
                  
                      echo "<br/>";
          
                      echo "������";          		

                                       
                   
              }

              if ($this -> selected_info_type == "masters"){
                  
                  
                      echo "�������: ";
		
                      echo "<br/>"; 

                      foreach ($this -> ids as $value) {
                          
                         echo "<br/>";
                         
                         echo $value;

                         
                      }                      

                      //echo $this -> player_login;	
            
                      echo "<br/>";
                      
                      echo "<br/>";
              
                      echo "��� ����������: ";  
                      
                      echo "<br/>";
                  
            
                      echo "<br/>";
           
                      echo "�������";      
      
                
              }

              
          
          
        }   

        public function WriteGatheredInfo() {
            
             include( "./controllers.php" );       
                  
             if ($this -> selected_info_type == "heroes") {
                                
                $current_url    = "http://the-tale.org/accounts/<player>/api/show?api_version=1.0&api_client=aaa-1";     
                $getuserinfo    = new GetPlayersInfoController();                 
                $ids_arr        = $this -> ids;      
                
                $getuserinfo -> GetArrayToParse($current_url, $ids_arr); 
                             
                unset($getuserinfo);     
            
              } 
              
              if ($this -> selected_info_type == "places"){
                      
                $current_url   = "http://the-tale.org/game/places/$player_login/api/list?api_version=1.1&api_client=1-0.3.22"; 
                $getplacesinfo = new GetPlacesInfoController();
                
                $getplacesinfo -> GetArrayToParse($current_url); 
                
                unset($getplacesinfo);                 
                        
                   
              }

              if ($this -> selected_info_type == "masters"){
                
                $current_url   = "http://the-tale.org/game/persons/<masters>/api/show?api_version=1.0&api_client=aaa-1";                        
                $getmastersinfo = new GetMastersInfoController();
                $ids_arr        = $this -> ids;   
                
                $getmastersinfo -> GetArrayToParse($current_url, $ids_arr); 
                
                unset($getmastersinfo);    
                
              }
            
        }
        
      
        function  __destruct( ) {
                                            

                              
        }

      
        
    
	}

    
    
  	
        $pl_id         = $_POST['selectID'];
        $info_sel_type = $_POST["info_type"];
       
		$credentials  = new RouterGetinfo($pl_id, $info_sel_type);
        
       	$credentials  -> WriteGatheredInfo();
		

		?>
		
		
	     <br/>
	
	     <input type="button" value="�����..." onclick="window.location.href='/index.html'">

	</body>


</html>