<?php include_once 'connection_handle.php';
$strPageTitle = "Add Attribute";
include_once 'header.php';
$strPageTitle2 = "Edit Attribute";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
    try {
		$dbh->query("DELETE FROM attribute WHERE 1 AND att_Id= '". $_GET['id']."'");
		$_SESSION['success_attribute_msg'] = 'Record Delete Successfully.';
		redirect('manage_attribute.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_attribute_msg'] = "Record used anywhere";
			redirect('manage_attribute.php');
		}
	}
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}

$aryErrors = $class_att->sizeProcessRequest('', $strMode);


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND att_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'attribute');
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
                        <h4><a href="manage_attribute.php"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Attribute";
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
									echo "Add Attribute";
								} ?>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <?php successmessage('success_attribute_msg') ?>
                <?php duplicatedataErr('error_attribute_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="alert alert-warning" id="success" style="display:none">
                        <span class="text-semibold" style="padding-bottom:10px;">Warning!</span> For Complete Upload
                        Please Click Save Image Button.
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group mb-2" id="attNameDiv">
                                    <label class="col-lg-2 control-label">Attribute Name<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="attName" id="attName" value="<?php if (isset($rowsizeData['att_Name']) && '' != $rowsizeData['att_Name']) {
																							echo $rowsizeData['att_Name'];
																						} ?>" class="form-control" placeholder="Enter Attribute Name">

                                    </div>
                                    <?php 
                                    $btnValue = "";
                                    if(isset($_GET['id'])){
                                        $btnValue = "Update";
                                    }else{
                                        $btnValue = "ADD";
                                    }
                                    
                                    ?>
                                    <div class="col-lg-2">
                                        <div class="row">
                                            <label class="col-lg-2 control-label">&nbsp;</label>
                                            <div class="col-lg-6">
                                                <input type="submit" class="btn btn-primary" id="add-updatebtn"
                                                    name="submit" aria-expanded="false"
                                                    value="<?php echo $btnValue; ?>">
                                                <!-- <button type="submit" name="submit" onclick="" class="btn btn-primary"
                                                    aria-expanded="false"><?php echo $btnValue; ?> </button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-lg-2 control-label">Select Choise<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <?php
                                            $Mchoise ="";
                                            $Schoise = "";
                                            $OnView = "";
                                            if(isset($rowsizeData['att_IsMultiple'])){
                                                
                                                $Choise = $rowsizeData['att_IsMultiple'];
                                                switch($Choise){
                                                    case "0":
                                                        $Schoise =  "checked";
                                                        $Mchoise = "";
                                                        $OnView = "";
                                                        break;
                                                    case "1":
                                                        $Schoise = "";
                                                        $Mchoise =  "checked";
                                                        $OnView = "";
                                                        break;
                                                } 
                                            }else{
                                                $Mchoise ="";
                                                $Schoise = "";
                                                $OnView = "checked";
                                            }
                                            if(isset($rowsizeData['att_IsonView'])){
                                                if($rowsizeData['att_IsonView'] == '1'){
                                                    $Mchoise ="";
                                                    $Schoise = "";
                                                    $OnView = "checked";
                                                }
                                            }
                                            $stockAtt = "";
                                            if(isset($rowsizeData['att_IsStockAtt'])){
                                                if($rowsizeData['att_IsStockAtt'] == '1'){
                                                    $stockAtt = "checked";
                                                }else{
                                                    $stockAtt = "";
                                                }
                                            }
                                        ?>
                                        <input type="radio" name="choise" id="Schoise" value="S"
                                            <?php echo $Schoise; ?>>
                                        <label for="Schoise">Singal Choise</label>&emsp;&emsp;&emsp;&emsp;
                                        <input type="radio" name="choise" id="Mchoise" value="M"
                                            <?php echo $Mchoise; ?>>
                                        <label for="Mchoise">Multiple Choise</label>&emsp;&emsp;&emsp;&emsp;
                                        <input type="radio" name="choise" id="Vchoise" value="V" <?php echo $OnView; ?>>
                                        <label for="Schoise">Only View</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        <input type="checkbox" name="isStockAtt" id="isStockAtt" value="1"
                                            <?php echo $stockAtt; ?>>
                                        <label for="isStockAtt">Stock Attribute</label>

                                    </div>
                                </div>
                                <?php
                                
                                if($strMode == 'edit'){
                                    $selAttDisplay = "style='display:block'";
                                }else{
                                    $selAttDisplay = "style='display:none'";
                                }
                                ?>
                                <!-- <div class="form-group" <?php echo $selAttDisplay; ?>>
                                    <label class="col-lg-2 control-label">Select Attribute<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" name="SelattName" id="SelattName"
                                            onchange="getAttval(this);">
                                            <option value="0">Select Attribute</option>
                                            <?php
                                                $strLoadConditions = ' ORDER BY att_Id ASC ';
                                                $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'attribute');
                                                if (count($resSelectCouponList) > 0) {
                                                    foreach ($resSelectCouponList as $rowSize) {
                                                        
                                            ?>


                                            <option value="<?php echo $rowSize['att_Id']; ?>">
                                                <?php echo $rowSize['att_Name']; ?></option>
                                            <?php }
											}?>
                                        </select>
                                    </div>

                                    <div class="col-lg-2" id="clearbtn" style="display: none;">
                                        <div class="row">
                                            <label class="col-lg-2 control-label">&nbsp;</label>
                                            <div class="col-lg-6">
                                                <button type="button" name="Clear" onclick="clearAttval();"
                                                    class="btn btn-info" aria-expanded="false">Clear </button>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <?php
                                //  if(isset($_GET['id'])){
                                //     $tabledataDisplay = "display: block;";
                                // }else{
                                //     $tabledataDisplay = "display: none;";

                                // } 
                                ?>
                                <div class="form-group mb-2" id="table-data" style="margin-top: 8rem;">
                                    <label class="col-lg-2 control-label">Add Attribute Value<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="attValue" id="attValue" class="form-control"
                                            placeholder="Enter Attribute Value">
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="row">
                                            <label class="col-lg-2 control-label">&nbsp;</label>
                                            <div class="col-lg-6">
                                                <button type="button" name="addattValue" id="addattValue" onclick=""
                                                    class="btn btn-primary" aria-expanded="false">ADD </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <?php 
                 $attId = '';
                if(isset($_GET['id'])){
                    $attId = $_GET['id'];
                    // $attdtldivDtl = "style='display: block;'";
                }else{
                    $attId = '';
                    // $attdtldivDtl = "style='display: none;'";
                }
                
                $strLoadConditions = " AND att_Id = '$attId' ORDER BY attd_id DESC ";
                $stFileds = " attribute.*, attributedtl.*";
                $strJoinCondition = " LEFT JOIN attribute ON attd_attid = att_Id";
                $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $stFileds, $strJoinCondition, 0, '', 'attributedtl');
                // if (count($resSelectCouponList) > 0) {
                 ?>
                <div class="panel panel-default" id="attDtlDiv" <?php //echo $attdtldivDtl; ?>>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="panel-body">
                            <div class="col-lg-12 d-flex" id="attDtldata" style="align-items: center;">

                                <?php
                                
                                    foreach ($resSelectCouponList as $rowSize) {
                                        $attValue = ucfirst($rowSize['attd_value']);
                                        $attdID = $rowSize["attd_id"];
                                    ?>

                                <div class='col-lg-2 border-danger position-relative' id="<?php echo $attdID; ?>" style='margin-right: 12px; margin-bottom: 5px; background: #1500D1; color: white; font-size: 15px;
                                        height: 3vh;'><?php echo $attValue; ?><button type='button'
                                        Class='delete-btn position: absolute'
                                        style='position: absolute; top: 0; right: 0; border-radius: 14px; border: none; background: transparent; color: white;'
                                        data-id='<?php echo $attdID; ?>'>X</button></div>
                                <?php }
                            
                            ?>

                            </div>
                        </div>
                    </form>
                </div>
                <?php //}?>
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
    var addupdatebtn = $("#add-updatebtn").val();
    if (addupdatebtn == 'ADD') {
        $("#table-data").css('display', 'none');
    } else {
        $("#table-data").css('display', 'block');
    }
});
</script>
<script>
// function selectAtt(){
//     var attId= <?php if(isset($_GET['id'])) ?>
// }
function getAttval(sel) {
    var IdofSelectedvalue = 0;
    if (!isNaN(sel))
        IdofSelectedvalue = sel;
    else
        IdofSelectedvalue = sel.value;
    if (IdofSelectedvalue == 0) {
        // $('#table-data').css('display', 'none');
        $('#clearbtn').css('display', 'none');
        // $('#attDtlDiv').css('display', 'none');
        $("select option[value='0']").attr("selected", "selected");
    } else {
        var selAttValue = IdofSelectedvalue;
        // $('#attNameDiv').css('display', 'none');
        // $('#table-data').css('display', 'block');
        $('#clearbtn').css('display', 'block');

        // $('#attDtlDiv').css('display', 'block');
        $("select option[value=" + IdofSelectedvalue + "]").attr("selected", "selected");
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                attId: selAttValue,
                isselAttValue: true
            },
            success: function(data) {
                // console.log(data);
                var res = JSON.parse(data)
                // console.log(res);
                if (res[0] == '1') {
                    document.getElementById("Mchoise").checked = true;
                } else {
                    document.getElementById("Mchoise").checked = false;
                }
                if (res[1] == '1') {
                    document.getElementById("Schoise").checked = true;
                } else {
                    document.getElementById("Schoise").checked = false;
                }
                if (res[2] == '1') {
                    document.getElementById("Vchoise").checked = true;
                } else {
                    document.getElementById("Vchoise").checked = false;
                }
                // $("#table-data").html(res[3]);
                if (res[4] == '1') {
                    document.getElementById("isStockAtt").checked = true;
                } else {
                    document.getElementById("isStockAtt").checked = false;
                }
                // console.log(res[5].length);
                for (var i = 0; i < res[5].length; i++) {
                    $("#attDtldata").html(res[5]);
                }
            }
        });
    }
}



function clearAttval() {
    // $('#attNameDiv').css('display', 'block');
    // $('#table-data').css('display', 'none');
    // $('#clearbtn').css('display', 'none');
    // $('#attDtlDiv').css('display', 'none');
    // $("#SelattName option[value='0']").prop('selected', true);
    // document.getElementById("isStockAtt").checked = false;
    // document.getElementById("Vchoise").checked = true;
    window.location.href = 'add_attribute.php';

}



//Delete Records

$(document).on("click", ".delete-btn", function(e) {

    if (confirm("Do you really want to delete this record ?")) {
        var attdtlId = $(this).data("id");
        var element = this;

        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                attdtlId: attdtlId,
                isDeleteData: true
            },
            success: function(data) {
                // console.log(data);
                // document.getElementById(attdtlId).
                $('#' + attdtlId).hide();
                // attdtlId.css('display', 'none');
                // console.log("target is :" + attdtlId);
                //   getAttval();
                // alert(data);
                // if (data == 1) {
                //     $(element).closest("div").fadeOut();
                // }
            }
        });
    }
});

// $(document).ready(function() {
//     var divs = $('#attDtldata').find('div').length;
//     var Schoise = $("#Schoise").prop("checked");
//     if (divs == 1 && $("#Schoise").prop("checked")){
//         $("#addattValue").hide();
//     }
// });
// Add Record 

$(document).on("click", "#addattValue", function() {
    // document.getElementById("attName").value;
    // var attSelVal = $("#SelattName option:selected").val();
    var attSelVal = <?php echo $_GET['id']; ?>;
    var attValue = $("#attValue").val();
    var divs = $('#attDtldata').find('div').length;
    var Schoise = $("#Schoise").prop("checked");
    // alert(divs);
    // if (divs == 1 && $("#Schoise").prop("checked")){
    //     $("#addattValue").hide();
    // } else {


        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                attSelVal: attSelVal,
                attValue: attValue,
                isAddAttData: true
            },
            success: function(data) {
                // console.log(data);
                $('#attDtlDiv').css('display', 'block');
                getAttval(attSelVal);
                // if ($("#Schoise").prop("checked")) {
                //     // alert("checked");
                //     $("#addattValue").hide();
                // }

            },
            error: function(data) {
                console.log(data);
                // $('#attDtlDiv').css('display', 'none');
            }
        });
    // }


});

// var addupdatebtn = $("#add-updatebtn").val();
// alert(addupdatebtn);
</script>