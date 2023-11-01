<?php include_once 'connection_handle.php';
$strPageTitle = "Add Cart";
include_once 'header.php';
$strPageTitle2 = "Edit Cart";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {

    try {
		$dbh->query("DELETE FROM cart WHERE 1 AND cart_Id= '". $_GET['id']."'");
		$_SESSION['success_cart_msg'] = 'Record Delete Successfully.';
		redirect('manage_cart.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_cart_msg'] = "Record used anywhere";
			redirect('manage_cart.php');
		}
	}
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}

$aryErrors = $class_cart->sizeProcessRequest('', $strMode);


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND cart_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'cart');
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
									echo "Add Cart";
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
									echo "Add Cart";
								} ?>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <?php successmessage('success_cart_image') ?>
                <?php duplicatedataErr('error_cart_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
								echo $strPageTitle2;
							} else {
								echo "Add Cart";
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
                                    <label class="col-lg-2 control-label">User Name<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="userName" id="userName">
                                            <option value="0">Select User</option>
                                            <?php
                                                $count = 0;
                                                $strLoadUserConditions = ' ORDER BY us_Id DESC ';
                                                $resSelectUserList = $class_common->loadMultipleDataByTableName($strLoadUserConditions, '', '', 0, '', 'mstuser');
                                                if (count($resSelectUserList) > 0) {
                                                    foreach ($resSelectUserList as $rowUser) {
                                                        $count++;
                                                        if($rowUser['us_Id'] == $rowsizeData['cart_UserID']){
                                                            $Userselected = "Selected";
                                                        }else{
                                                            $Userselected = "";
                                                        }
                                                ?>


                                            <option <?php echo $Userselected; ?>
                                                value="<?php echo $rowUser['us_Id']; ?>">
                                                <?php echo $rowUser['us_UserName']; ?></option>
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
                                                $count = 0;
                                                $strLoadItemConditions = ' ORDER BY ite_Id DESC ';
                                                $resSelectItemList = $class_common->loadMultipleDataByTableName($strLoadItemConditions, '', '', 0, '', 'item');
                                                if (count($resSelectItemList) > 0) {
                                                    foreach ($resSelectItemList as $rowItem) {
                                                        $count++;
                                                        if($rowItem['ite_Id'] == $rowsizeData['cart_itemId']){
                                                            $Itemselected = "Selected";
                                                        }else{
                                                            $Itemselected = "";
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
                                    <label class="col-lg-2 control-label">Cart Volume<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="cartVolume" id="cartVolume" value="<?php if (isset($rowsizeData['cart_volume']) && '' != $rowsizeData['cart_volume']) {
																												echo $rowsizeData['cart_volume'];
																											} ?>" class="form-control" placeholder="Enter Cart Volume"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Unit<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="cartUnit" id="cartUnit">
                                            <option value="0">Select Cart Unit</option>
                                            <?php
                                                $count = 0;
                                                $strLoadCpConditions = ' ORDER BY un_Id DESC ';
                                                $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadCpConditions, '', '', 0, '', 'unit');
                                                if (count($resSelectCouponList) > 0) {
                                                    foreach ($resSelectCouponList as $rowCoupan) {
                                                        $count++;
                                                        if($rowCoupan['un_ID'] == $rowsizeData['cart_UnitId']){
                                                            $Cselected = "Selected";
                                                        }else{
                                                            $Cselected = "";
                                                        }
                                                ?>
                                            <option <?php echo $Cselected; ?>
                                                value="<?php echo $rowCoupan['un_ID']; ?>">
                                                <?php echo $rowCoupan['un_Code']; ?></option>
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