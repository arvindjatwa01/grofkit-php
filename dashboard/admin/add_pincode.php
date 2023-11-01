<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Pincode";
include_once 'header.php';
$strPageTitle2 = "Manage Pincode";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	$sqlTrashRecord = ' DELETE FROM pincode_onavailable WHERE 1 AND Pin_Id=' . $_GET['id'];
	$dbh->query($sqlTrashRecord);
	$_SESSION['success_pincode_msg'] = 'Selected Entry removed successfully.';
	redirect('manage_pincode.php');
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}


$aryErrors = $class_pincode->catProcessRequest('', $strMode);




if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND Pin_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'pincode_onavailable');
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
                        <h4><a href="manage_pincode.php"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Pincode";
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
									echo "Add Pincode";
								} ?></a></li>

                    </ul>


                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <?php successmessage('success_pincode_msg') ?>
                <?php duplicatedataErr('error_pincode_msg') ?>

                <!-- Both borders -->


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title"><?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
													echo $strPageTitle2;
												} else {
													echo "Add Pincode";
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
                                            $selected="";
										$strLoadConditions = ' ORDER BY cu_Name ASC ';
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'country');
										
                                        if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												if(isset($rowsizeData['Pin_CountryId'])){
                                                    $PinCountry = $rowsizeData['Pin_CountryId'];
                                                
                                                    if($rowSize['cu_Id'] == $rowsizeData['Pin_CountryId']){
                                                        $selected = "Selected";
                                                    }else{
                                                        $selected = "";
                                                    }
                                                }
										?>


                                            <option <?php echo $selected; ?> value="<?php echo $rowSize['cu_Id']; ?>">
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
                                    <label class="col-lg-2 control-label">City<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="cityName" id="cityName">
                                            <option value="0">Select City</option>
                                        </select>


                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <label class="col-lg-4 control-label">Pin Name<span class="required"
                                                        style="color:red ;">*</span> :</label>
                                                <div class="col-lg-8 mb-5">
                                                    <input type="text" name="PinName" id="PinName" value="<?php if (isset($rowsizeData['Pin_Name']) && '' != $rowsizeData['Pin_Name']) {
																												echo $rowsizeData['Pin_Name'];
																											} ?>" class="form-control" placeholder="Enter Pin Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <label class="col-lg-3 control-label">Pin Code<span class="required"
                                                        style="color:red ;">*</span> :</label>
                                                <div class="col-lg-9 mb-5">
                                                    <input type="text" name="PinCode" id="PinCode" value="<?php if (isset($rowsizeData['Pin_PinCode']) && '' != $rowsizeData['Pin_PinCode']) {
																												echo $rowsizeData['Pin_PinCode'];
																											} ?>" class="form-control" placeholder="Enter Pin Code Number"
                                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                        maxlength="6">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <label class="col-lg-4 control-label">Delivery Cost<span
                                                        class="required" style="color:red ;">*</span> :</label>
                                                <div class="col-lg-8 mb-5">
                                                    <input type="text" name="deliveryCost" id="deliveryCost" value="<?php if (isset($rowsizeData['Pin_delivaryCost']) && '' != $rowsizeData['Pin_delivaryCost']) {
																												echo $rowsizeData['Pin_delivaryCost'];
																											} ?>" class="form-control allowdecimaldigit" placeholder="Enter Delicery Cost"
                                                        >

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <label class="col-lg-3 control-label">Max Cart Value<span
                                                        class="required" style="color:red ;">*</span> :</label>
                                                <div class="col-lg-9 mb-5">
                                                    <input type="text" name="minCartValue" id="minCartValue" value="<?php if (isset($rowsizeData['pin_MinCartValue']) && '' != $rowsizeData['pin_MinCartValue']) {
																												echo $rowsizeData['pin_MinCartValue'];
																											} ?>" class="form-control allowdecimaldigit" placeholder="Enter Minimum Cart Value"
                                                        >
                                            <div class="form-text text-bold"><span
                                                        class="required" style="color:red ;">*</span>If cart value is greater then this entered value, Delivery cost will not apply.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-lg-2 control-label">Pin Name<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="PinName" id="PinName" value="<?php if (isset($rowsizeData['Pin_Name']) && '' != $rowsizeData['Pin_Name']) {
																												echo $rowsizeData['Pin_Name'];
																											} ?>" class="form-control" placeholder="Enter Pin Name">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Pin Code<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="PinCode" id="PinCode" value="<?php if (isset($rowsizeData['Pin_PinCode']) && '' != $rowsizeData['Pin_PinCode']) {
																												echo $rowsizeData['Pin_PinCode'];
																											} ?>" class="form-control" placeholder="Enter Pin Code Number"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                            maxlength="6">

                                    </div>
                                </div> -->
                                <!-- <div class="form-group">
                                    <label class="col-lg-2 control-label">Delivery Cost<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="deliveryCost" id="deliveryCost" value="<?php if (isset($rowsizeData['Pin_delivaryCost']) && '' != $rowsizeData['Pin_delivaryCost']) {
																												echo $rowsizeData['Pin_delivaryCost'];
																											} ?>" class="form-control" placeholder="Enter Delicery Cost"
                                            onkeypress="return (event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57))">

                                    </div>
                                </div> -->
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
$('#country').on('change', function() {
    var country_id = this.value;
    var city = document.getElementById("cityName").value;
    var state = document.getElementById("stateName").value;
    var country = document.getElementById("country").value;


    if ($("#country option:selected").val() != 0) {
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
                $('#stateName').on('change', function() {

                    var state_id = this.value;
                    if (state_id != 0) {
                        $.ajax({
                            url: "action.php",
                            type: "POST",
                            data: {
                                state_id: state_id,
                                isState: true
                            },
                            cache: false,
                            success: function(result) {
                                $("#cityName").html(result);
                                // $('#city-dropdown').html(
                                //     '<option value="">Select State First</option>');
                            }
                        });
                    } else {
                        $("#cityName").html(
                            '<option value="0">Select State First</option>');
                    }
                });
            }
        });

    } else {
        $("#stateName").html('<option value="0">Select country First</option>');
        $("#cityName").html('<option value="0">Select city</option>');
    }
});
</script>

<script>
$(document).ready(function() {
    var urll = new URL(window.location.href);
    var mode = urll.searchParams.get("mode");
    var pinCodeId = urll.searchParams.get("id");

    if (mode == 'edit') {
        var countryId = $('#country').val();
        var StateId = $('#stateName').val();
        var cityId = $('#cityName').val();
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                countryId: countryId,
                StateId: StateId,
                cityId: cityId,
                pinCodeId: pinCodeId,
                isPinCodeUpdate: true
            },
            cache: false,
            success: function(result) {
                // console.log(result);
                $("#stateName").html(result);
                // $("#cityName").html(result);
                // $('#city-dropdown').html(
                //     '<option value="">Select State First</option>');
            }
        });

    }
});

$(document).ready(function() {
    var urll = new URL(window.location.href);
    var mode = urll.searchParams.get("mode");
    var pinCodeId = urll.searchParams.get("id");

    if (mode == 'edit') {
        var countryId = $('#country').val();
        var StateId = $('#stateName').val();
        var cityId = $('#cityName').val();
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                countryId: countryId,
                StateId: StateId,
                cityId: cityId,
                pinCodeId: pinCodeId,
                isPinCodeCityUpdate: true
            },
            cache: false,
            success: function(result) {
                // console.log(result);
                // $("#stateName").html(result);
                $("#cityName").html(result);
                // $('#city-dropdown').html(
                //     '<option value="">Select State First</option>');
            }
        });

    }
});
</script>

<!-- *********** Input tag Take only Number and decimal Point ********* -->

<script type="text/javascript">

$(function() {
    $('.allowdecimaldigit').keypress(function(event) {
        var $this = $(this);
        if ((event.which != 46 || $this.val().indexOf('.') != -1) && ((event.which < 48 || event.which >
                57) && (event.which != 0 && event.which != 8))) {
            event.preventDefault();
        }
        var text = $(this).val();
        if (text.length === 18) {
            $(this).val(text + ".")
        }
        if ((event.which == 46) && (text.indexOf('.') == -1)) {
            setTimeout(function() {
                if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                    $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
                }
            }, 1);
        }
        if ((text.indexOf('.') == 18 && text.substring(text.indexOf('.')).length > 2)) {
            event.preventDefault();
        }
        if (((text.indexOf('.') != -1) && (text.substring(text.indexOf('.')).length > 2) && (event
                .which != 0 && event.which != 8) && ($(this)[0].selectionStart >= text.length - 2))) {
            event.preventDefault();
        }
    });
});
</script>

</body>

</html>