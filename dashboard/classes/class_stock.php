<?php 

Class class_stock
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
				if(isset($countryNameData['prodName']) && '0' == $countryNameData['prodName'] OR isset($countryNameData['itemName']) && '0' == $countryNameData['itemName'] OR isset($countryNameData['unitCode']) && '0' == $countryNameData['unitCode'] OR isset($countryNameData['stockVol']) && '' == $countryNameData['stockVol'])
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
						    $sql = "SELECT * FROM stock WHERE stk_itemid='".$countryNameData['itemName']."'";
						    
						    $Res = $dbh->query($sql);
						    $rowdata = $Res->fetch();
						    if($Res->rowCount()>0){ 
						        $UpdationQuery = "UPDATE stock SET stl_Volumns=stl_Volumns+".$countryNameData['stockVol']."-".$countryNameData['stockRemoveVol']." WHERE stk_itemid='".$countryNameData['itemName']."'";
						        $updateRes =  $dbh->query($UpdationQuery);
						        $_SESSION['success_size_msg'] = 'Entry saved successfully.';
						        redirect('manage_stock.php');
						    }else{
						        
						    
					 	$sqlInsertSliderData= ' INSERT INTO stock SET
						stk_prodid=\''.mysql_real_escape_string_port($countryNameData['prodName']).'\',
						stk_itemid=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\',
						stk_unitid=\''.mysql_real_escape_string_port($countryNameData['unitCode']).'\',
						stl_Volumns=\''.($countryNameData['stockVol']).'\''; 
                        $strRes=$dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
                        $intInsertId= $dbh->lastInsertId();	
						    }
						
                         break;	
						 
                        case 'edit':

						$sqlUpdateSliderData= ' UPDATE cartdtl SET
						cartDtl_cartid=\''.mysql_real_escape_string_port($countryNameData['cartNo']).'\',
						cartDtl_attid=\''.mysql_real_escape_string_port($countryNameData['attName']).'\'
                        	   WHERE cartDtl_Id='.(int)$_GET['id'];
						
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
						  redirect('manage_stock.php');
					  
					 }
			 
					
				}
			}
			return $aryErrors;
		}
	}
}

$class_stock = new class_stock;

?>