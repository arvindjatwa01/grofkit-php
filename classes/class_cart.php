<?php 

Class class_cart
{
	// if(isset($_POST['isaddCart'])){

	// }
	function sizeProcessRequest($cartNameData,$strMode)
	{
		global $dbh;
		if($_SESSION['REQUEST_METHOD']='POST')
		{
			if(''==$cartNameData)
			{
				$cartNameData=$_POST;
			}
			$aryErrors=array();
            
            
			if(0==count($cartNameData))
			{
				if(isset($cartNameData['isaddCart']))
			    {
                    $sqlInsertSliderData= ' INSERT INTO cart SET
                    cart_UserID=\''.mysql_real_escape_string_port($countryNameData['userName']).'\',
                    cart_itemId=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\',
                    cart_volume=\'1\', 
                    cart_UnitId=\''.mysql_real_escape_string_port($countryNameData['cartUnit']).'\''; 
                    $strRes=$dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
                    $intInsertId= $dbh->lastInsertId();	
					print_r($sqlInsertSliderData);
			    
			    }
			}
			return $aryErrors;
		}
	}
}

$class_cart = new class_cart;

?>