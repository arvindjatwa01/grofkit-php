<?php 

Class class_item
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
				if(isset($countryNameData['itemName']) && '' == $countryNameData['itemName'] OR isset($countryNameData['prodName']) && '0' == $countryNameData['prodName'] OR isset($countryNameData['itemRate']) && '' == $countryNameData['itemRate'])
			    {
			       $aryErrors['itemName']=' Please Enter Product Tax Name .';
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
						    if(($countryNameData['itemBaseRate'] > $countryNameData['itemRate']) || ($countryNameData['itemRate'] > $countryNameData['itemMRP'])){
							
							$_SESSION['error_item_msg'] = 'Rate should be greate to Base Rate & less than to MRP';
							
						}else{
							try {
								$dbh->query(' INSERT INTO item SET
								ite_ProdId=\''.mysql_real_escape_string_port($countryNameData['prodName']).'\',
								ite_Name=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\',
								ite_sku=\''.mysql_real_escape_string_port($countryNameData['itemsku']).'\',
								ite_Descripton=\''.mysql_real_escape_string_port($countryNameData['itemDesc']).'\',
								ite_BaseRate=\''.mysql_real_escape_string_port($countryNameData['itemBaseRate']).'\',
								ite_Rate=\''.mysql_real_escape_string_port($countryNameData['itemRate']).'\',
								ite_MRP=\''.mysql_real_escape_string_port($countryNameData['itemMRP']).'\'');
								$_SESSION['success_item_msg'] = 'Record added successfully';
								redirect('manage_item.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_item_msg'] = "Product Name or Barcode Already Exist";
									redirect("add_item.php");
								}
							}
						}
						// $itemName = $countryNameData['itemName'];
				// 		$itemSku = $countryNameData['itemsku'];
				// 		$sql = "SELECT * FROM item WHERE ite_sku = '$itemSku'";

				// 		$res  = $dbh->query($sql);
				// 		$resSelect = $res->fetchAll();

						
				// 		if(count($resSelect)>0){
				// 			$_SESSION['error_item_msg'] = "Product Name or Barcode Already Exist";
				// 		}else{
				// 			if($countryNameData['itemRate'] > $countryNameData['itemMRP']){
				// 				$_SESSION['error_item_msg'] = 'MRP Should be grater to Rate';
				// 			}else{
				// 				$sqlInsertSliderData= ' INSERT INTO item SET
				// 				ite_ProdId=\''.mysql_real_escape_string_port($countryNameData['prodName']).'\',
				// 				ite_Name=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\',
				// 				ite_sku=\''.mysql_real_escape_string_port($countryNameData['itemsku']).'\',
				// 				ite_Descripton=\''.mysql_real_escape_string_port($countryNameData['itemDesc']).'\',
				// 				ite_BaseRate=\''.mysql_real_escape_string_port($countryNameData['itemBaseRate']).'\',
				// 				ite_Rate=\''.mysql_real_escape_string_port($countryNameData['itemRate']).'\',
				// 				ite_MRP=\''.mysql_real_escape_string_port($countryNameData['itemMRP']).'\''; 
				// 				echo $sqlInsertSliderData;
				// 				$strRes=$dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
				// 				$intInsertId= $dbh->lastInsertId();
				// 				// for($i=0;$i<=count($portfolioImg)-1;$i++){
									
				// 				// 	 $sqlInsertItemImg= ' INSERT INTO itemimage SET
				// 				// 	 itimg_itemID=\''.mysql_real_escape_string_port($intInsertId).'\',
				// 				// 	 itimg_path=\''.mysql_real_escape_string_port($portfolioImg[$i]).'\''; 
				// 				// 	 $strItemImgRes=$dbh->query($sqlInsertItemImg);	//print_r($sqlInsertSliderData); die();
									
				// 				//   }
				// 				// }
				// 			}
				// 		}
                        break;	
						 
                        case 'edit':

							$Id = (int)$_GET['id'];
							$EditItemsku = $countryNameData['itemsku'];
							try {
								date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
								$Modifydate = date('Y-m-d H:i:s ', time());
								$dbh->query(' UPDATE item SET
								ite_ProdId=\''.mysql_real_escape_string_port($countryNameData['prodName']).'\',
								ite_Name=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\',
								ite_sku=\''.mysql_real_escape_string_port($countryNameData['itemsku']).'\',
								ite_Descripton=\''.mysql_real_escape_string_port($countryNameData['itemDesc']).'\',
								ite_BaseRate=\''.mysql_real_escape_string_port($countryNameData['itemBaseRate']).'\',
								ite_Rate=\''.mysql_real_escape_string_port($countryNameData['itemRate']).'\',
								ite_MRP=\''.mysql_real_escape_string_port($countryNameData['itemMRP']).'\'
									   WHERE ite_Id='.(int)$_GET['id']);
								$_SESSION['success_item_msg'] = 'Slider Updated successfully';
								redirect('manage_item.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_item_msg'] = "Item Barcode $EditItemsku already Exists";
									redirect("add_item.php?id=$Id&mode=$strMode");
								}
							}

						// $sqlUpdateSliderData= ' UPDATE item SET
						// ite_Name=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\',
						// ite_sku=\''.mysql_real_escape_string_port($countryNameData['itemsku']).'\',
						// ite_Descripton=\''.mysql_real_escape_string_port($countryNameData['itemDesc']).'\',
						// ite_BaseRate=\''.mysql_real_escape_string_port($countryNameData['itemBaseRate']).'\',
						// ite_Rate=\''.mysql_real_escape_string_port($countryNameData['itemRate']).'\',
						// ite_MRP=\''.mysql_real_escape_string_port($countryNameData['itemMRP']).'\'
                        // 	   WHERE ite_Id='.(int)$_GET['id'];
						
                        // $strRes=$dbh->query($sqlUpdateSliderData);	
                        // $intInsertId= (int)$_GET['id'];
                         break;						 
					}
					 if($strRes)
					 {
						  if($strMode == 'edit')
						  {
						   $_SESSION['success_item_msg'] = ' Slider Updated successfully.';
						   
						  }
						  else
						  {
					      $_SESSION['success_item_msg'] = 'Entry saved successfully.';
						  
						  }
						  redirect('manage_item.php');
					  
					 }
			 
					
				}
			}
			return $aryErrors;
		}
	}
}

$class_item = new class_item;

?>