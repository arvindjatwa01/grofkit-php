<?php 

Class class_cart
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
				if(isset($countryNameData['cartVolume']) && '' == $countryNameData['cartVolume'] OR isset($countryNameData['itemName']) && '0' == $countryNameData['itemName'] OR isset($countryNameData['userName']) && '0' == $countryNameData['userName'] OR isset($countryNameData['cartUnit']) && '0' == $countryNameData['cartUnit'])
			    {
			       $aryErrors['cartVolume']=' Please Enter Coupan Code .';
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
					 	$sqlInsertSliderData= ' INSERT INTO cart SET
						cart_UserID=\''.mysql_real_escape_string_port($countryNameData['userName']).'\',
						cart_itemId=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\',
						cart_volume=\''.mysql_real_escape_string_port($countryNameData['cartVolume']).'\', 
						cart_UnitId=\''.mysql_real_escape_string_port($countryNameData['cartUnit']).'\''; 
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

						$sqlUpdateSliderData= ' UPDATE cart SET
						cart_UserID=\''.mysql_real_escape_string_port($countryNameData['userName']).'\',
						cart_itemId=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\',
						cart_volume=\''.mysql_real_escape_string_port($countryNameData['cartVolume']).'\', 
						cart_UnitId=\''.mysql_real_escape_string_port($countryNameData['cartUnit']).'\'
                        	   WHERE cart_Id='.(int)$_GET['id'];
						
                        $strRes=$dbh->query($sqlUpdateSliderData);	
                        $intInsertId= (int)$_GET['id'];
						// }
                         break;						 
					}
					 if($strRes)
					 {
						  if($strMode == 'edit')
						  {
						   $_SESSION['success_cart_msg'] = ' Slider Updated successfully.';
						   
						  }
						  else
						  {
					      $_SESSION['success_cart_msg'] = 'Entry saved successfully.';
						  
						  }
						  redirect('manage_cart.php');
					  
					 }
			 
					
				}
			}
			return $aryErrors;
		}
	}
}

$class_cart = new class_cart;

?>