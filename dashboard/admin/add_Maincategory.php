<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Main Category";
include_once 'header.php';
$strPageTitle2 = "Manage Main Category";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	try {
		$dbh->query("DELETE FROM maincategory WHERE 1 AND Mcat_Id= '". $_GET['id']."'");
		$_SESSION['success_Mcategory_msg'] = 'Record Delete Successfully.';
		redirect('manage_Maincategory.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_Mcategory_msg'] = "Record used anywhere";
			redirect('manage_Maincategory.php');
		}
	}
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}


$aryErrors = $class_Maincat->catProcessRequest('', $strMode);




if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND Mcat_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'maincategory');
	
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
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Main Category";
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
									echo "Add Main Category";
								} ?></a></li>

                    </ul>


                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <?php successmessage('success_Mcategory_msg') ?>
                <?php duplicatedataErr('error_Mcategory_msg') ?>

                <!-- Both borders -->


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title"><?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
													echo $strPageTitle2;
												} else {
													echo "Add Main Category";
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
                                    <label class="col-lg-2 control-label">Category Name<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="MainCatName" id="MainCatName" value="<?php if (isset($rowsizeData['Mcat_Name']) && '' != $rowsizeData['Mcat_Name']) {
																												echo $rowsizeData['Mcat_Name'];
																											} ?>" class="form-control" placeholder="Enter Category Name">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Category Image<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="button" id="chooseImgbtn" class="form-control text-left" value="Choose Image"
                                            data-toggle="modal" data-target="#categoryImgModal">
											<?php if(isset($rowsizeData['Mcat_Image'])){
                                        echo "<input type='radio' checked class='MainCatImg' name='MainCatImg' value='".$rowsizeData['Mcat_Image']."'><img src='".$rowsizeData['Mcat_Image']."' alt='Item Image' width='100'>";
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
                            </div>
                            <div class="modal fade" id="categoryImgModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-bottom border-secondary">
                                            <h5 class="modal-title" id="exampleModalLabel">Choose Image</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
																												} ?>" class="form-control" placeholder="Enter Category Name">

                                                </div>
                                            </div>
                                            <div class="col-lg-12">

                                                <?php
												$strLoadConditions = ' ORDER BY Mcat_Id DESC ';
												$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'maincategory');
												if (count($resSelectCouponList) > 0) {
													foreach ($resSelectCouponList as $rowSize) {
														echo "<div class='col-lg-3 mb-2'><input type='radio' class='MainCatImg' name='MainCatImg' value='".$rowSize['Mcat_Image']."'>
														<img src='".$rowSize['Mcat_Image']."' alt='Item Image' width='50' height='50'></div>";
													}
												}
																												
												
												?>
                                            </div>

                                        </div>
                                        <div class="modal-footer"></div>
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
<script>
var file = document.getElementById("MainCatImginput");

$(document).on("click", "#MainCatImginput", function() {
    if (file.files.length == 0) {
		$('#chooseImgbtn').val("Image Choosed");
		if($("input:radio[name=MainCatImg]:checked")[0].checked == true){
			$("input:radio[name=MainCatImg]:checked")[0].checked = false;
		}
		
    }
});
$(document).on("click", ".MainCatImg", function() {
    if ($("input:radio[name=MainCatImg]:checked")[0].checked == true) {
        $('#chooseImgbtn').val("Image Choosed");
        $("#MainCatImginput").val(null);

    }
});

// if(file.files.length != 0 && $("input:radio[name=MainCatImg]:checked")[0].checked == true){
// 	$("#MainCatImginput").attr('value', 'Image Choosed');
// }
</script>

</body>

</html>