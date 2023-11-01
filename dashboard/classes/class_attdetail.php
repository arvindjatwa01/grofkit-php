<?php 

Class class_attdetail
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
				if(isset($countryNameData['attValue']) && '' == $countryNameData['attValue'] OR isset($countryNameData['attName']) && '0' == $countryNameData['attName'])
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
					 	$sqlInsertSliderData= ' INSERT INTO attributedtl SET
						attd_attid=\''.mysql_real_escape_string_port($countryNameData['attName']).'\',
						attd_value=\''.mysql_real_escape_string_port($countryNameData['attValue']).'\''; 
                        $strRes=$dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
                        $intInsertId= $dbh->lastInsertId();	
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

						$sqlUpdateSliderData= ' UPDATE attributedtl SET
						attd_attid=\''.mysql_real_escape_string_port($countryNameData['attName']).'\',
						attd_value=\''.mysql_real_escape_string_port($countryNameData['attValue']).'\'
                        	   WHERE attd_id='.(int)$_GET['id'];
						
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
						  redirect('manage_attdetail.php');
					  
					 }
			 
					
				}
			}
			return $aryErrors;
		}
	}
}

$class_attdetail = new class_attdetail;

?>