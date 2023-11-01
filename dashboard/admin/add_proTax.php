<?php include_once 'connection_handle.php';
$strPageTitle = "Add Product Tax";
include_once 'header.php';
$strPageTitle2 = "Edit Product Tax";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
    
	$sqlTrashRecord = ' DELETE FROM producttax WHERE 1 AND Prot_Id =' . $_GET['id'];
	$dbh->query($sqlTrashRecord);
	$_SESSION['success_size_image'] = 'Selected Entry removed successfully.';
	redirect('manage_proTax.php');
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}

// $aryErrors = $class_proTax->sizeProcessRequest('', $strMode);


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND Prot_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'producttax');
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
        <div class="content-wrapper mainDataDiv">

            <!-- Page header -->
            <div class="page-header page-header-default" id="page-header">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><a href="index.php"><i class="icon-arrow-left52 position-left"></i></a> <span
                                class="text-semibold">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Product Tax";
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
									echo "Add Product Tax";
								} ?>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <?php successmessage('success_productTAx_msg') ?>
                <?php duplicatedataErr('error_productTAx_msg') ?>
                <!-- Both borders -->
                <div class="alert alert-success" id="error-message" display="none">
                </div>
                <div id="success-message"></div>
                <div class="panel panel-default" id="TaxformData">
                    <div class="alert alert-warning" id="success" style="display:none">
                        <span class="text-semibold" style="padding-bottom:10px;">Warning!</span> For Complete Upload
                        Please Click Save Image Button.
                    </div>
                    <form action="" id="proTaxForm" method="post" enctype="multipart/form-data">
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <!-- style="width: 22%;" -->
                                            <label class="col-lg-2 control-label">Product
                                                Name<span class="required" style="color:red ;">*</span> :</label>
                                            <div class="col-lg-10 mr-3 mb-5">
                                                <select class="form-control" name="prodName" id="prodName">
                                                    <option value="0">Select Product</option>
                                                    <?php
										                $strLoadConditions = ' ORDER BY prod_Id ASC ';
                                                        $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'product');
										                if (count($resSelectCouponList) > 0) {
											                foreach ($resSelectCouponList as $rowSize) {
												                if($rowSize['prod_Id'] == $rowsizeData['Prot_ProdID']){
													                $selected = "Selected";
												                }else{
													                $selected = "";
												                }
										            ?>
                                                    <option <?php echo $selected; ?>
                                                        value="<?php echo $rowSize['prod_Id']; ?>">
                                                        <?php echo $rowSize['prod_Name']; ?></option>


                                                    <?php 
                                                            }
											            }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <label class="col-lg-4 control-label">Tax Name<span class="required"
                                                    style="color:red ;">*</span> :</label>
                                            <div class="col-lg-8 mb-5">
                                                <input type="text" name="proTaxName" id="proTaxName" value="<?php if (isset($rowsizeData['Prot_Name']) && '' != $rowsizeData['Prot_Name']) {
																							echo $rowsizeData['Prot_Name'];
																						} ?>" class="form-control" placeholder="Enter Product Tax Name">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <label class="col-lg-4 control-label">CGST(in %)<span class="required"
                                                    style="color:red ;">*</span> :</label>
                                            <div class="col-lg-8 mb-5">
                                                <input type="text" name="proCgst" id="proCgst" value="<?php if (isset($rowsizeData['Prot_Cgst']) && '' != $rowsizeData['Prot_Cgst']) {
																							echo $rowsizeData['Prot_Cgst'];
																						} ?>" class="form-control" placeholder="Enter Product Current GST" maxlength="2"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <label class="col-lg-4 control-label">SGST(in %)<span class="required"
                                                    style="color:red ;">*</span> :</label>
                                            <div class="col-lg-8 mb-5">
                                                <input type="text" name="proSgst" id="proSgst" value="<?php if (isset($rowsizeData['Prot_Sgst']) && '' != $rowsizeData['Prot_Sgst']) {
																							echo $rowsizeData['Prot_Sgst'];
																						} ?>" class="form-control" placeholder="Enter Product Second GST" maxlength="2"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <label class="col-lg-4 control-label">IGST(in %)<span class="required"
                                                    style="color:red ;">*</span> :</label>
                                            <div class="col-lg-8 mb-5">
                                                <input type="text" name="proLgst" id="proLgst" value="<?php if (isset($rowsizeData['Prot_Lgst']) && '' != $rowsizeData['Prot_Lgst']) {
																							echo $rowsizeData['Prot_Lgst'];
																						} ?>" class="form-control " placeholder="Enter Product Last GST" maxlength="2"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <label class="col-lg-4 control-label">Tax Rate From<span class="required"
                                                    style="color:red ;">*</span> :</label>
                                            <div class="col-lg-8 mb-5">
                                                <input type="text" name="proTaxFrom" id="proTaxFrom" value="<?php if (isset($rowsizeData['Prot_RateFrom']) && '' != $rowsizeData['Prot_RateFrom']) {
																							echo $rowsizeData['Prot_RateFrom'];
																						} ?>" class="form-control allowdecimaldigit" placeholder="Enter Product Tax Rate From"
                                                    >
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <label class="col-lg-4 control-label">Tax Rate To<span class="required"
                                                    style="color:red ;">*</span> :</label>
                                            <div class="col-lg-8 mb-5">
                                                <input type="text" name="proTaxTo" id="proTaxTo" value="<?php if (isset($rowsizeData['Prot_RateTo']) && '' != $rowsizeData['Prot_RateTo']) {
                                                                                                echo $rowsizeData['Prot_RateTo'];
                                                                                            } ?>" class="form-control allowdecimaldigit"
                                                    placeholder="Enter Product Tax Rate To">
                                                <!-- <div id="emailHelp" class="form-text">Tax Rate To</div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-lg-0 control-label">&nbsp;</label>
                                        <input type="hidden" name="taxId" id="taxId" value="">
                                        <div class="col-lg-6">
                                            <input type="hidden" name="action" id="action" />
                                            <input type="submit" name="button_action" id="button_action"
                                                class="btn btn-primary" value="Insert" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered customemessage " data-module="sticky-table"
                                id="proTax_table">
                                <thead id="tablehead">
                                    <tr>

                                        <th style="width:10px; text-align:center">
                                            S.No </th>
                                        <th style="text-align:center">Tax Name </th>
                                        <th style="text-align:center">Tax Rate(₹) </th>
                                        <th style="text-align:center">CGST(%) </th>
                                        <th style="text-align:center">SGST(%) </th>
                                        <th style="text-align:center">IGST(%) </th>
                                        <th style="text-align:center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class=" replaceResponse " id="tableProTaxData">

                                </tbody>
                            </table>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>

</html>

<!------------ Product Tax Load Data Script Code -------------->

<script type="text/javascript">
$(document).ready(function() {
    load_data();
    var insertadata = $('#action').val("Insert");

    function load_data() {
        var action = "Load";
        $.ajax({
            url: "../classes/class_proTax.php",
            method: "POST",
            data: {
                action: action
            },
            success: function(data) {
                $('#tableProTaxData').html(data);
            }
        });
    }

    $(document).on("click", ".edit-btn", function() {
        var protId = $(this).data("eid");
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                protId: protId,
                isproductTax: true
            },
            success: function(data) {
                var proteditData = JSON.parse(data);

                $('#proTaxName').val(proteditData[0]);
                $('#proTaxFrom').val(proteditData[1]);
                $('#proTaxTo').val(proteditData[2]);
                $('#proCgst').val(proteditData[3]);
                $('#proSgst').val(proteditData[4]);
                $('#proLgst').val(proteditData[5]);
                $('#prodName').val(proteditData[6]);
                $('#taxId').val(proteditData[7]);
                $('#action').val("Update");
                $('#button_action').val('Update');
            }
        })
    });

    $(document).on("click", ".delete-btn", function() {
        if (confirm("Do you really want to delete this record ?")) {
            var protId = $(this).data("did");
            $.ajax({
                url: "action.php",
                type: "POST",
                data: {
                    protId: protId,
                    isproductDelteTax: true
                },
                success: function(data) {
                    console.log(data);
                    load_data();
                }
            })
        }
    });


    $('#proTaxForm').on('submit', function(event) {
        event.preventDefault();
        var prodName = $('#prodName').val();
        var proTaxName = $('#proTaxName').val();
        var proTaxFrom = $('#proTaxFrom').val();
        var proTaxTo = $('#proTaxTo').val();
        var proCgst = $('#proCgst').val();
        var proSgst = $('#proSgst').val();
        var proLgst = $('#proLgst').val();
        var proLgst = $('#proLgst').val();
        var taxId = $('#taxId').val();
        console.log("data");

        var action = "Insert";
        $.ajax({
            url: "../classes/class_proTax.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    $("#success-message").html("Data Inserted Successfully.").slideDown();
                    $("#error-message").slideUp();
                } else {
                    $("#error-message").html("Rate From always less than to Rate To.")
                        .slideDown();
                    $("#success-message").slideUp();
                }
                console.log(data);
                load_data();

            },
            error: function(data) {
                console.log(data);
            }
        })
    });

});
</script>

<!-- *********** Input tag Take only Number and decimal Point ********* -->

<script type="text/javascript">
// function decimalNumberAllow(e) {
//     // console.log(e);
//     var $this = e;
//     if ((event.which != 46 || $this.val().indexOf('.') != -1) && ((event.which < 48 || event.which >
//             57) && (event.which != 0 && event.which != 8))) {
//         event.preventDefault();
//     }
//     var text = e.value;
//     console.log(this.value);
//     if (text.length === 18) {
//         $(this).val(text + ".")
//     }
//     if ((event.which == 46) && (text.indexOf('.') == -1)) {
//         setTimeout(function() {
//             if ($this.val().substring($this.val().indexOf('.')).length > 3) {
//                 $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
//             }
//         }, 1);
//     }
//     if ((text.indexOf('.') == 18 && text.substring(text.indexOf('.')).length > 2)) {
//         event.preventDefault();
//     }
//     if (((text.indexOf('.') != -1) && (text.substring(text.indexOf('.')).length > 2) && (event
//             .which != 0 && event.which != 8) && ($(this)[0].selectionStart >= text.length - 2))) {
//         event.preventDefault();
//     }
// }

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