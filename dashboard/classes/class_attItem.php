<?php 

Class class_attItem
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
				if(isset($countryNameData['attValue']) && '' == $countryNameData['attValue'] OR isset($countryNameData['attName']) && '0' == $countryNameData['attName'] OR isset($countryNameData['itemName']) && '0' == $countryNameData['itemName'])
			    {
			       $aryErrors['attValue']=' Please Enter Attribute Value .';
			    //    $aryErrors['countryName']=' Please Enter Country Name .';
			    }
				// if(isset($countryNameData['cost']) && '' == $countryNameData['cost'])
			    // {
			    //    $aryErrors['cost']=' Please Enter cost .';
			    // }
				  $aryvranchId='';
				if(0==count($aryErrors))
				{
					$strRes=FALSE;
					switch($strMode)
					{
						case 'new':
						    
							try {
								$dbh->query(' INSERT INTO attributeitem SET
								iteAtt_attid=\''.mysql_real_escape_string_port($countryNameData['attName']).'\',
								iteAtt_value=\''.mysql_real_escape_string_port($countryNameData['attValue']).'\',
								iteAtt_itemID=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\'');
								$_SESSION['success_attributeItem_msg'] = 'Slider Updated successfully';
								redirect('manage_attItem.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_attributeItem_msg'] = "This Attribute item already Exists";
									redirect("add_attItem.php");
								}
							}
				// 	 	$sqlInsertSliderData= ' INSERT INTO attributeitem SET
				// 		iteAtt_attid=\''.mysql_real_escape_string_port($countryNameData['attName']).'\',
				// 		iteAtt_value=\''.mysql_real_escape_string_port($countryNameData['attValue']).'\',
				// 		iteAtt_itemID=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\''; 
    //                     $strRes=$dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
    //                     $intInsertId= $dbh->lastInsertId();	
						// }
                         break;	
						 
                        case 'edit':
						// $EditcountryName = $countryNameData['countryName'];
						// $EditcountryCode = $countryCodeData['countryCode'];
						// $Editsql = "SELECT * FROM country WHERE cu_Name = '$countryName' OR cu_Code = '$countryCode'";

						// $Editres  = $dbh->query($Editsql);
						// $EditresSelect = $Editres->fetchAll();
						// if(count($EditresSelect)>1){
						// 	$_SESSION['success_size_msg'] = "Country Name or Data Already Exist";
						// }else{

						$sqlUpdateSliderData= ' UPDATE attributeitem SET
						iteAtt_attid=\''.mysql_real_escape_string_port($countryNameData['attName']).'\',
						iteAtt_value=\''.mysql_real_escape_string_port($countryNameData['attValue']).'\',
						iteAtt_itemID=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\'
                        	   WHERE iteAtt_id='.(int)$_GET['id'];
						
                        $strRes=$dbh->query($sqlUpdateSliderData);	
                        $intInsertId= (int)$_GET['id'];
						// }
                         break;						 
					}
					 if($strRes)
					 {
						  if($strMode == 'edit')
						  {
						   $_SESSION['success_size_msg'] = ' Slider Updated successfully.';
						   
						  }
						  else
						  {
					      $_SESSION['success_size_msg'] = 'Entry saved successfully.';
						  
						  }
						  redirect('manage_attItem.php');
					  
					 }
			 
					
				}
			}
			return $aryErrors;
		}
	}
}

$class_attItem = new class_attItem;

?>