<?php

class class_city
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
				if (isset($arySizeData['cityName']) && '' == $arySizeData['cityName'] OR isset($arySizeData['stateName']) && '0' == $arySizeData['stateName'] OR isset($arySizeData['country']) && '0' == $arySizeData['country']) {
					$aryErrors['cityName'] = ' Please Enter City Name .';
					$_SESSION['error_city_msg'] = "all fileds are required";
				}
				$aryvranchId = '';
				if (0 == count($aryErrors)) {
					$strRes = FALSE;
					switch ($strMode) {
						case 'new':

						$cityName = $arySizeData['cityName'];
						$stateName = $stateID['stateName'];
						$sql = "SELECT * FROM city WHERE ct_Name = '$cityName' AND ct_StateId='$stateName'";
						$res  = $dbh->query($sql);

						$resSelect = $res->fetchAll();

						
						if(count($resSelect)>0 OR $stateID['stateName'] == '0' OR $countryID['country'] == '0'){
							$_SESSION['error_city_msg'] = "City Name Already Exists";
						}else{
						
						$sqlInsertSliderData = ' INSERT INTO city SET
						ct_Name=\'' . mysql_real_escape_string_port($arySizeData['cityName']) . '\',
                        ct_StateId=\'' . mysql_real_escape_string_port($stateID['stateName']) . '\',
						ct_CountryID=\'' . mysql_real_escape_string_port($countryID['country']) . '\'';
                        
							$strRes = $dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
							$intInsertId = $dbh->lastInsertId();
						}
							break;

						case 'edit':

							$Id = (int)$_GET['id'];
							$EditCityName = $arySizeData['cityName'];
							try {
								date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
								$Modifydate = date('Y-m-d H:i:s ', time());
								$dbh->query(' UPDATE city SET
								ct_Name=\'' . mysql_real_escape_string_port($arySizeData['cityName']) . '\',
								ct_StateId=\'' . mysql_real_escape_string_port($stateID['stateName']) . '\',
								ct_CountryID=\'' . mysql_real_escape_string_port($countryID['country']) . '\',
								ct_modifydate=\''.$Modifydate.'\'
								WHERE ct_Id=' . (int)$_GET['id']);
								$_SESSION['success_city_msg'] = 'Slider Updated successfully';
								redirect('manage_city.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_city_msg'] = "City $EditCityName already Exists";
									redirect("add_city.php?id=$Id&mode=$strMode");
								}
							}

						// 	date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
						// 	$Modifydate = date('Y-m-d H:i:s ', time());
						// 	$sqlUpdateSliderData = ' UPDATE city SET
						// ct_Name=\'' . mysql_real_escape_string_port($arySizeData['cityName']) . '\',
						// ct_StateId=\'' . mysql_real_escape_string_port($stateID['stateName']) . '\',
						// ct_CountryID=\'' . mysql_real_escape_string_port($countryID['country']) . '\',
						// ct_modifydate=\''.$Modifydate.'\'
                       	//    WHERE ct_Id=' . (int)$_GET['id'];

						// 	$strRes = $dbh->query($sqlUpdateSliderData);
						// 	$intInsertId = (int)$_GET['id'];
							break;
					}
					if ($strRes) {
						if ($strMode == 'edit') {
							$_SESSION['success_city_msg'] = ' Slider Updated successfully.';
						} else {
							$_SESSION['success_city_msg'] = 'Entry saved successfully.';
						}
						redirect('manage_city.php');
					}
				}
			}
			return $aryErrors;
		}
	}
}

$class_city = new class_city;