<?php include_once 'connection_handle.php';
$strPageTitle = "Add Attribute Item";
include_once 'header.php';
$strPageTitle2 = "Edit Attribute Item";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
    
	$sqlTrashRecord = ' DELETE FROM attributedtl WHERE 1 AND iteAtt_id =' . $_GET['id'];
	$dbh->query($sqlTrashRecord);
	$_SESSION['success_size_image'] = 'Selected Entry removed successfully.';
	redirect('manage_attItem.php');
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}

$aryErrors = $class_attItem->sizeProcessRequest('', $strMode);


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND iteAtt_id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'attributeitem');
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
                        <h4><a href="manage_attItem.php"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Attribute Item";
								} ?></h4>
                    </div>


                </div>

                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL; ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>
                        <li>
                            <a href="#">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Attribute Item";
								} ?>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <?php successmessage('success_attributeItem_msg') ?>
                <?php duplicatedataErr('error_attributeItem_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
								echo $strPageTitle2;
							} else {
								echo "Add Attribute Item";
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
                                    <label class="col-lg-2 control-label">Attribute Item<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="itemName" id="itemName">
                                            <option value="0">Select Attribute Item</option>
                                            <?php
                                                $count = 0;
                                                $strLoadConditions = ' ORDER BY ite_Id ASC ';
                                                $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'item');
                                                if (count($resSelectCouponList) > 0) {
                                                    foreach ($resSelectCouponList as $rowSize) {
                                                        $count++;
                                                        if($rowSize['ite_Id'] == $rowsizeData['iteAtt_itemID']){
                                                            $selected = "Selected";
                                                        }else{
                                                            $selected = "";
                                                        }
                                            ?>


                                            <option <?php echo $selected; ?> value="<?php echo $rowSize['ite_Id']; ?>">
                                                <?php echo $rowSize['ite_Name']; ?></option>
                                            <?php }
											}?>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Attribute Name<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="attName" id="attName">
                                            <option value="0">Select Attribute</option>
                                            <?php
                                                $strLoadConditions = ' ORDER BY att_Id ASC ';
                                                $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'attribute');
                                                if (count($resSelectCouponList) > 0) {
                                                    foreach ($resSelectCouponList as $rowSize) {
                                                        if(isset($rowsizeData['iteAtt_attid'])){

                                                            if($rowSize['att_Id'] == $rowsizeData['iteAtt_attid']){
                                                                $selected = "Selected";
                                                            }else{
                                                                $selected = "";
                                                            }
                                                        }
                                            ?>


                                            <option <?php echo $selected; ?> value="<?php echo $rowSize['att_Id']; ?>">
                                                <?php echo $rowSize['att_Name']; ?></option>
                                            <?php }
											}?>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Attribute Value<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="attValue" id="attValue">
                                            <option value="0">Select Attribute Value</option>
                                            <!-- <?php
                                                $strLoadConditions = ' ORDER BY attd_id ASC ';
                                                $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'attributedtl');
                                                if (count($resSelectCouponList) > 0) {
                                                    foreach ($resSelectCouponList as $rowSize) {
                                                        if($rowSize['attd_attid'] == $rowsizeData['iteAtt_value']){
                                                            $selected = "Selected";
                                                        }else{
                                                            $selected = "";
                                                        }
                                            ?>


                                            <option <?php echo $selected; ?> value="<?php echo $rowSize['attd_id']; ?>">
                                                <?php echo $rowSize['attd_value']; ?></option>
                                            <?php }
											}?> -->
                                        </select>

                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-lg-2 control-label">Attribute Value<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="attValue" id="attValue" value="<?php if (isset($rowsizeData['iteAtt_value']) && '' != $rowsizeData['iteAtt_value']) {
																							echo $rowsizeData['iteAtt_value'];
																						} ?>" class="form-control" placeholder="Enter Attribute Value"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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

</body>

</html>
<script>
$(document).ready(function() {
    $('#attName').on('change', function() {
        // var attributeId = $("#attName option:selected").val();
        var attributeId = this.value;
        // console.log(attributeId);
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                attributeId: attributeId,
                isattributeValSel: true
            },
            success: function(data){
                // console.log(data);
                $('#attValue').html(data);
            }
        });
    });
});
// $(document).ready(function() {
//     var attributeId = $("#attName option:selected").val();
//     console.log(attributeId);
// });
</script>