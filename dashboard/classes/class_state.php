<?php

class class_state
{
	function catProcessRequest($arySizeData, $strMode)
	{
		global $dbh;

		if ($_SESSION['REQUEST_METHOD'] = 'POST') {
			if ('' == $arySizeData) {
				$arySizeData = $_POST;
				$countryID = $_POST;
			}
			if ('' == $strMode) {
				$strMode = $_REQUEST['mode'];
			}
			$aryErrors = array();
			if (0 < count($arySizeData)) {
				if (isset($arySizeData['stateName']) && '' == $arySizeData['stateName'] OR isset($arySizeData['country']) && '0' == $arySizeData['country']) {
					$aryErrors['stateName'] = ' Please select Country or Enter state Name .';
					$_SESSION['error_state_msg'] = "all fileds are required";
				}
				$aryvranchId = '';
				if (0 == count($aryErrors)) {
					$strRes = FALSE;
					switch ($strMode) {
						case 'new':
							$stateName = $arySizeData['stateName'];
							$country = $countryID['country'];
							$sql = "SELECT * FROM state WHERE st_Name = '$stateName' AND st_CountryID = '$country'";
							$res  = $dbh->query($sql);
							$resSelect = $res->fetchAll();
							if(count($resSelect)> 0 ){
								$_SESSION['error_state_msg'] = "State already exists";
								
							}else{
							$sqlInsertSliderData = ' INSERT INTO state SET
							st_Name=\'' . mysql_real_escape_string_port($arySizeData['stateName']) . '\',
							st_CountryID=\'' . mysql_real_escape_string_port($countryID['country']) . '\'';
							$strRes = $dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
							$intInsertId = $dbh->lastInsertId();
							}
							break;

						case 'edit':

							
							$Id = (int)$_GET['id'];
							$EditStateName = $arySizeData['stateName'];
							try {
								date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
								$Modifydate = date('Y-m-d H:i:s ', time());
								$dbh->query(' UPDATE state SET
								st_Name=\'' . mysql_real_escape_string_port($arySizeData['stateName']) . '\',
								st_CountryID=\'' . mysql_real_escape_string_port($countryID['country']) . '\',
								st_modifydate=\''.$Modifydate.'\'
								WHERE st_Id=' . (int)$_GET['id']);
								$_SESSION['success_state_msg'] = 'Slider Updated successfully';
								redirect('manage_state.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_state_msg'] = "State $EditStateName already Exists";
									redirect("add_state.php?id=$Id&mode=$strMode");
								}
							}

							// $EditstateName = $arySizeData['stateName'];
							// $Editsql = "SELECT * FROM state WHERE st_Name = '$EditstateName'";
							// $Editres  = $dbh->query($Editsql);
							// $EditresSelect = $Editres->fetchAll();
							// if(count($EditresSelect) > 1 OR $countryID['country'] == '0'){
							// 	$_SESSION['error_state_msg'] = "State name already exists";
								
							// }else{
							// date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
							// $Modifydate = date('Y-m-d H:i:s ', time());
							// $sqlUpdateSliderData = ' UPDATE state SET
							// st_Name=\'' . mysql_real_escape_string_port($arySizeData['stateName']) . '\',
							// st_CountryID=\'' . mysql_real_escape_string_port($countryID['country']) . '\',
							// st_modifydate=\''.$Modifydate.'\'
                       	   	// WHERE st_Id=' . (int)$_GET['id'];

							// $strRes = $dbh->query($sqlUpdateSliderData);
							// $intInsertId = (int)$_GET['id'];
							// }
							break;
					}
					if ($strRes) {
						if ($strMode == 'edit') {
							$_SESSION['success_state_msg'] = ' Slider Updated successfully.';
						} else {
							$_SESSION['success_state_msg'] = 'Entry saved successfully.';
						}
						redirect('manage_state.php');
					}
				}
			}
			return $aryErrors;
		}
	}
}

$class_state = new class_state;