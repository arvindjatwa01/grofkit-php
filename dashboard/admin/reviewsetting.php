<?php include_once 'connection_handle.php';
$strPageTitle = "Review Setting";
include_once 'header.php';
$strPageTitle = 'Review Setting';


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
	$sqlUpdateData = ' UPDATE stock SET status= (CASE WHEN status=1 THEN 0 ELSE 1 END) WHERE stk_Id =' . $_GET['id'];
	$strRes = $dbh->query($sqlUpdateData);
	$_SESSION['success_size_msg'] = 'Status Updated successfully.';
	redirect('manage_stock.php');
}
if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	
	$sqlTrashData = ' DELETE FROM stock WHERE 1 AND stk_Id = ' . $_GET['id'];
	$dbh->query($sqlTrashData);
	$_SESSION['success_size_msg'] = 'Record Delete Successfully.';
	redirect('manage_stock.php');
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
                        <h4><a href="index.php"><i class="icon-arrow-left52 position-left"></i> </a><span
                                class="text-semibold">Review Settings </span> - Manage Review Setting</h4>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </div>


                </div>

                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>

                        <li class="active">Manage Review Settings</li>
                    </ul>


                </div>
            </div>



            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <?php successmessage('success_size_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    
                    <div class="panel-body">
                        <div class="col-lg-3"><h6 class="panel-title">Any One Can Review</h6></div>
                        <div class="col-lg-3">
                            <div class="row">
                                <?php
                                    $AnyOneCanReviewSql = "SELECT appSetting_Action, appSetting_desc FROM appsetting WHERE appSetting_Id =1";
                                    $AnyOneCanReviewRes = $dbh->query($AnyOneCanReviewSql);
                                    $AnyOneCanReviewRow = $AnyOneCanReviewRes->fetch();
                                    if($AnyOneCanReviewRow['appSetting_Action'] == NULL){
                                        $yesAnyOne = "checked";
                                        $noAnyOne = "";
                                    }else if($AnyOneCanReviewRow['appSetting_Action'] == 1){
                                        $yesAnyOne = "checked";
                                        $noAnyOne = "";
                                    }else{
                                        $yesAnyOne = "";
                                        $noAnyOne = "checked";
                                    }
                                    
                                ?>
                                <div class="col-lg-6">
                                    <input type="radio" <?php echo $yesAnyOne; ?> name="AnyOnecanReview" value="1" id="yesAnyOnecanReview">&nbsp;
                                    <label for="">Yes</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="radio" <?php echo $noAnyOne; ?> name="AnyOnecanReview" value="0" id="noAnyOnecanReview">&nbsp;
                                    <label for="">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-9">
                                    <label for=""><?php echo  $AnyOneCanReviewRow['appSetting_desc']; ?></label>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    
                    <div class="panel-body">
                        <div class="col-lg-3"><h6 class="panel-title">Approved Review</h6></div>
                        <div class="col-lg-3">
                            <div class="row">
                                <?php
                                    $ApprovedReviewSql = "SELECT appSetting_Action, appSetting_desc FROM appsetting WHERE appSetting_Id =2";
                                    $ApprovedReviewRes = $dbh->query($ApprovedReviewSql);
                                    $ApprovedReviewRow = $ApprovedReviewRes->fetch();
                                    if($ApprovedReviewRow['appSetting_Action'] == 1){
                                        $yesApproved = "checked";
                                        $notApproved = "";
                                    }else{
                                        $yesApproved = "";
                                        $notApproved = "checked";
                                    }
                                ?>
                                <div class="col-lg-6">
                                    <input type="radio" <?php echo $yesApproved; ?> name="ApprovedReview" value="1" id="yesApprovedReview">&nbsp;
                                    <label for="yesApprovedReview">Yes</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="radio" <?php echo $notApproved; ?> name="ApprovedReview" value="0" id="noApprovedReview">&nbsp;
                                    <label for="noApprovedReview">No</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-9">
                                    <label for=""><?php echo $ApprovedReviewRow['appSetting_desc']; ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Item Review Listing</h5>
                    </div>


                    <form action="" method="post">
                        <div class="panel-body">


                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered customemessage ">
                                    <thead>
                                        <tr>

                                            <th style="width:10px; text-align:center">
                                                S.No </th>


                                            
                                            <th style="text-align:center">Item Name </th>
                                            <th style="text-align:center">Total Review </th>
                                            
                                        </tr>
                                    </thead>


                                    <tbody class=" replaceResponse ">
                                        <?php
										$count = 0;
										$strLoadConditions = ' GROUP BY itemRev_itemId ORDER BY itemRev_id DESC ';
                                        $strFileds = 'item.ite_Name, count(ite_Id) as totalReview,ite_Id';
                                        $strJoinCondition = "LEFT JOIN item ON item_reviews.itemRev_itemId= item.ite_Id";
                                        $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, $strJoinCondition, 1, 'catpagination', 'item_reviews');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
										?>


                                        <tr class="clsparentinformation">
                                            <td style="text-align:center; width:10px">
                                                <?php echo $count; ?>
                                            </td>
                                            <td style="min-width:30px;text-align:center">
                                              <a href="itemreviewdtl.php?itemId=<?php echo $rowSize['ite_Id']; ?>"><?php echo $rowSize['ite_Name']; ?></a></td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowSize['totalReview']; ?></td>
                                            
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
$(document).ready(function(){ 
    $("input[name='AnyOnecanReview']").click(function() {
        var value = $(this).val();
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                value: value,
                isanyOnecanReview: true
            },
            success: function(data){
                console.log(data);
            },
            error: function(data){
                console.log(data);
            }
        })
        // alert(test);
        // $("div.desc").hide();
        // $("#"+test).show();
    }); 
});

$(document).ready(function(){ 
    $("input[name='ApprovedReview']").click(function() {
        var value = $(this).val();
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                value: value,
                isApprovedReview: true
            },
            success: function(data){
                console.log(data);
            },
            error: function(data){
                console.log(data);
            }
        })
        // alert(test);
        // $("div.desc").hide();
        // $("#"+test).show();
    }); 
});

</script>

    </body>

    </html>