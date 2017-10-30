<?php

    abstract class GameInfoUpdater
    
    {
           
       
        //tracing array         
        abstract public function WriteInfo($tr_array);
         
		//table header	
        abstract public function WriteTableHeader();      
        
        //table footer
		abstract public function WriteTableFooter(); 
        
       //find right array values by keys in array
        //abstract public function SortArray($arr, $column, $sort_order);
        
        abstract public function CreateInfoArray($arr);
        
        abstract protected function TraceArraySubPack($arr, $key_arr, &$arr_result);		
		 
		//if we have no id's	
        abstract public function PrepareArrayWhenHasNoIds(&$arrayByCurl);
		
		//if we'll need some special stuff here...		
		abstract public function ParseAdditionalInfo(&$arrcurlget, &$temp_array);
		
		
					
    }
    
    
    class PlayersInfoUpdater extends GameInfoUpdater 
    
    {
        
        function __construct() {
               
                   
 
                              
        }   
        
		public function WriteTableHeader(){
			
			 echo '<table border="1">';
             
				 echo "<tr>";     
				 echo "<td> Дата последнего визита </td>"; 
				 echo "<td> Статус </td>"; 
				 echo "<td> Компаньйон </td>"; 
				 echo "<td> Уровень героя </td>"; 	
				 echo "<td> Герой </td>";      
				 echo "<td> Раса </td>";				
				 echo "<td> Деньги </td>";
				 echo "<td> Жив\Мертв </td>";
				 echo "<td> Физическая сила\Магическая сила </td>";
				 echo "<td> Сила </td>";
				 echo "<td> Уровень экипировки </td>";
				 echo "<td> Скорость движения, ед </td>";
				 echo "<td> Полезность </td>";
				 echo "<td> Инициатива </td>";             
				 echo "<td> Позиция на карте (x,y) </td>";
				 echo "<td> Могущество </td>";
				 echo "<td> Спрайт героя </td>";
             
             echo '</tr>';
			
		}
		
		public function WriteTableFooter(){
			
			 echo '</table>';
			
		}
               
            
        public function CreateInfoArray($arr){
            
            static $pl_array = array(); 
				            
			foreach ($arr as $key => $value){
																  
				if (is_array($value)) {   
                
											
					$this->TraceArraySubPack($value, $key, $pl_array);                    
                  				
					$this->CreateInfoArray($value);    

				
				} else {
					  
					  
					//$this->TraceArraySubPack($value, $key, $pl_array);                            
													  
										   
				}                
			
			
			}
			
			//print_r	(array_count_values($pl_array));
                   
			
            return $pl_array;
            
            
        } 
        
		//for better times...
		public function PrepareArrayWhenHasNoIds(&$arrayByCurl){
			
			static $arr_result = array();
			
			
			return $arr_result;
			
		} 
			
		public function ParseAdditionalInfo(&$arrcurlget, &$temp_array){
			
			
			
		}	
			
                        
        protected function TraceArraySubPack($value, $key, &$arr_result){
			
			if (is_array($value)){
				
				if ((string) $key == "base"){
											
					if (isset ($value['name'])){									   
							
						$arr_result['player_name'] = $value['name']; 
											   
					} else {
														  
						$arr_result['player_name'] = "-"; 
														
					} 
				   
					if (isset ($value['race'])){								   
								   
						$arr_result['player_race'] = $value['race']; 

												   
					} else {
												   
						$arr_result['player_race'] = "-"; 						   
						   
					}
					
					if (isset ($value['level'])){
															   
						$arr_result['player_level'] = $value['level']; 

						   
					} else {
												   
						$arr_result['player_level'] = "-";            
											
					}
				
					if (isset ($value['gender'])){								   
							   
						$arr_result['player_gender'] = $value['gender'];      
						   
						   
					} else {
						   
						$arr_result['player_gender'] = "-";                 
											
					}
					
					if (isset ($value['money'])){							   
						   
						$arr_result['player_money'] = $value['money'];      
												   
					} else {							   
						   
						$arr_result['player_money'] = "-";            
											
					}
					
					if (isset ($value['alive'])){							   
						   
						$arr_result['player_alive'] = $value['alive'];  
										
					} else {
						   
						$arr_result['player_alive'] = "-";                 
												
					}

					if (isset ($value['gender'])){
						   
						$arr_result['player_gender'] = $value['gender'];      
												   
					} else {
													  
						$arr_result['player_gender'] = "-";                 
							
					}
					
					if (isset ($value['money'])){
													   
						$arr_result['player_money'] = $value['money'];      
			  
					} else {
													   
						$arr_result['player_money'] = "-";                 
										
					}
					
					if (isset ($value['alive'])){
													   
						$arr_result['player_alive'] = $value['alive'];   
												
					} else {
						   
						$arr_result['player_alive'] = "-";                 
												
					}							
					
					
				}
				
				if ((string)$key =="account"){                       
                                          
					if (isset ($value['last_visit'])){
                        
                        $last_visit_tm = date('m/d/Y H:i:s', $value['last_visit']);
                        
                        $date1 = new DateTime($last_visit_tm);
                        $date2 = new DateTime();
                    
                        $date_dif    = date_diff($date1 , $date2);
                        $minutes     = $date_dif-> format('%i');
  		
                        if ($minutes > 10) {
                            
                           $arr_result['online_offline'] = "offline";     
                            
                        } else {
                                                           
                          $arr_result['online_offline']  = "online";   
                            
                        }
					   
						$arr_result['player_last_visit'] = $last_visit_tm;      
											   
					} else {
						   						   
						$arr_result["player_last_visit"] = "-";     
					  						
					}    

                    if (isset ($value['id'])){									   
							
						$arr_result['player_id'] = $value['id'];      
											   
					} else {
														  
						$arr_result['player_id'] = "-"; 
														
					}     
              
                       
                }
								
				if ((string)$key =="companion"){                       
                 
				    if (isset ($value['name'])){						   
						   
						$arr_result['player_companion_name'] = $value['name'];      
						  
						   
					} else {
						   						   
						$arr_result['player_companion_name'] = "-";     
					   										
					}                                        
                 
                               
                }
							
				if ((string)$key =="secondary"){ 

					if (isset ($value['power'])){
						   						   
						$arr_result['player_power'] = $value['power']; 
						
						$summ_power = $value['power'][0] + $value['power'][1];
						
						$arr_result['summary_power'] = $summ_power;
						
						$equipment_lev = round ($summ_power/12, 0);
						
						$arr_result['equipment_level'] = $equipment_lev;
			
					} else {
					
						$arr_result['player_power'] 	= "-"; 
						$arr_result['summary_power'] 	= "-";	
						$arr_result['equipment_level']  = "-";							
					
					}  

					if (isset ($value['move_speed'])){
						
						$move_spd = $value['move_speed'] *10;
					
						$arr_result['player_move_speed'] = $move_spd;
		   
					} else {
					
						$arr_result['player_move_speed'] = "-";     
				
					}   

					if (isset ($value['initiative'])){
						
						$initiative = round( $value['initiative'] *1000, 0);
				
						$arr_result['player_initiative'] = $initiative;      
											   
					} else {
					
						$arr_result['player_initiative'] = "-";     
			
					}  
       				
				
			    }
				
				if((string)$key =="equipment"){
																	
					$arr_result['player_equipment'] = $value;  
			
				}	
								
                if((string)$key =="hero"){
                   
                    if (isset ($value['position'])){
                                
                        $arr_result['player_position'] = $value['position'];      
                                               
                    } else {
                        
                        $arr_result['player_position'] = "-";     
                                            
                    }   
                                    
                    if (isset ($value['sprite'])){
                                        
                        $arr_result['player_sprite'] = $value['sprite'];      
                                               
                    } else {
                        
                        $arr_result['player_sprite'] = "-";     
                                            
                    }  

                    if (isset ($value['might'])){
                                                   
                        $arr_result['player_might'] = $value['might'];      
                                                   
                    } else {
                               
                        $arr_result['player_might'] = "-";     
                                                
                    }  

                    
                }
	
				
			} else {

               
            ///for some STUFF here
                
            }	
            
            
	}
	
    
    private function DetectGender($gender, $race){        
        
        if ($gender == 0) {

            if ($race== 0) {
				
				echo "<td> Человек </td>";
				
			} else if($race == 1) {
				
				echo "<td> Эльф </td>";				
				
			} else if($race == 2) {
				
				echo "<td> Орк </td>";
				
			} else if ($race == 3)  {
				
				echo "<td> Гоблин </td>";				
				
			} else if ($race == 4) {
				
				echo "<td> Гном </td>";
				
			} else {
				
				echo "<td> -- </td>";
				
			}   
				 
        } else if($gender == 1) {
             
            if ($race == 0) {
				
				echo "<td> Женщина </td>";
				
			} else if($race == 1) {
				
				echo "<td> Эльфийка </td>";				
				
			} else if($race == 2) {
				
				echo "<td> Орчица </td>";
				
			} else if ($race == 3)  {
				
				echo "<td> Гоблица </td>";				
				
			} else if ($race == 4) {
				
				echo "<td> Гноминя </td>";
				
			} else {
				
				echo "<td> -- </td>";
				
			}
             
        }else if($gender == 2) {
             
            if ($race == 0) {
				
				echo "<td> Оно - Человек </td>";
				
			} else if($race == 1) {
				
				echo "<td> Оно - Эльф </td>";				
				
			} else if($race == 2) {
				
				echo "<td> Оно -Орк </td>";
				
			} else if ($race == 3)  {
				
				echo "<td> Оно - Гоблин </td>";				
				
			} else if ($race == 4) {
				
				echo "<td> оно -Гном </td>";
				
			} else {
				
				echo "<td> -- </td>";
				
			}
             
        } else {
            
            echo "<td> -- </td>";	
             
        }

        
    }

	private function GetUseableLevel(&$artifacts){
		
		static $art_count	 = 0;
		static $usable_summ	 = 0;
		static $us_level	 = 0;
		
		 for($i = 0; $i < count($artifacts); $i++){
			 					 
			$usable_summ = $usable_summ + $artifacts[$i]['preference_rating'];					
			$art_count	 = $art_count + 1;	
					 			 
		 }
		
		$us_level = Round($usable_summ/$art_count,2);
		
		return $us_level;
		
	}
        
	
    public function WriteInfo($tr_array){
       
			echo "<tr>"; 
	  
	         echo "<td> $tr_array[player_last_visit] </td>"; 
			 echo "<td> $tr_array[online_offline] </td>"; 
			 echo "<td> $tr_array[player_companion_name] </td>"; 
			 echo "<td> $tr_array[player_level] </td>"; 			 
             echo "<td> <a href=\"http://the-tale.org/game/heroes/$tr_array[player_id]\"> $tr_array[player_name] </a></td>"; 	
			 $this -> DetectGender($tr_array['player_gender'],  $tr_array['player_race']);
       			 
             echo "<td> $tr_array[player_money] </td>";
			 
			 if ($tr_array['player_alive'] == true){
				
			    	echo "<td> Живчик </td>";	
				 
			 }else if($tr_array['player_alive'] == false){
								
				    echo "<td> Дохлятина </td>";	
				 
			 } else{
				 				 
				    echo "<td> -- </td>";	 
				 
			 }
             			 
	    	 $sep 		 = "\\";
			 $x_coords 	 = Round($tr_array['player_position']['x'],2);	
			 $y_coords 	 = Round($tr_array['player_position']['y'],2);
			 
             echo "<td>{$tr_array['player_power'][0]}{$sep}{$tr_array['player_power'][1]}</td>";
			 echo "<td> $tr_array[summary_power] </td>";
			 echo "<td> $tr_array[equipment_level]</td>";
             echo "<td> $tr_array[player_move_speed] </td>";
			 
			 $player_us_lev = "";
			 
			 if (isset($tr_array['player_equipment'])){
								
				$player_us_lev = $this -> GetUseableLevel($tr_array['player_equipment']);	
				 
			 }else{
				
				$player_us_lev = 0;				
				 
			 }
						
			 $player_us_lev = $this -> GetUseableLevel($tr_array['player_equipment']);
			 
			 echo "<td> {$player_us_lev} </td>";
             echo "<td> $tr_array[player_initiative] </td>"; 										
             echo "<td> {$x_coords}{$sep}{$y_coords}</td>";
			 echo "<td> {$tr_array['player_might']['value']} </td>";
             echo "<td> $tr_array[player_sprite] </td>";
       
			echo "</tr>";  

        
        }
        
         
        
            
            
        function __destruct() {
               
                   

                              
            }      
        
        
    }
    
    
    class PlacesInformationUpdater extends GameInfoUpdater 
    
    {
		
		function __construct() {
               
                   
 
                              
        }   
		
		public function PrepareArrayWhenHasNoIds(&$arrayByCurl){
			
			static $arr_result = array();
			
			if (isset ($arrayByCurl['data']['places'])) {
				
				for($i = 1; $i < count($arrayByCurl['data']['places']); $i++) {
					
					$place_array = array();	
					
					$place_array['place_id']					 = $arrayByCurl['data']['places'][$i]['id'];
					$place_array['place_name']					 = $arrayByCurl['data']['places'][$i]['name'];
					$place_array['place_frontier']				 = $arrayByCurl['data']['places'][$i]['frontier'];
					$place_array['place_position']				 = $arrayByCurl['data']['places'][$i]['position'];					
					$place_array['place_size']					 = $arrayByCurl['data']['places'][$i]['size'];
					$place_array['place_specialization']		 = $arrayByCurl['data']['places'][$i]['specialization'];
					
				    if (count($place_array ) > 0)   {
					
						array_push($arr_result,  $place_array);
				
					}
					
				}	
			
				
			}
			
			//var_dump($arr_result);
			
			return $arr_result;
			
		} 
		
		//for parsing additional info	
		public function ParseAdditionalInfo(&$arrcurlget,&$temp_array){

            static $res_arr = array();            
            $res_arr        = $temp_array;
          
              
            if ( isset ($arrcurlget['data']['politic_power'] )){                
                           
              $res_arr['place_politic_power']    =  $arrcurlget['data']['politic_power'];    
                
            }
            
            if ( isset ($arrcurlget['data']['persons'])){
                
              $res_arr['place_persons']          =  $arrcurlget['data']['persons'];   
                
            }
            
            if ( isset ($arrcurlget['data']['attributes'])){
                
              $res_arr['place_attributes']       =  $arrcurlget['data']['attributes'];   
                
            }
            
          //  var_dump($res_arr);
        		
            return  $res_arr;   
                
			
		}	

   
		
		public function WriteTableHeader(){
			
			 echo '<table border="1">';
			 
			 echo "<tr>";   
			 
				 echo "<td> Город </td>"; 
				 echo "<td> Фронтир </td>"; 
				 echo "<td> Координаты города </td>"; 	
				 echo "<td> Размер города </td>";      
				 echo "<td> Специализация </td>";
				 echo "<td> Политическая сила, комплексное значение (список) </td>";
				 echo "<td> Персоны - имя, профессия (список) </td>";				
				 echo "<td> Итоговые значения атрибутов - наименование, значение(список) </td>";
             
             echo '</tr>';
			 
			
		}
		
		public function WriteTableFooter(){
			
			 echo '</table>';
			
		}
        
        public function CreateInfoArray($arr){
            
            static $pl_array = array();           
            
                foreach ($arr as $key => $value){
                                                                      
                    if (is_array($value)) {   
                      
                      $this->CreateInfoArray($value);
                                                                      
                      $this->TraceArraySubPack($value, $key, $pl_array); 
                    
                    
                    } else {
                          
                          
                        //$this->TraceArraySubPack($value, $key, $pl_array);                            
                                                          
                                               
                    }                
                
                
                }
            
            return $pl_array;
            
            
        } 
        
        
                
       protected function TraceArraySubPack($value, $key, &$arr_result){			
       
            if (is_array($value)){
                
                   foreach ($value as $key_arr => $value_arr){                       
                       
                    if ($key =="data"){                        
                        
                        if (isset ($value['id'])){									   
                                
                            $arr_result['place_id'] = $value['id'];      
                                                   
                        } else {
                                                              
                            $arr_result['place_id'] = "-"; 
                                                            
                        }    
        
                        if (isset ($value['name'])){									   
                                
                            $arr_result['place_name'] = $value['name'];      
                                                   
                        } else {
                                                              
                            $arr_result['place_name'] = "-"; 
                                                            
                        }      

                        if (isset ($value['frontier'])){									   
                                
                            $arr_result['place_frontier'] = $value['frontier'];      
                                                   
                        } else {
                                                              
                            $arr_result['place_frontier'] = "-"; 
                                                            
                        }   

                        if (isset ($value['size'])){									   
                                
                            $arr_result['place_size'] = $value['size'];      
                                                   
                        } else {
                                                              
                            $arr_result['place_size'] = "-"; 
                                                            
                        }   
        
                        if (isset ($value['specialization'])){									   
                                
                            $arr_result['place_specialization'] = $value['specialization'];      
                                                   
                        } else {
                                                              
                            $arr_result['place_specialization'] = "-"; 
                                                            
                        }     

                        if (isset ($value['persons'])){									   
                                
                            $arr_result['place_persons'] = $value['persons'];      
                                                   
                        } else {
                                                              
                            $arr_result['place_persons'] = "-"; 
                                                            
                        }   

                        if (isset ($value['politic_power'])){									   
                                
                            $arr_result['place_politic_power'] = $value['politic_power'];      
                                                   
                        } else {
                                                              
                            $arr_result['place_politic_power'] = "-"; 
                                                            
                        }     

                        if (isset ($value['attributes'])){									   
                                
                            $arr_result['place_attributes'] = $value['attributes'];      
                                                   
                        } else {
                                                              
                            $arr_result['place_attributes'] = "-"; 
                                                            
                        }      
                        
                                      
                    }
                                              
                } 
                   
            }       

        }    
        
		        
        private function WritePersonsList($array_of_persons){
           
            echo "<div> Персоны";
            
            echo "<details><summary></summary>";
            
            foreach ($array_of_persons as $key => $value){
               
			   $prof = ""; 	
               $prof = $this -> GetProfession($value['type']);
                       
               echo "<div> $value[name] $prof </div>";                 
                
            }
            
            echo "</details>";
            
            echo "</div>";
        }
               


        private function WriteAttributesParatemers($array_of_attributes){            
                        
            echo "<div> Итоговые атрибуты";
            
            echo "<details><summary></summary>";
                      
            foreach ($array_of_attributes as $key => $value){  
            
                $sep  = "->";
                $attr = "";
                $attr = $this -> GetPlaceAttribute($value['id']);               
                       
                echo "<div> {$attr} {$sep} {$value['value']} </div>";                 
                
            }
            
            echo "</details>";
            
            echo "</div>";          
            
            
        }           
         

        private function GetProfession($pro_id){
            
           switch ($pro_id) {
            
                case 0:
                    
                    return "кузнец";
                    
                    break;
         
                case 1:
                
                    return "рыбак";
                    
                    break;
                         
                case 2:
                
                    return "портной";
                    
                    break;
                         
                case 3:
                
                    return "плотник";
                    
                    break;
    
                case 4:
                
                    return "охотник";
                    
                    break;
                       
                case 5:
                
                    return "стражник";
                    
                    break;
                           
                case 6:
                
                    return "торговец";
                    
                    break;
                            
                case 7:
                
                    return "трактирщик";
                    
                    break;
                              
                case 8:
                
                    return "вор";
                    
                    break;
                              
                case 9:
                
                    return "фермер";
                    
                    break;
                               
                case 10:
                
                    return "шахтер";
                    
                    break;
                               
                case 11:
                
                    return "священник";
                    
                    break;
                                
                case 12:
                
                    return "лекарь";
                    
                    break;
                                   
                case 13:
                
                    return "алхимик";
                    
                    break;
                            
                case 14:
                
                    return "палач";
                    
                    break;
                               
                case 15:
                
                    return "волшебник";
                    
                    break;
                              
                case 16:
                
                    return "ростовщик";
                    
                    break;
                             
                case 17:
                
                    return "писарь";
                    
                    break;
                         
                case 18:
                
                    return "магомеханик";
                    
                    break;
                      
                case 19:
                
                    return "бард";
                    
                    break;
                          
                case 20:
                
                    return "дрессировщик";
                    
                    break;
                                              
                case 21:
                
                    return "скотовод";
                    
                    break;
          
           }      
            
        }
        
         private function GetPlaceAttribute($attr_id){
            
           switch ($attr_id) {
            
                case 0:
                    
                    return "размер города";
                    
                    break;
                           
                case 2:
                
                    return "радиус изменений";
                    
                    break;
                         
                case 3:
                
                    return "радиус владений";
                    
                    break;
    
                case 4:
                
                    return "производство";
                    
                    break;
                       
                case 5:
                
                    return "товары";
                    
                    break;
                           
                case 6:
                
                    return "дары Хранителей";
                    
                    break;
                            
                case 7:
                
                    return "безопасность";
                    
                    break;
                              
                case 8:
                
                    return "транспорт";
                    
                    break;
                              
                case 9:
                
                    return "свобода";
                    
                    break;
                               
                case 10:
                
                    return "пошлина";
                    
                    break;
                               
                case 11:
                
                    return "стабильность";
                    
                    break;
                                
                case 12:
                
                    return "восстановление стабильности";
                    
                    break;
                                   
                case 13:
                
                    return "бонус к опыту";
                    
                    break;
                            
                case 14:
                
                    return "цена покупки предметов";
                    
                    break;
                               
                case 15:
                
                    return "цена продажи предметов";
                    
                    break;
                              
                case 16:
                
                    return "сила покупаемых артефактов";
                    
                    break;
                             
                      
                case 19:
                
                    return "восстановление энергии";
                    
                    break;
                          
                case 20:
                
                    return "лечение героя";
                    
                    break;
                                              
                case 21:
                
                    return "лечение спутника";
                    
                    break;

                case 22:
                
                    return "экономика";
                    
                    break;

                case 23:
                
                    return "специализация «Торговый центр»";
                    
                    break;

                case 24:
                
                    return "специализация «Город ремёсел»";
                    
                    break;

                case 25:
                
                    return "специализация «Форт»";
                    
                    break;

                case 26:
                
                    return "специализация «Политический центр»";
                    
                    break;

                case 27:
                
                    return "специализация «Полис»";
                    
                    break;

                case 28:
                
                    return "специализация «Курорт»";
                    
                    break;

                case 29:
                
                    return "специализация «Транспортный узел»";
                    
                    break;

                case 30:
                
                    return "специализация «Вольница»";
                    
                    break;

                case 31:
                
                    return "специализация «Святой город»";
                    
                    break;

                case 32:
                
                    return "сила специализаций";
                    
                    break;

                case 33:
                
                    return "культура";
                    
                    break;    
                    
                case 34:
                
                    return "площадь владений";
                    
                    break;        

          
           }      
            
        }
        
        
        private function GetSpecialization($specialization){
            
            switch ($specialization) {
            
                case 0:
                    
                    return "Торговый центр";
                    
                    break;
         
                case 1:
                
                    return "Город ремёсел";
                    
                    break;
                         
                case 2:
                
                    return "Форт";
                    
                    break;
                         
                case 3:
                
                    return "Политический центр";
                    
                    break;
    
                case 4:
                
                    return "Полис";
                    
                    break;
                       
                case 5:
                                    
                    return "Курорт";
                    
                    break;
                           
                case 6:
                
                    return "Транспортный узел";
                    
                    break;
                            
                case 7:
                
                    return "Вольница";
                    
                    break;
                              
                case 8:
                
                    return "Святой город";
                    
                    break;
                              
                case 9: 

                    return "Обычный город";
                    
                    break;
              
            }
           
            
        }       
            
        public function WriteInfo($tr_array)    {            
                        
          	echo "<tr>"; 
	  	
				echo "<td> <a href=\"http://the-tale.org/game/places/$tr_array[place_id]\"> $tr_array[place_name] </a></td>"; 	
				$sep 		 = "\\";
				
				if ($tr_array['place_frontier'] == true){
					
					echo "<td> Во Фронтире </td>";  
					
				} else{
					
					echo "<td> Ядро </td>";
					
				}  
				
				echo "<td> {$tr_array['place_position']['x']}{$sep}{$tr_array['place_position']['y']} </td>";                   
				echo "<td> $tr_array[place_size] </td>";   
							
                $spec = $this -> GetSpecialization($tr_array['place_specialization']); 
				
				$power_nearest_area		 = Round($tr_array['place_politic_power']['power']['inner']['value'],2);
				$power_summ_crowd	     = Round($tr_array['place_politic_power']['power']['outer']['value'],2);	
                $power_in_other_places 	 = Round($tr_array['place_politic_power']['power']['inner']['fraction']*100,3)."%";
				$power_out_other_places  = Round($tr_array['place_politic_power']['power']['outer']['fraction']*100,3)."%";
				$power_all_other_places  = Round($tr_array['place_politic_power']['power']['fraction']*100,3)."%";
					
				echo "<td> {$spec} </td>";
				
                echo "<td> Внутреннее влияние: <br> Суммарное влияние ближнего круга <br> {$power_nearest_area} <br> Доля среди остальных городов <br> {$power_in_other_places} <br> Внешнее влияние: <br> Суммарное влияние толпы <br> {$power_summ_crowd}<br> Доля среди остальных городов<br>{$power_out_other_places} <br> Доля общего влияния среди остальных городов: <br> {$power_all_other_places} </td>"; 
                
                echo "<td> <div class='treeHTML'>";
                
                    $this -> WritePersonsList($tr_array['place_persons']);
                
                echo "</div></td> ";
                               
                echo "<td> <div class='treeHTML'>";
                
                    $this -> WriteAttributesParatemers($tr_array['place_attributes']['attributes']);
                
                echo "</div></td> ";
				
			echo "</tr>";  
                      
        
		}
            
            
		function __destruct() {
		   
			   

						  
		}       
	
        
    }
    
    class MastersInformationUpdater extends GameInfoUpdater 
    
    {
        
        function __construct() {
               
                   
 
                              
        }
        
        
		public function WriteTableHeader(){
			
			 echo '<table border="1">';
             
             echo "<tr>";     
             
				 echo "<td> Мастер </td>"; 			
				 echo "<td> Город </td>"; 
				 echo "<td> Домик </td>"; 				
				 echo "<td> Влияние </td>";      
				 echo "<td> Проект </td>";
                    
             echo '</tr>';
			
		}
		
		public function WriteTableFooter(){
			
			 echo '</table>';
			
		}
        
        public function CreateInfoArray($arr){
            
           static $ms_array = array();           
            
                foreach ($arr as $key => $value){
                                                                      
                    if (is_array($value)) {   
                      
                        $this->CreateInfoArray($value);
                                                                      
                        $this->TraceArraySubPack($value, $key, $ms_array); 
                    
                    
                    } else {
                          
                          
                      //  $this->TraceArraySubPack($value, $key, $ms_array);                            
                                                          
                                               
                    }                
                
                
                }
                
            
            return $ms_array;
            
            
        } 
        
        
                
        protected function TraceArraySubPack($value, $key, &$arr_result){
	   
            if (is_array($value)){
                    
                if((string) $key == "data"){
                        
                        if (isset($value['id'])){

                          $arr_result['master_id'] = $value['id']; 
                                                
                        }else{
                               
                          $arr_result['master_id'] = "-"; 
                               
                        } 
                   
                       if (isset($value['name'])){

                          $arr_result['master_name'] = $value['name'];

                       }else {
                           
                          $arr_result['master_name'] = "-"; 
                           
                       } 
                                                         
                       if (isset($value['building'])){

                          $arr_result['master_building'] = "YES";
                       
                       }else {
                           
                          $arr_result['master_building'] = "NO"; 
                           
                       } 
                       
                       if (isset($value['place'])){

                          $arr_result['master_place_name'] = $value['place']['name'];
						  $arr_result['master_place_id']   = $value['place']['id'];
                          
                       }else {
                           
                          $arr_result['master_place_name'] = "-";
						  $arr_result['master_place_id']   = "-";
                           
                       } 
                       
                       if (isset($value['politic_power'])){

                          $arr_result['master_politic_power'] = $value['politic_power'];
                       
                       }else {
                           
                         $arr_result['master_politic_power'] = "-"; 
                           
                       } 
                       
                       if (isset($value['job'])){

                          $arr_result['master_job'] = $value['job']['name'];
                         
                       }else {
                           
                         $arr_result['master_job'] = "-"; 
                           
                       } 
		   
                }
  
                             
            }   
        
        } 
       
		//for better times...
		public function PrepareArrayWhenHasNoIds(&$arrayByCurl){
			
			static $arr_result = array();
				
			return $arr_result;
			
		} 	   
        
		//for better times...		
		public function ParseAdditionalInfo(&$arrcurlget, &$temp_array){
			
			
			
		}		
			
            
        public function WriteInfo($tr_array){
                        
			echo "<tr>"; 
                
                $sep 					 = "\\";
				$power_nearest_area		 = Round($tr_array['master_politic_power']['power']['inner']['value'],2);
				$power_summ_crowd	     = Round($tr_array['master_politic_power']['power']['outer']['value'],2);
                $power_in_other_places 	 = Round($tr_array['master_politic_power']['power']['inner']['fraction']*100,3)."%";
				$power_out_other_places  = Round($tr_array['master_politic_power']['power']['outer']['fraction']*100,3)."%";
				$power_all_other_places  = Round($tr_array['master_politic_power']['power']['fraction']*100,3)."%";
				
				echo "<td> <a href=\"http://the-tale.org/game/persons/$tr_array[master_id]\"> $tr_array[master_name] </a></td>"; 			 
				echo "<td> <a href=\"http://the-tale.org/game/places/$tr_array[master_place_id]\"> $tr_array[master_place_name] </a></td>"; 			             
				echo "<td> $tr_array[master_building] </td>";  							
				echo "<td> Внутреннее влияние: <br> Суммарное влияние ближнего круга <br> {$power_nearest_area}<br> Доля среди остальных городов <br> {$power_in_other_places} <br> Внешнее влияние: <br> Суммарное влияние толпы <br> {$power_summ_crowd}<br> Доля среди остальных городов<br> {$power_out_other_places} <br> Доля общего влияния среди остальных городов: <br> {$power_all_other_places} </td>"; 		              
				echo "<td>  $tr_array[master_job] </td>";     
                    
			echo "</tr>";  
            
        }    
            
        function __destruct() {
               
                   
 
                              
        }   
        
        
    }
    
?>     