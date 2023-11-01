<?php include_once 'connection_handle.php';
$strPageTitle = "manage_item ";
include_once 'header.php';
$strPageTitle2 = "manage_item ";

// if (isset($_GET['id']) && '' != $_GET['id']) {
    
// 	$sqlTrashRecord = ' DELETE FROM itemimage WHERE 1 AND itImg_Id =' . $_GET['id'];
// 	$dbh->query($sqlTrashRecord);
// 	$_SESSION['success_size_image'] = 'Selected Entry removed successfully.';
// 	// redirect('manage_itemImg.php');
// }

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}

$aryErrors = $class_itemImg->sizeProcessRequest('', $strMode);


if (isset($_GET['id']) && '' != $_GET['id']) {
	$strLoadCondition = ' AND ite_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'item');
    $itemName = $rowsizeData['ite_Name'];
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
                        <h4><a href="manage_item.php"><i class="icon-arrow-left52 position-left"></i></a> <span
                                class="text-semibold">
                                <?php 
									echo "Add $itemName Images"; ?>
                        </h4>
                    </div>


                </div>
            </div>
            <!-- /page header -->

            <!-- Content area -->
            <div class="content" style="padding: 0 20px 15px 20px;">

                <?php successmessage('success_size_image') ?>
                <?php duplicatedataErr('error_size_image') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="row">
                                <?php 
                                $LoadCondition = " AND ite_Id ='". $_GET['id']."'";
                                // $stFileds = "item.*, product.*";
                                // $strJoinCondition = " LEFT JOIN product ON item.ite_ProdId = product.prod_Id";
                                $LoadResrow = $class_common->loadSingleDataBy($LoadCondition, '', '', 'item');
                                ?>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label"><b>Item Barcode :</b></label>
                                    <div class="col-lg-10 mb-5">
                                        <?php echo $LoadResrow['ite_sku']; ?>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label"><b>Item Description :</b></label>
                                    <div class="col-lg-10 mb-5">
                                    <?php echo $LoadResrow['ite_Descripton']; ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                </div>

            </div>

            <!-- Content area -->
            <div class="content" style="padding: 0 20px 15px 20px;">

                <?php successmessage('success_size_image') ?>
                <?php duplicatedataErr('error_size_image') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="panel-body">

                            <div class="row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Item Image(200X200px)<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-8 mb-5">
                                        <input type="hidden" name="itemName" value="<?php echo $_GET['id']; ?>">
                                        <input type="file" name="itemImg[]" multiple accept="image/*" id="itemImg"
                                            value="<?php if (isset($rowsizeData['itimg_path']) && '' != $rowsizeData['itimg_path']) {
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
                                    <div class="col-lg-2">
                                        <button type="submit" name="submit" onclick="" class="btn btn-primary"
                                            aria-expanded="false">Upload </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
            <div class="content">
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <?php
                                $strLoadConditions = " AND itimg_itemID ='".$_GET['id']."' ORDER BY itImg_Id DESC ";
                                $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'itemimage');
                                if (count($resSelectCouponList) > 0) {
                                    foreach ($resSelectCouponList as $rowSize) {
                            ?>
                            <div class="col-lg-2 text-center" id="<?php echo $rowSize['itImg_Id']; ?>"
                                style="position: relative; border: 1px solid #d9c0c0; margin-right: 10px; margin-top: 10px;">
                                <img src="../uploads/item_image/<?php echo $rowSize['itimg_path'];  ?>" alt="" width="150" height="150"><br>
                                <?php 
                            if($rowSize['itimg_IsMainImage'] == 1){
                                $Mainchecked = "checked";
                            }else{
                                $Mainchecked="";
                            }
                            ?>
                                <input type="radio" value="<?php echo $rowSize['itImg_Id']; ?>" name="mainImage"
                                    <?php echo $Mainchecked; ?>>
                                <div class="removeItemImg" data-imgid=<?php echo $rowSize['itImg_Id']; ?>>X</div>

                            </div>

                            <?php }
                                }
                            ?>
                            <div class="col-lg-2 text-center" style="margin-top: 10px;">
                                <button class="btn btn-primary" id="createMain" data-itemid=<?php echo $_GET['id']; ?> aria-expanded="false">Create Main
                                    Image</button>
                            </div>
                        </div>
                    </div>
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
    $(document).on("click", '.removeItemImg', function() {
        var imgId = $(this).data("imgid");
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                imgId: imgId,
                isremoveImg: true
            },
            success: function(data) {
                console.log(data);
                $("#" + imgId).hide();
            },
            error: function(data) {
                console.log(data);
            }
        })
    });
});
</script>
<script>
    
$(document).on("click", '#createMain', function() {
    var isMainImg = $("input[name='mainImage']:checked").val();
    var itemId = $(this).data("itemid");
    if (isMainImg != undefined) {
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                itemId: itemId,
                isMainImg: isMainImg,
                isCreateMainImg: true
            },
            success: function(data) {
                $("#createMain").removeClass("btn btn-primary");
                $("#createMain").addClass("btn btn-success");
                $("#createMain").html("Created");
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
    } else {
        alert("Please Select an Image");
    }
});
</script>