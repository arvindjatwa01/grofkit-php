<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Attribute";
include_once 'header.php';
$strPageTitle = 'Manage Attribute';


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
	$sqlUpdateData = ' UPDATE attribute SET status= (CASE WHEN status=1 THEN 0 ELSE 1 END) WHERE att_Id=' . $_GET['id'];
	$strRes = $dbh->query($sqlUpdateData);
	$_SESSION['success_attribute_msg'] = 'Status Updated successfully.';
	redirect('manage_attribute.php');
}
if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	try {
		$dbh->query("DELETE FROM attribute WHERE 1 AND att_Id= '". $_GET['id']."'");
		$_SESSION['success_attribute_msg'] = 'Record Delete Successfully.';
		redirect('manage_attribute.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_attribute_msg'] = "Record used anywhere";
			redirect('manage_attribute.php');
		}
	}
}

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
						<h4><a href="index.php"><i class="icon-arrow-left52 position-left"></i> </a><span class="text-semibold">Attribute </span> - Manage Attribute</h4>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a>
					</div>


				</div>

				<div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
					<ul class="breadcrumb">
						<li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>

						<li class="active">Manage Attribute</li>
					</ul>


				</div>
			</div>



			<!-- /page header -->
			<!-- Content area -->
			<div class="content">
				<?php successmessage('success_attribute_msg') ?>
				<?php duplicatedataErr('error_attribute_msg') ?>
				<!-- Both borders -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h5 class="panel-title">Attribute Listing</h5>
						<div class="heading-elements">

							<a href="add_attribute.php" class="btn btn-info btn-xs"><b><i class="icon-plus3"></i></b> Add New</a>
						</div>
						<a class="heading-elements-toggle"><i class="icon-menu"></i></a>
					</div>


					<form action="" method="post">
						<div class="panel-body">


						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-bordered customemessage ">
									<thead>
										<tr>

											<th style="width:10px;" ;text-align:center">
												S.No </th>


											<th style="text-align:center">Attribute Name </th>
											<th style="text-align:center">Is On View </th>
											<th style="text-align:center">Is Stock Attribute </th>
											<th style="text-align:center">Choise </th>
											<th style="text-align:center">Action</th>
										</tr>
									</thead>


									<tbody class=" replaceResponse ">
										<?php
										$count = 0;
										$strLoadConditions = ' ORDER BY att_Id DESC ';
                                        $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 1, 'catpagination', 'attribute');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
										?>


												<tr class="clsparentinformation">


													<td style="text-align:center; width:10px">
														<?php echo $count; ?>
													</td>
                                                    <?php
                                                        if($rowSize['att_IsonView'] == '0'){
                                                            $OnView = "No";
                                                        }else{
                                                            $OnView = "Yes";
                                                        }

                                                        if($rowSize['att_IsStockAtt'] == '0'){
                                                            $isStockAtt = "No";
                                                        }else{
                                                            $isStockAtt = "Yes";
                                                        }
                                                    ?>


													<td style="min-width:30px;text-align:center"><?php echo $rowSize['att_Name']; ?></td>
													
                                                    
                                                    <td style="min-width:30px;text-align:center"><?php echo $OnView; ?></td>
                                                    <td style="min-width:30px;text-align:center"><?php echo $isStockAtt; ?></td>
                                                    <?php
                                                        if($rowSize['att_IsMultiple'] == '0'){
                                                            $choise = "Singal Choise";
                                                        }else{
                                                            $choise = "Multi Choise";
                                                        }
                                                    ?>
                                                    <td style="min-width:30px;text-align:center"><?php echo $choise; ?></td>
													

													<td style="text-align: center;">
														<a href="add_attribute.php?id=<?php echo $rowSize['att_Id']; ?>&mode=edit" class="btn btn-primary" title=""> <i class="icon-pencil7"></i></a>



														<a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" href="manage_attribute.php?id=<?php echo $rowSize['att_Id'] ?>&mode=delete"> <i class="icon-trash"></i></a>



													</td>

												</tr>




										<?php
											}
										}
										?>


									</tbody>

								</table>

							</div>

						</div>

					</form>
					
                    <div class="panel-body">
                        <?php
						if (isset($_SESSION['catpagination'])) {
							echo $_SESSION['catpagination'];
						}
						?>
                        <div>
                        </div>
                    </div>
                    <!-- /form horizontal -->

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