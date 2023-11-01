<?php 

Class class_itemImg
{
	function sizeProcessRequest($countryNameData,$strMode)
	{
		global $dbh;
		
		if($_SESSION['REQUEST_METHOD']='POST')
		{
			if(''==$countryNameData)
			{
				$countryNameData=$_POST;
				$itemImageData = $_FILES;
			}
			if(''==$strMode)
			{
				$strMode= $_REQUEST['mode'];
			}
			$aryErrors=array();
			if(0<count($countryNameData))
			{
				if(isset($countryNameData['itemName']) && '' == $countryNameData['itemName'])
			    {
			       $aryErrors['itemName']=' Please Enter Product Tax Name .';
			    }
				  $aryvranchId='';
				if(0==count($aryErrors))
				{
					$strRes=FALSE;
					switch($strMode)
					{
						case 'new':
							if(empty($_FILES['itemImg']['name'])){
								$aryErrors['itemName']=' Please Enter Product Tax Name .';
							}else{

						
							$portfolioImg = array();
							foreach($_FILES['itemImg']['name'] as $key=>$val){
								$stritemImageName = uniqid() . '-' . $_FILES['itemImg']['name'][$key];
								$strPostImagePath = SITE_UPLOAD_PATH . SITE_ITEM_IMAGE_PATH;
								$itemImagePath = SITE_URL.SITE_UPLOAD.SITE_ITEM_IMAGE_PATH.$stritemImageName;
								

								$strSourcePath = $_FILES['itemImg']['tmp_name'][$key];
								$image_info = getimagesize($strSourcePath);
								$image_width = $image_info[0];
								$image_height = $image_info[1];
								if($image_width != 200 AND $image_height != 200){
									$_SESSION['error_size_image'] = 'Image Size should be 200x200 in pixels';
								}else{

								
						
								if(move_uploaded_file($strSourcePath, $strPostImagePath . $stritemImageName)){
								$portfolioImg[] = "$stritemImageName";
												
								$insertQrySplit[] = "('$itemImagePath')";
								}
								else {
								$errors[] = "Something went wrong";
								}
								$_SESSION['success_size_image'] = 'Entry saved successfully.';
							}
							}
							for($i=0;$i<=count($portfolioImg)-1;$i++){
							
								$sqlInsertItemImg= ' INSERT INTO itemimage SET
								itimg_itemID=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\',
								itimg_path=\''.mysql_real_escape_string_port($portfolioImg[$i]).'\''; 
								$strItemImgRes=$dbh->query($sqlInsertItemImg);	//print_r($sqlInsertSliderData); die();
							   
							 }
							
						}
						
						redirect('add_ItemImges.php?id='.$countryNameData['itemName']);
                         break;	
						 
                        case 'edit':
                            if(empty($_FILES['itemImg']['name'])){
                                $itemUpdateImg = $_POST['oldItemImg'];
                            }else{
                                
                                $stritemImageName = uniqid() . '-' . $_FILES['itemImg']['name'];
                       
                                $strPostImagePath = SITE_UPLOAD_PATH . SITE_ITEM_IMAGE_PATH;
                                
                                unlink($strPostImagePath.substr(strrchr($_POST['oldItemImg'], '/'), 1));
                                $itemUpdateImg = SITE_URL.SITE_UPLOAD.SITE_ITEM_IMAGE_PATH.$stritemImageName;
                                // $itemImagePath;
                                $strSourcePath = $_FILES['itemImg']['tmp_name'];
                                move_uploaded_file($strSourcePath, $strPostImagePath . $stritemImageName);
                            }

						$sqlUpdateSliderData= ' UPDATE itemimage SET
						itimg_itemID=\''.mysql_real_escape_string_port($countryNameData['itemName']).'\',
						itimg_path=\''.mysql_real_escape_string_port($itemUpdateImg).'\'
                        	   WHERE itImg_Id ='.(int)$_GET['id'];
						
                        $strRes=$dbh->query($sqlUpdateSliderData);	
                        $intInsertId= (int)$_GET['id'];
						// }
                         break;						 
					}
					 if($strRes)
					 {
						  if($strMode == 'edit')
						  {
						   $_SESSION['success_size_image'] = ' Slider Updated successfully.';
						   
						  }
						  else
						  {
					      $_SESSION['success_size_image'] = 'Entry saved successfully.';
						  
						  }
						  redirect('manage_itemImg.php');
					  
					 }
			 
					
				}
			}
			return $aryErrors;
		}
	}
}

$class_itemImg = new class_itemImg;

?>