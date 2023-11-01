<?php
include_once 'admin/connection_handle.php';

// include_once './classes/class_getvaluesamount.php';
$class_user_login->checkuserLoggedIn();
$strLoadAdminCondition = ' AND us_Id=' . $class_user_login->getCurrentLoginAdminId();
$rowAdminInfo = $class_common->loadSingleDataBy($strLoadAdminCondition, '', '', TABLE_USER);

$checkloginadmin = $class_user_login->checkuserLoggedIn();

if ($checkloginadmin == '') {
	redirect('loginsignup.php');
}

?>
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Grofkit | Cart</title>

    <script src="assets1/js/loader.js"></script>
    <style>
    .loader {
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
            class=" container-fluid d-flex flex-column justify-content-center cart-header position-sticky top-0  bg-black ">

            <div class="row align-items-center justify-content-between">
                <div class="col-lg-2 w-auto col-md-3 col-4 d-flex  align-items-center ">

                    <!-- <img src="assets1/images/WhatsApp_Image_2022-03-27_at_21.40.45-removebg-preview.png" alt="" class="img-fluid logo-img"> -->
                    <a href="index.php" class="logourl">
                        <div class="logo"><span>G</span>ROFKIT</div>
                    </a>
                </div>

                <div class="pincode w-auto col-lg-2 col-md-3 col-4 d-flex align-items-center">

                    <img src="assets1/images/location-pointer.png" alt="" class="pincode-img">
                    <span class="pincode-value"><?php
                    $loginUserId = $_SESSION['USER']['ID'];
                        $pincodeSql = "SELECT us_postalCode FROM mstuser WHERE us_Id = '$loginUserId'";
                        $pincodeRes = $dbh->query($pincodeSql);
                        $pincodeRow =  $pincodeRes->fetch();
                        if($pincodeRes->rowCount() >0){
                           echo $pincodeRow['us_postalCode'];
                        }
                    //echo $_SESSION['USER']['pincode']; 
                    ?></span>

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
                            <?php echo $_SESSION['USER']['mobile']; ?>

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




        <section class="container-fluid cart-main-section ">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-10 col-xl-9  col-md-12 shadow cart-main ">
                    <div class="row h-100">
                        <div class="cart-items-info   col-lg-8 col-md-7">
                            <!-- <div class="cart-heading cart-same-p border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-600 fsz-2">Your Cart</h6>
                                <span class="fw-600">
                                    <span class="items-quantity ">2</span> 
                                    <span>Items</span>
                                </span>
    
                            </div> -->

                            <div class="cart-all-items cart-same-p">
                                <div class="d-flex  justify-content-between">
                                    <span class="w-60">Product Details</span>
                                    <span class="w-20">Amount</span>

                                    <span class="d-flex w-20 justify-content-end">Quantity</span>

                                </div>

                                <div class="cart-select-items-container">
                                    <?php
                                        $itemids=array();
                                        $userId = $_SESSION['USER']['ID'];
                                        $pincode = $pincodeRow['us_postalCode'];
                                        $strLoadConditions = ' AND cart_UserID = '.$userId.' AND itimg_IsMainImage=1 ORDER BY cart_Id DESC ';
                                        $strFileds = 'item.*, itemimage.*, unit.*, cart.*';
                                        $strJoinCondition = "LEFT JOIN itemimage ON cart.cart_itemId = itemimage.itimg_itemID LEFT JOIN unit ON cart.cart_UnitId = unit.un_ID LEFT JOIN item ON cart.cart_itemId = item.ite_Id";
                                        $resSelectCartList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, $strJoinCondition, 0, '', 'cart');
                                        if (count($resSelectCartList) > 0) {
                                            foreach ($resSelectCartList as $rowSize) { 
                                                $itemids[]=$rowSize['ite_Id'];
                                    ?>
                                    <div class="cart-select-item  d-flex justify-content-between align-items-center">

                                        <div class="cart-item-details w-60 d-flex align-items-stretch">
                                            <div class="cart-img">
                                                <img src="dashboard/uploads/item_image/<?php echo $rowSize['itimg_path']; ?>"
                                                    alt="" class="img-fluid">
                                            </div>
                                            <div
                                                class="cart-item-name-det flex-grow-1 d-flex flex-column justify-content-md-evenly justify-content-center">
                                                <h6 class="mb-0"><?php echo $rowSize['ite_Name']; ?></h6>
                                                <?php
                                                    $iteminfo= $dbh->query("SELECT COUNT(*) as totalAtt FROM `cartdtl` WHERE cartDtl_cartid='".$rowSize['cart_Id']."'");
                                                    $iteminfoRes = $iteminfo->fetch();
                                                    if($iteminfoRes['totalAtt'] >0){
                                                ?><i
                                                    class="fa-solid fa-circle-info"
                                                    data-item=<?php echo $rowSize['ite_Id'] ?>></i><?php }?>
                                                <span class="d-flex">
                                                    <input type="hidden" id="itemUn<?php echo $rowSize['cart_Id']; ?>"
                                                        value="<?php echo $rowSize['un_Code']; ?>">
                                                    <span class="item-quant">1<?php echo $rowSize['un_Code']; ?></span>
                                                    <span class="mx-1"> X </span>
                                                    <span
                                                        class="item-price itemprice<?php echo $rowSize['cart_Id']; ?>"><?php echo $rowSize['cart_volume']; ?></span>
                                                    <span class="mx-1">=</span>
                                                    <span
                                                        id="volitem<?php echo $rowSize['cart_Id']; ?>"><?php echo $rowSize['cart_volume'].$rowSize['un_Code']; ?></span>

                                                </span>
                                                <div class="pro-info proinfo<?php echo $rowSize['ite_Id'] ?>">
                                                    <h6>Item Details </h6>
                                                    <?php
                                                        $itemDtlSql = $dbh->query("SELECT attribute.att_Name,attribute.att_Id FROM `cartdtl` LEFT JOIN attribute ON attribute.att_Id = cartdtl.cartDtl_attid WHERE cartDtl_cartid='".$rowSize['cart_Id']."' GROUP BY cartDtl_attid");
                                                        $itemDtlRes = $itemDtlSql->fetchAll();
                                                        foreach($itemDtlRes as $attinfo){
                                                    ?>
                                                    <div class="d-flex mt-2 flex-column justify-content-between">
                                                        <h5><?php echo ucfirst($attinfo['att_Name']); ?>:</h5>
                                                        <div class="ms-3 attr-item">
                                                            <?php 
                                                                $attVlaue= $dbh->query("SELECT attributedtl.attd_value FROM `cartdtl` LEFT JOIN attributedtl ON attributedtl.attd_id = cartdtl.cartDtl_attvalue WHERE cartDtl_cartid='".$rowSize['cart_Id']."' AND cartDtl_attid='".$attinfo['att_Id']."'");
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
                                        <div class="cart-item-price   w-20"
                                            data-bs-price="<?php echo $rowSize['ite_Rate']; ?>"> <label>
                                                &#8377; </label> <label class="cartItemPrice">
                                                <?php echo $rowSize['cart_volume']*$rowSize['ite_Rate']; ?></label>
                                        </div>
                                        <div
                                            class="cart-item-quantity w-20 d-flex justify-content-end align-items-center">
                                            <?php 
                                                if($rowSize['cart_volume'] == 1){ 
                                                    $sub_display = 'd-none';
                                                    $del_display = '';
                                                }else{
                                                    $sub_display=''; 
                                                    $del_display = 'd-none';
                                                }
                                                
                                            ?>
                                            <i class="fa-solid fa-trash <?php echo $del_display; ?> del"
                                                data-delid='<?php echo $rowSize['cart_Id']; ?>'
                                                data-userid='<?php echo $rowSize['cart_UserID']; ?>'></i>
                                            <i class="fa-solid fa-minus <?php echo $sub_display; ?> sub"
                                                data-subid='<?php echo $rowSize['cart_Id']; ?>'
                                                data-userid='<?php echo $rowSize['cart_UserID']; ?>'></i>

                                            <span class="item-value"
                                                id="<?php echo $rowSize['cart_Id']; ?>"><?php echo $rowSize['cart_volume']; ?></span>
                                            <i class="fa-solid fa-plus add "
                                                data-addid='<?php echo $rowSize['cart_Id']; ?>'
                                                data-unitCode='<?php echo $rowSize['un_Code']; ?>'
                                                data-userid='<?php echo $rowSize['cart_UserID']; ?>'
                                                data-pincode='<?php echo $pincode; ?>'></i>
                                        </div>

                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                        <?php 
                            $sql1 = "SELECT COUNT(*) as totalcart, SUM(item.ite_Rate * cart.cart_volume) as TotalitemCost FROM cart LEFT JOIN item ON cart.cart_itemId = item.ite_Id WHERE cart.cart_UserID = '$userId'";
                            $result1=$dbh->query($sql1);
                            $resUserItem = $result1->fetch();
                        ?>
                        <div class="cart-order-info d-md-block d-none  col-lg-4 col-md-5">
                            <?php 
                                $getAttPriceSql = "SELECT `cart`.`cart_Id`,cart.cart_itemId, GROUP_CONCAT(cartdtl.cartDtl_attvalue ORDER BY cartdtl.cartDtl_attvalue ASC) as attvalue FROM cart , cartdtl WHERE FIND_IN_SET(cartdtl.cartDtl_cartid, cart.cart_Id) AND `cart`.`cart_UserID`= $userId GROUP BY cart.`cart_itemId`";
                                $getAttPriceRes = $dbh->query($getAttPriceSql);
                            ?>
                            <div
                                class="cart-heading cart-same-p border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-600 fsz-2">Order Summary</h6>
                                <div class="pincode d-flex align-items-center">

                                    <img src="assets1/images/location-pointer.png" alt="" class="pincode-img">
                                    <span class="pincode-value"><?php echo $pincodeRow['us_postalCode']; ?></span>

                                </div>


                            </div>

                            <div class="no-scrollbar" style="height: 53vh; overflow: auto;">
                                <div class="card-order-details border-bottom cart-same-p">
                                    <div class="item-total d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-600 Totalcartitems">
                                            Items (<?php echo $resUserItem['totalcart']; ?>)
                                        </h6>
                                        <span class="border-dashed-1 flex-grow-1"></span>
                                        <h5 class="item-total-amount fw-600">
                                            <span>&#8377;</span><span id="totalItemCost"
                                                class="totalItemCost"><?php echo number_format($GetValuesAmount->GetItemsTotalCost($userId),2); ?></span>
                                        </h5>

                                    </div>

                                    <div class="shipping d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-600">
                                            Shipping
                                        </h6>
                                        <span class="border-dashed-1 flex-grow-1"></span>
                                        <h5 class="shipping-total-amount fw-600">
                                            <?php 
                                            $scost=$GetValuesAmount->GetShippingCost($itemids,$pincode,$userId);
                                            if($scost<=0){
                                            ?>
                                            <span class="text-green"><?php echo "FREE";
                                            ?></span>
                                            <?php }else{ ?>
                                            +<span>&#8377;</span><span
                                                id="shippingCost"><?php echo number_format($scost,2); ?></span>
                                            <?php } ?>
                                        </h5>

                                    </div>
                                    <?php 
                                        $applyCp = '';
                                        $removeCp = '';
                                        $coupanName = '';
                                        $coupanIs = '';
                                        $ispromocodeApply = '';
                                        $cpdtl_CP_Id = 0;
                                        if(isset($_GET['cp'])){
                                            $applyCp = "";
                                            $removeCp = 'd-none';
                                            $promocode = '';
                                            $coupanIs = $_GET['cp'];
                                            $ispromocodeApply = "cart=$coupanIs&";

                                            $sql ="SELECT coupandtl.*, coupen.* FROM coupandtl LEFT JOIN coupen ON CpDtl_CPID = Cp_ID WHERE CpDtl_Id = ".base64_decode($_GET['cp'])." AND CpDtl_UserID IN (0,$userId)";
                                            
                                            $result = $dbh->query($sql);
                                            // if($result->fetchColumn()>0){
                                                if($result->rowCount()>0){
                                                $applyCp = "d-none";
                                                $removeCp = '';
                                                
                                                $row = $result->fetch();
                                                $cpdtl_CP_Id = $row['Cp_ID'];
                                                // echo "Coupan Id is : ".$cpdtl_CP_Id;
                                                $Discountcost=$GetValuesAmount->GetDiscountAmount($itemids,$cpdtl_CP_Id,$userId);
                                                $coupanName = $row['CP_Code'];
                                                
                                            }else{
                                                redirect('cart.php');
                                            }
                                            
                                        }else{
                                            $cpdtl_CP_Id = 0;
                                            $applyCp = "";
                                            $removeCp = 'd-none';
                                            $promocode = 'd-none';
                                            $coupanIs ='';
                                            $ispromocodeApply = '';
                                            $cpdtl_CP_Id = '0';
                                            $coupanName = '';
                                        }
                                        
                                    ?>

                                    <div
                                        class="promocode-price d-flex justify-content-between align-items-center <?php echo $promocode; ?>">
                                        <h6 class="mb-0 fw-600">
                                            <?php echo $coupanName; ?>
                                        </h6>
                                        <span class="border-dashed-1 flex-grow-1"></span>
                                        <h5 class="procode-total-amount fw-600">


                                            <span class=""><span>-</span> <span>&#8377;</span><span id="coupanrate"
                                                    class="coupanrate"><?php echo $Discountcost; ?></span></span>
                                        </h5>

                                    </div>

                                    <div class="gst-price d-flex justify-content-between align-items-center">
                                        <input type="hidden" id="coupanCode" value="<?php echo $cpdtl_CP_Id; ?>">
                                        <h6 class="mb-0 fw-600">
                                            GST
                                        </h6>
                                        <span class="border-dashed-1 flex-grow-1"></span>
                                        <h5 class="procode-total-amount fw-600">

                                            <?php $Gcost=$GetValuesAmount->GetGstCost($itemids); ?>
                                            <span class=""><span>+</span><span>&#8377;</span><span id="gstAmount"
                                                    class="gstAmount"><?php echo $Gcost<=0?'0':$Gcost; ?></span></span>
                                        </h5>

                                    </div>
                                </div>

                                <div class="totalcost d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-600">
                                        Payable amount
                                    </h6>
                                    <span class="border-dashed-1 flex-grow-1"></span>
                                    <h5 class="item-total-amount fw-600">
                                        <span>&#8377;</span><span id="FinalCost"
                                            class="FinalCost"><?php echo number_format($GetValuesAmount->GetFinalCost($itemids,$pincode,$cpdtl_CP_Id,$userId),2); ?></span>
                                    </h5>


                                </div>
                                <div class="coupon-code d-flex justify-content-center">

                                    <a class="promocode <?php echo $applyCp; ?>">
                                        Apply Promocode
                                    </a>
                                    <a class="apply-promocode <?php echo $removeCp; ?>"> <span
                                            class="promo-name"><?php echo $coupanName; ?></span> <span
                                            class="canc-promo bi bi-x-lg fw-bolder"></span> </a>
                                </div>



                                <!--<a href="selectaddress.php?<?php echo $ispromocodeApply; ?>user=<?php echo $userId; ?>"-->
                                <!--    class="checkoutbtn text-decoration-none text-reset d-block text-center">-->
                                <!--    <span>Pay</span>-->
                                <!--    <span class="ms-1">&#8377; <span-->
                                <!--            class="payvalue"><?php echo number_format($GetValuesAmount->GetFinalCost($itemids,$pincode,$cpdtl_CP_Id,$userId),2); ?></span>-->
                                <!--    </span>-->
                                <!--</a>-->
                                <a class="checkoutbtn text-decoration-none text-reset d-block text-center">
                                    <span>Pay</span>
                                    <span class="ms-1">&#8377; <span
                                            class="payvalue"><?php echo number_format($GetValuesAmount->GetFinalCost($itemids,$pincode,$cpdtl_CP_Id,$userId),2); ?></span>
                                    </span>
                                </a>
                            </div>




                        </div>

                        <div class="cart-order-info d-md-none  col-lg-4 col-md-5">

                            <div class="coupon-code">
                                <a href="#ordersummary" class="details-order view-det" data-bs-toggle="collapse"
                                    aria-expanded="false">View Details</a>
                                <a class="promocode <?php echo $applyCp; ?>">
                                    Apply Promocode
                                </a>
                                <a class="apply-promocode  <?php echo $removeCp; ?>"> <span
                                        class="promo-name"><?php echo $coupanName; ?></span> <span
                                        class="canc-promo bi bi-x-lg fw-bolder"></span> </a>
                            </div>


                            <div class="collapse" id="ordersummary">
                                <div class="order-summary d-flex flex-grow-1 collapse  flex-column">
                                    <div
                                        class="cart-heading cart-same-p border-bottom d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-600 fsz-2">Order Summary</h6>
                                        <div class="pincode d-flex align-items-center">

                                            <img src="assets1/images/location-pointer.png" alt="" class="pincode-img">
                                            <span
                                                class="pincode-value"><?php echo $pincodeRow['us_postalCode']; ?></span>

                                        </div>


                                    </div>

                                    <div class="card-order-details border-bottom cart-same-p">
                                        <div class="item-total d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 fw-600 Totalcartitems">
                                                Items (<?php echo $resUserItem['totalcart']; ?>)
                                            </h6>
                                            <span class="border-dashed-1 flex-grow-1"></span>
                                            <h5 class="item-total-amount fw-600">
                                                <span>&#8377;</span>
                                                <span id="totalItemCost"
                                                    class="totalItemCost"><?php echo number_format($GetValuesAmount->GetItemsTotalCost($userId),2); ?></span>
                                            </h5>

                                        </div>

                                        <div class="shipping d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 fw-600">
                                                Shipping
                                            </h6>
                                            <span class="border-dashed-1 flex-grow-1"></span>
                                            <h5 class="shipping-total-amount fw-600">
                                                <?php 
                                            $scost=$GetValuesAmount->GetShippingCost($itemids,$pincode,$userId);
                                            if($scost<=0){
                                            ?>
                                                <span class="text-green"><?php echo 'FREE'; ?></span>
                                                <?php }else{ ?>
                                                +<span>&#8377;</span><span
                                                    id="shippingCost"><?php echo number_format($scost,2); ?></span>
                                                <?php } ?>
                                            </h5>

                                        </div>

                                        <div
                                            class="promocode-price <?php echo $promocode; ?> d-flex justify-content-between align-items-center <?php echo $promocode; ?>">
                                            <h6 class="mb-0 fw-600">
                                                <?php echo $coupanName; ?>
                                            </h6>
                                            <span class="border-dashed-1 flex-grow-1"></span>
                                            <h5 class="procode-total-amount fw-600">


                                                <span class=""><span>-</span> <span>&#8377;</span><span id="coupanrate"
                                                        class="coupanrate"><?php echo $Discountcost; ?></span></span>
                                            </h5>

                                        </div>
                                        <div class="gst-price d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 fw-600">
                                                GST
                                            </h6>
                                            <span class="border-dashed-1 flex-grow-1"></span>
                                            <h5 class="procode-total-amount fw-600">

                                                <?php $Gcost=$GetValuesAmount->GetGstCost($itemids); ?>
                                                <span class=""><span>+</span>
                                                    <span>&#8377;</span><span id="gstAmount"
                                                        class="gstAmount"><?php echo $Gcost<=0?'0':$Gcost; ?></span></span>
                                            </h5>

                                        </div>
                                    </div>

                                    <div class="totalcost d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-600">
                                            Payable amount
                                        </h6>
                                        <span class="border-dashed-1 flex-grow-1"></span>
                                        <h5 class="item-total-amount fw-600">
                                            <span>&#8377;</span>
                                            <span id="FinalCost"
                                                class="FinalCost"><?php echo number_format($GetValuesAmount->GetFinalCost($itemids,$pincode,$cpdtl_CP_Id,$userId),2); ?></span>
                                        </h5>
                                    </div>


                                </div>
                            </div>



                            <div class="payout">
                                <a class="checkoutbtn text-decoration-none text-reset d-block text-center">
                                    <span>Pay</span>
                                    <span class="ms-1">&#8377; <span
                                            class="payvalue"><?php echo number_format($GetValuesAmount->GetFinalCost($itemids,$pincode,$cpdtl_CP_Id,$userId),2); ?></span>
                                    </span>
                                </a>
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



        <!-- <footer class="container-fluid">

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


        <footer class="container-fluid border-top-0 p-foot-2 fixed-bottom">

            <div class="row">
                <a class="col " href="index.php">
                    <img src="assets1/images/home (1)inactive.png" alt="">
                    <span>Home</span>

                </a>
                <a class="col active-footer position-relative" href="cart.php">
                    <img src="assets1/images/shopping-cartactive.png" alt="">
                    <span>Cart</span>
                    <?php if ($checkloginadmin) { ?>
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


                <a class="col position-relative" href="myorders.php">
                    <img src="assets1/images/bag.png" alt="">
                    <span>My Orders</span>
                    <?php 
                    

                    $sql2 = "SELECT COUNT(*) as totalorder FROM `order` WHERE ord_userid = ' $userId' AND OrderStatusID < 4";
                    $result2 = $dbh->query($sql2);
                    $rezultTotalOrder = $result2->fetch();
                    if ($checkloginadmin) { ?>
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
    <div class="loader   top-0 start-0  flex-column align-items-center justify-content-center bottom-0 end-0">
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

    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets1/css/mediaquery.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/e4988a60cc.js" crossorigin="anonymous"></script>

    <script src="assets1/js/cart.js"></script>

    <script>
    // ----------- Add More Item ---------- //

    $(document).on("click", ".add", function() {
        // alert("Hello");
        var cartId = $(this).data("addid");
        var userid = $(this).data("userid");
        var unit = $("#itemUn" + cartId).val();
        var coupanrate = $(".coupanrate").text();
        var coupanCode = $("#coupanCode").val();
        // alert(coupanCode);
        var itemVol = parseInt($('#' + cartId).html());
        // console.log(itemVol);
        var pincode = <?php echo $pincode; ?>;

        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                cartId: cartId,
                itemVol: itemVol,
                userid: userid,
                coupanCode: coupanCode,
                pincode: pincode,
                isaddCartvalue: true
            },
            success: function(data) {
                console.log(data);
                var val = JSON.parse(data)
                $('.gstAmount').html(val[0]);
                $('.totalItemCost').html(val[1]);
                $('.FinalCost').html(val[2]);
                $('.payvalue').html(val[2]);
                $('#' + cartId).html(val[3]);
                $('.itemprice' + cartId).html(val[3]);
                $('#volitem' + cartId).html(val[3] + unit);
                $(".coupanrate").html(val[4]);
            }
        });
    });

    // ------------- Remove More Item -------- //


    $(document).on("click", ".sub", function() {

        var cartId = $(this).data("subid");
        var unit = $("#itemUn" + cartId).val();
        var coupanrate = $(".coupanrate").text();
        var userid = $(this).data("userid");
        var coupanCode = $("#coupanCode").val();
        var itemVol = parseInt($('#' + cartId).html());
        var pincode = <?php echo $pincode; ?>;

        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                cartId: cartId,
                itemVol: itemVol,
                userid: userid,
                coupanCode: coupanCode,
                pincode: pincode,
                isaddCartvalue: true
            },
            success: function(data) {
                var val = JSON.parse(data)
                // $('#gstAmount').html(data);
                $('.gstAmount').html(val[0]);
                $('.totalItemCost').html(val[1]);
                $('.FinalCost').html(val[2]);
                $('.payvalue').html(val[2]);
                $('#' + cartId).html(val[3]);
                $('.itemprice' + cartId).html(val[3]);
                $('#volitem' + cartId).html(val[3] + unit);
                $(".coupanrate").html(val[4]);

            }
        });
    });

    // -------- Delete Item From Cart --------- //

    $(document).on("click", ".del", function() {
        var cartId = $(this).data("delid");
        var coupanrate = $(".coupanrate").text();
        var coupanCode = $("#coupanCode").val();
        // var total = 0;
        // $('.cartItemPrice').each(function() {
        //     total += parseInt($(this).text());
        // });
        // var editbtn1 = $('.totalItemCost').html();
        var userid = $(this).data("userid");
        var pincode = <?php echo $pincode; ?>;

        // $('.totalItemCost').html(total);
        // $('.FinalCost').html(total - coupanrate);
        // $('.payvalue').html(total - coupanrate);
        // $('#totalitemVolume').php('Items (' + itemVol + ')');
        var userid = <?php echo $_SESSION['USER']['ID'];?>;
        // var coupanIs = <?php echo $coupanIs; ?>;
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                cartId: cartId,
                userid: userid,
                coupanCode: coupanCode,
                pincode: pincode,
                isdeleteCart: true
            },
            success: function(data) {
                // console.log(data);
                var val = JSON.parse(data)
                $(".Totalcartitems").html('Items (' + val[0] + ')');
                $(".totalcarfooter").html(val[0]);
                $('.gstAmount').html(val[1]);
                $('.FinalCost').html(val[2]);
                $('.payvalue').html(val[2]);
                if (val[0] == 0) {
                    window.location.href = "index.php";
                }
            }
        });
    });
    $(document).on("click", ".promocode ", function() {
        // console.log($('#FinalCost').text());
        if ($('.FinalCost').text() == 0) {
            alert("Add Item into Cart");
        } else {
            window.location.href = "applypromo.php";
        }
    });

    $(document).on("click", ".checkoutbtn", function() {
        var userid = <?php if($checkloginadmin){ echo $_SESSION['USER']['ID']; }else{
            echo '0';
        } ?>;
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                userid: userid,
                isinStockcheck: true
            },
            success: function(data) {
                console.log(data);
                var val = JSON.parse(data);
                // if(data.includes("no")) {

                //     alert("found");
                // }
                if (val['no']) {
                    alert("You can Order only " + val['no']['stockvolume'] + " quantity of " + val[
                        'no']['itemname'] + " at a time");
                } else {
                    // $(".checkoutbtn").attr("href", "selectaddress.php?<?php echo $ispromocodeApply; ?>user=<?php echo $userId; ?>")
                    window.location.href =
                        "selectaddress.php?<?php echo $ispromocodeApply; ?>user=<?php echo $userId; ?>";
                }
                // console.log(array);
            },
            error: function(data) {
                console.log(data);
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