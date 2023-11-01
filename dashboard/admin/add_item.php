<?php include_once 'connection_handle.php';
$strPageTitle = "Add Item";
include_once 'header.php';
$strPageTitle2 = "Edit Item";
$AttributeDisplay = "style=display:none;";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
    try {
		$dbh->query("DELETE FROM item WHERE 1 AND ite_Id= '". $_GET['id']."'");
		$_SESSION['success_item_msg'] = 'Record Delete Successfully.';
		redirect('manage_item.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_item_msg'] = "Record used anywhere";
			redirect('manage_item.php');
		}
	}
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}

$aryErrors = $class_item->sizeProcessRequest('', $strMode);


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND ite_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'item');
    $AttributeDisplay = "style=display:block;";
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
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Item";
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
									echo "Add Item";
								} ?>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content" style="padding: 0 20px 0px 20px;">

                <?php successmessage('success_item_msg') ?>
                <?php duplicatedataErr('error_item_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
								echo $strPageTitle2;
							} else {
								echo "Add Item";
							} ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                        <div class="heading-elements">
                            <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') { ?>
                            <a href="add_attribute_price.php?id=<?php echo $_GET['id']; ?>"
                                class="btn btn-info btn-xs"><b><i class="icon-plus3"></i></b> Attribute Price</a>
                            <?php } ?>
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
                                <div class="col-lg-12">
                                    <div class="row">
                                        <label class="col-lg-2 control-label">Product Name<span class="required"
                                                style="color:red ;">*</span> :</label>
                                        <div class="col-lg-10 mb-5">
                                            <select class="form-control" name="prodName" id="prodName">
                                                <option value="0">Select Product</option>
                                                <?php
                                                    $strLoadConditions = ' ORDER BY prod_Id ASC ';
                                                    
                                                    $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'product');
                                                    if (count($resSelectCouponList) > 0) {
                                                        foreach ($resSelectCouponList as $rowSize) {
                                                            if(isset($rowsizeData['ite_ProdId'])){

                                                            }
                                                            if($rowSize['prod_Id'] == $rowsizeData['ite_ProdId']){
                                                                $selected = "Selected";
                                                            }else{
                                                                $selected = "";
                                                            }
                                                ?>
                                                <option <?php echo $selected; ?>
                                                    value="<?php echo $rowSize['prod_Id']; ?>">
                                                    <?php echo $rowSize['prod_Name']; ?>
                                                </option>
                                                <?php }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <label class="col-lg-4 control-label">Item Name<span class="required"
                                                        style="color:red ;">*</span> :</label>
                                                <div class="col-lg-8 mb-5">
                                                    <input type="text" name="itemName" id="itemName" value="<?php if (isset($rowsizeData['ite_Name']) && '' != $rowsizeData['ite_Name']) {
                                                                                                echo $rowsizeData['ite_Name'];
                                                                                            } ?>" class="form-control"
                                                        placeholder="Enter Item Name">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <label class="col-lg-4 control-label">Item Barcode :</label>
                                                <div class="col-lg-8 mb-5">
                                                    <input type="text" name="itemsku" id="itemsku" value="<?php if (isset($rowsizeData['ite_sku']) && '' != $rowsizeData['ite_sku']) {
																							echo $rowsizeData['ite_sku'];
																						} ?>" class="form-control" placeholder="Enter Item Barcode">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="row">
                                        <label class="col-lg-2 control-label">Item Description :</label>
                                        <div class="col-lg-10 mb-5">
                                            <input type="text" name="itemDesc" id="itemDesc" value="<?php if (isset($rowsizeData['ite_Descripton']) && '' != $rowsizeData['ite_Descripton']) {
                                                                                                echo $rowsizeData['ite_Descripton'];
                                                                                            } ?>" class="form-control"
                                                placeholder="Enter Item Description">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="row">
                                                <label class="col-lg-6 control-label">Base Rate :</label>
                                                <div class="col-lg-6 mb-5">
                                                    <input type="text" name="itemBaseRate" id="itemBaseRate" value="<?php if (isset($rowsizeData['ite_BaseRate']) && '' != $rowsizeData['ite_BaseRate']) {
																							echo $rowsizeData['ite_BaseRate'];
																						} ?>" class="form-control allowdecimaldigit" placeholder="Enter Item Base Rate">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row">
                                                <label class="col-lg-6 control-label">Item Rate<span class="required"
                                                        style="color:red ;">*</span> :</label>
                                                <div class="col-lg-6 mb-5">
                                                    <input type="text" name="itemRate" id="itemRate" value="<?php if (isset($rowsizeData['ite_Rate']) && '' != $rowsizeData['ite_Rate']) {
																							echo $rowsizeData['ite_Rate'];
																						} ?>" class="form-control allowdecimaldigit" placeholder="Enter Item Rate">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row">
                                                <label class="col-lg-6 control-label">Item MRP :</label>
                                                <div class="col-lg-6 mb-5">
                                                    <input type="text" name="itemMRP" id="itemMRP" value="<?php if (isset($rowsizeData['ite_MRP']) && '' != $rowsizeData['ite_MRP']) {
																							echo $rowsizeData['ite_MRP'];
																						} ?>" class="form-control allowdecimaldigit" placeholder="Enter Item MRP">
                                                    <span id='mrpErr'></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3" <?php echo $AttributeDisplay ?>>
                                    <div class="row">
                                        <label class="col-lg-2 control-label">Add Attribute <span class="required"
                                                style="color:red ;">*</span> :</label>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="attName" id="attName">
                                                <option value="0">Select Attribute</option>
                                                <?php
                                                $strLoadConditions = ' ORDER BY att_Id ASC ';
                                                $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'attribute');
                                                if (count($resSelectCouponList) > 0) {
                                                    foreach ($resSelectCouponList as $rowSize) {
                                            ?>
                                                <option <?php echo $selected; ?>
                                                    value="<?php echo $rowSize['att_Id']; ?>">
                                                    <?php echo $rowSize['att_Name']; ?></option>
                                                <?php }
											}?>
                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <button type="button" name="addAtt" id="addAtt" class="btn btn-primary"
                                                aria-expanded="false" onclick="getAttval()">ADD </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- </form> -->
                </div>
                <?php
                   $AttributeItemSql = "SELECT iteAtt_attid FROM `attributeitem` where `iteAtt_itemID`=".$_GET['id']." group by iteAtt_attid";
                   $AttributeItemRes = $dbh->query($AttributeItemSql);
                   $AttributeItemFetchData = $AttributeItemRes->fetchAll();
                   
                ?>

            </div>
            <!-- <div class="content"> -->
            <div class="col-lg-12" style="padding-right: 25px;">
                <div class="row">
                    <label class="col-lg-2 control-label">&nbsp;</label>
                    <div class="col-lg-10 text-right">
                        <button type="submit" name="submit" onclick="" class="btn btn-primary"
                            aria-expanded="false">Upload </button>
                    </div>
                </div>
            </div>
            </form>
            <!-- </div> -->
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

<script>
/* ================== Get Attribute Value Script Code ================== */

function getAttval() {
    var attVal = $("#attName option:selected").val();
    var item = <?php echo $_GET['id']; ?>;
    if (attVal == 0) {
        $('#detailAtt').css('display', 'none');
    } else {
        var selAttValue = attVal;
        $.ajax({
            url: 'action.php',
            type: 'POST',
            async: false,
            data: {
                selAttribute: selAttValue,
                item: item,
                isItemAtt: true
            },
            success: function(data) {
                var mydata = JSON.parse(data);
                $('.content').append(
                    '<div class="panel panel-default" id="detailAtt"><div class="panel-body"><div class="col-lg-12"><p><span class="required" style="color:red ;">*</span> To set default Attribute for this item, select/check the checkbox/radio button</p></div><div class="col-lg-12 mb-5"><div class="row" id="attributDtl' +
                    attVal + '"></div></div><div class="col-lg-12" id="attValList' + attVal +
                    '" style="display: none;"></div></div></div>');

                $('#attributDtl' + attVal).html(mydata[1]);
                if (mydata[0] == 1) {
                    $('#attValList' + attVal).css('display', 'block');
                    $('#attValList' + attVal).append(mydata[2]);
                    $('#' + attVal).append(mydata[3]);
                    // $("#attName option[value="+selAttValue+"]").remove();
                    // console.log($("#attName").find(selAttValue));
                    // .remove();

                } else {
                    $('#attValList' + attVal).css('display', 'none');
                }
            }
        });
        $("#attName option[value=" + selAttValue + "]").remove();
    }
}
$(document).ready(function() {
    var values = <?php echo json_encode($AttributeItemFetchData);  ?>;
    var selectfrom = document.getElementById('attName');
    var addbutton = document.getElementById('addAtt');
    for (var rowi = 0; rowi < values.length; rowi++) {
        selectfrom.value = values[rowi][0];
        addbutton.click();
    }
    selectfrom.value = 0;

});
/* ================ Add Attribute Value Script Code =============== */

$(document).on("click", ".addAttvalue", function() {
    var attributeId = $(this).data("attid");
    $('#attValList' + attributeId).css('display', 'block');
    var value = $("#attValues" + attributeId + " option:selected").text();
    var selectedAtt = $("#SelattName option:selected").val();
    var attVal = $("#attValues" + attributeId + " option:selected").val();
    var item = <?php echo $_GET['id']; ?>;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            attributeId: attributeId,
            attval: attVal,
            item: item,
            isAddattributeItem: true
        },
        success: function(data) {
            console.log(data);
            $('#attValList' + attributeId).append(data);
        }

    });
});

/* ================ Script For Singal Choise Attribute ================ */

$(document).on("change", ".schoisedata", function() {
    var dtlAttId = $(this).data("idvalue");
    var dtlId = $(this).data("idvalue2");


    var value = $("#SchoiseValues" + dtlId + " option:selected").text();
    var attVal = $("#SchoiseValues" + dtlId + " option:selected").val();

});


/* ================ Delete Attribute Iteam ================= */

$(document).on("click", ".delete-btn", function(e) {
    if (confirm("Do you really want to delete this record ?")) {
        var attdtlId = $(this).data("id");
        var itemId = <?php echo $_GET['id']; ?>;
        var attId = $(this).data("attid");
        var element = this;
        console.log(attId);
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                attdtlId: attdtlId,
                attId: itemId,
                attId: attId,
                iddelAttItem: true
            },
            success: function(data) {
                console.log(data);
                $('#' + attdtlId).remove();
            }
        });
        // $('#' + attdtlId).hide();
    }
});
</script>
<script>
$(document).on("change", '.ismultipleAtt', function() {
    isChecked = $(this).is(':checked');
    var itemAttid = $(this).data('attitemid');

    if (isChecked) {
        var isdefault= 1
    } else {
        var isdefault= 0
    }
    $.ajax({
        url: 'action.php',
        type: "POST",
        data:{
            isdefault: isdefault,
            itemAttid: itemAttid,
            isdefaultAttItemValue: true
        },
        success: function(data){
            console.log(data);
        }
    });
});
$(document).on("change", '.ismultipleAtt', function() {
    isChecked = $(this).is(':checked');
    var itemAttid = $(this).data('attitemid');

    if (isChecked) {
        var isdefault= 1
    } else {
        var isdefault= 0
    }
    $.ajax({
        url: 'action.php',
        type: "POST",
        data:{
            isdefault: isdefault,
            itemAttid: itemAttid,
            isMultipledefaultAttItemValue: true
        },
        success: function(data){
            console.log(data);
        }
    });
});
$(document).on("change", '.isSingleAtt', function(){
    isChecked = $(this).is(':checked');

    if (isChecked) {
        var isdefault= 1
    } else {
        var isdefault= 0
    }
    var itemid = $(this).data('itemid');
    var Attributeid = $(this).data('attributeid');
    var itemAttid = $(this).data('attitemid');
    $.ajax({
        url: 'action.php',
        type: "POST",
        data:{
            isdefault: isdefault,
            itemid: itemid,
            Attributeid: Attributeid,
            itemAttid: itemAttid,
            isSingledefaultAttItemValue: true
        },
        success: function(data){
            console.log(data);
        }
    });


})
</script>