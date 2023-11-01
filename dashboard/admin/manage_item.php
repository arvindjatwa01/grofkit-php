<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Item";
include_once 'header.php';
$strPageTitle = 'Manage Item';


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
	$sqlUpdateData = ' UPDATE item SET status= (CASE WHEN status=1 THEN 0 ELSE 1 END) WHERE ite_Id=' . $_GET['id'];
	$strRes = $dbh->query($sqlUpdateData);
	$_SESSION['success_item_msg'] = 'Status Updated successfully.';
	redirect('manage_item.php');
}
if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	try {
		$dbh->query("DELETE FROM item_reviews WHERE 1 AND itemRev_itemId= '". $_GET['id']."'");
		$dbh->query("DELETE FROM attributeitem WHERE 1 AND iteAtt_itemID= '". $_GET['id']."'");
		$dbh->query("DELETE FROM coupandtl WHERE 1 AND CpDtl_itemID= '". $_GET['id']."'");
		$dbh->query("DELETE FROM cart WHERE 1 AND cart_itemId= '". $_GET['id']."'");
		$dbh->query("DELETE FROM stock WHERE 1 AND stk_itemid= '". $_GET['id']."'");
		$dbh->query("DELETE FROM itemimage WHERE 1 AND itimg_itemID= '". $_GET['id']."'");
		$dbh->query("DELETE FROM item WHERE 1 AND ite_Id= '". $_GET['id']."'");
		$_SESSION['success_item_msg'] = 'Record Delete Successfully.';
		redirect('manage_item.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_item_msg'] = "Record used anywhere";
			redirect('manage_item.php');
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
						<h4><a href="index.php"><i class="icon-arrow-left52 position-left"></i> </a><span class="text-semibold">Item </span> - Manage Item</h4>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a>
					</div>


				</div>

				<div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
					<ul class="breadcrumb">
						<li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>

						<li class="active">Manage Item</li>
					</ul>


				</div>
			</div>



			<!-- /page header -->
			<!-- Content area -->
			<div class="content">
				<?php successmessage('success_item_msg') ?>
				<?php duplicatedataErr('error_item_msg') ?>
				<!-- Both borders -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h5 class="panel-title">Item Listing</h5>
						<div class="heading-elements">

							<a href="add_item.php" class="btn btn-info btn-xs"><b><i class="icon-plus3"></i></b> Add New</a>
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
											<th style="text-align:center">Item Name </th>
											<th style="text-align:center">Add Image </th>
											<th style="text-align:center">Main Image </th>
											<th style="text-align:center">Base Rate(₹) </th>
											<th style="text-align:center">Rate(₹) </th>
											<th style="text-align:center">MRP(₹) </th>
											<th style="text-align:center">Action</th>
										</tr>
									</thead>


									<tbody class=" replaceResponse ">
										<?php
										$count = 0;
										$strLoadConditions = ' ORDER BY ite_Id DESC ';
										$stFileds = "item.*, product.*";
										$strJoinCondition = " LEFT JOIN product ON item.ite_ProdId = product.prod_Id";
                                        $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $stFileds, $strJoinCondition, 1, 'catpagination', 'item');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
										?>


												<tr class="clsparentinformation">


													<td style="text-align:center; width:10px">
														<?php echo $count; ?>
													</td>


													<td style="min-width:30px;text-align:center"><?php echo $rowSize['prod_Name']; ?></td>
													<td style="min-width:30px;text-align:center"><?php echo $rowSize['ite_Name']; ?></td>
													
                                                    
                                                    <td style="min-width:30px;text-align:center">
														<?php 
														$sqlImagesQuery = "SElECT * FROM itemimage WHERE itimg_itemID = '".$rowSize['ite_Id']."'";
														
														$ResImageQuery = $dbh->query($sqlImagesQuery);
														if($ResImageQuery->rowCount() > 0){
															?>
															<a href="add_ItemImges.php?id=<?php echo $rowSize['ite_Id']; ?>" class="btn btn-success" title="">Add more <i class="bi bi-plus-lg h6"></i></i></a>
															<?php 
														}else{ ?>
															<a href="add_ItemImges.php?id=<?php echo $rowSize['ite_Id']; ?>" class="btn btn-success" title="">Add <i class="bi bi-plus-lg h6"></i></a>
													<?php	}	
														?>
													</td>
                                                    <td style="min-width:30px;text-align:center"><?php
													$ImagePath = "SElECT * FROM itemimage WHERE itimg_itemID = '".$rowSize['ite_Id']."' AND itimg_IsMainImage = 1";
													
													$ImgePathRes = $dbh->query($ImagePath);
													if($ImgePathRes->rowCount() > 0){ 
														$ImageRow = $ImgePathRes->fetch(); ?>
													
													<img src="../uploads/item_image/<?php echo $ImageRow['itimg_path']; ?>" alt="Item Image" width="100"><?php }else{ 
														echo "No Choosen Main Image";
													}?></td>
                                                    <td style="min-width:30px;text-align:center"><?php echo $rowSize['ite_BaseRate']; ?></td>
													<td style="min-width:30px;text-align:center"><?php echo $rowSize['ite_Rate']; ?></td>
													<td style="min-width:30px;text-align:center"><?php echo $rowSize['ite_MRP']; ?></td>
													

													<td style="text-align: center;">
														<a href="add_item.php?id=<?php echo $rowSize['ite_Id']; ?>&mode=edit" class="btn btn-primary" title=""> <i class="icon-pencil7"></i></a>



														<a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" href="manage_item.php?id=<?php echo $rowSize['ite_Id'] ?>&mode=delete"> <i class="icon-trash"></i></a>



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