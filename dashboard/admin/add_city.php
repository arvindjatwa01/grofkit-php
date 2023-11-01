<?php include_once 'connection_handle.php';
$strPageTitle = "Manage city";
include_once 'header.php';
$strPageTitle2 = "Manage city";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	$sqlTrashRecord = ' DELETE FROM state WHERE 1 AND ct_Id=' . $_GET['id'];
	$dbh->query($sqlTrashRecord);
	$_SESSION['success_cat_image'] = 'Selected Entry removed successfully.';
	redirect('manage_city.php');
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}


$aryErrors = $class_city->catProcessRequest('', $strMode);




if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND ct_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'city');
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
                        <h4><a href="manage_city.php"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add City";
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
									echo "Add City";
								} ?></a></li>

                    </ul>


                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <?php successmessage('success_city_msg') ?>
                <?php duplicatedataErr('error_city_msg') ?>

                <!-- Both borders -->


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title"><?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
													echo $strPageTitle2;
												} else {
													echo "Add City";
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
                                    <label class="col-lg-2 control-label">Country<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="country" id="country">
                                            <option select value="0">Select Country</option>
                                            <?php
										$count = 0;
										$strLoadConditions = ' ORDER BY cu_Name ASC ';
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'country');
										
                                        if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
												if($rowSize['cu_Id'] == $rowsizeData['ct_CountryID']){
													$selected = "Selected";
												}else{
													$selected = "";
												}
										?>


                                            <option <?php echo $selected; ?> value="<?php echo $rowSize['cu_Id']; ?> ">
                                                <?php echo $rowSize['cu_Name']; ?></option>
                                            <?php }
											}?>
                                        </select>


                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">State<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="stateName" id="stateName">
                                            <option select value="0">Select state</option>
                                        </select>


                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">City Name<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="cityName" id="cityName" value="<?php if (isset($rowsizeData['ct_Name']) && '' != $rowsizeData['ct_Name']) {
																												echo $rowsizeData['ct_Name'];
																											} ?>" class="form-control" placeholder="Enter City Name">

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
$(document).ready(function() {
    $('#country').on('change', function() {
        var country_id = this.value;
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                country_id: country_id,
                isCountry: true
            },
            cache: false,
            success: function(result) {
                $("#stateName").html(result);
                // $('#city-dropdown').html(
                //     '<option value="">Select State First</option>');
            }
        });
    });
});
</script>

<script>
$(document).ready(function() {
    var urll = new URL(window.location.href);
    var mode = urll.searchParams.get("mode");
    var stateId = urll.searchParams.get("id");

    if (mode == 'edit') {
        var countryId = $('#country').val();
        // var stateId = $("stateName").val();
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                countryId: countryId,
                stateId: stateId,
                isCityUpdate: true
            },
            cache: false,
            success: function(result) {
                // console.log(result);
                $("#stateName").html(result);
                
                // $('#city-dropdown').html(
                //     '<option value="">Select State First</option>');
            }
        });

    }
});
</script>

</body>

</html>