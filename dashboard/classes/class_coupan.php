<?php 

Class class_coupan
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
				if(isset($countryNameData['cpCode']) && '' == $countryNameData['cpCode'] OR isset($countryNameData['cpVolumn']) && '' == $countryNameData['cpVolumn'] OR isset($countryNameData['cpMinAmount']) && '' == $countryNameData['cpMinAmount']  OR isset($countryNameData['cpMaxAmount']) && '' == $countryNameData['cpMaxAmount'])
			    {
			       $aryErrors['cpCode']=' Please Enter Coupan Code .';
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
							$coupanCode = $countryNameData['cpCode'];
							$sql = "SELECT * FROM coupen WHERE CP_Code = '$coupanCode'";
	
							$res  = $dbh->query($sql);
							$resSelect = $res->fetchAll();
	
							
							if(count($resSelect)>0){
								$_SESSION['error_coupan_msg'] = "Coupan Code Already Exist";
							}else{
					 	$sqlInsertSliderData= ' INSERT INTO coupen SET
						CP_Code=\''.mysql_real_escape_string_port($countryNameData['cpCode']).'\',
						CP_Volumn=\''.mysql_real_escape_string_port($countryNameData['cpVolumn']).'\',
						cp_Minamount=\''.mysql_real_escape_string_port($countryNameData['cpMinAmount']).'\',
						cp_Maxamount=\''.mysql_real_escape_string_port($countryNameData['cpMaxAmount']).'\',
						CP_IsInAmount=\''.mysql_real_escape_string_port($countryNameData['cpAmount']).'\',
						CP_description=\''.mysql_real_escape_string_port($countryNameData['cpDesc']).'\''; 
                        $strRes=$dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
                        $intInsertId= $dbh->lastInsertId();	
						}
                         break;	
						 
                        case 'edit':
						
							$Id = (int)$_GET['id'];
							$EditCoupanCode = $countryNameData['cpCode'];
							try {
								date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
								$Modifydate = date('Y-m-d H:i:s ', time());
								$dbh->query(' UPDATE coupen SET
								CP_Code=\''.mysql_real_escape_string_port($countryNameData['cpCode']).'\',
								CP_Volumn=\''.mysql_real_escape_string_port($countryNameData['cpVolumn']).'\',
								cp_Minamount=\''.mysql_real_escape_string_port($countryNameData['cpMinAmount']).'\',
								cp_Maxamount=\''.mysql_real_escape_string_port($countryNameData['cpMaxAmount']).'\',
								CP_IsInAmount=\''.mysql_real_escape_string_port($countryNameData['cpAmount']).'\',
								CP_description=\''.mysql_real_escape_string_port($countryNameData['cpDesc']).'\'
									   WHERE Cp_ID='.(int)$_GET['id']);
								$_SESSION['success_coupan_msg'] = 'Slider Updated successfully';
								redirect('manage_coupan.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_coupan_msg'] = "Coupan Code $EditCoupanCode already Exists";
									redirect("add_coupan.php?id=$Id&mode=$strMode");
								}
							}

						// $sqlUpdateSliderData= ' UPDATE coupen SET
						// CP_Code=\''.mysql_real_escape_string_port($countryNameData['cpCode']).'\',
						// CP_Volumn=\''.mysql_real_escape_string_port($countryNameData['cpVolumn']).'\',
						// CP_InAmount=\''.mysql_real_escape_string_port($countryNameData['cpAmount']).'\'
                        // 	   WHERE Cp_ID='.(int)$_GET['id'];
						
                        // $strRes=$dbh->query($sqlUpdateSliderData);	
                        // $intInsertId= (int)$_GET['id'];
                         break;						 
					}
					 if($strRes)
					 {
						  if($strMode == 'edit')
						  {
						   $_SESSION['success_coupan_msg'] = ' Slider Updated successfully.';
						   
						  }
						  else
						  {
					      $_SESSION['success_coupan_msg'] = 'Entry saved successfully.';
						  
						  }
						  redirect('manage_coupan.php');
					  
					 }
			 
					
				}
			}
			return $aryErrors;
		}
	}
}

$class_coupan = new class_coupan;

?>