<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Category";
include_once 'header.php';
$strPageTitle2 = "Manage Category";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	try {
		$dbh->query("DELETE FROM category WHERE 1 AND cat_Id= '". $_GET['id']."'");
		$_SESSION['success_category_msg'] = 'Record Delete Successfully.';
		redirect('manage_category.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_category_msg'] = "Record used anywhere";
			redirect('manage_category.php');
		}
	}
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}


$aryErrors = $class_cat->catProcessRequest('', $strMode);




if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND cat_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'category');
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
                        <h4><a href="manage_category.php"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Category";
								} ?></h4>
                    </div>


                </div>

                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL; ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>
                        <li><a href="#">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Category";
								} ?></a></li>

                    </ul>


                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <?php successmessage('success_category_msg') ?>
                <?php duplicatedataErr('error_category_msg') ?>

                <!-- Both borders -->


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title"><?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
													echo $strPageTitle2;
												} else {
													echo "Add Category";
												} ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                        <div class="heading-elements">



                        </div>
                        <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                    </div>

                    <div class="alert alert-warning" id="success" style="display:none">
                        <span class="text-semibold" style="padding-bottom:10px;">Warning!</span> For Complete Upload
                        Please Click Save Image Button.
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="panel-body">

                            <div class="row">

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Under Category<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="Maincategory" id="Maincategory">

                                            <?php
										$strLoadConditions = ' ORDER BY cat_Id ASC ';
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'category');
										if (count($resSelectCouponList) > 0) { ?>
                                            <option select value="0">Select Category</option>
                                            <?php
											foreach ($resSelectCouponList as $rowSize) {
												if(isset($rowSize['cat_UnderCatID'])){

												
												if($rowSize['cat_Id'] == $rowsizeData['cat_UnderCatID']){
													$selected = "Selected";
												}else{
													$selected = "";
												}
											}
										?>
                                            <option <?php echo $selected; ?> value="<?php echo $rowSize['cat_Id']; ?>">
                                                <?php echo $rowSize['cat_Name']; ?></option>
                                            <?php }
											}else{ ?>
                                            <option selected value="0">Under Category Not Available</option>
                                            <?php }?>
                                        </select>


                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Category Name<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="catName" id="catName" value="<?php if (isset($rowsizeData['cat_Name']) && '' != $rowsizeData['cat_Name']) {
																												echo $rowsizeData['cat_Name'];
																											} ?>" class="form-control" placeholder="Enter Category Name">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Category Image<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="button" id="chooseImgbtn" class="form-control text-left"
                                            value="Choose Image" data-toggle="modal" data-target="#categoryImgModal">
                                        <?php if(isset($rowsizeData['cat_Image'])){
                                        echo "<input type='radio' checked class='MainCatImg' name='MainCatImg' value='".$rowsizeData['cat_Image']."'><img src='../uploads/category_icon_image/".$rowsizeData['cat_Image']."' alt='Item Image' width='100'>";
                                    }
                                     ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group" style="margin-top:55px;">
                                        <label class="col-lg-2 control-label">&nbsp;</label>
                                        <div class="col-lg-6">
                                            <button type="submit" name="submit" onclick="" class="btn btn-primary"
                                                aria-expanded="false">Upload </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="categoryImgModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-bottom border-secondary">
                                                <h5 class="modal-title" id="exampleModalLabel">Choose Image</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <label class="col-lg-2 control-label">Add More<span class="required"
                                                            style="color:red ;">*</span> :</label>
                                                    <div class="col-lg-10 mb-5">
                                                        <input type="file" name="MainCatImginput" id="MainCatImginput"
                                                            value="<?php if (isset($rowsizeData['Mcat_Name']) && '' != $rowsizeData['Mcat_Name']) {
																													echo $rowsizeData['Mcat_Name'];
																												} ?>" class="form-control" accept="image/*"  placeholder="Enter Category Name">

                                                    </div>
                                                </div>
                                                <div class="col-lg-12">

                                                    <?php
												$strLoadConditions = ' ORDER BY cat_Id DESC ';
												$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'category');
												if (count($resSelectCouponList) > 0) {
													foreach ($resSelectCouponList as $rowSize) {
														echo "<div class='col-lg-3 mb-2'><input type='radio' class='MainCatImg' name='MainCatImg' value='".$rowSize['cat_Image']."'>
														<img src='../uploads/category_icon_image/".$rowSize['cat_Image']."' alt='Item Image' width='50' height='50'></div>";
													}
												}
																												
												
												?>
												<div class="col-lg-2">
												    <input type='button' value='Ok' id="okaybtn" class="btn btn-primary">
												</div>
                                                </div>

                                            </div>
                                            <div class="modal-footer"></div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>
<script>
    $(document).ready(function(){
        // if(document.getElementById("MainCatImginput").files.length == 0 &&  document.querySelectorAll('input[name="MainCatImg"]').checked){
        //     console.log("files selected");
        // }else{
        //     console.log("files not selected");
        // }
        $(document).on("click", "#MainCatImginput", function(){
            // if ($("input[name='MainCatImg']").prop("checked")){
                $('.MainCatImg').prop('checked', false);
                // alert("Hello");
            // }
            
        });
         $(document).on("click", ".MainCatImg", function(){
             $("#MainCatImginput").val(null);
         });
         
        $("#okaybtn").on("click",function(){
            // $("#categoryImgModal").modal('toggle');
            // if($("#MainCatImginput").val() == 0 || $('.MainCatImg').prop('checked', false)){
            //     $("#chooseImgbtn").val("Image Not Select");
            // }
            $("#categoryImgModal .close").click();
            
    });
        
    });
</script>