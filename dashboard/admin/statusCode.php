<?php include_once 'connection_handle.php';
$strPageTitle = "Status Code";
include_once 'header.php';
$strPageTitle = 'Status Code';


// if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
// 	$sqlUpdateData = ' UPDATE unit SET status= (CASE WHEN status=1 THEN 0 ELSE 1 END) WHERE un_ID=' . $_GET['id'];
// 	$strRes = $dbh->query($sqlUpdateData);
// 	$_SESSION['success_unit_msg'] = 'Status Updated successfully.';
// 	redirect('manage_unit.php');
// }
// if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
// 	try {
// 		$dbh->query("DELETE FROM unit WHERE 1 AND un_ID= '". $_GET['id']."'");
// 		$_SESSION['success_unit_msg'] = 'Record Delete Successfully.';
// 		redirect('manage_unit.php');
// 	} catch (Exception $e) {
// 		if ($e->getCode() == '23000') {
// 			$_SESSION['error_unit_msg'] = "Record used anywhere";
// 			redirect('manage_unit.php');
// 		}
// 	}
// }

// if (isset($_POST['bulkaction']) && 0 < $_POST['bulkaction']) {


// 	$intBulkAction = $_POST['bulkaction'];
// 	$strURL = 'manage_unit.php';

// 	if (isset($_POST['id']) && 0 < count($_POST['id'])) {
// 		$strBulkServiceIds = implode(',', $_POST['id']);
// 		$strWhereCond = 'WHERE un_ID IN(' . $strBulkServiceIds . ')';

// 		if (1 == $intBulkAction) {
// 			$sqlDeleteSelected = 'DELETE FROM unit ' . $strWhereCond;
// 			$dbh->query($sqlDeleteSelected);
// 			$_SESSION['success_unit_msg'] = 'Selected Entry removed successfully.';
// 		}

// 		if (2 == $intBulkAction) {
// 			$sqlActiveUpdateSelected = 'UPDATE  unit SET  status=1 ' . $strWhereCond;

// 			$dbh->query($sqlActiveUpdateSelected);
// 			$_SESSION['success_unit_msg'] = 'Selected Entry active successfully.';
// 		}

// 		if (3 == $intBulkAction) {
// 			$sqlInActiveUpdateSelected = 'UPDATE  unit SET  status=0 ' . $strWhereCond;

// 			$_SESSION['success_unit_msg'] = 'Selected Entry Inactive successfully.';
// 			$dbh->query($sqlInActiveUpdateSelected);
// 		}


// 		redirect($strURL);
// 	}
// }






?>



<!-- Main content -->

<div class="page-container">

	<!-- Page content -->
	<div class="page-content">

		<?php include_once 'sidebar.php' ?>

		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Page header -->
			<div class="page-header page-header-default">
				<div class="page-header-content">
					<div class="page-title">
						<h4><a href="index.php"><i class="icon-arrow-left52 position-left"></i> </a><span class="text-semibold">Code Status</span></h4>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a>
					</div>


				</div>

				<div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
					<ul class="breadcrumb">
						<li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>

						<li class="active">Code Status</li>
					</ul>


				</div>
			</div>



			<!-- /page header -->
			<!-- Content area -->
			<div class="content">
				<?php successmessage('success_unit_msg') ?>
				<?php duplicatedataErr('error_unit_msg') ?>
				<!-- Both borders -->
				<div class="panel panel-default">
					


					<form action="" method="post">
						<div class="panel-body">


						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-bordered customemessage ">
									<thead>
										<tr>

											<th style="width:10px;" ;text-align:center">
												Code Id </th>


											<th style="text-align:center">Code</th>
											<th style="text-align:center">Description</th>
											<th style="text-align:center">Status</th>
										</tr>
									</thead>


									<tbody class=" replaceResponse ">
										<tr>
                                            <td>1</td>
                                            <td>New Order</td>
                                            <td>New Order</td>
                                            <td>
                                                <select name="" id=""
                                                    onchange="status('<?php echo $rowCompany['ord_id']; ?>',this.value)"
                                                    class="form-control">
                                                    <?php
                                                        $strOrderStatusConditions = ' ORDER BY Os_Id ASC ';
                                                        $resSelectOrderStatus = $class_common->loadMultipleDataByTableName($strOrderStatusConditions, '', '', 1, 'catpagination', '`orderstatus`');
                                                        if (count($resSelectOrderStatus) > 0) {
                                                            foreach ($resSelectOrderStatus as $rowOrderstatus) {
                                                                if($rowCompany['OrderStatusID'] == $rowOrderstatus['Os_Id']){
                                                                    $select = "selected";
                                                                }else{
                                                                    $select = "";
                                                                }
                                                                echo "<option $select value='".$rowOrderstatus['Os_Id']."'>".$rowOrderstatus['Os_Name']."</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Accept Order</td>
                                            <td>Order Accepted</td>
                                            <td>
                                                <select name="" id=""
                                                    onchange="status('<?php echo $rowCompany['ord_id']; ?>',this.value)"
                                                    class="form-control">
                                                    <?php
                                                        $strOrderStatusConditions = ' ORDER BY Os_Id ASC ';
                                                        $resSelectOrderStatus = $class_common->loadMultipleDataByTableName($strOrderStatusConditions, '', '', 1, 'catpagination', '`orderstatus`');
                                                        if (count($resSelectOrderStatus) > 0) {
                                                            foreach ($resSelectOrderStatus as $rowOrderstatus) {
                                                                if($rowCompany['OrderStatusID'] == $rowOrderstatus['Os_Id']){
                                                                    $select = "selected";
                                                                }else{
                                                                    $select = "";
                                                                }
                                                                echo "<option $select value='".$rowOrderstatus['Os_Id']."'>".$rowOrderstatus['Os_Name']."</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>3</td>
                                            <td>Packing Order</td>
                                            <td>Order in Packing process</td>
                                            <td>
                                                <select name="" id=""
                                                    onchange="status('<?php echo $rowCompany['ord_id']; ?>',this.value)"
                                                    class="form-control">
                                                    <?php
                                                        $strOrderStatusConditions = ' ORDER BY Os_Id ASC ';
                                                        $resSelectOrderStatus = $class_common->loadMultipleDataByTableName($strOrderStatusConditions, '', '', 1, 'catpagination', '`orderstatus`');
                                                        if (count($resSelectOrderStatus) > 0) {
                                                            foreach ($resSelectOrderStatus as $rowOrderstatus) {
                                                                if($rowCompany['OrderStatusID'] == $rowOrderstatus['Os_Id']){
                                                                    $select = "selected";
                                                                }else{
                                                                    $select = "";
                                                                }
                                                                echo "<option $select value='".$rowOrderstatus['Os_Id']."'>".$rowOrderstatus['Os_Name']."</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Dispatch For Delivery</td>
                                            <td>Order Out For Delivery</td>
                                            <td>
                                                <select name="" id=""
                                                    onchange="status('<?php echo $rowCompany['ord_id']; ?>',this.value)"
                                                    class="form-control">
                                                    <?php
                                                        $strOrderStatusConditions = ' ORDER BY Os_Id ASC ';
                                                        $resSelectOrderStatus = $class_common->loadMultipleDataByTableName($strOrderStatusConditions, '', '', 1, 'catpagination', '`orderstatus`');
                                                        if (count($resSelectOrderStatus) > 0) {
                                                            foreach ($resSelectOrderStatus as $rowOrderstatus) {
                                                                if($rowCompany['OrderStatusID'] == $rowOrderstatus['Os_Id']){
                                                                    $select = "selected";
                                                                }else{
                                                                    $select = "";
                                                                }
                                                                echo "<option $select value='".$rowOrderstatus['Os_Id']."'>".$rowOrderstatus['Os_Name']."</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Deliverd</td>
                                            <td>Order Delivered to the Customer</td>
                                            <td>
                                                <select name="" id=""
                                                    onchange="status('<?php echo $rowCompany['ord_id']; ?>',this.value)"
                                                    class="form-control">
                                                    <?php
                                                        $strOrderStatusConditions = ' ORDER BY Os_Id ASC ';
                                                        $resSelectOrderStatus = $class_common->loadMultipleDataByTableName($strOrderStatusConditions, '', '', 1, 'catpagination', '`orderstatus`');
                                                        if (count($resSelectOrderStatus) > 0) {
                                                            foreach ($resSelectOrderStatus as $rowOrderstatus) {
                                                                if($rowCompany['OrderStatusID'] == $rowOrderstatus['Os_Id']){
                                                                    $select = "selected";
                                                                }else{
                                                                    $select = "";
                                                                }
                                                                echo "<option $select value='".$rowOrderstatus['Os_Id']."'>".$rowOrderstatus['Os_Name']."</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Complited</td>
                                            <td>Order Completee</td>
                                            <td>
                                                <select name="" id=""
                                                    onchange="status('<?php echo $rowCompany['ord_id']; ?>',this.value)"
                                                    class="form-control">
                                                    <?php
                                                        $strOrderStatusConditions = ' ORDER BY Os_Id ASC ';
                                                        $resSelectOrderStatus = $class_common->loadMultipleDataByTableName($strOrderStatusConditions, '', '', 1, 'catpagination', '`orderstatus`');
                                                        if (count($resSelectOrderStatus) > 0) {
                                                            foreach ($resSelectOrderStatus as $rowOrderstatus) {
                                                                if($rowCompany['OrderStatusID'] == $rowOrderstatus['Os_Id']){
                                                                    $select = "selected";
                                                                }else{
                                                                    $select = "";
                                                                }
                                                                echo "<option $select value='".$rowOrderstatus['Os_Id']."'>".$rowOrderstatus['Os_Name']."</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>


									</tbody>

								</table>

							</div>

						</div>

					</form>

					<!-- /both borders -->


					<?php include_once 'footer.php'; ?>
				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	</body>

	</html>