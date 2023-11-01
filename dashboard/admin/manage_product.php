<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Product";
include_once 'header.php';
$strPageTitle = 'Manage Product';


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
	$sqlUpdateData = ' UPDATE product SET status= (CASE WHEN status=1 THEN 0 ELSE 1 END) WHERE prod_Id=' . $_GET['id'];
	$strRes = $dbh->query($sqlUpdateData);
	$_SESSION['success_product_msg'] = 'Status Updated successfully.';
	redirect('manage_product.php');
}
if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	try {
		$dbh->query("DELETE FROM product WHERE 1 AND prod_Id= '". $_GET['id']."'");
		$_SESSION['success_product_msg'] = 'Record Delete Successfully.';
		redirect('manage_product.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_product_msg'] = "Record used anywhere";
			redirect('manage_product.php');
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
						<h4><a href="index.php"><i class="icon-arrow-left52 position-left"></i> </a><span class="text-semibold">Product</span> - Manage Product</h4>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a>
					</div>


				</div>

				<div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
					<ul class="breadcrumb">
						<li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>

						<li class="active">Manage Product</li>
					</ul>


				</div>
			</div>



			<!-- /page header -->
			<!-- Content area -->
			<div class="content">
				<?php successmessage('success_product_msg') ?>
				<?php duplicatedataErr('error_product_msg') ?>
				<!-- Both borders -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h5 class="panel-title">Product Listing</h5>
						<div class="heading-elements">

							<a href="add_product.php" class="btn btn-info btn-xs"><b><i class="icon-plus3"></i></b> Add New</a>
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


											<th style="text-align:center">Product Name </th>
											<th style="text-align:center">Category </th>
											<th style="text-align:center">Desc </th>
											<th style="text-align:center">HSN Code </th>
											<th style="text-align:center">Delivery Cost (₹) </th>
											<th style="text-align:center">Unit </th>
											<!--<th style="text-align:center">Status </th>-->
											<th style="text-align:center">Action</th>
											
										</tr>
									</thead>


									<tbody class=" replaceResponse ">
										<?php
										$count = 0;
										$strLoadConditions = ' ORDER BY prod_Id DESC ';
                                        $strFileds = "product.*, category.*, unit.*";
                                        $strJoinCondition = " LEFT JOIN category ON product.prod_CatID = category.cat_Id LEFT JOIN unit ON product.prod_unitId = unit.un_Id";
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, $strJoinCondition, 1, 'catpagination', 'product');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
										?>


												<tr class="clsparentinformation">


													<td style="text-align:center; width:10px">
														<?php echo $count; ?>
													</td>


													<td style="min-width:30px;text-align:center"><?php echo $rowSize['prod_Name']; ?></td>
													
                                                    
                                                    <td style="min-width:30px;text-align:center"><?php echo $rowSize['cat_Name']; ?></td>
                                                    <td style="min-width:30px;text-align:center"><?php echo $rowSize['prod_description']; ?></td>
													<td style="min-width:30px;text-align:center"><?php echo $rowSize['prod_HSNCode']; ?></td>
                                                    <td style="min-width:30px;text-align:center"><?php echo $rowSize['prod_DeliveryCost']; ?></td>
													<td style="min-width:30px;text-align:center"><?php echo $rowSize['un_Code']; ?></td>
													<!--<td style="min-width:30px;text-align:center">-->
													
													<?php //echo "<select id='selectstatus".$rowSize['prod_Id']."' onchange='status(".$rowSize['prod_Id'].",this.value)' class='form-control'>
															//<option selected disabled>Select</option>
															//<option value='0'";if($rowSize['prod_active'] == '0'){echo "selected";}echo " >Inactive</option>
															//<option value='1'";if($rowSize['prod_active']=='1'){echo "selected";}echo ">Active</option>
														//</select> ";
													?>
													<!--</td>-->

													<td style="text-align: center;">
														<a href="add_product.php?id=<?php echo $rowSize['prod_Id']; ?>&mode=edit" class="btn btn-primary" title=""> <i class="icon-pencil7"></i></a>



														<a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" href="manage_product.php?id=<?php echo $rowSize['prod_Id'] ?>&mode=delete"> <i class="icon-trash"></i></a>



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
	<script>
    function status(a, value) {
        var pid = a;
        var status = value;
        console.log(pid);
        console.log(value);
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                pid: pid,
                status: status
            },
            // dataType: "JSON",
            success: function(data) {
                // console.log(data);
                // $('#result').html(data);  
            },
            error: function(data) {
                console.log(data);
            }
        });

    }
    </script>

	</body>

	</html>