<?php include_once './admin/connection_handle.php';

$class_user_login->checkuserLoggedIn();
$strLoadAdminCondition = ' AND us_Id=' . $class_user_login->getCurrentLoginAdminId();
$rowAdminInfo = $class_common->loadSingleDataBy($strLoadAdminCondition, '', '', TABLE_USER);


$checkloginadmin = $class_user_login->checkuserLoggedIn();
if ($checkloginadmin == '') {
	redirect('loginsignup.php');
}


?>
<!DOCTYPE html>
<html lang="en">

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

<body>


    <div class="">
        <header class="container-fluid position-sticky top-0  bg-black ">

            <div class="row align-items-center justify-content-between">
                <div class="col-lg-2 col-md-3 col-4 d-flex  align-items-center ">

                    <!-- <img src="assets1/images/WhatsApp_Image_2022-03-27_at_21.40.45-removebg-preview.png" alt="" class="img-fluid logo-img"> -->
                    <a href="index.php" class="logourl"><div class="logo"><span>G</span>ROFKIT</div></a>
                </div>

                <a
                    class="col-lg-2 col-md-3 col-5 d-flex  align-items-center text-decoration-none text-white  justify-content-end pincode-sec">


                    <!-- <div class="d-flex flex-column justify-content-between">
                        <span class="pincode-value ">000000</span>

                    </div> -->

                    <h6 class="your-cart mb-0">
                        My Orders

                    </h6>



                </a>


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


        <div class="container-fluid my-orders-main">
            <div class="row justify-content-center position-sticky top-10 z-99">
                <nav class="col-lg-9 nav-tabs bg-white order-tabs nav px-0 col-11">
                    <a href="#current_orders" class="nav-link text-center flex-grow-1 active text-decoration-none"
                        data-bs-toggle="tab">Current Orders</a><a href="#previous_orders" data-bs-toggle="tab"
                        class="nav-link text-decoration-none flex-grow-1 text-center">Previous Orders</a>

                </nav>

            </div>
            <!-- <div class="row">
                <h6 class="col-12 fw-600     fsz-2 mb-0">
                   <span>My Orders</span> (<span class="order-count">2</span>)
                </h6>


            </div> -->


            <div class="tab-content orders-content mb-6">
                <div class="row tab-pane fade show active my-order-cont justify-content-center" id="current_orders">

                    <div class="accordion col-lg-9 px-0 col-11 shadow my-orders-allitems" id="accordionExample">
                        <?php
                        $userId = $_SESSION['USER']['ID'];
                        date_default_timezone_set("Asia/Kolkata"); 
                        $date = date('M d Y');
                        
                        $date = strtotime($date);
                        // $placedDate = strtotime("+1 day", $date);
                        $shipeedDate = strtotime("+3 day", $date);
                        $date = strtotime("+7 day", $date);
                        
                        
                        $strLoadConditions = ' AND ord_userid = '.$userId.' AND OrderStatusID < 4  GROUP BY ord_id ORDER BY ord_id DESC';
                        $strFileds = "orderstatus.*, `order`.*, orderstausTime.*";
                        $strJoinConditions = " LEFT JOIN orderstatus ON OrderStatusID = Os_Id LEFT JOIN orderstausTime ON ord_id = ordTime_ordId";
                        $resSelectCartList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, $strJoinConditions, 0, '', '`order`');
                        // echo count($resSelectCartList);
                        if (count($resSelectCartList) > 0) {
                            foreach ($resSelectCartList as $rowSize) { 
                                if($rowSize['OrderStatusID'] < 4){
                                $orderId = $rowSize['ord_id'];
                                $sql1 = "SELECT COUNT(*) as totalitem, orderdtl.* FROM orderdtl LEFT JOIN `order` ON ordDtl_OrderId = ord_id WHERE ordDtl_OrderId = '$orderId'";
                                $result1=$dbh->query($sql1);
                                $resUserItem = $result1->fetch();
                                $sql2 = "SELECT * FROM orderstausTime WHERE ordTime_ordId='$orderId' AND ordTime_statusId=3";
                                $result2 = $dbh->query($sql2);
                                $dispatchOrder = $result2->fetch();
                                
                                 $sql3 = "SELECT * FROM orderstausTime WHERE ordTime_ordId='$orderId' AND ordTime_statusId=4";
                                $result3 = $dbh->query($sql3);
                               
                                // $deliveredOrder = $result3->fetch();
                                $placedDate= $rowSize['ord_Date'];
                    ?>
                        <div class="accordion-item my-bag-<?php echo $rowSize['ord_id']; ?>">
                            <h2 class="accordion-header " id="headingOne">
                                <div class="accordion-button flex-column align-items-stretch  order-short  p-0 "
                                    type="button" aria-expanded="true" aria-controls="collapseOne">

                                    <div class="d-flex align-items-center flex-grow-1">
                                        <div class="order-img d-flex justify-content-center  h-100">
                                            <img src="assets1/images/invoice.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="order-track-info flex-grow-1">
                                            <!-- <h5 class="mb-0 ">Order#: <span class="order-id">99012</span></h5>
                                      <h5 class="mb-0"><span class="order-date">
                                        12-Apr-2022
                                      </span>,&nbsp;
                                      <span class="order-time">3:00 PM</span>
                                    </h5>
        
                                    <h5 class="mb-0">Delivered on <span class="delivered-date">16 Apr</span> </h5> -->
                                            <div class="d-flex justify-content-between">
                                                <h5 class="mb-0 order-name">#<?php echo $rowSize['ord_OrderNo']; ?></h5>
                                                <h5 class="mb-0 order-price fw-600">
                                                    <span>&#8377;</span><span><?php echo $rowSize['OrderTotalAmount']; ?></span>
                                                </h5>


                                            </div>



                                            <div class="d-flex">
                                                <?php 
                                                date_default_timezone_set("Asia/Kolkata"); 
                                                    $currentdate = date("Y-m-d");
                                                // if($rowSize['ord_DeliverDate'] == '0000-00-00'){
                                                    if($rowSize['ord_DeliverDate'] >= $currentdate OR $rowSize['ord_DeliverDate'] == '0000-00-00'){
                                                      echo '<h6 class="mb-0 ls-1">Will be Delivered By:</h6>';  
                                                    }else{
                                                        echo '<h6 class="mb-0 ls-1">About to Delivered By:</h6>';
                                                    }
                                                // }
                                                
                                                
                                                ?>
                                                <!--<h6 class="mb-0 ls-1">Will be Delivered :</h6>-->
                                                <h6 class="mb-0 delivered-date "><?php 
                                                if($rowSize['ord_DeliverDate']!= '0000-00-00'){
                                                $orderDate = new DateTime($rowSize['ord_DeliverDate']);

                                                echo $orderDate->format('M d, Y ');       
                                                }  
                                                ?>
                                                </h6>
                                            </div>

                                            <div class="d-flex">
                                                <h6 class="mb-0 ls-1">Status :</h6>
                                                <?php 
                                                // $orderStatus = $rowSize['OrderStatusID'];
                                                // switch($orderStatus) {
                                                //     case '1':
                                                //         echo $rowSize['Os_Name'];
                                                //     case '2'
                                                // }
                                                
                                                ?>
                                                <h6 class="mb-0 order-status "><?php echo $rowSize['Os_Name']; ?></h6>
                                            </div>

                                            <div class="d-flex">
                                                <h6 class="mb-0 ls-1"> Total Items :</h6>
                                                <h6 class="mb-0 total-items "><?php echo $resUserItem['totalitem']; ?></h6>
                                            </div>

                                            <div class="d-flex">
                                                <h6 class="mb-0 ls-1">Promocode :</h6>
                                                <h6 class="mb-0 promocode-order ">
                                                    <?php echo $resUserItem['OrdDtl_DIscountCode']; ?></h6>
                                            </div>






                                        </div>
                                    </div>

                                    <div class="d-flex track-order-div justify-content-between ">
                                        <a href="orderdetails.php?orderNo=<?php echo $orderId;?>" class="details-myorder"> Order Details</a>
                                        <a href="#collapseordered<?php echo $orderId; ?>" class="track-order"
                                            data-bs-toggle="collapse">Track Order</a>
                                    </div>



                                </div>
                            </h2>
                            <div id="collapseordered<?php echo $orderId; ?>" class="accordion-collapse bg-track collapse "
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body container-fluid">

                                    <div class="row justify-content-center">
                                        <div class="col-lg-7 col-md-6 col-12 d-flex justify-content-evenly flex-column">
                                            <div
                                                class=" order-track-style ordered-done justify-content-between d-flex ">
                                                <?php 
                                                if($rowSize['Os_Name'] == "New Order"){
                                                    $neworderClass = "new-order";
                                                    $processOrder = 'new-order-zero';
                                                    $dispatchOrd = "pending-order";
                                                    $ondelivaryWay = "pending-order";
                                                    $shippeddonw = '';
                                                    $delivereddone = '';
                                                    

                                                }elseif($rowSize['Os_Name'] == 'Accept Order'){
                                                    $neworderClass = "done-order";
                                                    $processOrder = 'new-order-zero';
                                                    $dispatchOrd = "pending-order";
                                                    $ondelivaryWay = "pending-order";
                                                    $shippeddonw = '';
                                                    $delivereddone = '';
                                                }else if($rowSize['Os_Name'] == "Dispatch Order"){
                                                    $neworderClass = "done-order";
                                                    $processOrder = 'dispatchprocess';
                                                    $dispatchOrd = "done-order";
                                                    $ondelivaryWay = "pending-order";
                                                    $shippeddonw = 'done';
                                                    $delivereddone = '';
                                                }else if($rowSize['Os_Name'] == "Delivered"){
                                                    $neworderClass = "done-order";
                                                    $processOrder = 'shippedCompletedprocess';
                                                    $dispatchOrd = "done-order";
                                                    $ondelivaryWay = "done-order";
                                                    $shippeddonw = 'done';
                                                    $delivereddone = 'done';
                                                }
                                                
                                                ?>
                                                <span class="<?php echo $neworderClass; ?> "></span>
                                                <span class="<?php echo $dispatchOrd;?>"></span>
                                                <span class="<?php echo $ondelivaryWay; ?>"></span>
                                                <div class="<?php echo $processOrder; ?>"></div>



                                            </div>
                                            <div class=" order-track-info-style justify-content-between d-flex  ">

                                                <div class="ordered  done">
                                                    <img src="assets1/images/clipboard (1).png" alt="">
                                                </div>

                                                <div class="shipped <?php echo  $shippeddonw; ?>">
                                                    <img src="assets1/images/shipped.png" alt="">
                                                </div>

                                                <div class="delivered <?php echo $delivereddone; ?>">
                                                    <img src="assets1/images/delivered.png" alt="">
                                                </div>


                                            </div>

                                            <div class=" order-track-info-style  justify-content-between d-flex  ">

                                                <div class="ordered  done">
                                                    <span> Placed</span>
                                                    <span class="myorder-placed-date"><?php $orderDate = new DateTime($placedDate);

                                                echo $orderDate->format('M d, Y '); ?></span>
                                                </div>

                                                <div class="shipped <?php echo  $shippeddonw; ?>">
                                                    <span> Shipped</span>
                                                    <span class="myorder-shipped-date"><?php 
                                                    if($result2->rowCount() >0){
                                    $dispatchorderDate = new DateTime($dispatchOrder['ordTime_time']);

                                                echo $dispatchorderDate->format('M d, Y '); 
                                }
                                        
                                                    ?></span>

                                                </div>

                                                <div class="delivered <?php echo $delivereddone; ?>">
                                                    <span> Delivered</span>
                                                    <span class="myorder-delivered-date"><?php 
                                                     if($result3->rowCount() >0){
                                    $deliveredOrder = $result3->fetch();
                                     $deliveredorderDate = new DateTime($deliveredOrder['ordTime_time']);

                                                echo $deliveredorderDate->format('M d, Y ');
                                }
                                                   
                                                    //echo date('M d, Y',$date); ?></span>

                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php }else{
                            echo "";
                        } }}
                        else{ ?>
                            <h5 class="text-center pt-3">No Current Order Available</h5>
                        <?php }?>
                    </div>

                </div>

                <div class="row tab-pane fade show  my-order-cont justify-content-center" id="previous_orders">
                    <div class="accordion col-lg-9 px-0 col-11 shadow my-orders-allitems-prev" id="accordionExample1">
                        <?php
                        $userId = $_SESSION['USER']['ID'];
                        date_default_timezone_set("Asia/Kolkata"); 
                        $date = date('M d Y');
                        
                        $date = strtotime($date);
                        // $placedDate = strtotime("+1 day", $date);
                        $shipeedDate = strtotime("+3 day", $date);
                        $date = strtotime("+7 day", $date);
                        
                        
                        $strLoadConditions = ' AND ord_userid = '.$userId.' AND OrderStatusID >= 4 GROUP BY ord_id ORDER BY ord_id DESC';
                        $strFileds = "orderstatus.*, `order`.*, orderstausTime.*";
                        $strJoinConditions = " LEFt JOIN orderstatus ON OrderStatusID = Os_Id LEFT JOIN orderstausTime ON ord_id = ordTime_ordId";
                        $resSelectCartList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, $strJoinConditions, 0, '', '`order`');
                        if (count($resSelectCartList) > 0) {
                            foreach ($resSelectCartList as $rowSize) { 
                                if($rowSize['OrderStatusID'] >= 4){
                                $orderId = $rowSize['ord_id'];
                                $sql1 = "SELECT COUNT(*) as totalitem, orderdtl.* FROM orderdtl LEFT JOIN `order` ON ordDtl_OrderId = ord_id WHERE ordDtl_OrderId = '$orderId'";
                                $result1=$dbh->query($sql1);
                                $resUserItem = $result1->fetch();
                                $sql2 = "SELECT * FROM orderstausTime WHERE ordTime_ordId='$orderId' AND ordTime_statusId=3";
                                $result2 = $dbh->query($sql2);
                                $dispatchOrder = $result2->fetch();
                                
                                 $sql3 = "SELECT * FROM orderstausTime WHERE ordTime_ordId='$orderId' AND ordTime_statusId=4";
                                $result3 = $dbh->query($sql3);
                               
                                // $deliveredOrder = $result3->fetch();
                                $placedDate= $rowSize['ord_Date'];
                    ?>
                        <div class="accordion-item my-bag-<?php echo $rowSize['ord_id']; ?>">
                            <h2 class="accordion-header " id="headingOne">
                                <div class="accordion-button flex-column align-items-stretch  order-short  p-0 "
                                    type="button" aria-expanded="true" aria-controls="collapseOne">

                                    <div class="d-flex align-items-center flex-grow-1">
                                        <div class="order-img d-flex justify-content-center  h-100">
                                            <img src="assets1/images/invoice.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="order-track-info flex-grow-1">
                                            <!-- <h5 class="mb-0 ">Order#: <span class="order-id">99012</span></h5>
                                      <h5 class="mb-0"><span class="order-date">
                                        12-Apr-2022
                                      </span>,&nbsp;
                                      <span class="order-time">3:00 PM</span>
                                    </h5>
        
                                    <h5 class="mb-0">Delivered on <span class="delivered-date">16 Apr</span> </h5> -->
                                            <div class="d-flex justify-content-between">
                                                <h5 class="mb-0 order-name">#<?php echo $rowSize['ord_OrderNo']; ?></h5>
                                                <h5 class="mb-0 order-price fw-600">
                                                    <span>&#8377;</span><span><?php echo $rowSize['OrderTotalAmount']; ?></span>
                                                </h5>


                                            </div>



                                            <div class="d-flex">
                                                <h6 class="mb-0 ls-1">Delivered By :</h6>
                                                <h6 class="mb-0 delivered-date "><?php if($rowSize['OrderStatusID'] == 1){
                                                  $orderDate = new DateTime($placedDate);

                                                echo $orderDate->format('M d, Y ');   
                                                }else{
                                               
                                                $orderDate = new DateTime($rowSize['ordTime_time']);

                                                echo $orderDate->format('M d, Y ');  
                                                    
                                                }  
                                                ?>
                                                </h6>
                                            </div>

                                            <div class="d-flex">
                                                <h6 class="mb-0 ls-1">Status :</h6>
                                                <?php 
                                                // $orderStatus = $rowSize['OrderStatusID'];
                                                // switch($orderStatus) {
                                                //     case '1':
                                                //         echo $rowSize['Os_Name'];
                                                //     case '2'
                                                // }
                                                
                                                ?>
                                                <h6 class="mb-0 order-status "><?php echo $rowSize['Os_Name']; ?></h6>
                                            </div>

                                            <div class="d-flex">
                                                <h6 class="mb-0 ls-1"> Total Items :</h6>
                                                <h6 class="mb-0 total-items "><?php echo $resUserItem['totalitem']; ?></h6>
                                            </div>

                                            <div class="d-flex">
                                                <h6 class="mb-0 ls-1">Promocode :</h6>
                                                <h6 class="mb-0 promocode-order ">
                                                    <?php echo $resUserItem['OrdDtl_DIscountCode']; ?></h6>
                                            </div>






                                        </div>
                                    </div>

                                    <div class="d-flex track-order-div justify-content-between ">
                                        <a href="orderdetails.php?orderNo=<?php echo $orderId;?>" class="details-myorder"> Order Details</a>
                                        <a href="#collapseordered<?php echo $orderId; ?>" class="track-order"
                                            data-bs-toggle="collapse">Track Order</a>
                                    </div>



                                </div>
                            </h2>
                            <div id="collapseordered<?php echo $orderId; ?>" class="accordion-collapse bg-track collapse "
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body container-fluid">

                                    <div class="row justify-content-center">
                                        <div class="col-lg-7 col-md-6 col-12 d-flex justify-content-evenly flex-column">
                                            <div
                                                class=" order-track-style ordered-done justify-content-between d-flex ">
                                                <?php 
                                                if($rowSize['Os_Name'] == "New Order"){
                                                    $neworderClass = "new-order";
                                                    $processOrder = 'new-order-zero';
                                                    $dispatchOrd = "pending-order";
                                                    $ondelivaryWay = "pending-order";
                                                    $shippeddonw = '';
                                                    $delivereddone = '';
                                                    

                                                }elseif($rowSize['Os_Name'] == 'Accept Order'){
                                                    $neworderClass = "done-order";
                                                    $processOrder = 'new-order-zero';
                                                    $dispatchOrd = "pending-order";
                                                    $ondelivaryWay = "pending-order";
                                                    $shippeddonw = '';
                                                    $delivereddone = '';
                                                }else if($rowSize['Os_Name'] == "Dispatch Order"){
                                                    $neworderClass = "done-order";
                                                    $processOrder = 'dispatchprocess';
                                                    $dispatchOrd = "done-order";
                                                    $ondelivaryWay = "pending-order";
                                                    $shippeddonw = 'done';
                                                    $delivereddone = '';
                                                }else if($rowSize['Os_Name'] == "Delivered"){
                                                    $neworderClass = "done-order";
                                                    $processOrder = 'shippedCompletedprocess';
                                                    $dispatchOrd = "done-order";
                                                    $ondelivaryWay = "done-order";
                                                    $shippeddonw = 'done';
                                                    $delivereddone = 'done';
                                                }
                                                
                                                ?>
                                                <span class="<?php echo $neworderClass; ?> "></span>
                                                <span class="<?php echo $dispatchOrd;?>"></span>
                                                <span class="<?php echo $ondelivaryWay; ?>"></span>
                                                <div class="<?php echo $processOrder; ?>"></div>



                                            </div>
                                            <div class=" order-track-info-style justify-content-between d-flex  ">

                                                <div class="ordered  done">
                                                    <img src="assets1/images/clipboard (1).png" alt="">
                                                </div>

                                                <div class="shipped <?php echo  $shippeddonw; ?>">
                                                    <img src="assets1/images/shipped.png" alt="">
                                                </div>

                                                <div class="delivered <?php echo $delivereddone; ?>">
                                                    <img src="assets1/images/delivered.png" alt="">
                                                </div>


                                            </div>

                                            <div class=" order-track-info-style  justify-content-between d-flex  ">

                                                <div class="ordered  done">
                                                    <span> Placed</span>
                                                    <span class="myorder-placed-date"><?php $orderDate = new DateTime($placedDate);

                                                echo $orderDate->format('M d, Y '); ?></span>
                                                </div>

                                                <div class="shipped <?php echo  $shippeddonw; ?>">
                                                    <span> Shipped</span>
                                                    <span class="myorder-shipped-date"><?php 
                                                    if($result2->rowCount() >0){
                                    $dispatchorderDate = new DateTime($dispatchOrder['ordTime_time']);

                                                echo $dispatchorderDate->format('M d, Y '); 
                                }
                                        
                                                    ?></span>

                                                </div>

                                                <div class="delivered <?php echo $delivereddone; ?>">
                                                    <span> Delivered</span>
                                                    <span class="myorder-delivered-date"><?php 
                                                     if($result3->rowCount() >0){
                                    $deliveredOrder = $result3->fetch();
                                     $deliveredorderDate = new DateTime($deliveredOrder['ordTime_time']);

                                                echo $deliveredorderDate->format('M d, Y ');
                                }
                                                   
                                                    //echo date('M d, Y',$date); ?></span>

                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php } }}else{ ?>
                            <h5 class="text-center pt-3">No Previous Order Available</h5>
                        <?php }?>
                    </div>

                </div>


            </div>

        </div>


        <?php 
            $userId = $_SESSION['USER']['ID'];
            $sql1 = "SELECT COUNT(*) as totalcart, SUM(item.ite_Rate * cart.cart_volume) as TotalitemCost FROM cart LEFT JOIN item ON cart.cart_itemId = item.ite_Id WHERE cart.cart_UserID = '$userId'";
            $result1=$dbh->query($sql1);
            $resUserItem = $result1->fetch();

            $sql2 = "SELECT COUNT(*) as totalorder FROM `order` WHERE ord_userid = ' $userId' AND OrderStatusID < 4";
            // echo $sql2;
            $result2 = $dbh->query($sql2);
            $rezultTotalOrder = $result2->fetch();
        ?>



        <footer class="container-fluid position-fixed bottom-0">

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


                <a class="col active-footer position-relative" href="myorders.php">
                    <img src="assets1/images/bagactive.png" alt="">
                    <span>My Orders</span>
                    <?php if ($checkloginadmin) { ?>
                    <span
                        class="cart-items-badge my-orders-value  rounded-pill bg-theme2 position-absolute top-0 translate-middle-y start-50  text-white totalorders">
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
 <div  class="loader   top-0 start-0  flex-column align-items-center justify-content-center bottom-0 end-0">
        <span class="text-white fs-4 mb-2">Loading</span>
        <div class=" spinner-border text-theme-3  "></div>

    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets1/css/myorder.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="assets1/css/mediaquery.css">

    <script src="assets1/js/myorders.js"></script>
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
    
    </script>


</body>

</html>