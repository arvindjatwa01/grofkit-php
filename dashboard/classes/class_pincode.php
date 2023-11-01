<?php

class class_pincode
{
	function catProcessRequest($arySizeData, $strMode)
	{
		global $dbh;

		if ($_SESSION['REQUEST_METHOD'] = 'POST') {
			if ('' == $arySizeData) {
				$arySizeData = $_POST;
				$countryID = $_POST;
                $stateID = $_POST;
			}
			if ('' == $strMode) {
				$strMode = $_REQUEST['mode'];
			}
			$aryErrors = array();
			if (0 < count($arySizeData)) {
				if (isset($arySizeData['PinCode']) && '' == $arySizeData['PinCode'] OR isset($arySizeData['PinName']) && '' == $arySizeData['PinName'] OR isset($arySizeData['deliveryCost']) && '' == $arySizeData['deliveryCost'] OR isset($arySizeData['cityName']) && '0' == $arySizeData['cityName'] OR isset($arySizeData['stateName']) && '0' == $arySizeData['stateName'] OR isset($arySizeData['country']) && '0' == $arySizeData['country']) {
					$aryErrors['PinCode'] = ' Please Enter Pin Code Number .';
					$_SESSION['error_pincode_msg'] = "All fileds are required";
				}
				$aryvranchId = '';
				if (0 == count($aryErrors)) {
					$strRes = FALSE;
					switch ($strMode) {
						case 'new':
							if($stateID['minCartValue'] == ''){
								$MinCostValue = "500";
							}else{
								$MinCostValue = mysql_real_escape_string_port($stateID['minCartValue']);
							}
							try {
								$dbh->query(' INSERT INTO pincode_onavailable SET
								Pin_Name=\'' . mysql_real_escape_string_port($arySizeData['PinName']) . '\',
								Pin_PinCode=\'' . mysql_real_escape_string_port($stateID['PinCode']) . '\',
								Pin_CountryId=\'' . mysql_real_escape_string_port($stateID['country']) . '\',
								Pin_StateId=\'' . mysql_real_escape_string_port($stateID['stateName']) . '\',
								Pin_CityId=\'' . mysql_real_escape_string_port($stateID['cityName']) . '\',
								Pin_delivaryCost=\'' . mysql_real_escape_string_port($stateID['deliveryCost']) . '\',
								pin_MinCartValue=\'' . $MinCostValue . '\'');
								$_SESSION['success_pincode_msg'] = 'Record added successfully';
								redirect('manage_pincode.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_pincode_msg'] = "Pincode already Exists";
									redirect("add_pincode.php");
								}
							}

						// $pincode = $arySizeData['PinCode'];
						// $sql = "SELECT * FROM pincode_onavailable WHERE Pin_PinCode = '$pincode'";
						
						// $res  = $dbh->query($sql);
						// $resSelect = $res->fetchAll();
						// if(count($resSelect)>0){
						// 	$_SESSION['error_pincode_msg'] = "Pincode already Exists";
						// }else{
						// $sqlInsertSliderData = ' INSERT INTO pincode_onavailable SET
						// Pin_Name=\'' . mysql_real_escape_string_port($arySizeData['PinName']) . '\',
                        // Pin_PinCode=\'' . mysql_real_escape_string_port($stateID['PinCode']) . '\',
                        // Pin_CountryId=\'' . mysql_real_escape_string_port($stateID['country']) . '\',
                        // Pin_StateId=\'' . mysql_real_escape_string_port($stateID['stateName']) . '\',
                        // Pin_CityId=\'' . mysql_real_escape_string_port($stateID['cityName']) . '\',
                        // Pin_delivaryCost=\'' . mysql_real_escape_string_port($stateID['deliveryCost']) . '\'';
                        
						// 	$strRes = $dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
						// 	$intInsertId = $dbh->lastInsertId();
						// }
							break;

						case 'edit':
							if($arySizeData['minCartValue'] == ''){
								$MinCostValue = "500";
							}else{
								$MinCostValue = mysql_real_escape_string_port($arySizeData['minCartValue']);
							}
							$Id = (int)$_GET['id'];
							$EditPinCode = $arySizeData['PinCode'];
							try {
								date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
								$Modifydate = date('Y-m-d H:i:s ', time());
								$dbh->query(' UPDATE pincode_onavailable SET
								Pin_Name=\'' . mysql_real_escape_string_port($arySizeData['PinName']) . '\',
								Pin_PinCode=\'' . mysql_real_escape_string_port($stateID['PinCode']) . '\',
								Pin_CountryId=\'' . mysql_real_escape_string_port($stateID['country']) . '\',
								Pin_StateId=\'' . mysql_real_escape_string_port($stateID['stateName']) . '\',
								Pin_CityId=\'' . mysql_real_escape_string_port($countryID['cityName']) . '\',
								Pin_delivaryCost=\'' . mysql_real_escape_string_port($countryID['deliveryCost']) . '\',
								pin_MinCartValue=\'' . $MinCostValue . '\',
								Pin_modifydate=\''.$Modifydate.'\'
								WHERE Pin_Id=' . (int)$_GET['id']);
								$_SESSION['success_pincode_msg'] = 'Slider Updated successfully';
								redirect('manage_pincode.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_pincode_msg'] = "Pincode $EditPinCode already Exists";
									redirect("add_pincode.php?id=$Id&mode=$strMode");
								}
							}

							// $EditPinCode = $arySizeData['PinCode'];
							// echo $Editsql = "SELECT * FROM pincode_onavailable WHERE Pin_Id = '$EditPinCode'";
							// $Editres  = $dbh->query($Editsql);
							// $EditresSelect = $Editres->fetchAll();
							// if(count($EditresSelect) > 1){
							// 	$Id = (int)$_GET['id'];
							// 	$_SESSION['error_pincode_msg'] = "Pincode already exists";
							// 	redirect("add_pincode.php?id=$Id&mode=$strMode");
							// 	break;
							// }else{
							// date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
							// $Modifydate = date('Y-m-d H:i:s ', time());
							// $sqlUpdateSliderData = ' UPDATE pincode_onavailable SET
							// Pin_Name=\'' . mysql_real_escape_string_port($arySizeData['PinName']) . '\',
							// Pin_PinCode=\'' . mysql_real_escape_string_port($stateID['PinCode']) . '\',
							// Pin_CityId=\'' . mysql_real_escape_string_port($countryID['cityName']) . '\',
							// Pin_delivaryCost=\'' . mysql_real_escape_string_port($countryID['deliveryCost']) . '\',
							// Pin_modifydate=\''.$Modifydate.'\'
                       	   	// WHERE Pin_Id=' . (int)$_GET['id'];

							// $strRes = $dbh->query($sqlUpdateSliderData);
							// $intInsertId = (int)$_GET['id'];
							// }
							break;
					}
					if ($strRes) {
						if ($strMode == 'edit') {
							$_SESSION['success_pincode_msg'] = ' Slider Updated successfully.';
						} else {
							$_SESSION['success_pincode_msg'] = 'Entry saved successfully.';
						}
						redirect('manage_pincode.php');
					}
				}
			}
			return $aryErrors;
		}
	}
}

$class_pincode = new class_pincode;