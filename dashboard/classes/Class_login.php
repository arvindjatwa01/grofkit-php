<?php 

Class class_login
{
	
	public function loginAdmin()
	{
		global $dbh;
global $class_common;
	$aryErrors=array();
	if(isset($_POST['username']) && ''!= $_POST['username'] && isset($_POST['password']) && ''!=$_POST['password'] )
	{
		$strLoadCondition=' AND admin_username=\''.$_POST['username'].'\' AND admin_password=\''.$_POST['password'].'\'';
		$rowAdminData= $class_common->loadSingleDataBy($strLoadCondition,'','',TABLE_ADMIN);
		
		if($rowAdminData['admin_id']>0)
		{
			$_SESSION['ADMIN']['ID']=$rowAdminData['admin_id'];
			$_SESSION['ADMIN']['username']=$rowAdminData['admin_username'];
			$_SESSION['ADMIN']['password']=$rowAdminData['admin_password'];
			$_SESSION['ADMIN']['fullname']=$rowAdminData['admin_full_name'];
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
  if(isset($_SESSION['ADMIN']['ID']) && (int)$_SESSION['ADMIN']['ID']>0)
  {
	$intAdminID =$_SESSION['ADMIN']['ID'];
  
  }

  return $intAdminID;
}


function checkAdminLoggedIn()
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
header('location:login.php');
	
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




$class_login = new class_login;

?>