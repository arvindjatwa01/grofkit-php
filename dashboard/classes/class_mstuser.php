<?php

class class_mstuser
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
				if (isset($arySizeData['PinCode']) && '' == $arySizeData['PinCode']) {
					$aryErrors['PinCode'] = ' Please Enter Pin Code Number .';
				}
				$aryvranchId = '';
				if (0 == count($aryErrors)) {
					$strRes = FALSE;
					switch ($strMode) {
						case 'new':
							$emailId = $arySizeData['EmailId'];
							$mobileNo = $stateID['mobileNo'];
						$sql = "SELECT * FROM mstuser WHERE us_EmailID = '$emailId' OR us_mobileNo = '$mobileNo'";
						
						$res  = $dbh->query($sql);
						$resSelect = $res->fetchAll();
						if(count($resSelect)>0){
							$_SESSION['success_cat_image'] = "Email Or Mobile number already Exists";
						}else{

						$sqlInsertSliderData = ' INSERT INTO mstuser SET
						us_UserName=\'' . mysql_real_escape_string_port($arySizeData['userName']) . '\',
                        us_EmailID=\'' . mysql_real_escape_string_port($stateID['EmailId']) . '\',
                        us_mobileNo=\'' . mysql_real_escape_string_port($stateID['mobileNo']) . '\',
                        us_Password=\'' . mysql_real_escape_string_port($stateID['password']) . '\',
                        us_gender=\'' . mysql_real_escape_string_port($stateID['gender']) . '\',
                        us_dob=\'' . mysql_real_escape_string_port($stateID['userdob']) . '\'';
                        
							$strRes = $dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
							$intInsertId = $dbh->lastInsertId();
						}
							break;

						case 'edit':
							date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
							$Modifydate = date('Y-m-d H:i:s ', time());
							$sqlUpdateSliderData = ' UPDATE mstuser SET
						us_UserName=\'' . mysql_real_escape_string_port($arySizeData['userName']) . '\',
						us_EmailID=\'' . mysql_real_escape_string_port($stateID['EmailId']) . '\',
						us_mobileNo=\'' . mysql_real_escape_string_port($countryID['mobileNo']) . '\',
						us_Password=\'' . mysql_real_escape_string_port($countryID['password']) . '\',
						us_gender=\'' . mysql_real_escape_string_port($countryID['gender']) . '\',
						us_dob=\'' . mysql_real_escape_string_port($countryID['userdob']) . '\',
						us_modifydate=\''.$Modifydate.'\'
                       	   WHERE us_Id=' . (int)$_GET['id'];

							$strRes = $dbh->query($sqlUpdateSliderData);
							$intInsertId = (int)$_GET['id'];
							break;
					}
					if ($strRes) {
						if ($strMode == 'edit') {
							$_SESSION['success_cat_image'] = ' Slider Updated successfully.';
						} else {
							$_SESSION['success_cat_image'] = 'Entry saved successfully.';
						}
						redirect('manage_mstuser.php');
					}
				}
			}
			return $aryErrors;
		}
	}
}

$class_mstuser = new class_mstuser;