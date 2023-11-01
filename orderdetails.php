<?php include_once './admin/connection_handle.php';
include_once './classes/class_getvaluesamount.php';
$class_user_login->checkuserLoggedIn();
$strLoadAdminCondition = ' AND us_Id=' . $class_user_login->getCurrentLoginAdminId();
$rowAdminInfo = $class_common->loadSingleDataBy($strLoadAdminCondition, '', '', TABLE_USER);


$checkloginadmin = $class_user_login->checkuserLoggedIn();
if ($checkloginadmin == '') {
	redirect('loginsignup.php');
}
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grofkit</title>

<script src="assets1/js/loader.js"></script>
    <style>
        .loader{
    background: black;
    position: fixed !important;
    display: flex;
    z-index: 99999999999999;
}
    </style>

</head>

<body class="h-100">


    <div class="h-100 d-flex flex-column justify-content-between">
        <header
            class="container-fluid d-flex flex-column justify-content-center cart-header position-sticky top-0  bg-black ">

            <div class="row align-items-center justify-content-between">
                <div class="col-lg-2 w-auto col-md-3 col-4 d-flex  align-items-center ">

                    <!-- <img src="assets1/images/WhatsApp_Image_2022-03-27_at_21.40.45-removebg-preview.png" alt="" class="img-fluid logo-img"> -->
                    <a href="index.php" class="logourl"><div class="logo"><span>G</span>ROFKIT</div></a>
                </div>

                <div class="pincode w-auto col-lg-2 col-md-3 col-4 d-flex align-items-center">

                    <img src="assets1/images/location-pointer.png" alt="" class="pincode-img">
                    <span class="pincode-value">
                        <?php
                        $loginUserId = $_SESSION['USER']['ID'];
                        $pincodeSql = "SELECT us_postalCode FROM mstuser WHERE us_Id = '$loginUserId'";
                        $pincodeRes = $dbh->query($pincodeSql);
                        $pincodeRow =  $pincodeRes->fetch();
                        if($pincodeRes->rowCount() >0){
                           echo $pincodeRow['us_postalCode'];
                        }else{
                            echo "Pincode";
                        }
                        
                        //echo $_SESSION['USER']['pincode']; 
                        ?>
                    </span>

                </div>




                <!-- <div class="col-2 d-flex align-items-center justify-content-evenly">
                    <a class="login-signup" href="">
                        LOG IN/SIGN UP
                    </a>
                    <a href="" class="cart">
                        <img src="assets1/images/cart.png" alt="" class="" >
                    </a>

                </div> -->
            </div>

            <div class="d-flex d-md-none align-items-center justify-content-between">
                <div class=" d-flex  align-items-center ">

                    <!-- <img src="assets1/images/WhatsApp_Image_2022-03-27_at_21.40.45-removebg-preview.png" alt="" class="img-fluid logo-img"> -->
                    <div class="customer-order-name">Qazim Hussain</div>
                </div>

                <div class=" d-flex  align-items-center ">

                    <!-- <img src="assets1/images/WhatsApp_Image_2022-03-27_at_21.40.45-removebg-preview.png" alt="" class="img-fluid logo-img"> -->
                    <a
                        class=" d-flex  align-items-center text-decoration-none text-white  justify-content-end pincode-sec">


                        <!-- <div class="d-flex flex-column justify-content-between">
                            <span class="pincode-value ">000000</span>
    
                        </div> -->

                        <h6 class="customer-order-phone mb-0">
                            9689786908

                        </h6>



                    </a>
                </div>




                <!-- <div class="col-2 d-flex align-items-center justify-content-evenly">
                    <a class="login-signup" href="">
                        LOG IN/SIGN UP
                    </a>
                    <a href="" class="cart">
                        <img src="assets1/images/cart.png" alt="" class="" >
                    </a>

                </div> -->
            </div>






        </header>




        <section class="container-fluid h-100 ">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-10 col-xl-9 col-md-12 shadow cart-main order-details-main ">
                    <div class="row h-100">
                        <div class="cart-items-info order-details-items-info    col-lg-8 col-md-7">
                            <!-- <div class="cart-heading cart-same-p border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-600 fsz-2">Your Cart</h6>
                                <span class="fw-600">
                                    <span class="items-quantity ">2</span> 
                                    <span>Items</span>
                                </span>
    
                            </div> -->

                            <div class="cart-all-items order-details-allitems  cart-same-p">
                                <div class="d-flex  justify-content-between">
                                    <span class="w-60">Product Details</span>
                                    <span class="w-20">Amount</span>
                                    <span class="w-20 d-flex justify-content-end">Quantity</span>



                                </div>
                                <?php 
                                    if(isset($_GET['orderNo'])){
                                        $orderno = $_GET['orderNo'];
                                        $orddetail = "AND ord_id = '$orderno'";
                                    }else{
                                        $orddetail = '';
                                    }
                                ?>

                                <div class="cart-select-items-container order-all-items-container">
                                    <?php
                                        $userId = $_SESSION['USER']['ID'];
                                        $orderItems = array();
                                        $strLoadConditions = " AND ord_userid = '$userId' $orddetail ORDER BY ordDtl_OrderId DESC";
                                        // $Fileds = '`order`.*, orderdtl.*, itemimage.*';
                                        // $strJoinCondition = "LEFT JOIN itemimage ON ordDtl_itemID = itimg_itemID LEFT JOIN `order` ON ordDtl_OrderId = ord_id";
                                        // $resSelectCartList = $class_common->loadMultipleDataByTableName($strLoadConditions, $Fileds, $strLoadConditions, 0, '', '`orderdtl`');
                                        
                                        $strLoadConditions = " AND ord_userid = '$userId' $orddetail AND itimg_IsMainImage = 1 GROUP BY OrdDtl_itemName ORDER BY ordDtl_OrderId DESC ";
                                        $strFileds = '`order`.*, orderdtl.*, itemimage.*';
                                        $strJoinCondition = "LEFT JOIN itemimage ON ordDtl_itemID = itimg_itemID LEFT JOIN `order` ON ordDtl_OrderId = ord_id";
                                        $resSelectCartList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, $strJoinCondition, 0, '', 'orderdtl');

                                        if (count($resSelectCartList) > 0) {
                                            foreach ($resSelectCartList as $rowSize) { 
                                                $orderItems[] = $rowSize['ordDtl_itemID'];
                                    ?>
                                    <div class="cart-select-item  d-flex justify-content-between align-items-center">

                                        <div class="cart-item-details w-60 d-flex align-items-stretch">
                                            <div class="cart-img">
                                                <img src="dashboard/uploads/item_image/<?php echo $rowSize['itimg_path']; ?>" alt=""
                                                    class="img-fluid">
                                            </div>
                                            <div
                                                class="cart-item-name-det flex-grow-1 d-flex flex-column justify-content-md-evenly justify-content-center">
                                                <h6 class="mb-0 "><?php echo $rowSize['OrdDtl_itemName']; ?></h6>
                                                <?php
                                                    $iteminfo= $dbh->query("SELECT COUNT(*) as totalAtt FROM `orderdtl_att` WHERE orderdtl_att_orddtlId='".$rowSize['ordDtl_id']."'");
                                                    $iteminfoRes = $iteminfo->fetch();
                                                    if($iteminfoRes['totalAtt'] >0){
                                                ?>
                                                <i class="fa-solid fa-circle-info"
                                                    data-item=<?php echo $rowSize['itimg_itemID'] ?>></i>
                                                <?php }?>
                                                <span class="d-flex">
                                                    <span
                                                        class="item-quant">1<?php echo $rowSize['OrdDtl_UnitName']; ?></span>
                                                    <span class="mx-1"> X </span>
                                                    <span
                                                        class="item-price"><?php echo $rowSize['OrdDtl_Volumen']; ?></span>
                                                    <span class="mx-1">=</span>
                                                    <span><?php echo $rowSize['OrdDtl_Volumen'].$rowSize['OrdDtl_UnitName']; ?></span>

                                                </span>

                                                <div class="pro-info proinfo<?php echo $rowSize['itimg_itemID'] ?>">
                                                    <h6>Item Details </h6>
                                                    <?php
                                                        $itemDtlSql = $dbh->query("SELECT attribute.att_Name,attribute.att_Id FROM `orderdtl_att` LEFT JOIN attribute ON attribute.att_Id = `orderdtl_att`.`orderdtl_att_AttId` WHERE orderdtl_att_orddtlId='".$rowSize['ordDtl_id']."' GROUP BY orderdtl_att_AttId");
                                                        $itemDtlRes = $itemDtlSql->fetchAll();
                                                        foreach($itemDtlRes as $attinfo){
                                                    ?>
                                                    <div class="d-flex mt-2 flex-column justify-content-between">
                                                        <h5><?php echo ucfirst($attinfo['att_Name']); ?>:</h5>
                                                        <div class="ms-3 attr-item">
                                                            <?php 
                                                                $attVlaue= $dbh->query("SELECT attributedtl.attd_value FROM `orderdtl_att` LEFT JOIN attributedtl ON attributedtl.attd_id = `orderdtl_att`.`orderdtl_att_AttValue` WHERE orderdtl_att_orddtlId='".$rowSize['ordDtl_id']."' AND orderdtl_att_AttId='".$attinfo['att_Id']."'");
                                                                $attValueRes = $attVlaue->fetchAll();
                                                                foreach($attValueRes as $attvalueName){
                                                            ?>
                                                            <span class="active"><?php echo ucfirst($attvalueName['attd_value']); ?></span>
                                                            <?php } ?>
                                                            <!-- <span>Red</span> -->
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <!-- <div class="d-flex mt-2 flex-column justify-content-between">
                                                        <h5>Size:</h5>

                                                        <div class="ms-3 attr-item">
                                                            <span>XXl</span>
                                                            <span class="active">Xl</span>
                                                        </div>
                                                    </div> -->
                                                </div>

                                            </div>
                                        </div>
                                        <div class="cart-item-price order-details-amount   w-20"
                                            data-bs-price=${cartelem.price}"> <label> &#8377; </label> <label>
                                                <?php echo $rowSize['OrdDtl_Rate']; ?></label> </div>

                                        <div
                                            class="order-item-quantity w-20 d-flex justify-content-end align-items-center">
                                            <!--<i class="fa-solid fa-trash del"></i>-->
                                            <!--<i class="fa-solid fa-minus d-none sub"></i>-->

                                            <span class="item-value order-item-value "><?php echo $rowSize['OrdDtl_Volumen']; ?></span>
                                            <!--<i class="fa-solid fa-plus add "></i>-->
                                        </div>

                                    </div>
                                    <?php } 
                                } ?>
                                </div>

                            </div>
                        </div>
                        <div class="cart-order-info order-details-info d-md-block d-none  col-lg-4 col-md-5">

                            <div
                                class="cart-heading cart-same-p border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-600 fsz-2">Order Summary</h6>
                                <div class="pincode d-flex align-items-center">

                                    <img src="assets1/images/location-pointer.png" alt="" class="pincode-img">
                                    <span class="pincode-value">
                                    <?php
                                    $OrderpincodeSql = "SELECT ord_postalcode FROM `order` WHERE ord_id = '$orderno'";
                                    $OrderpincodeRes = $dbh->query($OrderpincodeSql);
                                    $OrderpincodeRow = $OrderpincodeRes->fetch();
                                    ?>
                                    <?php echo $OrderpincodeRow['ord_postalcode']; ?></span>

                                </div>


                            </div>
                            <?php
                            $mysql = "SELECT COUNT(*) as totalOrderItem, sum(OrdDtl_Rate) as itemamount, sum(OrdDtl_Rate+OrdDDtl_Cgst+OrdDtl_sgst-OrdDtl_DIscountAmount) as FinalAmount,`order`.*, orderdtl.* FROM orderdtl LEFT JOIN `order` ON `ordDtl_OrderId` = ord_id WHERE `ordDtl_OrderId` = '$orderno' AND ord_userid = '$userId'";
                            // echo $mysql;
                            $myRes = $dbh->query($mysql);
                            $totalOrderItem = $myRes->fetch();
                            $OrderPinCode = $totalOrderItem['ord_postalcode'];
                            
                            // $orderNoCode = $totalOrderItem['OrdDtl_DIscountCode'];
                            ?>

                            <div class="no-scrollbar" style="height: 53vh; overflow: auto;">

                                <div class="card-order-details order-details-block  border-bottom cart-same-p">
                                    <div class="item-total d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-600">
                                            Items (<?php echo $totalOrderItem['totalOrderItem']; ?>)
                                        </h6>
                                        <span class="border-dashed-1 flex-grow-1"></span>
                                        <h5 class="item-total-amount fw-600">
                                            <span>&#8377;</span><span><?php echo number_format($totalOrderItem['itemamount'],2); ?></span>
                                        </h5>

                                    </div>

                                    <div class="shipping d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-600">
                                            Shipping
                                        </h6>
                                        <span class="border-dashed-1 flex-grow-1"></span>
                                        <h5 class="shipping-total-amount fw-600">
                                            <?php 
                                            $scost=$totalOrderItem['ord_DeliveryCost'];
                                            
                                            if($scost <= 0){
                                                $scost = "FREE";
                                            ?>
                                            <span class="text-green"><?php echo $scost; ?></span>
                                            <?php }else{ ?>
                                            +<span>&#8377;</span><span id="shippingCost"><?php 
                                            // number_format($totalOrderItem['ord_DeliveryCost'],2);
                                        echo number_format($scost,2);
                                        // echo $OrderPinCode;
                                        ?></span>
                                            <?php } ?>
                                        </h5>

                                    </div>
<?php if($totalOrderItem['OrdDtl_DIscountAmount'] == 0){
    $display = "d-none";
}else{
    $display = "d-block";
} ?>
                                    <div class="promocode-price d-flex justify-content-between align-items-center <?php echo $display; ?>">
                                        <h6 class="mb-0 fw-600">
                                        <?php echo $totalOrderItem['OrdDtl_DIscountCode']; ?>
                                        </h6>
                                        <span class="border-dashed-1 flex-grow-1"></span>
                                        <h5 class="procode-total-amount fw-600">


                                            <span class=""><span>-</span> <span>&#8377;</span><?php echo $totalOrderItem['OrdDtl_DIscountAmount']; ?></span>
                                        </h5>

                                    </div>
                                    <div class="gst-price d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-600">
                                            GST
                                        </h6>
                                        <span class="border-dashed-1 flex-grow-1"></span>
                                        <h5 class="procode-total-amount fw-600">

                                            <?php $Gcost=$GetValuesAmount->GetGstCost($orderItems); ?>
                                            <span
                                                class=""><span>+</span><span>&#8377;</span><?php 
                                                //echo $Gcost<=0?'0':$Gcost;
                                                echo number_format($totalOrderItem['OrdertaxAmount'],2);
                                                ?></span>
                                        </h5>

                                    </div>
                                </div>

                                <div class="totalcost d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-600">
                                        Total Cost
                                    </h6>
                                    <span class="border-dashed-1 flex-grow-1"></span>
                                    <h5 class="item-total-amount fw-600">
                                        <span>&#8377;</span><span><?php
                                        
                                        // $GetValuesAmount->GetShippingCost($orderItems,$OrderPinCode);
                                        echo number_format($totalOrderItem['OrderTotalAmount'],2); ?></span>
                                    </h5>


                                </div>
                                <!-- <div class="coupon-code d-flex justify-content-center">

                                    <a href="applypromo.php" class="promocode d-none">
                                        Apply Promocode
                                    </a>
                                    <a class="apply-promocode"> <span class="promo-name">OFFER50</span> <span
                                            class="canc-promo bi bi-x-lg fw-bolder"></span> </a>
                                </div> -->
                                <?php 
                                $cancellationSql = "SELECT count(*) as cancelReq,`cancelResq_Iscancel` FROM `cancellationrequest` WHERE 1=1 AND `cancelResq_OderId` = '$orderno'";
                                $mycancellationRes = $dbh->query($cancellationSql);
                                $cancellationRequest = $mycancellationRes->fetch();
                                if($cancellationRequest['cancelReq'] != 0){ 
                                    $cancelbtndisplay = "d-none";
                                    $cancellationReqbtn = "d-block";
                                }else{
                                    $cancelbtndisplay = "d-block";
                                    $cancellationReqbtn = "d-none";
                                }
                                $ForCancellationSql = "SELECT * FROM `order` WHERE ord_id = '$orderno'";
                        $ForCancellationRes = $dbh->query($ForCancellationSql) or die("query FAield");
                                $ForCancellationRow = $ForCancellationRes->fetch();
                                if($ForCancellationRow['OrderStatusID'] != 3 OR $ForCancellationRow['OrderStatusID'] != 4){
                                
                                ?>
                                <a class="cancelbtn cancelbtnmodal  text-decoration-none text-reset text-center <?php echo $cancelbtndisplay; ?>"
                                    id="cancelbtn">
                                    <span>Cancel Order</span>
                                    <!-- <span class="canc-order bi bi-x-lg fw-bolder"></span> -->
                                </a>
                                <?php if($cancellationRequest['cancelResq_Iscancel'] == NULL){
                                     $cancellationBtnIdName = "cancellationbtn";
                                         $text = "<span>Cancel the cancellation order</span>";
                                    $cancellationBtnClass = "cancellation-btn";
                                    
                                    }else if($cancellationRequest['cancelResq_Iscancel'] == 1){
                                        $cancellationBtnIdName = "";
                                        $text = "<span>Order Cancelled</span>";
                                        $cancellationBtnClass = '';
                                    }else{
                                       $cancellationBtnIdName = "";
                                       $text = "<span>Cancellation Request Decline</span>";
                                       $cancellationBtnClass='';
                                    }
                                    ?>
                                
                                <a class="cancelbtn <?php $cancellationBtnClass ?>  text-decoration-none text-reset <?php echo $cancellationReqbtn; ?> text-center"
                                    id="<?php echo $cancellationBtnIdName; ?>" data-cancelorderno="<?php echo $orderno; ?>">
                                    <?php echo $text; ?>
                                    <!--<span>Cancel the cancellation order</span>-->
                                    <!-- <span class="canc-order bi bi-x-lg fw-bolder"></span> -->
                                    
                                </a>

                                <a class="re-order cancelbtn d-none text-center" id="reorderbtn">
                                    <span>Re-Order</span>
                                </a>
                                <?php  }?>
                            </div>






                        </div>

                        <div class="cart-order-info order-details-info d-md-none  col-lg-4 col-md-5">

                            <div class="coupon-code">
                                <a href="#ordersummary" class="details-order view-det" data-bs-toggle="collapse"
                                    aria-expanded="false">View Details</a>
                                <!-- <a href="applypromo.php" class="promocode d-none">
                                    Apply Promocode
                                </a> -->
                                <a class="apply-promocode <?php echo $display; ?>"> <span class="promo-name"><?php echo $totalOrderItem['OrdDtl_DIscountCode']; ?></span> 
                                <!-- <span class="canc-promo bi bi-x-lg fw-bolder"></span>  -->
                            </a>
                            </div>


                            <div class="collapse" id="ordersummary">
                                <div class="order-summary d-flex flex-grow-1 collapse  flex-column">
                                    <div
                                        class="cart-heading cart-same-p border-bottom d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-600 fsz-2">Order Summary</h6>
                                        <div class="pincode d-flex align-items-center">

                                            <img src="assets1/images/location-pointer.png" alt="" class="pincode-img">
                                            <span class="pincode-value"><?php echo $OrderpincodeRow['ord_postalcode']; ?></span>

                                        </div>


                                    </div>

                                    <div class="card-order-details order-details-block border-bottom cart-same-p">
                                        <div class="item-total d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 fw-600">
                                                Items (<?php echo $totalOrderItem['totalOrderItem']; ?>)
                                            </h6>
                                            <span class="border-dashed-1 flex-grow-1"></span>
                                            <h5 class="item-total-amount fw-600">
                                                <span>&#8377;</span>
                                                <span><?php echo number_format($totalOrderItem['itemamount'],2); ?></span>
                                            </h5>

                                        </div>

                                        <div class="shipping d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 fw-600">
                                                Shipping
                                            </h6>
                                            <span class="border-dashed-1 flex-grow-1"></span>
                                            <h5 class="shipping-total-amount fw-600">
                                            <?php if($scost<=0){
                                                $scost = "FREE";
                                            ?>
                                                <span class="text-green"><?php echo $scost; ?></span>
                                                <?php }else{ ?>
                                            +<span>&#8377;</span><span id="shippingCost"><?php 
                                            // number_format($totalOrderItem['ord_DeliveryCost'],2);
                                            echo number_format($scost,2); ?></span>
                                            <?php } ?>
                                            </h5>

                                        </div>

                                        <div class="promocode-price d-flex justify-content-between align-items-center <?php echo $display; ?>">
                                            <h6 class="mb-0 fw-600">
                                            <?php echo $totalOrderItem['OrdDtl_DIscountCode']; ?>
                                            </h6>
                                            <span class="border-dashed-1 flex-grow-1"></span>
                                            <h5 class="procode-total-amount fw-600">


                                                <span class=""><span>-</span> <span>&#8377;</span><?php echo $totalOrderItem['OrdDtl_DIscountAmount']; ?></span>
                                            </h5>

                                        </div>
                                        <div class="gst-price d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 fw-600">
                                                GST
                                            </h6>
                                            <span class="border-dashed-1 flex-grow-1"></span>
                                            <h5 class="procode-total-amount fw-600">


                                                <span class=""><span>+</span> <span>&#8377;</span><?php 
                                                //echo $Gcost<=0?'0':$Gcost;
                                                echo number_format($totalOrderItem['OrdertaxAmount'],2);
                                                ?></span>
                                            </h5>

                                        </div>
                                    </div>

                                    <div class="totalcost d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-600">
                                            Total Cost
                                        </h6>
                                        <span class="border-dashed-1 flex-grow-1"></span>
                                        <h5 class="item-total-amount fw-600">
                                            <span>&#8377;</span>
                                            <span><?php 
                                           // echo number_format($totalOrderItem['FinalAmount']+$Gcost+$scost,2); 
                                           echo number_format($totalOrderItem['OrderTotalAmount'],2);
                                            ?></span>
                                        </h5>
                                    </div>


                                </div>
                            </div>



                            <div class="cancel-order">
                                <?php 
                                $cancellationSql = "SELECT count(*) as cancelReq,`cancelResq_Iscancel` FROM `cancellationrequest` WHERE 1=1 AND `cancelResq_OderId` = '$orderno'";
                                $mycancellationRes = $dbh->query($cancellationSql);
                                $cancellationRequest = $mycancellationRes->fetch();
                                if($cancellationRequest['cancelReq'] != 0){ 
                                    $cancelbtndisplay = "d-none";
                                    $cancellationReqbtn = "d-block";
                        // if($cancellationRequest['cancelResq_Iscancel'] == 1){
                        //                 $cancellationReqbtn = "d-none";
                        //                 $cancelbtndisplay = "d-block";
                        //             }
                                }else{
                                    $cancelbtndisplay = "d-block";
                                    $cancellationReqbtn = "d-none";
                                }
                                // if
                                $ForCancellationSql = "SELECT * FROM `order` WHERE ord_id = '$orderno'";
                        $ForCancellationRes = $dbh->query($ForCancellationSql) or die("query FAield");
                                $ForCancellationRow = $ForCancellationRes->fetch();
                                if($ForCancellationRow['OrderStatusID'] < 3){
                                   
                                ?>
                                <a class="cancelbtn cancelbtnmodal  text-decoration-none text-reset <?php echo $cancelbtndisplay; ?> text-center"
                                    id="cancelbtn">
                                    <span>Cancel Order</span>
                                    <!-- <span class="canc-order bi bi-x-lg fw-bolder"></span> -->
                                </a>
                                <?php if($cancellationRequest['cancelResq_Iscancel'] == 0){
                                    $cancellationBtnId = "";
                                       $text = "<span>Cancellation Request Decline</span>";
                                    }else if($cancellationRequest['cancelResq_Iscancel'] == 1){
                                        $cancellationBtnId = "";
                                        $text = "<span>Order Cancelled</span>";
                                    }else{
                                        $cancellationBtnId = "cancellationbtn";
                                         $text = "<span>Cancel the cancellation order</span>";
                                    }
                                    ?>
                                <a class="cancelbtn cancellation-btn  text-decoration-none text-reset <?php echo $cancellationReqbtn; ?> text-center"
                                    id="<?php echo $cancellationBtnId; ?>" data-cancelorderno="<?php echo $orderno; ?>">
                                     <?php echo $text; ?>
                                    <!--<span>Cancel the cancellation order</span>-->
                                    <!-- <span class="canc-order bi bi-x-lg fw-bolder"></span> -->
                                </a>

                                <a class="re-order cancelbtn d-none text-center" id="reorderbtn">
                                    <span>Re-Order</span>
                                </a>
                                <?php }?>
                            </div>




                        </div>
                    </div>
                </div>

                <!-- <div class="col-lg-10 cart-empty">

                    <img src="assets1/images/shopping-cartactive.png" alt="">

                    <span>
                        Unfortunately Your cart is empty
                    </span>

                    <a href="" class="continue-shopping">
                        Continue Shopping
                    </a>

                    
                </div>  -->



            </div>
        </section>



        <!-- <footer class="container-fluid border-top-0 p-foot-2 fixed-bottom">

            <div class="row justify-content-between">
                <div class="col-2 d-flex flex-column align-items-center">
                    <img src="assets1/images/WhatsApp_Image_2022-03-27_at_21.40.45-removebg-preview.png" alt="" class="img-fluid logo-img">

                    <p class="tagline text-center">
                        Easily Order Groceries Online With Our Convenient Services.
                    </p>
                </div>

                <div class="col-2">
                    <div class="footer-categories">
                        <h6 class="text-uppercase">Top Categories</h6>
                        
                        <div class="footer-top-categories  d-flex flex-column">
                                <a href="">Fruits</a>
                                <a href="">Vegetables</a>
                                <a href="">Tea & Coffee</a>
                                <a href="">Dairy Products</a>
                                <a href="">Medicines</a>




                        </div>
                    </div>
                </div>

                <div class="col-2 d-flex">
                    <div class="footer-contact d-flex flex-column  flex-grow-1">
                        <h6 class="text-uppercase">Contact Info</h6>
                        
                        <div class="footer-contact-info  justify-content-between d-flex flex-column flex-grow-1">
                                <a href="tel:9876543210">  <i class="bi bi-telephone"></i>  +91-9876543210</a>
                                <a >  <i class="bi bi-geo-alt"></i>   Lane No. 3
                                    Raja Park, Jaipur, Rajasthan 302004.</a>
                                <a href=""><i class="bi bi-envelope"></i> grofkit452@gmail.com</a>
                                <a ><i class="bi bi-clock"></i>Mon-Sat: 10:00AM - 9:00PM</a>




                        </div>
                    </div> 
                </div>

                <div class="col-2 d-flex">
                    <div class="footer-newsletter d-flex flex-column  flex-grow-1">
                        <h6 class="text-uppercase">HELP</h6>
                        
                        <div class="footer-newsletter-info  justify-content-start d-flex flex-column flex-grow-1">

                            <a href="">
                                Privacy Policy
                            </a>
                            <a href="">
                                Terms of Use
                            </a>
        
                            <a href="">FAQS</a>
        
        
                            <a href="">Return/Refund & Shipping Policy </a>


                               




                        </div>
                    </div> 
                </div>

                <div class="col-2 d-flex">
                    <div class="footer-newsletter d-flex flex-column  flex-grow-1">
                        <h6 class="text-uppercase">HELP</h6>
                        
                        <div class="footer-newsletter-info  justify-content-start d-flex flex-column flex-grow-1">

                            <a href="">
                                Privacy Policy
                            </a>
                            <a href="">
                                Terms of Use
                            </a>
        
                            <a href="">FAQS</a>
        
        
                            <a href="">Return/Refund & Shipping Policy </a>


                               




                        </div>
                    </div> 
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-3 d-flex  justify-content-between">
                    <span class=" copyright">
                        &copy; Copyright GROFKIT 2022.

                    </span>

                    <div class="social-icons d-flex">
                        <a href=""><i class="lab la-twitter"></i></a>
                        <a href=""><i class="lab la-facebook-f"></i></a>

                        <a href=""><i class="lab la-instagram"></i></a>

                    </div>
                </div>
                <div class="col-5 privacytc">
                  

                   
                </div>
            </div>
        </footer> -->
            <?php
                $userId = $_SESSION['USER']['ID'];

                $sql1 = "SELECT COUNT(*) as totalcart, SUM(item.ite_Rate * cart.cart_volume) as TotalitemCost FROM cart LEFT JOIN item ON cart.cart_itemId = item.ite_Id WHERE cart.cart_UserID = '$userId'";
                $result1=$dbh->query($sql1);
                $resUserItem = $result1->fetch();
        
                $sql2 = "SELECT COUNT(*) as totalorder FROM `order` WHERE ord_userid = ' $userId' AND OrderStatusID < 4";
                $result2 = $dbh->query($sql2);
                $rezultTotalOrder = $result2->fetch();
            ?>

        <footer class="container-fluid border-top-0 p-foot-2 fixed-bottom">

            <div class="row">
                <a class="col " href="index.php">
                    <img src="assets1/images/home (1)inactive.png" alt="">
                    <span>Home</span>

                </a>
                <?php 
                if ($checkloginadmin) {
                    $cartpageUrl = "href=''";
                }else{
                    $cartpageUrl = "href='cart.php'";
                }
                
                ?>
                <a class="col position-relative cartlink" <?php echo $cartpageUrl; ?>>
                    <img src="assets1/images/shopping-cart.png" alt="">
                    <span>Cart</span>
                    <?php if ($checkloginadmin) { 

                ?>
                    <span
                        class="cart-items-badge my-cart-value rounded-pill bg-theme2 position-absolute top-0 translate-middle-y start-50  text-white totalcarfooter">
                        <?php echo $resUserItem['totalcart']; ?>
                    </span>
                    <?php }?>

                </a>

                <!-- <a class="col">
                    <img src="assets1/images/bag.png" alt="">
                    <span>Cart</span>

                </a> -->


                <a class="col active-footer position-relative" href="myorders.php">
                    <img src="assets1/images/bagactive.png" alt="">
                    <span>My Orders</span>
                    <?php if ($checkloginadmin) { ?>
                    <span
                        class="cart-items-badge my-orders-value  rounded-pill bg-theme2 position-absolute top-0 translate-middle-y start-50  text-white">
                        <?php echo $rezultTotalOrder['totalorder']; ?>
                    </span>
                    <?php }?>
                </a>

                <a class="col" href="loginsignup.php">
                    <img src="assets1/images/user.png" alt="">
                    <span>Profile</span>

                </a>
                <!-- <a class="col">
                    <img src="assets1/images/user.png" alt="">
                    <span>Profile</span>

                </a> -->
            </div>

        </footer>



        <div class="cancel-modal fade show modal" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <h6 class="mb-0">Are you sure you want to cancel this order?</h6>
                    </div>
                    <div class="modal-footer">
<!--  -->
                        <a class="flex-grow yes " data-orderid="<?php echo $orderno; ?>" data-userid=<?php echo $userId; ?>>Yes</a>
                        <a class="flex-grow no">No</a>


                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- <div class="offcanvas px-0 offcanvas-start  bg-black" id="menu-offcanvas">
        <div class="  close-menu d-flex justify-content-end ">
            <a  class="bi bi-x-lg " data-bs-dismiss="offcanvas"></a>
        </div>

        <div class="offcanvas-body p-0">
            <div class="d-flex offcanvas-logo">
                <img src="assets1/images/WhatsApp_Image_2022-03-27_at_21.40.45-removebg-preview.png" alt="" class="img-fluid logo-img">
            </div>

            <div class="primary-navbar">
                <a href="">Home</a>
                <a href="">Shop Now</a>

                <a href="">About</a>
                <a href="">Contact</a>







            </div>
          
        </div>
    </div> -->
    
     <div  class="loader   top-0 start-0  flex-column align-items-center justify-content-center bottom-0 end-0">
        <span class="text-white fs-4 mb-2">Loading</span>
        <div class=" spinner-border text-theme-3  "></div>

    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/2918a48001.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="assets1/css/myorder.css">

    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets1/css/mediaquery.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="https://kit.fontawesome.com/e4988a60cc.js" crossorigin="anonymous"></script>


    <script src="assets1/js/orderdetails.js"></script>

    <script>
    $(document).on("click", ".cartlink", function() {
        // alert("Hello");
        var carttotal = $('.totalcarfooter').text();
        if (carttotal == 0) {
            alert("Add item into cart");
            $(".cartlink").attr("href", "index.php");
        } else {
            // alert("go to page");
            $(".cartlink").attr("href", "cart.php");
        }
    });

    $(document).on("click", ".yes", function(){
        // alert("Hello");
        var orderId = $(this).data("orderid");
        var userId = $(this).data("userid");
        $.ajax({
            url: "action.php",
            type: "POST",
            data:{
                orderId: orderId,
                userId: userId,
                isordeCancel: true
            },
            success: function(data){
                console.log(data);
            }
        })
    });
    $(document).on("click", "#cancellationbtn", function(){
        var cancelRequestId = $(this).data("cancelorderno");
        $.ajax({
            url: "action.php",
            type: "POST",
            data:{
                orderId: cancelRequestId,
                isordeCancelRequest: true
            },
            success: function(data){
                // console.log(data);
                if(data != 1){
                    $("#cancelbtn").removeClass("d-none").addClass("d-block");
                    $("#cancellationbtn").removeClass("d-block").addClass("d-none");
                    // $("#cancelbtn").css("display","block");
                    // $("#cancellationbtn").css("display","none");
                }
            }
        })
    });
    $(document).on("mouseover", '.fa-circle-info', function() {
        var data = $(this).data('item');
        $(".proinfo" + data).show();
    })
    $(document).on("mouseout", '.fa-circle-info', function() {
        var data = $(this).data('item');
        $(".proinfo" + data).hide();
    })
    </script>
</body>

</html>