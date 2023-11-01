<?php include_once 'connection_handle.php';
$strPageTitle = "Manage state";
include_once 'header.php';
$strPageTitle2 = "Manage state";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	$sqlTrashRecord = ' DELETE FROM state WHERE 1 AND st_Id=' . $_GET['id'];
	$dbh->query($sqlTrashRecord);
	$_SESSION['success_cat_image'] = 'Selected Entry removed successfully.';
	redirect('manage_state.php');
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}


$aryErrors = $class_state->catProcessRequest('', $strMode);




if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND st_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'state');
	// print_r($strLoadCondition);
}

if (isset($_POST['size'])) {

	$rowsizeData = $_POST;
}

?>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->

		<?php include("sidebar.php"); ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-default">
				<div class="page-header-content">
					<div class="page-title">
						<h4><a href="manage_state.php"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
								<?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add State";
								} ?></h4>
					</div>


				</div>

				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="<?php echo SITE_ADMIN_URL; ?>"><i class="icon-home2 position-left"></i> Home</a></li>
						<li><a href="#">
								<?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add State";
								} ?></a></li>

					</ul>


				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">

				<?php successmessage('success_state_msg') ?>
				<?php duplicatedataErr('error_state_msg') ?>

				<!-- Both borders -->


				<div class="panel panel-default">
					<div class="panel-heading">
						<h5 class="panel-title"><?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
													echo $strPageTitle2;
												} else {
													echo "Add State";
												} ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
						<div class="heading-elements">



						</div>
						<a class="heading-elements-toggle"><i class="icon-menu"></i></a>
					</div>

					<div class="alert alert-warning" id="success" style="display:none">
						<span class="text-semibold" style="padding-bottom:10px;">Warning!</span> For Complete Upload Please Click Save Image Button.
					</div>
					<form action="" method="post" enctype="multipart/form-data">
						<div class="panel-body">

							<div class="row">

								<div class="form-group">
									<label class="col-lg-2 control-label">Country<span class="required" style="color:red ;">*</span> :</label>
									<div class="col-lg-10 mb-5">
										<select class="form-control" name="country" id="country">
										<!-- <option value="<?php if (isset($rowsizeData['st_CountryID']) && '' != $rowsizeData['st_CountryID']) {
																												echo $rowsizeData['st_CountryID'];
																											} ?>"><?php if (isset($rowsizeData['st_CountryID']) && '' != $rowsizeData['st_CountryID']) {
																												echo "";
																											}else{
																												echo "Select Country";	
																											} ?></option>	 -->
										<option value="0">Select Country</option>
										<?php
										$count = 0;
										$strLoadConditions = ' ORDER BY cu_Name ASC ';
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'country');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
												if($rowSize['cu_Id'] == $rowsizeData['st_CountryID']){
													$selected = "Selected";
												}else{
													$selected = "";
												}
										?>
										
												
												<option <?php echo $selected; ?> value="<?php echo $rowSize['cu_Id']; ?>"><?php echo $rowSize['cu_Name']; ?></option>
											<?php }
											}?>
										</select>
										

									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">State Name<span class="required" style="color:red ;">*</span> :</label>
									<div class="col-lg-10 mb-5">
										<input type="text" name="stateName" id="stateName" value="<?php if (isset($rowsizeData['st_Name']) && '' != $rowsizeData['st_Name']) {
																												echo $rowsizeData['st_Name'];
																											} ?>" class="form-control" placeholder="Enter State Name">

									</div>
								</div>
								<div class="row">
									<div class="form-group" style="margin-top:55px;">
										<label class="col-lg-2 control-label">&nbsp;</label>
										<div class="col-lg-6">
											<button type="submit" name="submit" onclick="" class="btn btn-primary" aria-expanded="false">Upload </button>
										</div>
									</div>
								</div>



							</div>
					</form>

				</div>
			</div>
			<?php include_once "footer.php"; ?>
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