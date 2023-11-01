<?php include_once 'connection_handle.php';
$strPageTitle = "Cancellation Request Orders";
include_once 'header.php';
$strPageTitle = 'Cancellation Request Orders';



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
                                class="text-semibold">Order</span> - Manage Order Cancellation request</h4>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </div>


                </div>

                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>

                        <li class="active">Manage Order Cancellation request</li>
                    </ul>


                </div>
            </div>



            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <?php successmessage('success_state_msg') ?>
                <?php duplicatedataErr('error_state_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Order Cancellation Requests Listing</h5>
                        <div class="heading-elements">

                            <!-- <a href="add_state.php" class="btn btn-info btn-xs"><b><i class="icon-plus3"></i></b> Add
                                New</a> -->
                        </div>
                        <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                    </div>


                    <form action="" method="post">
                        <div class="panel-body">


                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered customemessage ">
                                    <thead>
                                        <tr>

                                            <th style="width:10px;" ;text-align:center">
                                                S.No </th>


                                            <th style="text-align:center">Order No </th>
                                            <th style="text-align:center">Main User </th>
                                            <th style="text-align:center">User Name </th>
                                            <th style="text-align:center">Email </th>
                                            <th style="text-align:center">Price(₹) </th>
                                            <th style="text-align:center">Action </th>
                                        </tr>
                                    </thead>


                                    <tbody class=" replaceResponse ">
                                        <?php
										$count = 0;
										$strLoadConditions = ' ORDER BY cancelResq_Id DESC ';
										$strFields = "cancellationrequest.*, `order`.*, mstuser.*";
										$strJoinCondition = " LEFT JOIN `order` ON cancelResq_OderId = `order`.ord_id LEFT JOIN mstuser ON cancelResq_userId=us_Id";
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFields, $strJoinCondition, 1, 'catpagination', '`cancellationrequest`');
										
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowCompany) {
												$count++;
										?>


                                        <tr class="clsparentinformation">


                                            <td style="text-align:center; width:10px">
                                                <?php echo $count; ?> </td>


                                            <td style="min-width:30px;text-align:center">
                                                #<?php 
                                                
                                                echo $rowCompany['ord_OrderNo']; ?></td>
                                                 <td style="min-width:30px;text-align:center">
                                                <?php 
                                                
                                                echo $rowCompany['us_UserName']."(".$rowCompany['us_EmailID'].")"; ?></td>
                                                <td style="min-width:30px;text-align:center">
                                                <?php 
                                                
                                                echo $rowCompany['ord_userName']; ?></td>
                                                 <td style="min-width:30px;text-align:center">
                                                <?php 
                                                
                                                echo $rowCompany['ord_emailid']; ?></td>
                                                 <td style="min-width:30px;text-align:center">
                                                <?php 
                                                
                                                echo $rowCompany['OrderTotalAmount']; ?></td>
                                            
                                            <td style="min-width:30px;text-align:center">
                                                <select name="" id=""
                                                    onchange="status('<?php echo $rowCompany['ord_id']; ?>',this.value)"
                                                    class="form-control">
                                                    <?php 
                                                        if($rowCompany['cancelResq_Iscancel'] == NULL){
                                                        $select = "";
                                                        $declineselect = "";
                            }else if($rowCompany['cancelResq_Iscancel'] == 1){
                                                $select = "selected";
                                                $declineselect = "";
                                        }else{
                                           $select = "";
                                            $declineselect = "selected"; 
                                        }
                                                    ?>
                                                    <option value="">select an Option</option>
                                                    <option <?php echo $select; ?> value="Yes">Approved</option>
                                                    <option <?php echo $declineselect; ?> value="No">Decline</option>
                                                </select>
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
    function status(a, value) {
        var cancellationOrderid = a;
        var cancellationOrderstatus = value;
        // console.log(Orderid);
        // console.log(Orderstatus);
        
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                cancellationOrderid: cancellationOrderid,
                cancellationOrderstatus: cancellationOrderstatus
            },
            // dataType: "JSON",
            success: function(data) {
                console.log(data);
                // $('#result').html(data);  
            },
            error: function(data) {
                console.log(data);
            }
        });

    }
    </script>

    </body>

    </html>