<?php 

Class class_cpDtl
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
				if(isset($countryNameData['cpCode']) && '0' == $countryNameData['cpCode'])
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
							try {
								$dbh->query(' INSERT INTO coupandtl SET
								CpDtl_CPID=\''.mysql_real_escape_string_port($countryNameData['cpCode']).'\',
								CpDtl_itemID=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\',
								CpDtl_UserID=\''.mysql_real_escape_string_port($countryNameData['userName']).'\'');
								$_SESSION['success_coupandtl_msg'] = 'Slider Updated successfully';
								redirect('manage_cpDtl.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_coupandtl_msg'] = "This Coupan Code already Exists for this Item";
									redirect("add_cpDtl.php");
								}
							}
					 	// $sqlInsertSliderData= ' INSERT INTO coupandtl SET
						// CpDtl_CPID=\''.mysql_real_escape_string_port($countryNameData['cpCode']).'\',
						// CpDtl_itemID=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\',
						// CpDtl_UserID=\''.mysql_real_escape_string_port($countryNameData['userName']).'\''; 
                        // // print_r($sqlInsertSliderData); die();
						// $strRes=$dbh->query($sqlInsertSliderData);	
						
                        // $intInsertId= $dbh->lastInsertId();	
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

						$sqlUpdateSliderData= ' UPDATE coupandtl SET
						CpDtl_CPID=\''.mysql_real_escape_string_port($countryNameData['cpCode']).'\',
						CpDtl_itemID=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\',
						CpDtl_UserID=\''.mysql_real_escape_string_port($countryNameData['userName']).'\'
                        	   WHERE CpDtl_Id='.(int)$_GET['id'];
						
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
						  redirect('manage_cpDtl.php');
					  
					 }
			 
					
				}
			}
			return $aryErrors;
		}
	}
}

$class_cpDtl = new class_cpDtl;

?>