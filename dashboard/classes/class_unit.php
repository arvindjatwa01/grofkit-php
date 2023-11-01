<?php 

Class class_unit
{
	function sizeProcessRequest($UnitData,$strMode)
	{
		global $dbh;
		
		if($_SESSION['REQUEST_METHOD']='POST')
		{
			if(''==$UnitData)
			{
				$UnitData=$_POST;
			}
			if(''==$strMode)
			{
				$strMode= $_REQUEST['mode'];
			}
			$aryErrors=array();
			if(0<count($UnitData))
			{
				if(isset($UnitData['unitCode']) && '' == $UnitData['unitCode'])
			    {
			       $aryErrors['unitCode']=' Please Enter Unit Code .';
				   $_SESSION['error_unit_msg'] = "All Fileds are required";
			    }
				  $aryvranchId='';
				if(0==count($aryErrors))
				{
					$strRes=FALSE;
					switch($strMode)
					{
						case 'new':
							
							$unitName = $UnitData['unitCode'];
							try {
								$dbh->query('INSERT INTO unit SET
								un_Code=\''.mysql_real_escape_string_port($UnitData['unitCode']).'\'');
								$_SESSION['success_unit_msg'] = 'Unit '.$unitName.' Added Successfully.';
								redirect('manage_unit.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_unit_msg'] = "Unit ".$unitName ." Already Exist";
									redirect('add_unit.php');
								}
							}
                         	break;	
						 
                        case 'edit':

							$Id = (int)$_GET['id'];
							$EditunitName = $arySizeData['unitCode'];
							try {
								date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
								$Modifydate = date('Y-m-d H:i:s ', time());
								$dbh->query(' UPDATE unit SET
								un_Code=\''.mysql_real_escape_string_port($UnitData['unitCode']).'\'
                        	   	WHERE un_ID='.(int)$_GET['id']);
								$_SESSION['success_unit_msg'] = 'Slider Updated successfully';
								redirect('manage_unit.php');
							} catch (Exception $e) {
								if ($e->getCode() == '23000') {
									$_SESSION['error_unit_msg'] = "Unit $EditunitName already Exists";
									redirect("add_unit.php?id=$Id&mode=$strMode");
								}
							}
							break;						 
					}
					 if($strRes)
					 {
						  if($strMode == 'edit')
						  {
						   $_SESSION['success_unit_msg'] = ' Slider Updated successfully.';
						   
						  }
						  else
						  {
					      $_SESSION['success_unit_msg'] = 'Entry saved successfully.';
						  
						  }
						  redirect('manage_unit.php');
					  
					 }
			 
					
				}
			}
			return $aryErrors;
		}
	}
}

$class_unit = new class_unit;

?>