<?php 
 include_once '../admin/connection_handle.php';
if(isset($_POST["action"]))  
{ 
	if($_POST["action"] == "Load")  
	{ 
		$strLoadConditions = ' ORDER BY Prot_Id DESC ';
        $strFileds = "product.*, producttax.*";
        $strJoinCondition = " LEFT JOIN product ON producttax.Prot_ProdID = product.prod_Id";
		$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, $strJoinCondition, 0, '', 'producttax');
			  
		if (count($resSelectCouponList) > 0) {
			$count = 0;
			foreach ($resSelectCouponList as $rowSize) {
				$count++;
				// echo $count;
				echo "
				<tr class='clsparentinformation'>
				<td style='text-align:center;'>$count</td>
				<td style='text-align:center;'>".$rowSize['Prot_Name']."</td>
				<td style='text-align:center;'>".$rowSize['Prot_RateFrom']." <b>to</b> ".$rowSize['Prot_RateTo']."</td>
				<td style='text-align:center;'>".$rowSize['Prot_Cgst']."</td>
				<td style='text-align:center;'>".$rowSize['Prot_Sgst']."</td>
				<td style='text-align:center;'>".$rowSize['Prot_Lgst']."</td>
				<td style='text-align: center;'>
					<button class='edit-btn btn btn-primary' data-eid='{$rowSize["Prot_Id"]}'><i class='icon-pencil7'></i></button>
					<button class='delete-btn btn btn-danger' data-did='{$rowSize["Prot_Id"]}'><i class='icon-pencil7'></i></button>
				</td>";

			}
		}
	}
	if($_POST["action"] == "Insert"){  
		if($_POST['proTaxFrom'] > $_POST['proTaxTo']){
			echo 0;
			// echo $_SESSION['error_productTax_msg'] = "Rate From always less than to Rate To";
		}else{
			$sqlInsertSliderData= ' INSERT INTO producttax SET
			Prot_ProdID=\''.mysql_real_escape_string_port($_POST['prodName']).'\',
			Prot_Name=\''.mysql_real_escape_string_port($_POST['proTaxName']).'\',
			Prot_RateFrom=\''.mysql_real_escape_string_port($_POST['proTaxFrom']).'\',
			Prot_RateTo=\''.mysql_real_escape_string_port($_POST['proTaxTo']).'\',
			Prot_Cgst=\''.mysql_real_escape_string_port($_POST['proCgst']).'\',
			Prot_Sgst=\''.mysql_real_escape_string_port($_POST['proSgst']).'\',
			Prot_Lgst=\''.mysql_real_escape_string_port($_POST['proLgst']).'\''; 
			$strRes=$dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
			$intInsertId= $dbh->lastInsertId(); 
			echo 1;
			// echo $_SESSION['success_productTax_msg'] = "Data Insert Successfully";
		}  
	} 
	
	if($_POST["action"] == "Update"){
		
		$sqlUpdateSliderData= ' UPDATE producttax SET
		Prot_ProdID=\''.mysql_real_escape_string_port($_POST['prodName']).'\',
		Prot_Name=\''.mysql_real_escape_string_port($_POST['proTaxName']).'\',
		Prot_RateFrom=\''.mysql_real_escape_string_port($_POST['proTaxFrom']).'\',
		Prot_RateTo=\''.mysql_real_escape_string_port($_POST['proTaxTo']).'\',
		Prot_Cgst=\''.mysql_real_escape_string_port($_POST['proCgst']).'\',
		Prot_Sgst=\''.mysql_real_escape_string_port($_POST['proSgst']).'\',
		Prot_Lgst=\''.mysql_real_escape_string_port($_POST['proLgst']).'\'
        WHERE Prot_Id='.$_POST['taxId'];
		// print_r($sqlUpdateSliderData);
						
        $strRes=$dbh->query($sqlUpdateSliderData);
		// echo "Update Successfull";
		$_SESSION['success_productTAx_msg'] = "Slider Update Successfully";
	}
}


?>