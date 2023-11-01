<?php

class class_cat
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
				if (isset($arySizeData['catName']) && '' == $arySizeData['catName']) {
					$aryErrors['catName'] = ' Please Enter Category Name .';
					$_SESSION['error_category_msg'] = "All Fileds are required";
				}
				$aryvranchId = '';
				if (0 == count($aryErrors)) {
					$strRes = FALSE;
					switch ($strMode) {
						case 'new':
						$CateName = $arySizeData['catName'];
						$sql = "SELECT * FROM category WHERE cat_Name = '$CateName'";
						
						$res  = $dbh->query($sql);
						$resSelect = $res->fetchAll();
						if(count($resSelect)>0){
							$_SESSION['error_category_msg'] = "Category already Exists";
						}else{
						    if(empty($_FILES['MainCatImginput']['name'])){
								$categoryImgName = $_POST['MainCatImg'];
							}else{
								$categoryImgName = $_FILES['MainCatImginput']['name'];
								$strCategoryImagePath = SITE_UPLOAD_PATH . SITE_CATEGORY_ICON_PATH;
								$categoryImg = SITE_URL.SITE_UPLOAD.SITE_ITEM_IMAGE_PATH.$categoryImgName;
								// unlink($strCategoryImagePath.$_POST['MainCatImg']);
								$categoryImgPath = $_FILES['MainCatImginput']['tmp_name'];
								// echo $categoryImgPath.$strCategoryImagePath . $categoryImgName;
								// die();
                                move_uploaded_file($categoryImgPath, $strCategoryImagePath . $categoryImgName);
							}
						$sqlInsertSliderData = ' INSERT INTO category SET
						cat_Name=\'' . mysql_real_escape_string_port($arySizeData['catName']) . '\',
						cat_Image=\''.mysql_real_escape_string_port($categoryImgName).'\',
						cat_UnderCatID=\'' . mysql_real_escape_string_port($arySizeData['Maincategory']) . '\'';
                        
							$strRes = $dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
							$intInsertId = $dbh->lastInsertId();
						}
							break;

						case 'edit':

							$Id = (int)$_GET['id'];
							$EditCategory = $arySizeData['catName'];
							if(empty($_FILES['MainCatImginput']['name'])){
								$categoryImgName = $_POST['MainCatImg'];
							}else{
								$categoryImgName = $_FILES['MainCatImginput']['name'];
								$strCategoryImagePath = SITE_UPLOAD_PATH . SITE_CATEGORY_ICON_PATH;
								$categoryImg = SITE_URL.SITE_UPLOAD.SITE_CATEGORY_ICON_PATH.$categoryImgName;
								// unlink($strCategoryImagePath.$_POST['MainCatImg']);
								$categoryImgPath = $_FILES['MainCatImginput']['tmp_name'];
                                move_uploaded_file($categoryImgPath, $strCategoryImagePath . $categoryImgName);
							}
							try {
								date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
								$Modifydate = date('Y-m-d H:i:s ', time());
								$dbh->query(' UPDATE category SET
								cat_Name=\'' . mysql_real_escape_string_port($arySizeData['catName']) . '\',
								cat_UnderCatID=\'' . mysql_real_escape_string_port($arySizeData['Maincategory']) . '\',
								cat_modifydate=\''.$Modifydate.'\',
								cat_Image=\''.mysql_real_escape_string_port($categoryImgName).'\'
								  WHERE cat_Id=' . (int)$_GET['id']);
								$_SESSION['success_category_msg'] = 'Slider Updated successfully';
								redirect('manage_category.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_category_msg'] = "Category $EditCategory already Exists";
									redirect("add_category.php?id=$Id&mode=$strMode");
								}
							}

						// 	date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
						// 	$Modifydate = date('Y-m-d H:i:s ', time());
						// 	$sqlUpdateSliderData = ' UPDATE category SET
						// 	cat_Name=\'' . mysql_real_escape_string_port($arySizeData['catName']) . '\',
						// 	cat_UnderCatID=\'' . mysql_real_escape_string_port($arySizeData['Maincategory']) . '\',
						// 	cat_modifydate=\''.$Modifydate.'\'
                       	//    WHERE cat_Id=' . (int)$_GET['id'];

						// 	$strRes = $dbh->query($sqlUpdateSliderData);
						// 	$intInsertId = (int)$_GET['id'];
							break;
					}
					if ($strRes) {
						if ($strMode == 'edit') {
							$_SESSION['success_category_msg'] = ' Slider Updated successfully.';
						} else {
							$_SESSION['success_category_msg'] = 'Entry saved successfully.';
						}
						redirect('manage_category.php');
					}
				}
			}
			return $aryErrors;
		}
	}
}

$class_cat = new class_cat;