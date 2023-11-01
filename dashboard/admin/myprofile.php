<?php include_once 'connection_handle.php';

include_once 'header.php';




$aryErrors = $class_login->processAdminRequest('');


$strLoadCondition = ' AND admin_id=' . $class_login->getCurrentLoginAdminId();
$rowAdminInfo = $class_common->loadSingleDataBy($strLoadCondition, '', '', TABLE_ADMIN);


if (isset($_POST['admin_full_name'])) {
	$rowAdminInfo = $_POST;
}

//print_r($rowAdminInfo); 

?>


<!-- Page container -->
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
						<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Forms</span> - Basic Inputs</h4>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a>
					</div>


				</div>

				<div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
					<ul class="breadcrumb">
						<li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>
						<li><a href="#">Forms</a></li>
						<li class="active">Basic inputs</li>
					</ul>


				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">


				<form action="" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<!-- Both borders -->
					<?php successmessage('success_msg');

					if (isset($aryErrors) && 0 < count($aryErrors)) {
						errormessage($aryErrors);
					} ?>


					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Add Profile</h5>
							<div class="heading-elements">


								<button type="submit" name="submit" class="btn btn-info btn-xs">Save &amp; Continue</button>

							</div>
							<a class="heading-elements-toggle"><i class="icon-menu"></i></a>
						</div>



						<div class="panel-body" style="padding:0px 20px;">

							<ul class="nav nav-tabs nav-tabs-highlight">
								<li class="active"><a href="#Personal-Info" data-toggle="tab">General</a></li>

							</ul>

							<div class="tab-content">
								<div class="tab-pane active" id="Book-Info">
									<div class="form-group">
										<label class="col-lg-2 control-label">Full Name: <span class="required" style="color:red ;">*</span> :</label>
										<div class="col-lg-10">
											<input type="text" name="admin_full_name" value="<?php if (isset($rowAdminInfo['admin_full_name']) && '' != $rowAdminInfo['admin_full_name']) {
																									echo $rowAdminInfo['admin_full_name'];
																								} ?>" class="form-control" placeholder="Enter Full Name">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Username: <span class="required" style="color:red ;">*</span> :</label>
										<div class="col-lg-10">
											<input type="text" name="admin_username" value="<?php if (isset($rowAdminInfo['admin_username']) && '' != $rowAdminInfo['admin_username']) {
																								echo $rowAdminInfo['admin_username'];
																							} ?>" class="form-control" placeholder="Enter Username">
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Password: <span class="required" style="color:red ;">*</span> :</label>
										<div class="col-lg-10">
											<input type="password" name="admin_password" value="<?php if (isset($rowAdminInfo['admin_password']) && '' != $rowAdminInfo['admin_password']) {
																									echo $rowAdminInfo['admin_password'];
																								} ?>" class="form-control" placeholder="Enter Password">
										</div>
									</div>


									<div class="form-group">
										<label class="col-lg-2 control-label">Phone: <span class="required" style="color:red ;">*</span> :</label>
										<div class="col-lg-10">
											<input type="text" name="admin_phone" value="<?php if (isset($rowAdminInfo['admin_phone']) && '' != $rowAdminInfo['admin_phone']) {
																								echo $rowAdminInfo['admin_phone'];
																							} ?>" class="form-control" placeholder="Enter Phone Number">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Email Id: <span class="required" style="color:red ;">*</span> :</label>
										<div class="col-lg-10">
											<input type="text" name="admin_email" value="<?php if (isset($rowAdminInfo['admin_email']) && '' != $rowAdminInfo['admin_email']) {
																								echo $rowAdminInfo['admin_email'];
																							} ?>" class="form-control" placeholder="Enter Email Id">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Address: <span class="required" style="color:red ;">*</span> :</label>
										<div class="col-lg-10">
											<textarea name="admin_address" class="form-control" placeholder="Enter Address" style="overflow:hidden"><?php if (isset($rowAdminInfo['admin_address']) && '' != $rowAdminInfo['admin_address']) {
																																						echo $rowAdminInfo['admin_address'];
																																					} ?></textarea>
										</div>
									</div>



									<div class="form-group">
										<label class="col-lg-2 control-label">Image :</label>
										<div class="col-lg-10">
											<div class="media no-margin-top">
												<div class="media-left">
													<a href="#"><img src="<?php if (is_file(SITE_UPLOAD_PATH . SITE_ADMIN_IMAGE_PATH . $rowAdminInfo['admin_image'])) {
																				echo SITE_UPLOAD_URL . SITE_ADMIN_IMAGE_PATH . $rowAdminInfo['admin_image'];
																			} else {
																				echo 'assets/images/placeholder.jpg';
																			} ?>" name="admin_image" id="blah" style="width: 58px; height: 58px; border-radius: 2px;" alt=""></a>
												</div>

												<div class="media-body">
													<div class="uploader "><input class="file-styled" name="admin_image" onchange="readURL(this)" type="file"><span class="filename" name="admin_image" style="-moz-user-select: none;"></span><span class="action btn bg-pink-400 legitRipple" style="-moz-user-select: none;" name="admin_image">Choose File</span></div>
													<span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
												</div>
											</div>
										</div>
									</div>




								</div>

							</div>

						</div>


					</div>
					<!-- /both borders -->
				</form>
				<!-- Content area -->

				<!-- /content area -->





				<!-- /main content -->

				<?php include_once 'footer.php' ?>
				<script>
					function readURL(input) {
						if (input.files && input.files[0]) {
							var reader = new FileReader();

							reader.onload = function(e) {

								$('#blah')
									.attr('src', e.target.result);
							};

							reader.readAsDataURL(input.files[0]);
						}
					}
				</script>