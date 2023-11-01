<?php //include_once "connection_handle.php";
include_once '../config/config.php';
include_once '../classes/class_user_login.php';
include_once '../classes/Class_common.php';

$aryResponse=array();

if(isset($_POST['useremail']) && isset($_POST['userpassword'])){
	$aryErrors=$class_user_login->loginuser();
	
	if(count($aryErrors)==0){
		$aryResponse['message']='ok';
		$aryResponse['error'][]=$aryErrors;
	
	}else{
		// $aryResponse['message']=$_POST['useremail'];
		$aryResponse['message']='failed';
		$aryResponse['error'][] =$aryErrors;
	}
}else{
	$aryResponse['message']='failed';
	// $aryResponse['message']=$_POST['useremail'];
	$aryResponse['error'][] =array();
}
echo json_encode($aryResponse);
?>