<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Orders";
include_once 'header.php';
$strPageTitle = 'Manage Orders';

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
                        <h4><a href="manage_order.php"><i class="icon-arrow-left52 position-left"></i> </a><span
                                class="text-semibold">Order </span> - Details</h4>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </div>


                </div>
            </div>



            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <?php successmessage('success_item_msg') ?>
                <?php duplicatedataErr('error_item_msg') ?>
                <!-- Both borders -->
                
                <div class="panel panel-default">
                    <!--<div>-->
                    <!--        <h4>Ordered By: RAHul</h4>-->
                    <!--    </div>-->
                    <div class="panel-body" >
                        
                        <div class="row" style="">
                            <?php
                            $sql = "SELECT * FROM `order` WHERE ord_id = '".$_GET['order_id']."'";
                            $result= $dbh->query($sql);
                            $userRow = $result->fetch();
							?>
                            <div class="col-lg-12" style="background: #fff; display: flex;" >
                                <div class="row" style="width: 100%;">
                                    <div class="col-lg-5">
                                        <div class="row">
                                            <div class="col-lg-12 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Ordered No : </b>
                                            </span>
                                            <span class=" text-uppercase">
                                                
                                                #<?php echo $userRow['ord_OrderNo']; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Ordered By : </b>
                                            </span>
                                            <span class=" text-uppercase">
                                                
                                                <?php echo $userRow['ord_userName']; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Email : </b>
                                            </span>
                                            <span class=" text-uppercase">
                                                
                                                <?php echo $userRow['ord_emailid']; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Mobile : </b>
                                            </span>
                                            <span class=" text-uppercase">
                                                
                                                <?php echo $userRow['ord_mobilNo']; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Delivary Address : </b>
                                            </span>
                                            <span class=" text-uppercase">
                                                
                                                <?php echo $userRow['ord_AddressLine1'].",".$userRow['ord_AddressLine1']."-".$userRow['ord_postalcode'].",".$userRow['ord_City']; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <?php if($userRow['ord_paymentMethod'] == 1){ ?>
                                    <div class="col-lg-12 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Razorpay Order Id : </b>
                                            </span>
                                            <span class="">
                                                
                                                <?php echo $userRow['razorpay_order_id']; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Razorpay Payment Id : </b>
                                            </span>
                                            <span class="">
                                                
                                                <?php echo $userRow['razorpay_payment_id']; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="col-lg-12 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Invoice No : </b>
                                            </span>
                                            <?php
                                                if($userRow['ord_invoiceNo'] != NULL){ ?>
                                            <span class=" text-uppercase">
                                            <?php echo $userRow['ord_invoiceNo']; ?> 
                                            </span>
                                            <?php }else{ ?>
                                            <input type="text" class="invoiceClass<?php echo $userRow['ord_id']; ?>" id="invoice" style="border: 1px solid #958f8f; margin-right: 5px;" placeholder="Set Invoice Number." value="<?php echo $userRow['ord_invoiceNo']; ?>">
                                            <button type="button" class="btn btn-info addinvoice" id="<?php echo $userRow['ord_id']; ?>" data-orderid="<?php echo $userRow['ord_id']; ?>" style="height: 25px; padding-top: 2px;">Add</button> 
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Total Item Cost : </b>
                                            </span>
                                            <span class="">
    <b>₹</b><?php echo number_format($userRow['OrderTotalBftAmount'],2); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Delivery Cost : </b>
                                            </span>
                                            <span class="">
                                                <b>₹</b><?php echo number_format($userRow['ord_DeliveryCost'],2); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Tax Amount : </b>
                                            </span>
                                            <span class="">
                                                <b>₹</b><?php echo number_format($userRow['OrdertaxAmount'],2); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <?php if($userRow['ord_TotalDiscount']>0){ ?>
                                    <div class="col-lg-12 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Discount Amount : </b>
                                            </span>
                                            <span class="">
                                                <b>₹</b><?php echo number_format($userRow['ord_TotalDiscount'],2); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Coupan Name : </b>
                                            </span>
                                            <?php 
                                                $coupanNameSql = "SELECT OrdDtl_DIscountCode FROM orderdtl WHERE ordDtl_OrderId=".$userRow['ord_id']."";
                                                $coupanNameRes = $dbh->query($coupanNameSql);
                                                $coupanNameRow = $coupanNameRes->fetch();
                                                
                                            
                                            ?>
                                            <span class="">
                                                <?php echo $coupanNameRow['OrdDtl_DIscountCode']; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="col-lg-12 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Final Amount : </b>
                                            </span>
                                            <span class="">
                                                <b>₹</b><?php echo number_format($userRow['OrderTotalAmount'],2); ?>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row">
                                            <div class="col-lg-12 prod-info ">
                                                <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Ordered On : </b>
                                            </span>
                                            <span class=" text-uppercase">
                                                <?php 
                                                date_default_timezone_set("Asia/Kolkata");
                                                $orderDate = new DateTime($userRow['ord_Date']);

                                                echo $orderDate->format('M d, Y  h:iA');       
                                                //echo $userRow['ord_Date'];     ?>
                                            </span>
                                        </div>
                                        </div>
                                            <div class="col-lg-12 prod-info ">
                                                <div class="prod-name d-flex ">
                                                    <span class="itemName">
                                                        <b>Accept Ordered : </b>
                                                    </span>
                                                    <span class=" text-uppercase">
                                                        
                                                        <?php
                                                        $AcceptSql = "SELECT * FROM orderstausTime WHERE ordTime_ordId = '".$_GET['order_id']."' AND ordTime_statusId = 2";
                                                        $AcceptRes = $dbh->query($AcceptSql);
                                                        $Acceptrow = $AcceptRes->fetch();
                                                        if($AcceptRes->rowCount() > 0){
                                                             $AcceptDate = new DateTime($Acceptrow['ordTime_time']);

                                                echo $AcceptDate->format('M d, Y  h:iA');   
                                                        }
                                                    //echo $userRow['ord_Date']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 prod-info ">
                                                <div class="prod-name d-flex ">
                                                    <span class="itemName">
                                                        <b>Dispatch Order : </b>
                                                    </span>
                                                    <span class=" text-uppercase">
                                                        
                                                        <?php
                                                        $DispatchSql = "SELECT * FROM orderstausTime WHERE ordTime_ordId = ".$_GET['order_id']." AND ordTime_statusId = 3";
                                                        
                                        $DispatchRes = $dbh->query($DispatchSql);
                                                        
                                                        if($DispatchRes->rowCount() > 0){
                                                            // echo 0;
                                                            $Dispatchrow = $DispatchRes->fetch();
                                                             $DispatchDate = new DateTime($Dispatchrow['ordTime_time']);

                                                echo $DispatchDate->format('M d, Y  h:iA');   
                                                        }
                                                        
                                                    //echo $userRow['ord_Date']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 prod-info ">
                                                <div class="prod-name d-flex ">
                                                    <span class="itemName">
                                                        <b>Delivered : </b>
                                                    </span>
                                                    <span class=" text-uppercase">
                                                        
                                                        <?php
                                                        $DeliveredSql = "SELECT * FROM orderstausTime WHERE ordTime_ordId = ".$_GET['order_id']." AND ordTime_statusId = 4";
                                                        $DelivereRes = $dbh->query($DeliveredSql);
                                                        
                                                        if($DelivereRes->rowCount() > 0){
                                                            $Delivererow = $DelivereRes->fetch();
                                                             $DelivereDate = new DateTime($Delivererow['ordTime_time']);

                                                echo $DelivereDate->format('M d, Y  h:iA');  
                                                        } ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 prod-info ">
                                                <div class="prod-name d-flex ">
                                                    <span class="itemName">
                                                        <b>Cancelled : </b>
                                                    </span>
                                                    <span class=" text-uppercase">
                                                        
                                                        <?php 
                                                        $CanceledSql = "SELECT * FROM cancellationrequest WHERE cancelResq_OderId = ".$_GET['order_id']." AND cancelResq_Iscancel = 1";
                                                        $CanceledRes = $dbh->query($CanceledSql);
                                                        
                                                        if($CanceledRes->rowCount() > 0){
                                                            $Canceledrow = $CanceledRes->fetch();
                                                             $CanceledDate = new DateTime($Canceledrow['cancelResq_ApprovedDate']);

                                                echo $CanceledDate->format('M d, Y  h:iA');  
                                                        }
                                                //echo $userRow['ord_Date']; 
                                                ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 prod-info ">
                                                <div class="prod-name d-flex ">
                                                    <span class="itemName">
                                                        <b>Cancelled Decline: </b>
                                                    </span>
                                                    <span class=" text-uppercase">
                                                        
                                                        <?php 
                                                        $CanceledDeclineSql = "SELECT * FROM cancellationrequest WHERE cancelResq_OderId = ".$_GET['order_id']." AND cancelResq_Iscancel = 0";
                                                        $CanceledDeclineRes = $dbh->query($CanceledDeclineSql);
                                                        
                                                        if($CanceledDeclineRes->rowCount() > 0){
                                                            $CanceledDeclinerow = $CanceledDeclineRes->fetch();
                                                             $CanceledDeclineDate = new DateTime($CanceledDeclinerow['cancelResq_ApprovedDate']);

                                                echo $CanceledDeclineDate->format('M d, Y  h:iA');  
                                                        }
                                                    //echo $userRow['ord_Date']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-4">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                 <div class="col-lg-12">
                                    <label class="col-lg-4 control-label">Delivary Date<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-8">
                                        
                                        <input type="date" name="delivaryDate" id="delivaryDate" value="<?php
                                        if($userRow['ord_DeliverDate'] != '0000-00-00'){echo $userRow['ord_DeliverDate'];
                                        }else{date_default_timezone_set("Asia/Kolkata");echo date('Y-m-d'); }?>" class="form-control" placeholder="Delivary Date">

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label class="col-lg-4 control-label">Time From<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-8">
                                        <?php if($userRow['ord_deliveredTimeFrom'] != '00:00:00'){
                                            $timeFrom = date("h:i A", strtotime($userRow['ord_deliveredTimeFrom'])); echo "$timeFrom";
                                        }else{ ?>
                                        <input type="time" name="timefrom" id="timefrom" value="" class="form-control" placeholder="Delivary Date">
                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label class="col-lg-4 control-label"> to<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-8">
                                        <?php if($userRow['ord_deliveredTimeTo'] != '00:00:00'){
                                             $timeTo = date("h:i A", strtotime($userRow['ord_deliveredTimeTo'])); echo "$timeTo"; 
                                        }else{ ?>
                                        <input type="time" name="timeto" id="timeto" value="" class="form-control" placeholder="Delivary Date">
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center" style="margin-top: 5px;">
                                    <?php if($userRow['ord_deliveredTimeTo'] == '00:00:00' ||$userRow['ord_deliveredTimeFrom'] == '00:00:00' || $userRow['ord_DeliverDate'] == '0000-00-00'){ 
                                    if($userRow['OrderStatusID'] != 5){?>
                                    <button type="button" name="delivaryDatevtn" id="delivaryDatevtn" onclick="" class="btn btn-primary"
                                                aria-expanded="false">Set Time </button>
                                                <?php } }?>
                                    <!--<div class="col-lg-8">-->
                                    <!--    <input type="time" name="delivaryDate" id="countryName" class="form-control" placeholder="Delivary Date">-->
                                    <!--</div>-->
                                </div>
                                    
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            



                        </div>
                    </div>
                    <div class="panel-body" style="background: #F5F5F5;">
                        
                        <div class="row" style="display: flex;">
                            <?php
								$strLoadConditions = " AND ordDtl_OrderId = '".$_GET['order_id']."' ";
                                $strFields = "orderdtl.*, `order`.*, item.*, unit.*";
								$strJoinCondition = " LEFT JOIN item ON orderdtl.ordDtl_itemID = item.ite_Id LEFT JOIN unit ON orderdtl.OrdDtlUnitId = unit.un_Id LEFT JOIN `order` ON orderdtl.ordDtl_id = `order`.ord_id";
								$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFields, $strJoinCondition, 1, 'catpagination', '`orderdtl`');
                                if (count($resSelectCouponList) > 0) {
									foreach ($resSelectCouponList as $rowSize) {
							?>
                            <div class="col-lg-4" style="background: #fff; border: 1px solid #979191; margin: 0px 4px;">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <?php 
                                            $imgSql = "SELECT * FROM itemimage WHERE itimg_itemID IN ('".$rowSize['ite_Id']."')"; 
                                            $Imgresult = $dbh->query($imgSql);
                                            $Imgrow = $Imgresult->fetch();
                                        ?>
                                        <img src="../uploads/item_image/<?php echo $Imgrow['itimg_path']; ?>" alt="" width="100" height="100"
                                            class="w-100">
                                    </div>
                                    <div class="col-lg-6 prod-info ">
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Product Name : </b>
                                            </span>
                                            <span class=" text-uppercase">
                                                <?php 
                                            $productSql = "SELECT * FROM product WHERE prod_Id IN ('".$rowSize['ite_ProdId']."')"; 
                                            $productresult = $dbh->query($productSql);
                                            $productrow = $productresult->fetch();
                                        ?>
                                                <?php echo $productrow['prod_Name']; ?>
                                            </span>
                                        </div>
                                        <div class="prod-name d-flex ">
                                            <span class="itemName">
                                                <b>Item Name : </b>
                                            </span>
                                            <span class=" text-uppercase">
                                                <?php echo $rowSize['ite_Name'];     ?>
                                            </span>
                                        </div>
                                        <div class="prod-value">
                                            <span><b>Volume :</b></span>
                                            <span class="prodvalue">
                                                <?php echo $rowSize['OrdDtl_Volumen']; ?>
                                            </span>
                                        </div>

                                        <span class="prod-price">
                                            <span><b>Price :</b></span>
                                            &#8377;<?php echo $rowSize['OrdDtl_Rate']; ?>
                                        </span>


                                        <div class="prod-add-now  d-flex justify-content-between">
                                            <span><b>Unit :</b></span>
                                            <span class=""><?php echo $rowSize['un_Code']; ?></span>
                                        </div>
                                        <?php 
                                            $attributedata = "SELECT `attribute`.`att_Name`,orderdtl_att_AttId, `attributedtl`.`attd_value` FROM orderdtl_att LEFT JOIN attribute ON orderdtl_att_AttId=att_Id LEFT JOIN attributedtl ON orderdtl_att_AttValue=attd_id WHERE orderdtl_att_orddtlId=".$rowSize['ordDtl_id']." GROUP BY att_Name";
                                            // echo $attributedata;
                                            $attributeRes = $dbh->query($attributedata);
                                            $attributeName = $attributeRes->fetchAll();
                                            if(count($attributeName) > 0){
                                                
                                            
                                        
                                        ?>
                                        <div class="prod-add-now  d-flex justify-content-between">
                                            <span><b>Attribute :</b></span></b>
                                           <br><span class="" style="position: relative; left: 10%;"><?php 
                                            
                                            foreach($attributeName as $attributeRow){
                                                $AttributeValueData = "SELECT `attributedtl`.`attd_value` FROM orderdtl_att LEFT JOIN attributedtl ON orderdtl_att_AttValue=attd_id WHERE orderdtl_att_orddtlId=".$rowSize['ordDtl_id']." AND orderdtl_att_AttId=".$attributeRow['orderdtl_att_AttId']."";
                                        $AttributeValueRes = $dbh->query($AttributeValueData);
                                            $AttributeValueName = $AttributeValueRes->fetchAll();
                                            $attributevalues = array();
                                                foreach($AttributeValueName as $AttributeValueRow){
                                                    $attributevalues[] = $AttributeValueRow['attd_value'];
                                                }
                                                
                                                echo "<b>".$attributeRow['att_Name']."</b>=>".implode(',',$attributevalues)."<br>";
                                            }
                                                ?>
                                                </span>
                                                </div>
                                            <?php }
                                        //echo $rowSize['un_Code']; ?>
                                    
                                    </div>


                                </div>
                            </div>
                            <?php
										}
									}
								?>



                        </div>
                    </div>


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

    </body>

    </html>
    <script>
        $(document).ready(function(){
            $(document).on("click", "#delivaryDatevtn", function() {
                // alert("Hello");
                var delivarydate = $("#delivaryDate").val();
                var timefrom = $("#timefrom").val();
                var timeto = $("#timeto").val();
                var orderId = <?php echo $_GET['order_id']; ?>;
                $.ajax({
                   url: "action.php",
                   type: "post",
                   data: {
                       delivarydate: delivarydate,
                       timefrom: timefrom,
                       timeto: timeto,
                       orderId:orderId,
                       isselDelivaryDateTime: true
                   },
                   success: function(data){
                    //   console.log(data);
                    location.reload();
                   }
                });
            });
        });
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
                        location.reload();
                    }
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
    });
    </script>