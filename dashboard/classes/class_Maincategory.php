<?php

class class_Maincat
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
				if (isset($arySizeData['MainCatName']) && '' == $arySizeData['MainCatName']) {
					$aryErrors['MainCatName'] = ' Please Enter Category Name .';
					$_SESSION['error_Mcategory_msg'] = "All Fileds are requied";
				}
				$aryvranchId = '';
				if (0 == count($aryErrors)) {
					$strRes = FALSE;
					switch ($strMode) {
						case 'new':
						$MainCateName = $arySizeData['MainCatName'];
						$sql = "SELECT * FROM maincategory WHERE Mcat_Name = '$MainCateName'";
						
						$res  = $dbh->query($sql);
						$resSelect = $res->fetchAll();
						if(count($resSelect)>0){
							$_SESSION['error_Mcategory_msg'] = "Category already Exists";
						}else{
							if(empty($_FILES['MainCatImginput']['name'])){
								$categoryImg = $_POST['MainCatImg'];
							}else{
								$categoryImgName = $_FILES['MainCatImginput']['name'];
								$strCategoryImagePath = SITE_UPLOAD_PATH . SITE_ITEM_IMAGE_PATH;
								$categoryImg = SITE_URL.SITE_UPLOAD.SITE_ITEM_IMAGE_PATH.$categoryImgName;
								
								$categoryImgPath = $_FILES['MainCatImginput']['tmp_name'];
                                move_uploaded_file($categoryImgPath, $strCategoryImagePath . $categoryImgName);
							}
						$sqlInsertSliderData = ' INSERT INTO maincategory SET
						Mcat_Name=\'' . mysql_real_escape_string_port($arySizeData['MainCatName']) . '\',
						Mcat_Image=\''.mysql_real_escape_string_port($categoryImg).'\'';
                        
							$strRes = $dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
							$intInsertId = $dbh->lastInsertId();
						}
							break;

						case 'edit':

							$Id = (int)$_GET['id'];
							$EditMainCategory = $arySizeData['MainCatName'];
							if(empty($_FILES['MainCatImginput']['name'])){
								$categoryImg = $_POST['MainCatImg'];
							}else{
								$categoryImgName = $_FILES['MainCatImginput']['name'];
								$strCategoryImagePath = SITE_UPLOAD_PATH . SITE_ITEM_IMAGE_PATH;
								$categoryImg = SITE_URL.SITE_UPLOAD.SITE_ITEM_IMAGE_PATH.$categoryImgName;
								// unlink($strCategoryImagePath.$_POST['MainCatImg']);
								$categoryImgPath = $_FILES['MainCatImginput']['tmp_name'];
                                move_uploaded_file($categoryImgPath, $strCategoryImagePath . $categoryImgName);
							}
							try {
								date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
								$Modifydate = date('Y-m-d H:i:s ', time());
								$dbh->query(' UPDATE maincategory SET
								Mcat_Name=\'' . mysql_real_escape_string_port($arySizeData['MainCatName']) . '\',
								Mcat_modifydate=\''.$Modifydate.'\'
								  WHERE Mcat_Id=' . (int)$_GET['id']);
								$_SESSION['success_Mcategory_msg'] = 'Slider Updated successfully';
								redirect('manage_Maincategory.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_Mcategory_msg'] = "Category $EditMainCategory already Exists";
									redirect("add_Maincategory.php?id=$Id&mode=$strMode");
								}
							}

						// 	date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
						// 	$Modifydate = date('Y-m-d H:i:s ', time());
						// 	$sqlUpdateSliderData = ' UPDATE maincategory SET
						// 	Mcat_Name=\'' . mysql_real_escape_string_port($arySizeData['MainCatName']) . '\',
						// 	Mcat_modifydate=\''.$Modifydate.'\'
                       	//    WHERE Mcat_Id=' . (int)$_GET['id'];

						// 	$strRes = $dbh->query($sqlUpdateSliderData);
						// 	$intInsertId = (int)$_GET['id'];
							break;
					}
					if ($strRes) {
						if ($strMode == 'edit') {
							$_SESSION['success_Mcategory_msg'] = ' Slider Updated successfully.';
						} else {
							$_SESSION['success_Mcategory_msg'] = 'Entry saved successfully.';
						}
						redirect('manage_Maincategory.php');
					}
				}
			}
			return $aryErrors;
		}
	}
}

$class_Maincat = new class_Maincat;