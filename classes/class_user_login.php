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
		

		$strLoadCondition=' AND (us_EmailID=\''.$_POST['useremail'].'\' OR us_mobileNo=\''.$_POST['useremail'].'\') AND us_Password=\''.$_POST['userpassword'].'\'';
		
		$rowAdminData= $class_common->loadSingleDataBy($strLoadCondition,'','',TABLE_USER);
		
		if($rowAdminData['us_Id']>0)
		{	
			$appsettingSql = "SELECT appSetting_Action FROM appsetting WHERE appSetting_Id=2";
			$appsettingRes = $dbh->query($appsettingSql);
			$appsettingRow = $appsettingRes->fetch();
			
			$_SESSION['USER']['ID']=$rowAdminData['us_Id'];
			$_SESSION['USER']['username']=$rowAdminData['us_UserName'];
			$_SESSION['USER']['password']=$rowAdminData['us_Password'];
			$_SESSION['USER']['pincode']=$rowAdminData['us_postalCode'];
			$_SESSION['USER']['mobile']=$rowAdminData['us_mobileNo'];
			$_SESSION['USER']['Approved'] = $appsettingRow['appSetting_Action'];
			// header('location: afterlogin.php');
			// redirect('afterlogin.php');
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
  if(isset($_SESSION['USER']['ID']) && (int)$_SESSION['USER']['ID']>0)
  {
	$intAdminID =$_SESSION['USER']['ID'];
  
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
	// print_r($_SESSION['USER']);
	// die();
	
if(isset($_SESSION['USER']))
{
	// echo "Hello";
   unset ($_SESSION['USER']);
}
header('location: loginsignup.php');
	
}

}
$class_user_login = new class_user_login;

?>