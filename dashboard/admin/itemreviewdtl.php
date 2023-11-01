<?php include_once 'connection_handle.php';
$strPageTitle = "Item Review";
include_once 'header.php';
$strPageTitle = 'Item Review';


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
	$sqlUpdateData = ' UPDATE city SET ct_status= (CASE WHEN st_status=1 THEN 0 ELSE 1 END) WHERE ct_Id=' . $_GET['id'];
	$strRes = $dbh->query($sqlUpdateData);
	$_SESSION['success_city_msg'] = 'Status Updated successfully.';
	redirect('manage_city.php');
}
if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	try {
		$dbh->query("DELETE FROM city WHERE 1 AND ct_Id= '". $_GET['id']."'");
		$_SESSION['success_city_msg'] = 'Record Delete Successfully.';
		redirect('manage_city.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_city_msg'] = "Record used anywhere";
			redirect('manage_city.php');
		}
	}
}

if(isset($_GET['itemId'])){
    $sqlItemName = "SELECT ite_Name FROM item WHERE ite_Id =".$_GET['itemId'];
    $ItemNameRes = $dbh->query($sqlItemName);
    $ItemNameRow = $ItemNameRes->fetch();
    $itemIs = $ItemNameRow['ite_Name'];
}

?>



<!-- Main content -->

<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <?php include_once 'sidebar.php' ?>

        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="page-header page-header-default">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><a href="reviewsetting.php"><i class="icon-arrow-left52 position-left"></i> </a><span
                                class="text-semibold">Item <?php echo $itemIs; ?></span> - Reviews</h4>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </div>


                </div>

                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>

                        <li class="active">See Reviews</li>
                    </ul>


                </div>
            </div>



            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <?php successmessage('success_city_msg') ?>
                <?php duplicatedataErr('error_city_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">



                    <form action="" method="post">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered customemessage ">
                                    <thead>
                                        <tr>

                                            <th style="width:10px;" ;text-align:center">
                                                S.No </th>


                                            <th style="text-align:center">User </th>
                                            <th style="text-align:center">Review </th>
                                            <th style="text-align:center">Date </th>
                                            <!-- <th style="text-align:center">is Removed </th> -->
                                            <th style="text-align:center">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody class=" replaceResponse ">
                                        <?php
										$count = 0;
										$strLoadConditions = ' AND itemRev_itemId='.$_GET['itemId'].' AND ifNULL(`itemRev_isApproved`,0)<>1 AND ifNULL(`itemRev_isRemove`,0)<>1 ORDER BY itemRev_id DESC ';
										$strFields = "`mstuser`.`us_UserName`,`item_reviews`.`itemRev_id`,`item_reviews`.`itemRev_isApproved`, `item_reviews`.`itemRev_isRemove`, `item_reviews`.`itemRev_desc`, `item_reviews`.`itemRev_Time`";
										$strJoinCondition = " LEFT JOIN mstuser ON `item_reviews`.`itemRev_userId` = mstuser.us_Id";
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFields, $strJoinCondition, 1, 'catpagination', 'item_reviews');
										
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowCompany) {
												$count++;
										?>


                                        <tr class="clsparentinformation">


                                            <td style="text-align:center; width:10px">
                                                <?php echo $count; ?> </td>


                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowCompany['us_UserName']; ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo substr($rowCompany['itemRev_desc'],0,70); ?><span
                                                    id="dots<?php echo $rowCompany['itemRev_id']; ?>">...</span><span
                                                    id="more<?php echo $rowCompany['itemRev_id']; ?>"
                                                    style="display:none;"><?php echo substr($rowCompany['itemRev_desc'],70); ?></span>
                                                <button type="button"
                                                    id="readmorebtn<?php echo $rowCompany['itemRev_id']; ?>"
                                                    onclick="readmore('<?php echo $rowCompany['itemRev_id']; ?>')"
                                                    data-review=<?php echo $rowCompany['itemRev_id']; ?> class="btn btn-info"   >Read
                                                    more</button>
                                            </td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowCompany['itemRev_Time']; ?></td>





                                            <!-- <td style="text-align: center;">
                                                <select name="" id=""
                                                    onchange="status('<?php echo $rowCompany['itemRev_id']; ?>',this.value)"
                                                    class="form-control">
                                                    <?php 
                                                   
                                                        if($rowCompany['itemRev_isRemove'] == NULL){
                                                            $select = "";
                                                            $declineselect = "";
                                                        }else if($rowCompany['itemRev_isRemove'] == 1){
                                                            $select = "selected";
                                                            $declineselect = "";
                                                        }else{
                                                            $select = "";
                                                            $declineselect = "selected"; 
                                                        }
                                                    ?>
                                                    <option value="">select an Option</option>
                                                    <option <?php echo $select; ?> value="1">Yes</option>
                                                    <option <?php echo $declineselect; ?> value="0">No</option>
                                                </select>
                                            </td> -->
                                            <td style="text-align: center;">
                                                <input type="button" class="btn btn-success approvebtn" id="approvebtn" data-reviewid=<?php echo $rowCompany['itemRev_id']; ?> value="Approved">
                                                <input type="button" class="btn btn-danger rejectbtn" id="rejectbtn" data-reviewid=<?php echo $rowCompany['itemRev_id']; ?> value="Reject">
                                                
                                                <!-- <select name="" id=""
                                                    onchange="approvedstatus('<?php echo $rowCompany['itemRev_id']; ?>',this.value)"
                                                    class="form-control">
                                                    <?php 
                                                   
                                                        if($rowCompany['itemRev_isApproved'] == NULL){
                                                            $Approveselect = "";
                                                            $ApproveUnselect = "";
                                                        }else if($rowCompany['itemRev_isApproved'] == 1){
                                                            $Approveselect = "selected";
                                                            $ApproveUnselect = "";
                                                        }else{
                                                            $Approveselect = "";
                                                            $ApproveUnselect = "selected"; 
                                                        }
                                                    ?>
                                                    <option value="">select an Option</option>
                                                    <option <?php echo $Approveselect; ?> value="1">Yes</option>
                                                    <option <?php echo $ApproveUnselect; ?> value="0">No</option>
                                                </select> -->
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
                    <div class="panel-body">
                        <?php
						if (isset($_SESSION['catpagination'])) {
							echo $_SESSION['catpagination'];
						}
						?>
                        <div>
                        </div>
                    </div>
                    <!-- /form horizontal -->

                    <!-- /both borders -->


                    <?php include_once 'footer.php'; ?>
                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->
    <script>
    function readmore(a) {
        reviewid = a;
        if ($("#dots" + reviewid).is(":visible")) {

            $("#dots" + reviewid).css("display", "none");
            $("#more" + reviewid).css("display", "inline");
            $("#readmorebtn" + reviewid).html("Read less");
        } else {
            $("#dots" + reviewid).css("display", "inline");
            $("#more" + reviewid).css("display", "none");
            $("#readmorebtn" + reviewid).html("Read More");
        }

    }
    function status(id, value){
        reviewid = id;
        statusvalue = value;
        // alert(action);
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                reviewid: reviewid,
                statusvalue: statusvalue,
                isremovebyadmin: true
            },
            success: function(data){
                console.log(data);
            },
            error: function(data){
                console.log(data);
            }
        });
    }

    function approvedstatus(id, value){
        reviewid = id;
        approvedstatus = value;
        // alert(action);
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                reviewid: reviewid,
                approvedstatus: approvedstatus,
                isApprovedRev: true
            },
            success: function(data){
                console.log(data);
            },
            error: function(data){
                console.log(data);
            }
        });
    }

    /* ----------- Approved Review Ajax ------------ */

    $(document).on("click", ".approvebtn", function(){
        var reviewid = $(this).data("reviewid");
        var element = this;
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                reviewid: reviewid,
                isApprovedRev: true
            },
            success: function(data){
                // console.log(data);
                if(data ==1 ){
                    $(element).closest("tr").fadeOut();
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    });

    $(document).on("click", ".rejectbtn", function(){
        var reviewid = $(this).data("reviewid");
        var element = this;
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                reviewid: reviewid,
                isRejectReview: true
            },
            success: function(data){
                // console.log(data);
                if(data ==1 ){
                    $(element).closest("tr").fadeOut();
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    });
    </script>

    </body>

    </html>