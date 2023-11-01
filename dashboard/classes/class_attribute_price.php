<?php 

Class class_attribute_price
{
	function sizeProcessRequest($attributePriceData,$strMode)
	{
		global $dbh;
		
		if($_SESSION['REQUEST_METHOD']='POST')
		{
			if(''==$attributePriceData)
			{
				$attributePriceData=$_POST;
			}
			if(''==$strMode)
			{
				$strMode= $_REQUEST['mode'];
			}
			$aryErrors=array();
			if(0<count($attributePriceData))
			{
				if(isset($attributePriceData['attprice']) && '' == $attributePriceData['attprice'])
			    {
                    $_SESSION['error_unit_msg'] = " Please Enter Attribute Price.";
			        $aryErrors['attValue']=' Please Enter Attribute Price.';
			    }
				// if(isset($attributePriceData['cost']) && '' == $attributePriceData['cost'])
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
							$itemTableSql = $dbh->query("SELECT ite_MRP FROM item WHERE ite_Id='".$attributePriceData['attItemId']."'");
							$itemTableRes=$itemTableSql->fetch();
							if($attributePriceData['attprice'] >= $itemTableRes['ite_MRP']){
								$_SESSION['error_unit_msg'] = "Price Should be less than or equal to the item MRP ₹".$itemTableRes['ite_MRP'];
								redirect('add_attribute_price.php?id='.$attributePriceData['attItemId']);
							}

							if($attributePriceData['attpriceId1'] == 0){
								$attvalues = $attributePriceData['attName'];
								if (($key = array_search("0", $attvalues)) !== false) {
									unset($attvalues[$key]);
								}
								if(count($attvalues)>0){
									sort($attvalues);
									$sortedAttValues = $attvalues;
									try {
									$dbh->query(' INSERT INTO attributeprice SET
									attPrice_itemId =\''.mysql_real_escape_string_port($attributePriceData['attItemId']).'\',
									attPrice_attvaluesId  =\''.mysql_real_escape_string_port(implode(',',$sortedAttValues)).'\',
									attPrice_Price=\''.mysql_real_escape_string_port($attributePriceData['attprice']).'\'');
										$_SESSION['success_unit_msg'] = 'Added Successfully.';
										redirect('add_attribute_price.php?id='.$attributePriceData['attItemId']);
										} catch (Exception $e) {
											if ($e->getCode() == '23000') {
												$_SESSION['error_unit_msg'] = "Price Set Already for this Attribute Values";
												redirect('add_attribute_price.php?id='.$attributePriceData['attItemId']);
											}
										}
									
								}else{
									$_SESSION['error_unit_msg'] = "Please select at least One Attribute Value";
									redirect('add_attribute_price.php?id='.$attributePriceData['attItemId']);
								}
							}else{
								$attvalues = $attributePriceData['attName'];
								if (($key = array_search("0", $attvalues)) !== false) {
									unset($attvalues[$key]);
								}
								if(count($attvalues)>0){
									sort($attvalues);
									$sortedAttValues = $attvalues;
									try {
										$dbh->query(' UPDATE attributeprice SET
										attPrice_itemId =\''.mysql_real_escape_string_port($attributePriceData['attItemId']).'\',
										attPrice_attvaluesId  =\''.mysql_real_escape_string_port(implode(',',$sortedAttValues)).'\',
										attPrice_Price=\''.mysql_real_escape_string_port($attributePriceData['attprice']).'\' WHERE attPrice_Id='.(int)$attributePriceData['attpriceId1']);
										$_SESSION['success_unit_msg'] = ' Slider Updated successfully.';
										redirect('add_attribute_price.php?id='.$attributePriceData['attItemId']);
									} catch (Exception $e) {
										if ($e->getCode() == '23000') {
											$_SESSION['error_unit_msg'] = "Price Set Already for this Attribute Values ";
											redirect('add_attribute_price.php?id='.$attributePriceData['attItemId']);
										}
									}
									
								}else{
									$_SESSION['error_unit_msg'] = "Please select at least One Attribute Value";
									redirect('add_attribute_price.php?id='.$attributePriceData['attItemId']);
								}
							}
                        break;	
						 
                        case 'edit':
                            $attvalues = $attributePriceData['attName'];
                            if (($key = array_search("0", $attvalues)) !== false) {
                                unset($attvalues[$key]);
                            }
                            if(count($attvalues)>0){
                                sort($attvalues);
                                $sortedAttValues = $attvalues;
                                try {
                                $dbh->query(' UPDATE attributeprice SET
                                attPrice_itemId =\''.mysql_real_escape_string_port($attributePriceData['attItemId']).'\',
                                attPrice_attvaluesId  =\''.mysql_real_escape_string_port(implode(',',$sortedAttValues)).'\',
                                attPrice_Price=\''.mysql_real_escape_string_port($attributePriceData['attprice']).'\' WHERE attPrice_Id='.(int)$_GET['attpriceId']);
                                	$_SESSION['success_unit_msg'] = ' Slider Updated successfully.';
                                	redirect('add_attribute_price.php?id='.$attributePriceData['attItemId']);
                                	} catch (Exception $e) {
                                		if ($e->getCode() == '23000') {
                                			$_SESSION['error_unit_msg'] = "Price Set Already for this Attribute Values ";
                                			redirect('add_attribute_price.php?id='.$attributePriceData['attItemId']);
                                		}
                                	}
                                
                            }else{
                                $_SESSION['error_unit_msg'] = "Please select at least One Attribute Value";
                                redirect('add_attribute_price.php?id='.$attributePriceData['attItemId']);
                            }
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
						//   redirect('manage_attdetail.php');
					  
					 }
			 
					
				}
			}
			return $aryErrors;
		}
	}
}

$class_attribute_price = new class_attribute_price;

?>