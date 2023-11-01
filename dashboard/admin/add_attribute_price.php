<?php include_once 'connection_handle.php';
$strPageTitle = "Add Attribute Price";
include_once 'header.php';
$strPageTitle2 = "Add Attribute Price";

if (isset($_GET['attpriceId']) && '' != $_GET['attpriceId'] && $_GET['mode'] == 'delete') {
    try {
		$dbh->query("DELETE FROM attributeprice WHERE 1 AND attPrice_Id= '". $_GET['attpriceId']."'");
		$_SESSION['success_unit_msg'] = 'Record Delete Successfully.';
		redirect('add_attribute_price.php?id='.$_GET['id']);
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_unit_msg'] = "Record used anywhere";
            redirect('add_attribute_price.php?id='.$_GET['id']);
			// redirect('manage_unit.php');
		}
	}
}

$strMode = 'new';
if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}

$aryErrors = $class_attribute_price->sizeProcessRequest('', $strMode);


if (isset($_GET['attpriceId']) && '' != $_GET['attpriceId'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND attPrice_Id=' . $_GET['attpriceId'];
	$rowsizeAttdtlData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'attributeprice');
    $AttributeDisplay = "style=display:block;";
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
                        <h4><a href="add_item.php?id=<?php echo $_GET['id']; ?>&mode=edit"><i
                                    class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo " Attribute Price";
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
									echo " Attribute Price";
								} ?>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <?php successmessage('success_unit_msg') ?>
                <?php duplicatedataErr('error_unit_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
								echo $strPageTitle2;
							} else {
								echo "Attribute Price";
							} ?><a class="heading-elements-toggle"><i class="icon-more"></i></a>
                        </h5>
                        <div class="heading-elements">
                            <?php
                                $strLoadConditions = ' AND ite_Id='. $_GET['id'];
                                $rowSize = $class_common->loadSingleDataBy($strLoadConditions, '', '', 'item');
                                echo "<h1 class='btn-xs' style='font-size: 16px; font-weight: bold;'>".$rowSize['ite_Name']."</h1>";
                            ?>
                        </div>
                        <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                    </div>

                    <div class="alert alert-warning" id="success" style="display:none">
                        <span class="text-semibold" style="padding-bottom:10px;">Warning!</span> For Complete Upload
                        Please Click Save Image Button.
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="panel-body">
                            <div class="row ">
                                <div class="col-lg-8">
                                    <div class="row multiattName">
                                        <div class="col-lg-3">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label><b id="attributeName" class="attributeName"></b></label>
                                                </div>
                                                <div class="col-lg-12 mb-5 attselecter" id="attselecter"
                                                    style="/*position: absolute; top: 0px;*/">
                                                    <select class="form-control attnameclass"
                                                        onchange="seleactatt(event)" name="attName[]" id="attName">
                                                        <option value="0">Select Attribute</option>
                                                        <?php
                                                            $strAttNameConditions = 'AND iteAtt_itemID='.$_GET['id'].' GROUP BY att_Id ORDER BY att_Id ASC ';
                                                            $strAttNameFileds = "`attribute`.`att_Id`,`attribute`.`att_Name`";
                                                            $strAttNameJoinCondition = "LEFT JOIN attribute ON `attributeitem`.`iteAtt_attid`= `attribute`.`att_Id`";
                                                            $resSelectAttNameList = $class_common->loadMultipleDataByTableName($strAttNameConditions, $strAttNameFileds, $strAttNameJoinCondition, 0, '', 'attributeitem');
                                                            if (count($resSelectAttNameList) > 0) {
                                                                foreach ($resSelectAttNameList as $rowAttName) {
                                                        ?>
                                                        <optgroup value="<?php echo $rowAttName['att_Name']; ?>"
                                                            label="<?php echo $rowAttName['att_Name']; ?>">
                                                            <?php 
                                                                $strAttLoadConditions = ' AND iteAtt_attid='.$rowAttName['att_Id'].' AND iteAtt_itemID='.$_GET['id'].' ORDER BY attd_id ASC ';
                                                                $strAttFileds = "`attributedtl`.`attd_id`, `attributedtl`.`attd_value`";
                                                                $strAttJoinCondition = "LEFT JOIN attributedtl ON `attributeitem`.`iteAtt_value`= `attributedtl`.`attd_id`";
                                                                $resSelectCouponList = $class_common->loadMultipleDataByTableName($strAttLoadConditions, $strAttFileds, $strAttJoinCondition, 0, '', 'attributeitem');
                                                                if (count($resSelectCouponList) > 0) {
                                                                    foreach ($resSelectCouponList as $rowSize) {
                                                        
                                                            ?>
                                                            <option value="<?php echo $rowSize['attd_id']; ?>">
                                                                <?php echo $rowSize['attd_value']; ?></option>
                                                            <?php }
                                                                }?>

                                                        </optgroup>
                                                        <?php
                                                        }
                                                            }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row" style="margin-top: 25px;">
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" placeholder="Enter Price"
                                                pattern="^\d+(?:\.\d{1,2})?$" name="attprice" id="attributeprice"
                                               >
                                               <?php
                                               
                                               $itemTableSql = $dbh->query("SELECT ite_MRP FROM item WHERE ite_Id='".$_GET['id']."'");
                                               $itemTableRes=$itemTableSql->fetch();
                                               
                                               ?>
                                               <span class="mrpErr" style="display: none; color: red;">Price Should be less than to item price ₹<?php echo $itemTableRes['ite_MRP']; ?></span>
                                            <input class="form-control" type="hidden" name="attItemId" id="attItemId"
                                                value="<?php echo $_GET['id']; ?>">
                                            <input class="form-control" type="hidden" name="attpriceId1"
                                                id="attpriceId1" value="0">
                                        </div>
                                        <div class="col-lg-6">
                                            <button type="submit" name="submit" onclick="" class="btn btn-primary"
                                                aria-expanded="false">Add </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="panel panel-default">

                    <form action="" method="post">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered customemessage ">
                                    <thead>
                                        <tr>

                                            <th style="width:10px; text-align:center;">
                                                S.No </th>


                                            <th style="text-align:center">Attribute Values </th>
                                            <th style="text-align:center">Price(₹) </th>
                                            <th style="text-align:center">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody class=" replaceResponse ">
                                        <?php
										$count = 0;
										$strLoadConditions = ' AND `attributeprice`.`attPrice_itemId`='.$_GET['id'].' ORDER BY attPrice_Id  DESC ';
                                        $strFileds = "`attributeprice`.`attPrice_Id`,`attributeprice`.`attPrice_attvaluesId`,`attributeprice`.`attPrice_Price`";
                                        // $strJoinCondition = " LEFT JOIN attributedtl ON find_in_set(`attributedtl`.`attd_id`, `attributeprice`.`attPrice_attvaluesId`)";
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, '', 0, '', 'attributeprice');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
										?>


                                        <tr class="clsparentinformation">


                                            <td style="text-align:center; width:10px">
                                                <?php echo $count; ?>
                                            </td>


                                            <td style="min-width:30px;text-align:center">
                                                <?php 
                                                $newValue =array();
                                                $AttdtlstrLoadConditions = " AND attd_id IN (".$rowSize['attPrice_attvaluesId'].")";
                                                $AttdtlstrFileds = "`attributedtl`.`attd_id`,`attributedtl`.`attd_value`";
                                                // $AttdtlstrJoinCondition = " LEFT JOIN attributedtl ON find_in_set(`attributedtl`.`attd_id`, `attributeprice`.`attPrice_attvaluesId`)";
                                                $AttdtlresSelectCouponList = $class_common->loadMultipleDataByTableName($AttdtlstrLoadConditions, $AttdtlstrFileds, '', 0, '', 'attributedtl');
                                                foreach($AttdtlresSelectCouponList as $attdtlValue){
                                                    $newValue[] = $attdtlValue['attd_value']; 
                                                }
                                                echo implode(',',$newValue);
                                                ?></td>


                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowSize['attPrice_Price']; ?></td>



                                            <td style="text-align: center;">
                                                <a class="btn btn-primary" title=""
                                                    onclick="attpriceUpdation('<?php echo $rowSize['attPrice_attvaluesId']; ?>','<?php echo $rowSize['attPrice_Id']; ?>','<?php echo $rowSize['attPrice_Price']; ?>')"
                                                    data-attpriceid='<?php echo $rowSize['attPrice_Id']; ?>'> <i
                                                        class="icon-pencil7"></i></a>
                                                <!-- <a href="add_attribute_price.php?id=<?php echo $_GET['id'] ?>&attpriceId=<?php echo $rowSize['attPrice_Id']; ?>&mode=edit"
                                                    class="btn btn-primary" title=""> <i class="icon-pencil7"></i></a> -->



                                                <a onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger"
                                                    href="add_attribute_price.php?id=<?php echo $_GET['id'] ?>&attpriceId=<?php echo $rowSize['attPrice_Id']; ?>&mode=delete">
                                                    <i class="icon-trash"></i></a>



                                            </td>

                                        </tr>




                                        <?php
											}
										}
										?>


                                    </tbody>

                                </table>

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

<script>
function removeAllNextNode(node) {
    if (node.nextElementSibling != null)
        removeAllNextNode(node.nextElementSibling);
    node.remove();
}

function seleactatt(att) {
    var selected = $("option:selected", att.target);
    var Lable = $("#attributeName", att.target.parentElement.parentElement);
    var Nextch = att.target.parentElement.parentElement.parentElement.nextElementSibling;
    if (Nextch != null)
        removeAllNextNode(Nextch);
    var values = [];
    $('select[name="attName[]"]').each(function() {
        values.push(this.value);
    });

    Lable[0].innerHTML = selected.parent()[0].label;

    var attrId = att.value;
    var itemId = <?php echo $_GET['id']; ?>;

    var mySelect = $('select[name=attName]').val();
    $.ajax({
        url: 'action.php',
        type: 'POST',
        async: false,
        data: {
            newattValue: values,
            itemId: itemId,
            isSetNewattribute: true
        },
        success: function(data) {
            // $("#attselecter").css("top", "25px");
            $(".multiattName").append(data);
        }
    });
    if (iscallfromeditvalue)
        attpriceUpdation(editvaluerems, 0, 0);
}
var editvaluerems = "";
var iscallfromeditvalue = false;

function attpriceUpdation(value, id, price) {

    // console.log($(this).attr("#data-attpriceid"));
    if (!iscallfromeditvalue) {
        var valuesAttsel = $(".attnameclass");
        if (valuesAttsel.length > 1) {
            for (var col = 1; col < valuesAttsel.length; col++)
                valuesAttsel[col].remove();
        }
        // console.log(id);
        $("#attpriceId1").val(id);
        $("#attributeprice").val(price);
    }
    if (value.length > 0) {
        var allvalues = value.split(',');
        var currentvalue = allvalues[0];
        allvalues.shift()
        editvaluerems = allvalues.join(',');
        iscallfromeditvalue = allvalues.length > 0;
        $('.attnameclass option[value=' + currentvalue + ']').last().prop('selected', true);
        $(".attnameclass").last().trigger("change");
    } else {
        iscallfromeditvalue = false;
    }
    // dataset.columns
}
</script>

<!-- *********** Input tag Take only Number and decimal Point ********* -->

<script type="text/javascript">
    $(function() {
        $('#attributeprice').keypress(function(event) {
            var $this = $(this);
            // console.log($this)
            if ((event.which != 46 || $this.val().indexOf('.') != -1) && ((event.which < 48 || event.which >
                    57) && (event.which != 0 && event.which != 8))) {
                event.preventDefault();
            }
            var text = $(this).val();
            // console.log(text);
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
            $(".mrpErr").show();
            // console.log($(this).val());
            
        });
    });
</script>

</body>

</html>