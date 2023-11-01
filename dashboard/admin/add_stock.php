<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Stock";
include_once 'header.php';
$strPageTitle2 = "Manage Stock";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
    
	$sqlTrashRecord = ' DELETE FROM stock WHERE 1 AND stk_Id =' . $_GET['id'];
	$dbh->query($sqlTrashRecord);
	$_SESSION['success_size_image'] = 'Selected Entry removed successfully.';
	redirect('manage_stock.php');
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}

$aryErrors = $class_stock->sizeProcessRequest('', $strMode);


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND stk_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'stock');
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
                        <h4><a href="manage_stock.php"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Stock";
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
									echo "Add Stock";
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
								echo "Add Stock";
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
                                        <select class="form-control" name="prodName" id="prodName">
                                            <option value="0">Select Product</option>
                                            <?php
                                                $strLoadUserConditions = ' ORDER BY prod_Id DESC ';
                                                $resSelectUserList = $class_common->loadMultipleDataByTableName($strLoadUserConditions, '', '', 0, '', 'product');
                                                if (count($resSelectUserList) > 0) {
                                                    foreach ($resSelectUserList as $rowUser) {
                                                        $Userselected ='';
                                                       if(isset($rowsizeData['stk_prodid']))
                                                       {
                                                        if($rowUser['prod_Id'] == $rowsizeData['stk_prodid']){
                                                            $Userselected = "Selected";
                                                        }else{
                                                            $Userselected = "";
                                                        }
                                                       }
                                                ?>


                                            <option <?php echo $Userselected; ?>
                                                value="<?php echo $rowUser['prod_Id']; ?>">
                                                <?php echo $rowUser['prod_Name']; ?></option>
                                            <?php }
											}?>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Item Name<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="itemName" id="itemName">
                                            <option value="0">Select Item</option>
                                            
                                        </select>

                                    </div>
                                </div>
                                <!--<div class="form-group">-->
                                    <!--<label class="col-lg-2 control-label">Stock Attribute<span class="required"-->
                                    <!--        style="color:red ;">*</span> :</label>-->
                                    <!--<div class="col-lg-10 mb-5">-->
                                    <!--    <select class="form-control" name="attName" id="attName">-->
                                            <!--<option value="0">Select Attribute</option>-->
                                            <?php
                                            
                                                $strLoadItemConditions = ' ORDER BY att_Id DESC ';
                                                $resSelectItemList = $class_common->loadMultipleDataByTableName($strLoadItemConditions, '', '', 0, '', 'attribute');
                                                if (count($resSelectItemList) > 0) {
                                                    foreach ($resSelectItemList as $rowItem) {
                                                        if(isset($rowsizeData['cartDtl_attid'])){
                                                            if($rowItem['att_Id'] == $rowsizeData['cartDtl_attid']){
                                                                $Itemselected = "Selected";
                                                            }else{
                                                                $Itemselected = "";
                                                            }
                                                        }
                                                        
                                                ?>


                                            <!--<option <?php echo $Itemselected; ?>-->
                                            <!--    value="<?php echo $rowItem['att_Id']; ?>">-->
                                            <!--    <?php echo $rowItem['att_Name']; ?></option>-->
                                            <?php }
											}?> 
                                <!--        </select>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Stock Unit<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="unitCode" id="unitCode" style="-webkit-appearance: none;" readonly>
                                            <option value="0">Select product at first</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-lg-2 control-label">User Name<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <select class="form-control" name="userName" id="userName">
                                            <option value="0">Select User</option>
                                            <?php
                                                $count = 0;
                                                $strLoadItemConditions = ' ORDER BY us_Id DESC ';
                                                $resSelectItemList = $class_common->loadMultipleDataByTableName($strLoadItemConditions, '', '', 0, '', 'mstuser');
                                                if (count($resSelectItemList) > 0) {
                                                    foreach ($resSelectItemList as $rowItem) {
                                                        $count++;
                                                        if($rowItem['us_Id'] == $rowsizeData['stk_UserID']){
                                                            $Itemselected = "Selected";
                                                        }else{
                                                            $Itemselected = "";
                                                        }
                                                ?>


                                            <option <?php echo $Itemselected; ?>
                                                value="<?php echo $rowItem['us_Id']; ?>">
                                                <?php echo $rowItem['us_UserName']; ?></option>
                                            <?php }
											}?>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <label class="col-lg-4 control-label">Volume<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-8 mb-5">
                                        <input type="text" name="stockVol" id="stockVol" value="<?php if (isset($rowsizeData['stl_Volumns']) && '' != $rowsizeData['stl_Volumns']) {
																												echo $rowsizeData['stl_Volumns'];
																											} ?>" class="form-control" placeholder="Enter Stock Volume"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <label class="col-lg-3 control-label">Remove :</label>
                                    <div class="col-lg-9 mb-5">
                                        <input type="text" name="stockRemoveVol" id="stockVol" value="<?php if (isset($rowsizeData['stl_Volumns']) && '' != $rowsizeData['stl_Volumns']) {
																												echo $rowsizeData['stl_Volumns'];
																											} ?>" class="form-control" placeholder="Enter Stock Volume"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="0">
                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           <!--     <div class="form-group">-->
                           <!--         <label class="col-lg-2 control-label">Volume<span class="required"-->
                           <!--                 style="color:red ;">*</span> :</label>-->
                           <!--         <div class="col-lg-10 mb-5">-->
                           <!--             <input type="text" name="stockVol" id="stockVol" value="<?php //if (isset($rowsizeData['stl_Volumns']) && '' != $rowsizeData['stl_Volumns']) {-->
																												//echo $rowsizeData['stl_Volumns'];
																											//} ?>" class="form-control" placeholder="Enter Stock Volume"-->
                           <!--                 onkeypress="return event.charCode >= 48 && event.charCode <= 57">-->
                           <!--         </div>-->
                           <!--     </div>-->


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
    $('#prodName').on('change', function() {
        var product_id = this.value;
        // console.log(product_id);
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                productId: product_id,
                isStockProdId: true
            },
            success: function(data){
                // console.log(data);
                var res = JSON.parse(data);
                $("#unitCode").html(res[0]);
                $('#itemName').html(res[1]);
            }
        });
    });
    $('#itemName').on('change', function() {
        var itemId = this.value;
        // console.log(itemId);
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                itemId: itemId,
                isStockItemId: true
            },
            success: function(data){
                console.log(data);

                // var res = JSON.parse(data);
                $("#attName").html(data);
                // $('#itemName').html(res[1]);
            }
        });
    });
});
</script>