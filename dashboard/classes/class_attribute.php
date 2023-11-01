<?php 

Class class_att
{
	function sizeProcessRequest($countryNameData,$strMode)
	{
		global $dbh;
		
		if($_SESSION['REQUEST_METHOD']='POST')
		{
			if(''==$countryNameData)
			{
				$countryNameData=$_POST;
				$countryCodeData = $_POST;
			}
			if(''==$strMode)
			{
				$strMode= $_REQUEST['mode'];
			}
			$aryErrors=array();
			if(0<count($countryNameData))
			{
				if(isset($countryNameData['attName']) && '' == $countryNameData['attName'] OR isset($countryNameData['choise']) && '' == $countryNameData['choise']  OR isset($countryNameData['isStockAtt']) && '' == $countryNameData['isStockAtt'])
			    {
			       $aryErrors['attName']=' Please Enter Attribute Name .';
			    }
				  $aryvranchId='';
				if(0==count($aryErrors))
				{
					$strRes=FALSE;
					switch($strMode)
					{
						case 'new':
                                $MChoise = "";
                                $SChoise = "";
								$VChoise = '';
                            if($countryNameData['choise'] == "S"){
                                $MChoise = "0";
                                $SChoise = "1";
								$VChoise = '0';

                            }elseif($countryNameData['choise'] == "M"){
                                $MChoise = "1";
                                $SChoise = "0";
								$VChoise = '0';
                            }else{
								$MChoise = "0";
                                $SChoise = "0";
								$VChoise = '1';
							}
                            
							
							$attName = $countryNameData['attName'];
							$sql = "SELECT * FROM attribute WHERE att_Name = '$attName'";
	
							$res  = $dbh->query($sql);
							$resSelect = $res->fetchAll();
	
							
							if(count($resSelect)>0){
								$_SESSION['error_attribute_msg'] = "Attribute Already Exist";
							}else{
					 	$sqlInsertSliderData= ' INSERT INTO attribute SET
						att_Name=\''.mysql_real_escape_string_port($countryNameData['attName']).'\',
						att_IsMultiple=\''.mysql_real_escape_string_port($MChoise).'\',
						att_IsonView=\''.mysql_real_escape_string_port($VChoise).'\',
						att_isSingalChoise=\''.mysql_real_escape_string_port($SChoise).'\',
						att_IsStockAtt=\''.mysql_real_escape_string_port($countryNameData['isStockAtt']).'\''; 
                        $strRes=$dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
                        $intInsertId= $dbh->lastInsertId();	
						}
                         break;	
						 
                        case 'edit':

                            $MChoise = "";
                            $SChoise = "";
							$VChoise = '';
                        if($countryNameData['choise'] == "S"){
                            $MChoise = "0";
                            $SChoise = "1";

                        }elseif($countryNameData['choise'] == "M"){
							$MChoise = "1";
							$SChoise = "0";
							$VChoise = '0';
						}else{
							$MChoise = "0";
							$SChoise = "0";
							$VChoise = '1';
						}

						$Id = (int)$_GET['id'];
							$EditunitName = $countryNameData['attName'];
							try {
								date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
								$Modifydate = date('Y-m-d H:i:s ', time());
								$dbh->query(' UPDATE attribute SET
								att_Name=\''.mysql_real_escape_string_port($countryNameData['attName']).'\',
								att_IsMultiple=\''.mysql_real_escape_string_port($MChoise).'\',
								att_IsonView=\''.mysql_real_escape_string_port($VChoise).'\',
								att_isSingalChoise=\''.mysql_real_escape_string_port($SChoise).'\',
								att_IsStockAtt=\''.mysql_real_escape_string_port($countryNameData['isStockAtt']).'\'
									   WHERE att_Id='.(int)$_GET['id']);
								$_SESSION['success_attribute_msg'] = 'Slider Updated successfully';
								redirect('manage_attribute.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_attribute_msg'] = "Attribute $EditunitName already Exists";
									redirect("add_attribute.php?id=$Id&mode=$strMode");
								}
							}
                         break;						 
					}
					 if($strRes)
					 {
						  if($strMode == 'edit')
						  {
						   $_SESSION['success_attribute_msg'] = ' Slider Updated successfully.';
						   
						  }
						  else
						  {
					      $_SESSION['success_attribute_msg'] = 'Entry saved successfully.';
						  
						  }
						  redirect('manage_attribute.php');
					  
					 }
			 
					
				}
			}
			return $aryErrors;
		}
	}
}

$class_att = new class_att;

?>