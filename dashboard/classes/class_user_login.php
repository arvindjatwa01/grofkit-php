<?php 

Class class_user_login
{
	
	public function loginuser()
	{
		global $dbh;
		global $class_common;
		$aryErrors=array();
		if(isset($_POST['useremail']) && ''!= $_POST['useremail'] && isset($_POST['userpassword']) && ''!=$_POST['userpassword'] )
	{
		

		$strLoadCondition=' AND us_EmailID=\''.$_POST['useremail'].'\' AND us_Password=\''.$_POST['userpassword'].'\'';
		$rowAdminData= $class_common->loadSingleDataBy($strLoadCondition,'','',mstuser);
		echo $rowAdminData;
		if($rowAdminData['us_Id']>0)
		{
			$_SESSION['ID']=$rowAdminData['us_Id'];
			$_SESSION['username']=$rowAdminData['us_UserName'];
			$_SESSION['password']=$rowAdminData['us_Password'];
			// echo "<script>alert('Hello')</script>";
			// $_SESSION['ADMIN']['fullname']=$rowAdminData['admin_full_name'];
		}
		else
		{
			$aryErrors['error']="Please Enter Correct Credential";
		}
		
	}
	else
	{
		$aryErrors['error']="Please Enter Username and Password";
	}
	return $aryErrors;
	}
	
	public function getCurrentLoginAdminId()
{
  $intAdminID =0;
  if(isset($_SESSION['ID']) && (int)$_SESSION['ID']>0)
  {
	$intAdminID =$_SESSION['ID'];
  
  }

  return $intAdminID;
}


function checkuserLoggedIn()
{
	
	if(self::getCurrentLoginAdminId())
	{
		return true;
	}
	else 
	{ 
      return false;
	 }
}


public function  doadminlogout()
{
	
	
if(isset($_SESSION['ADMIN']))
{
   unset ($_SESSION['ADMIN']);
}
header('location: loginsignup.php');
	
}



public function processAdminRequest($aryAdminData)
{
	
	global $dbh;
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if('' == $aryAdminData)
			{
			   $aryAdminData = $_POST;
			
			}
		
			
			$aryErrors=array();
			  
			if(0<count($aryAdminData))
			{ 
		
                 if(isset($aryAdminData['admin_username']) && '' == $aryAdminData['admin_username'])
			   {
			      $aryErrors['admin_username']='Username is required.';
			   }
			  if(isset($aryAdminData['admin_full_name']) && '' == $aryAdminData['admin_full_name'])
			   {
			      $aryErrors['admin_full_name']='Full name is required.';
			   }
            
				if(0==count($aryErrors))
				{ 
			     
				     $strRes =false;
					 
				     
						 
						   $sqlUpdateAdminData='UPDATE '.TABLE_ADMIN.' SET 
						  admin_username=\''.$aryAdminData['admin_username'].'\',
						  admin_password=\''.$aryAdminData['admin_password'].'\',
						  admin_email=\''.$aryAdminData['admin_email'].'\',
						   
						   admin_address=\''.$aryAdminData['admin_address'].'\',
						  admin_full_name=\''.$aryAdminData['admin_full_name'].'\',
						  admin_phone=\''.$aryAdminData['admin_phone'].'\' WHERE admin_id='.self::getCurrentLoginAdminId();
				
						  $strRes= $dbh->query($sqlUpdateAdminData);
						 
					  
					  
					  if($strRes)
					  {
						  
					      if(isset($_FILES['admin_image']['name']) && ''!=$_FILES['admin_image']['name'])
						  {
						     $strImageName = time() . '-'.$_FILES['admin_image']['name'];
						     $strAdminImagePath = SITE_UPLOAD_PATH.SITE_ADMIN_IMAGE_PATH;
							$file_tmp= $_FILES['admin_image']['tmp_name'];
							 //uploadDocument($_FILES['admin_image']['tmp_name'],$strAdminImagePath,$strImageName);
							 move_uploaded_file($file_tmp,$strAdminImagePath.$strImageName);
							 
							 $sqlAdminImageData =' UPDATE '.TABLE_ADMIN.' SET 	admin_image = \''.$strImageName.'\' WHERE admin_id='.self::getCurrentLoginAdminId();
							 $strRes=$dbh->query($sqlAdminImageData); 
						  }
						  if($strRes)
						  {
						   $_SESSION['success_msg'] = 'Profile Updated successfully.';
						
					     
						  }
						  redirect('myprofile.php');
					  }
			
			
			    }
			
			}
			
		return $aryErrors;
	}
}
	
  
}
$class_user_login = new class_user_login;

?>