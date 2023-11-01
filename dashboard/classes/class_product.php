<?php 

Class class_prod
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
				if(isset($countryNameData['prodName']) && '' == $countryNameData['prodName'] OR isset($countryCodeData['categoryName']) && '0' == $countryCodeData['categoryName'] OR isset($countryCodeData['prodDesc']) && '' == $countryCodeData['prodDesc'] OR isset($countryCodeData['HSNCode']) && '' == $countryCodeData['HSNCode'] OR isset($countryCodeData['prodDelCost']) && '' == $countryCodeData['prodDelCost'] OR isset($countryCodeData['unitName']) && '0' == $countryCodeData['unitName'])
			    {
			       $aryErrors['prodName']=' Please Enter Product Name .';
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
					 	$sqlInsertSliderData= ' INSERT INTO product SET
						prod_Name=\''.mysql_real_escape_string_port($countryNameData['prodName']).'\',
						prod_CatID=\''.mysql_real_escape_string_port($countryNameData['categoryName']).'\',
						prod_description=\''.mysql_real_escape_string_port($countryNameData['prodDesc']).'\',
						prod_HSNCode=\''.mysql_real_escape_string_port($countryNameData['HSNCode']).'\',
						prod_DeliveryCost=\''.mysql_real_escape_string_port($countryNameData['prodDelCost']).'\',
						prod_unitId=\''.mysql_real_escape_string_port($countryNameData['unitName']).'\',
                        prod_active=0'; 
                        $strRes=$dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
                        $intInsertId= $dbh->lastInsertId();
                        break;	
						 
                        case 'edit':

						$sqlUpdateSliderData= ' UPDATE product SET
						prod_Name=\''.mysql_real_escape_string_port($countryNameData['prodName']).'\',
						prod_CatID=\''.mysql_real_escape_string_port($countryNameData['categoryName']).'\',
						prod_description=\''.mysql_real_escape_string_port($countryNameData['prodDesc']).'\',
						prod_HSNCode=\''.mysql_real_escape_string_port($countryNameData['HSNCode']).'\',
						prod_DeliveryCost=\''.mysql_real_escape_string_port($countryNameData['prodDelCost']).'\',
						prod_unitId=\''.mysql_real_escape_string_port($countryNameData['unitName']).'\'
                        	   WHERE prod_Id='.(int)$_GET['id'];
						
                        $strRes=$dbh->query($sqlUpdateSliderData);	
                        $intInsertId= (int)$_GET['id'];
						// }
                         break;						 
					}
					 if($strRes)
					 {
						  if($strMode == 'edit')
						  {
						   $_SESSION['success_product_msg'] = ' Slider Updated successfully.';
						   
						  }
						  else
						  {
					      $_SESSION['success_product_msg'] = 'Entry saved successfully.';
						  
						  }
						  redirect('manage_product.php');
					  
					 }
			 
					
				}
			}
			return $aryErrors;
		}
	}
}

$class_prod = new class_prod;

?>