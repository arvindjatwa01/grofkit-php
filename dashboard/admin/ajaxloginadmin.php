<?php include_once "connection_handle.php";
// include_once '../classes/class_common.php';
// include_once '../config/config.php';
// include_once 'class_user_login.php';


$aryResponse=array();

if(isset($_POST['username']) && isset($_POST['password']))

{
	$aryErrors=$class_login->loginAdmin();
	
if(count($aryErrors)==0)
{
	$aryResponse['message']='ok';
	$aryResponse['error'][]=$aryErrors;
	
}else
{
	$aryResponse['message']='failed';
	$aryResponse['error'][] =$aryErrors;
}
}else{
	$aryResponse['message']='failed';
	$aryResponse['error'][] =array();
}
echo json_encode($aryResponse);
?>