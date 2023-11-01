<?php 

Class class_checkout
{
	function sizeProcessRequest($userAddressData,$strMode)
	{
		global $dbh;
		
		if($_SESSION['REQUEST_METHOD']='POST')
		{
			if(''==$userAddressData)
			{
				$userAddressData=$_POST;
			}
			if(''==$strMode)
			{
				$strMode= $_REQUEST['mode'];
			}
			$aryErrors=array();
			if(0<count($userAddressData))
			{
				if(isset($userAddressData['AdduserName']) && '' == $userAddressData['AdduserName'] OR isset($userAddressData['Adduseremail']) && '' == $userAddressData['Adduseremail'] OR isset($userAddressData['Adduserphone']) && '' == $userAddressData['Adduserphone'] OR isset($userAddressData['AdduserAdd1']) && '' == $userAddressData['AdduserAdd1'] OR isset($userAddressData['Addzipcode']) && '' == $userAddressData['Addzipcode'])
			    {
			       $aryErrors['AdduserName']=' Please Enter all Fileds Code .';
			    
			    }
				  $aryvranchId='';
				if(0==count($aryErrors))
				{
					$strRes=FALSE;
					switch($strMode)
					{
						case 'new':
					 	$sqlInsertSliderData= ' INSERT INTO mstaddress SET
						ad_UserID=\''.mysql_real_escape_string_port($userAddressData['AdduserID']).'\',
						ad_name=\''.mysql_real_escape_string_port($userAddressData['AdduserName']).'\',
						ad_EmailID=\''.mysql_real_escape_string_port($userAddressData['Adduseremail']).'\',
						ad_MobileNo=\''.mysql_real_escape_string_port($userAddressData['Adduserphone']).'\',
                        ad_address1=\''.mysql_real_escape_string_port($userAddressData['AdduserAdd1']).'\',
						ad_address2=\''.mysql_real_escape_string_port($userAddressData['AdduserAdd2']).'\',
						ad_addressType=\''.mysql_real_escape_string_port($userAddressData['add-type']).'\',
						ad_postalCode=\''.mysql_real_escape_string_port($userAddressData['Addzipcode']).'\',
                        ad_City=\''.mysql_real_escape_string_port($userAddressData['AddCity']).'\',
						ad_StateName=\''.mysql_real_escape_string_port($userAddressData['AddState']).'\', 
						ad_country=\''.mysql_real_escape_string_port($userAddressData['AddCountry']).'\''; 
                        $strRes=$dbh->query($sqlInsertSliderData);	
						// print_r($sqlInsertSliderData); die();
                        $intInsertId= $dbh->lastInsertId();	
                        break;	
						 
                        case 'edit':

						$sqlUpdateSliderData= ' UPDATE mstaddress SET
						ad_UserID=\''.mysql_real_escape_string_port($userAddressData['AdduserID']).'\',
						ad_name=\''.mysql_real_escape_string_port($userAddressData['AdduserName']).'\',
						ad_EmailID=\''.mysql_real_escape_string_port($userAddressData['Adduseremail']).'\',
						ad_MobileNo=\''.mysql_real_escape_string_port($userAddressData['Adduserphone']).'\',
                        ad_address1=\''.mysql_real_escape_string_port($userAddressData['AdduserAdd1']).'\',
						ad_address2=\''.mysql_real_escape_string_port($userAddressData['AdduserAdd2']).'\',
						ad_addressType=\''.mysql_real_escape_string_port($userAddressData['add-type']).'\',
						ad_postalCode=\''.mysql_real_escape_string_port($userAddressData['Addzipcode']).'\',
                        ad_City=\''.mysql_real_escape_string_port($userAddressData['AddCity']).'\',
						ad_StateName=\''.mysql_real_escape_string_port($userAddressData['AddState']).'\', 
						ad_country=\''.mysql_real_escape_string_port($userAddressData['AddCountry']).'\'
                        	   WHERE ad_ID='.(int)$_GET['id'];
						
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
						  //echo $_POST['applyCoupanName'];
						  redirect('selectaddress.php'.$_POST['applyCoupanName']);
					  
					 }
			 
					
				}
			}
			return $aryErrors;
		}
	}
}

$class_checkout = new class_checkout;

?>