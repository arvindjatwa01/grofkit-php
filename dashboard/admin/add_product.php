<?php include_once 'connection_handle.php';
$strPageTitle = "Add Product";
include_once 'header.php';
$strPageTitle2 = "Edit Product";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {

    try {
		$dbh->query("DELETE FROM product WHERE 1 AND prod_Id= '". $_GET['id']."'");
		$_SESSION['success_product_msg'] = 'Record Delete Successfully.';
		redirect('manage_product.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_product_msg'] = "Record used anywhere";
			redirect('manage_product.php');
		}
	}
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}

$aryErrors = $class_prod->sizeProcessRequest('', $strMode);


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND prod_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'product');
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
                        <h4><a href="manage_product.php"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Product";
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
									echo "Add Product";
								} ?>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <?php successmessage('success_product_msg') ?>
                <?php duplicatedataErr('error_product_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
								echo $strPageTitle2;
							} else {
								echo "Add Product";
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
                                    <label class="col-lg-2 control-label">Product Name<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="prodName" id="prodName" value="<?php if (isset($rowsizeData['prod_Name']) && '' != $rowsizeData['prod_Name']) {
																							echo $rowsizeData['prod_Name'];
																						} ?>" class="form-control" placeholder="Enter Product Name">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Category<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="categoryName" id="categoryName">
                                            <option select value="0">Select Category</option>
                                            <?php
										$count = 0;
										$strLoadConditions = ' ORDER BY cat_Name ASC ';
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'category');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
												if($rowSize['cat_Id'] == $rowsizeData['prod_CatID']){
													$selected = "Selected";
												}else{
													$selected = "";
												}
										?>
                                            <option <?php echo $selected; ?> value="<?php echo $rowSize['cat_Id']; ?>">
                                                <?php echo $rowSize['cat_Name']; ?></option>


                                            <?php }
											}?>
                                        </select>


                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Product Description<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="prodDesc" id="prodDesc" value="<?php if (isset($rowsizeData['prod_description']) && '' != $rowsizeData['prod_description']) {
																							echo $rowsizeData['prod_description'];
																						} ?>" class="form-control" placeholder="Enter Product Description Code">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">HSNCode<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="HSNCode" id="HSNCode" value="<?php if (isset($rowsizeData['prod_HSNCode']) && '' != $rowsizeData['prod_HSNCode']) {
																							echo $rowsizeData['prod_HSNCode'];
																						} ?>" class="form-control" placeholder="Enter HSN Code">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Delivery Cost<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="prodDelCost" id="prodDelCost" value="<?php if (isset($rowsizeData['prod_DeliveryCost']) && '' != $rowsizeData['prod_DeliveryCost']) {
																							echo $rowsizeData['prod_DeliveryCost'];
																						} ?>" class="form-control" placeholder="Enter Product Delivary Cost"
                                            >

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Unit<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="unitName" id="unitName">
                                            <option select value="0">Select unit</option>
                                            <?php
										$count = 0;
										$strLoadConditions = ' ORDER BY un_ID ASC ';
                                        
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'unit');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
												if($rowSize['un_ID'] == $rowsizeData['prod_unitId']){
													$selected = "Selected";
												}else{
													$selected = "";
												}
										?>
                                            <option <?php echo $selected; ?> value="<?php echo $rowSize['un_ID']; ?>">
                                                <?php echo $rowSize['un_Code']; ?></option>


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


<!-- *********** Input tag Take only Number and decimal Point ********* -->

<script type="text/javascript">
    $(function() {
        $('#prodDelCost').keypress(function(event) {
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
