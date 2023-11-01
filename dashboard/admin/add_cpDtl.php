<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Coupen Detail";
include_once 'header.php';
$strPageTitle2 = "Manage Coupen Detail";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
    
	$sqlTrashRecord = ' DELETE FROM coupandtl WHERE 1 AND CpDtl_Id =' . $_GET['id'];
	$dbh->query($sqlTrashRecord);
	$_SESSION['success_coupandtl_msg'] = 'Selected Entry removed successfully.';
	redirect('manage_coupan.php');
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}

$aryErrors = $class_cpDtl->sizeProcessRequest('', $strMode);


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND CpDtl_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'coupandtl');
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
                        <h4><a href="manage_cpDtl.php"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Coupan Detail";
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
									echo "Add Coupen Detail";
								} ?>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <?php successmessage('success_coupandtl_msg') ?>
                <?php duplicatedataErr('error_coupandtl_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
								echo $strPageTitle2;
							} else {
								echo "Add Coupan Detail";
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
                                    <label class="col-lg-2 control-label">Coupan Code<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="cpCode" id="cpCode">
                                            <option value="0">Select Coupan Code</option>
                                            <?php
                                                $Cselected = '';
                                                $strLoadCpConditions = ' ORDER BY Cp_ID DESC ';
                                                $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadCpConditions, '', '', 0, '', 'coupen');
                                                if (count($resSelectCouponList) > 0) {
                                                    foreach ($resSelectCouponList as $rowCoupan) {
                                                       
                                                        if(isset($rowsizeData['CpDtl_CPID'])){
                                                            if($rowCoupan['Cp_ID'] == $rowsizeData['CpDtl_CPID']){
                                                                $Cselected = "Selected";
                                                            }else{
                                                                $Cselected = "";
                                                            }
                                                        }
                                                        
                                                ?>


                                            <option <?php echo $Cselected; ?>
                                                value="<?php echo $rowCoupan['Cp_ID']; ?>">
                                                <?php echo $rowCoupan['CP_Code']; ?></option>
                                            <?php }
											}?>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Item<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="itemName" id="itemName">
                                            <option value="0">Select Item</option>
                                            <?php
                                                $Itemselected = '';
                                                $strLoadItemConditions = ' ORDER BY ite_Id DESC ';
                                                $resSelectItemList = $class_common->loadMultipleDataByTableName($strLoadItemConditions, '', '', 0, '', 'item');
                                                if (count($resSelectItemList) > 0) {
                                                    foreach ($resSelectItemList as $rowItem) {
                                                        
                                                        if(isset($rowsizeData['CpDtl_itemID'])){
                                                            if($rowItem['ite_Id'] == $rowsizeData['CpDtl_itemID']){
                                                                $Itemselected = "Selected";
                                                            }else{
                                                                $Itemselected = "";
                                                            }
                                                        }
                                                        
                                                ?>


                                            <option <?php echo $Itemselected; ?>
                                                value="<?php echo $rowItem['ite_Id']; ?>">
                                                <?php echo $rowItem['ite_Name']; ?></option>
                                            <?php }
											}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">User Name<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="userName" id="userName">
                                            <option value="0">Select User</option>
                                            <?php
                                                $Userselected = '';
                                                $strLoadUserConditions = ' ORDER BY us_Id DESC ';
                                                $resSelectUserList = $class_common->loadMultipleDataByTableName($strLoadUserConditions, '', '', 0, '', 'mstuser');
                                                if (count($resSelectUserList) > 0) {
                                                    foreach ($resSelectUserList as $rowUser) {
                                                        if(isset($rowsizeData['CpDtl_UserID'])){
                                                            
                                                            if($rowUser['us_Id'] == $rowsizeData['CpDtl_UserID']){
                                                                $Userselected = "Selected";
                                                            }else{
                                                                $Userselected = "";
                                                            }
                                                        }
                                                ?>


                                            <option <?php echo $Userselected; ?>
                                                value="<?php echo $rowUser['us_Id']; ?>">
                                                <?php 
                                                if($rowUser['us_UserName'] != ''){
                                                    echo $rowUser['us_UserName']."(".$rowUser['us_EmailID'].")";
                                                }else{
                                                    echo $rowUser['us_EmailID'];
                                                }
                                                 ?></option>
                                            <?php }
											}?>
                                        </select>

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

</body>

</html>
<script>
function removecontenthtml1(object) {
    var confirms = confirm('Are you sure you want to remove this file');
    if (confirms) {
        object.$('.appendimage').remove();

    }

}
</script>
<script>
function imgSize(objectElement) {
    var srcdata = objectElement.attr('data-src');
    var title = objectElement.attr('data-title');
    var dataid = objectElement.attr('data-id');

    $('#imageurl').val(srcdata);
    $('#imagedata').attr('src', srcdata);
    $('#imagename').html(title);

    $('#galleryId').val(dataid);

}
</script>
<script>
function updatetitloe(objectElement) {
    objectElement.html('processing...');
    var title_name = $('#image_name').val();

    var title_id = $('#galleryId').val();
    var datatype = 'imagename=' + title_name + '&galleryId=' + title_id;
    $.post('ajaxtitle.php', datatype, function(response) {
        objectElement.html('Save');
        $('#closePopUp').trigger('click');

    });
}
</script>