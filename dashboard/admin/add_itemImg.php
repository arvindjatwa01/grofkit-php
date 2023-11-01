<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Item Image";
include_once 'header.php';
$strPageTitle2 = "Manage Item Image";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
    
	$sqlTrashRecord = ' DELETE FROM itemimage WHERE 1 AND itImg_Id =' . $_GET['id'];
	$dbh->query($sqlTrashRecord);
	$_SESSION['success_size_image'] = 'Selected Entry removed successfully.';
	redirect('manage_itemImg.php');
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}

$aryErrors = $class_itemImg->sizeProcessRequest('', $strMode);


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND itImg_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'itemimage');
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
									echo "Add Item Image";
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
									echo "Add Item Image";
								} ?>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <?php successmessage('success_size_image') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
								echo $strPageTitle2;
							} else {
								echo "Add Item Image";
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
                                    <label class="col-lg-2 control-label">Item Name<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="itemName" id="itemName">
                                            <option value="0">Select Item</option>
                                            <?php
                                                $count = 0;
                                                $strLoadUserConditions = ' ORDER BY ite_Id DESC ';
                                                $resSelectUserList = $class_common->loadMultipleDataByTableName($strLoadUserConditions, '', '', 0, '', 'item');
                                                if (count($resSelectUserList) > 0) {
                                                    foreach ($resSelectUserList as $rowUser) {
                                                        $count++;
                                                        if($rowUser['ite_Id'] == $rowsizeData['itimg_itemID']){
                                                            $Userselected = "Selected";
                                                        }else{
                                                            $Userselected = "";
                                                        }
                                                ?>


                                            <option <?php echo $Userselected; ?>
                                                value="<?php echo $rowUser['ite_Id']; ?>">
                                                <?php echo $rowUser['ite_Name']; ?></option>
                                            <?php }
											}?>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Item Image(200X200)<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="file" name="itemImg[]" multiple
                                            accept="image/*" id="itemImg" value="<?php if (isset($rowsizeData['itimg_path']) && '' != $rowsizeData['itimg_path']) {
																												echo $rowsizeData['itimg_path'];
																											} ?>" class="form-control" placeholder="Enter Stock Volume">
                                        <input type="hidden" name="oldItemImg" id="oldItemImg" value="<?php if (isset($rowsizeData['itimg_path']) && '' != $rowsizeData['itimg_path']) {
                                                                                                            // $str = substr(strrchr($url, '/'), 1);
                                                                                                            // echo $str;
																												echo $rowsizeData['itimg_path'];
																											} ?>">
                                        <?php if(isset($rowsizeData['itimg_path'])){
                                        echo "<img src='../uploads/item_image/".$rowsizeData['itimg_path']."' alt='Item Image' width='100'>";
                                    }else{
                                        echo "";
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