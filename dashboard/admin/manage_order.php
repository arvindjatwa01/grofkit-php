<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Orders";
include_once 'header.php';
$strPageTitle = 'Manage Orders';


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
	$sqlUpdateData = ' UPDATE state SET st_status= (CASE WHEN st_status=1 THEN 0 ELSE 1 END) WHERE st_Id=' . $_GET['id'];
	$strRes = $dbh->query($sqlUpdateData);
	$_SESSION['success_state_msg'] = 'Status Updated successfully.';
	redirect('manage_state.php');
}
if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
    try {
		$dbh->query("DELETE FROM state WHERE 1 AND st_Id= '". $_GET['id']."'");
		$_SESSION['success_state_msg'] = 'Record Delete Successfully.';
		redirect('manage_state.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_state_msg'] = "Record used anywhere";
			redirect('manage_state.php');
		}
	}
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
                                class="text-semibold">Order</span> - Manage Order</h4>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </div>


                </div>

                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>

                        <li class="active">Manage Order</li>
                    </ul>


                </div>
            </div>



            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <div class="alert alert-danger" id="ErrMessage" style="background: red  !important; display: none; color: white; font-size: 14px; font-weight: 500;">
				<span class="text-semibold" style="padding-bottom:10px;">Error!</span> Please Set Delivary Date And Time
			</div>
			<div class="alert alert-danger" id="cantCancelMessage" style="background: red  !important; display: none; color: white; font-size: 14px; font-weight: 500;">
				<span class="text-semibold" style="padding-bottom:10px;">Error!</span> You Can't Cancelled this Order Now!
			</div>
                <?php successmessage('success_state_msg') ?>
                <?php duplicatedataErr('error_state_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Orders Listing</h5>
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


                                            <th style="text-align:center">Main User </th>
                                            <th style="text-align:center">User Name </th>
                                            <th style="text-align:center">Payment Mode </th>
                                            <th style="text-align:center">Total Amount(₹) </th>
                                            <th style="text-align:center">Status </th>
                                            <th style="text-align:center">Order Date </th>
                                            <th style="text-align:center">Details</th>
                                        </tr>
                                    </thead>


                                    <tbody class=" replaceResponse ">
                                        <?php
										$count = 0;
										$strLoadConditions = ' ORDER BY ord_id DESC ';
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, "", "", 1, 'catpagination', '`order`');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowCompany) {
											 
												$count++;
										?>


                                        <tr class="clsparentinformation">


                                            <td style="text-align:center; width:10px">
                                                <?php echo $count; ?> </td>


                                            <td style="min-width:30px;text-align:center">
                                                <?php 
                                                $sql = "SELECT * FROM mstuser WHERE us_Id = '".$rowCompany['ord_userid']."'"; 
                                                $result = $dbh->query($sql);
                                                $row = $result->fetch();
                                                if($row['us_UserName'] == ''){
                                                    echo $row['us_EmailID'];
                                                }else{
                                                    echo $row['us_UserName']."(".$row['us_EmailID'].")";
                                                }
                                                 ?></td>
                                                <td style="min-width:30px;text-align:center">
                                                <?php 
                                                echo $rowCompany['ord_userName']; ?></td>
                                            <!--<td style="min-width:30px;text-align:center">-->
                                            <!--    <?php echo $rowCompany['ord_emailid']; ?></td>-->
                                            <td style="min-width:30px;text-align:center; ">
                                            <?php
                                                if($rowCompany['ord_paymentMethod'] == 0){
                                                    echo "COD";
                                                     }else{
                                                         echo "Online";
                                            }?>
                                                </td>
                                            
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo number_format($rowCompany['OrderTotalAmount'],2); ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <!-- <?php //echo $rowCompany['Os_Name']; ?> -->
                                                <select name="" id=""
                                                    onchange="status('<?php echo $rowCompany['ord_id']; ?>',this.value)"
                                                    class="form-control">
                                                    <?php
                                            
                                                $strOrderStatusConditions = ' ORDER BY Os_Id ASC ';
                                                $resSelectOrderStatus = $class_common->loadMultipleDataByTableName($strOrderStatusConditions, '', '', 0, '', '`orderstatus`');
                                                if (count($resSelectOrderStatus) > 0) {
                                                    foreach ($resSelectOrderStatus as $rowOrderstatus) {
                                                        if($rowCompany['OrderStatusID'] == $rowOrderstatus['Os_Id']){
                                                            $select = "selected";
                                                        }else{
                                                            $select = "";
                                                        }
                                                        echo "<option $select value='".$rowOrderstatus['Os_Id']."'>".$rowOrderstatus['Os_Name']."</option>";
                                                    }
                                                }
                                            ?>
                                                </select>
                                            </td>


                                            <td style="min-width:30px;text-align:center">
                                                <?php
                                                $date = $rowCompany['ord_Date'];
                                                $orderDate = new DateTime($date);

                                                echo $orderDate->format('M d, Y '); ?></td>





                                            <td style="text-align: center;">
                                                <a href="order_details.php?order_id=<?php echo $rowCompany['ord_id']; ?>"
                                                    class="btn btn-primary" title=""> <i class="icon-pencil7"></i></a>
                                                <!-- <a href="#exampleModal<?php echo $rowCompany['ord_id']; ?>"
                                                    data-toggle="modal" class="btn btn-primary">
                                                    <i class="icon-pencil7"></i>
                                                </a> -->



                                                <!--<a onclick="return confirm('Are you sure you want to delete?')"-->
                                                <!--    class="btn btn-danger"-->
                                                <!--    href="manage_state.php?id=<?php echo $rowCompany['st_Id']; ?>&mode=delete">-->
                                                <!--    <i class="icon-trash"></i></a>-->



                                            </td>

                                        </tr>

                                        <!-- Order Details Modal -->
                                        <div class="modal fade" id="exampleModal<?php echo $rowCompany['ord_id']; ?>"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header border-bottom border-secondary">
                                                        <h5 class="modal-title" id="exampleModalLabel">Order
                                                            <?php echo "<b>".$rowCompany['ord_invoiceNo']."</b>"; ?>
                                                            Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <!-- <hr style="margin-top: 3px; margin-bottom: 10px;"> -->
                                                    <div class="modal-body"
                                                        style="padding-top: 10px; display: flex;justify-content: center;">
                                                        <div class="card"
                                                            style="width: 22rem; border: 1px solid #767070; padding-top: 5px; box-shadow: 0px 0px 9px 4px #e5dcdc;">
                                                            <img class="card-img-top" <?php 
                                                                $imgSql = "SELECT * FROM itemimage WHERE itimg_itemID IN ('".$rowCompany['ite_Id']."')"; 
                                                                $Imgresult = $dbh->query($imgSql);
                                                                $Imgrow = $Imgresult->fetch();
                                                            ?> src="<?php echo $Imgrow['itimg_path']; ?>" width="150"
                                                                height="150" alt="Card image cap"
                                                                style="transform: translate(25%, 0px);">
                                                            <div class="card-body"
                                                                style="background: #697179; margin-top: 5%;">
                                                                <p class="card-text"
                                                                    style="margin-bottom: 0px; color: #fff; foont-size: 15px; font-weight: 500; transform: translate(10px);">
                                                                    <?php echo $rowCompany['ite_Name']; ?></p>
                                                                <p class="card-text"
                                                                    style="margin-bottom: 0px; color: #fff; foont-size: 15px; font-weight: 500; transform: translate(10px);">
                                                                    <?php echo "₹".$rowCompany['OrderTotalAmount']; ?>
                                                                </p>
                                                                <p class="card-text"
                                                                    style="margin-bottom: 0px; color: #fff; foont-size: 15px; font-weight: 500; transform: translate(10px);">
                                                                    <?php echo "Unit :".$rowCompany['un_Code']; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




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
        var Orderid = a;
        var Orderstatus = value;
        // console.log(Orderid);
        // console.log(Orderstatus);
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                Orderid: Orderid,
                Orderstatus: Orderstatus
            },
            // dataType: "JSON",
            success: function(data) {
                console.log(data);
                if(data == 1){
                console.log("status");
                    $('#ErrMessage').css('display','block');
                }else if(data == 2){
                    $('#cantCancelMessage').css('display','block');
                }
                // $('#result').html(data);  
            },
            error: function(data) {
                console.log(data);
            }
        });

    }
    </script>
    <script>
    $(document).ready(function(){
        $(document).on('click', '.addinvoice', function(){
            
            var orderID = $(this).data("orderid");
            var invoiceNo= $('.invoiceClass'+orderID).val();
            $.ajax({
                url: "action.php",
                type: "POST",
                data:{
                    inVoiceNo: invoiceNo,
                    orderId: orderID,
                    issetInvoice: true
                },
                success: function(data){
                    if(data == 1){
                        $("#"+orderID).remove();
                        $('.invoiceClass'+orderID).prop('disabled', true);
                    }
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
    });
    </script>

    </body>

    </html>