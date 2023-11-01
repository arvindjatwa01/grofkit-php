<?php 

Class class_country
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
				if(isset($countryNameData['countryName']) && '' == $countryNameData['countryName'] || isset($countryCodeData['countryCode']) && '' == $countryCodeData['countryCode'])
			    {
			       	$aryErrors['countryName']=' Please Enter Country Name .';
					$_SESSION['error_country_msg'] = "All Fields are required";
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
						$countryName = $countryNameData['countryName'];
						$countryCode = $countryCodeData['countryCode'];
						$sql = "SELECT * FROM country WHERE cu_Name = '$countryName' OR cu_Code = '$countryCode'";

						$res  = $dbh->query($sql);
						$resSelect = $res->fetchAll();

						
						if(count($resSelect)>0){
							// echo "<script>alert('Country Name or Code Already Exist')</script>";
							$_SESSION['success_size_image'] = "Country Name or Code Already Exist";
						}else{
							

					 	$sqlInsertSliderData= ' INSERT INTO country SET
						cu_Name=\''.mysql_real_escape_string_port($countryNameData['countryName']).'\',
						cu_Code=\''.mysql_real_escape_string_port($countryCodeData['countryCode']).'\',
                        cu_active=0'; 
                        $strRes=$dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
                        $intInsertId= $dbh->lastInsertId();	
						}
                        break;	
						 
                        case 'edit':

							date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
							$Modifydate = date('Y-m-d H:i:s ', time());
							$Id = (int)$_GET['id'];
							$EditCountryName = $countryNameData['countryName'];
							$EditCountryCode = $countryCodeData['countryCode'];
							try {
								$dbh->query(' UPDATE country SET
								cu_Name=\''.mysql_real_escape_string_port($countryNameData['countryName']).'\',
								cu_Code=\''.mysql_real_escape_string_port($countryCodeData['countryCode']).'\',
								cu_modifydate =\''.$Modifydate.'\'
									   WHERE cu_id='.(int)$_GET['id']);
								$_SESSION['success_country_msg'] = 'Slider Updated successfully';
								redirect('manage_country.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_country_msg'] = "Country $EditCountryName or Code $EditCountryCode already Exists";
									redirect("add_country.php?id=$Id&mode=$strMode");
								}
							}
							
						// $EditcountryName = $countryNameData['countryName'];
						// $EditcountryCode = $countryCodeData['countryCode'];
						// $Editsql = "SELECT * FROM country WHERE cu_Name = '$EditcountryName' OR cu_Code = '$EditcountryCode'";

						// $Editres  = $dbh->query($Editsql);
						// $EditresSelect = $Editres->fetchAll();
						// if(count($EditresSelect)>1){
						// 	$_SESSION['error_country_msg'] = "Country Name or Data Already Exist";
						// }else{
						// 	date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
						// 	$Modifydate = date('Y-m-d H:i:s ', time());
						// $sqlUpdateSliderData= ' UPDATE country SET
						// cu_Name=\''.mysql_real_escape_string_port($countryNameData['countryName']).'\',
						// cu_Code=\''.mysql_real_escape_string_port($countryCodeData['countryCode']).'\',
						// cu_modifydate =\''.$Modifydate.'\'
                        // 	   WHERE cu_id='.(int)$_GET['id'];
						
                        // $strRes=$dbh->query($sqlUpdateSliderData);	
                        // $intInsertId= (int)$_GET['id'];
						// }	
                         break;						 
					}
					 if($strRes)
					 {
						  if($strMode == 'edit')
						  {
						   $_SESSION['success_country_msg'] = ' Slider Updated successfully.';
						   
						  }
						  else
						  {
					      $_SESSION['success_country_msg'] = 'Entry saved successfully.';
						  
						  }
						  redirect('manage_country.php');
					  
					 }
			 
					
				}
			}
			return $aryErrors;
		}
	}
}

$class_country = new class_country;

?>