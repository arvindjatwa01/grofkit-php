<?php
include_once 'admin/connection_handle.php';
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
    <title>Grofkit | Select Address</title>

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


    <div class="h-100 d-flex flex-column">
        <header class="container-fluid position-sticky top-0  bg-black ">

            <div class="row">
                <div class="col-12 position-relative d-flex align-items-center justify-content-center">
                    <?php 
                        if(isset($_GET['cart'])){
                            $cart = $_GET['cart'];
                            $applyedCoupan = "?cp=$cart";
                            $applyCoupanIs= "&cp=$cart";
                        }else{
                            $applyedCoupan = ''; 
                            $applyCoupanIs ='';
                        }
                    ?>
                    <a class="las la-arrow-left btn-back text-white text-decoration-none fw-bolder"
                        href="cart.php<?php echo $applyedCoupan; ?>">


                    </a>
                    <span class="fc-1 fw-600"> Select Address
                    </span>
                </div>
            </div>






        </header>


        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="add-newadd row same-style-address justify-content-center">
                        <div class="col-12 px-0">

                            <a class="d-flex shadow-sm text-decoration-none "
                                href="checkout.php<?php echo $applyedCoupan; ?>">
                                <i class="fa-solid fa-plus"></i>

                                <h6 class="mb-0">Add new Address</h6>
                            </a>









                        </div>

                    </div>

                    <form class="save-address-list row align-items-center flex-column">
                        <?php 
                            $userId = $_SESSION['USER']['ID'];
                            
                            $mstuserSql = "SELECT us_postalCode FROM mstuser WHERE us_Id='$userId'";
     
                         $mstuserRes = $dbh->query($mstuserSql);
                         $mstuserRow = $mstuserRes->fetch(); 
                            
                            
                             $strLoadConditions = " AND ad_UserID = '$userId' ORDER BY ad_ID DESC ";
                             $resSelectCartList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'mstaddress');
                             if (count($resSelectCartList) > 0) {
                                foreach ($resSelectCartList as $rowsize) {
                                    $mainuserId = $rowsize['ad_UserID'];
                                    $mstuserSql = "SELECT us_postalCode FROM mstuser WHERE us_Id='$mainuserId'";
     
                         $mstuserRes = $dbh->query($mstuserSql);
                         $mstuserRow = $mstuserRes->fetch();
                                    if($rowsize['ad_postalCode'] != $mstuserRow['us_postalCode']){
                                        $checked = "";
                                    }else{
                                        $checked ="checked";
                                    }
                         
                        ?>
                        <div class="col-12 checkedAddress" for="save-address-<?php echo $rowsize['ad_ID'] ?>" data-selpincode="<?php echo $rowsize['ad_postalCode'] ?>" data-seluserid="<?php echo $userId; ?>" data-saveaddressid="<?php echo $rowsize['ad_ID'] ?>">

                            <div class="">
                                
                                <input type="radio" id="save-address-<?php echo $rowsize['ad_ID'] ?>" name="addresssame"
                                    value="<?php echo $rowsize['ad_ID'] ?>" <?php echo $checked; ?>>

                            </div>

                            <div class="address-info">
                                <div class="d-flex mb-25">
                                    <h4 class="mb-0 me-2"><?php echo $rowsize['ad_name']; ?></h4>

                                    <?php
                                    if($rowsize['ad_addressType'] == 1){
                                        $addressType = 'home';
                                    }else{
                                        $addressType = 'Office';
                                    }
                                    ?>
                                    <span class="home-office"><?php echo $addressType; ?></span>

                                    <a href="checkout.php?id=<?php echo $rowsize['ad_ID']; ?>&mode=edit<?php echo $applyCoupanIs; ?>"
                                        class="editaddress-btn d-none shadow">Edit</a>


                                </div>

                                <h6 class="full-address mb-0">
                                    <?php echo $rowsize['ad_address1'].", ".$rowsize['ad_address2']; ?>
                                </h6>
                            </div>





                        </div>
                        <?php 
                                }
                            }else{
                                redirect('checkout.php'.$applyedCoupan); 
                            }
        ?>


                    </form>
                    </div>
            </div>
            
        </div>
                    <?php 
                    $loginUserId = $_SESSION['USER']['ID'];
                        $pincodeSql = "SELECT us_postalCode FROM mstuser WHERE us_Id = '$loginUserId'";
                        $pincodeRes = $dbh->query($pincodeSql);
                        $pincodeRow =  $pincodeRes->fetch();
                    
                            $userId = $_SESSION['USER']['ID'];
                            $pincode = $pincodeRow['us_postalCode'];
                            $sql1 = "SELECT COUNT(*) as totalcart, SUM(item.ite_Rate * cart.cart_volume) as TotalitemCost FROM cart LEFT JOIN item ON cart.cart_itemId = item.ite_Id WHERE cart.cart_UserID = '$userId'";
                            $result1=$dbh->query($sql1);
                            $resUserItem = $result1->fetch();
                            
                        ?>
                    <?php 
                    
                     $itemids = array();
                        $cartLoadConditions = ' AND cart_UserID = '.$userId.'';
                        $cartFileds = 'item.*, cart.*';
                        $cartJoinCondition = "LEFT JOIN item ON cart.cart_itemId = item.ite_Id";
                        $cartSelectCartList = $class_common->loadMultipleDataByTableName($cartLoadConditions, $cartFileds, $cartJoinCondition, 0, '', 'cart');
                        if (count($cartSelectCartList) > 0) {
                            foreach ($cartSelectCartList as $cartSize) { 
                                $itemids[]=$cartSize['ite_Id'];
                            }
                        }
                                       
                        // $coupanRate = '';
                        $coupanName = '';
                        // $cpdtl_CP_Id = 0;                
                        if(isset($_GET['cart'])){
                            
                            $sql ="SELECT coupandtl.*, coupen.* FROM coupandtl LEFT JOIN coupen ON CpDtl_CPID = Cp_ID WHERE CpDtl_Id = ".base64_decode($_GET['cart'])."";
                            $result = $dbh->query($sql);
                            $row = $result->fetch();
                            $coupanName = $row['CP_Code'];
                            $cpdtl_CP_Id = $row['CpDtl_CPID'];
                            // if($row['CP_IsInAmount'] == 1){
                            //     $coupanRate = $row['CP_Volumn'];
                                                
                            //     }else{
                            //         $coupanRate = ($resUserItem['TotalitemCost']*$row['CP_Volumn'])/100;
                            //     }
                            $coupanRate= $GetValuesAmount->GetDiscountAmount($itemids,$cpdtl_CP_Id,$userId);
                            // $coupanRate = $cpdtl_CP_Id;
                        }else{
                            $coupanRate = 0;
                            $coupanName = 'no';
                            $cpdtl_CP_Id= 0;
                        }

                        $finalAMount = $GetValuesAmount->GetFinalCost($itemids,$pincode,$cpdtl_CP_Id,$userId);
                        
                        $userinfoSql ="SELECT * FROM mstuser WHERE us_Id = '$userId'";
                        $userinfoRes = $dbh->query($userinfoSql);
                        $userinfoRow = $userinfoRes->fetch();
                        $userEmailId = $userinfoRow['us_EmailID'];
                        $userMobileNo = $userinfoRow['us_mobileNo'];
                                        
                    ?>
                    <div class="container-fluid mt-auto">
            <div class="row justify-content-center">
                <div class="col-md-6 border-top">
                    <form class="d-flex w-100 payment-options   justify-content-between align-items-center  bottom-0">
                        <div class="d-flex align-items-center">
                            <input type="radio" name="pay-info" class="pay-choose" id="payOnline" checked>
                            <label for="payOnline">
                                Pay Online
                            </label>
                        </div>

                        <div class="d-flex align-items-center">
                            <input type="radio" name="pay-info" class="pay-choose" id="cashOndelivery">
                            <label for="cashOndelivery">
                                Cash on Delivery
                            </label>
    
                        </div>


                       
                        
                       
                       
                        
                    </form>
                </div>
            </div>
        </div>
                    <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <!--<div class="d-flex w-100 justify-content-between border-top-0 align-items-center bottom-0">-->
                    <!--    <div class="justify-content-between">-->
                    <!--        <input type="radio" value="0" name="paymentType" id="cashOndelivery">-->
                    <!--    <label>Cash On delivery</label>-->
                    <!--    </div>-->
                    <!--    <div class="justify-content-between">-->
                    <!--        <input type="radio" value="1" name="paymentType" id="payOnline" checked>-->
                    <!--        <label>Pay Online</label>-->
                    <!--    </div>-->
                        
                        
                    <!--</div>-->
                    <div
                        class="d-flex w-100 justify-content-between border-top-0 align-items-center payment-small-det bottom-0">
                        <div class="total-amount "> <span>&#8377;</span>

                            <span class="d-none" id="coupandataname"><?php echo $coupanName; ?></span>
                            <span
                                id="payableAmount"><?php echo number_format($finalAMount,2); ?></span>
                                
                                
                        </div>
                        <a id="rzp-button1" class="proceedpay-btn">Continue</a>
                        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                        <form name='razorpayform' action="verify.php" method="POST" class="position-absolute">
                            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                            <input type="hidden" name="razorpay_signature" id="razorpay_signature">
                            <input type="hidden" name="login_user_id" id="login_user_id">
                            <input type="hidden" name="checked_user_name" id="checked_user_name">
                            <input type="hidden" name="checked_user_email" id="checked_user_email">
                            <input type="hidden" name="checked_user_mobile" id="checked_user_mobile">
                            <input type="hidden" name="checked_user_address1" id="checked_user_address1">
                            <input type="hidden" name="checked_user_address2" id="checked_user_address2">
                            <input type="hidden" name="checked_user_pincode" id="checked_user_pincode">
                            <input type="hidden" name="checked_user_city" id="checked_user_city">
                            <input type="hidden" name="checked_user_state" id="checked_user_state">
                            <input type="hidden" name="checked_user_country" id="checked_user_country">
                            <input type="hidden" name="checked_user_coupanrate" id="checked_user_coupanrate">
                            <input type="hidden" name="checked_user_finalcost" id="checked_user_finalcost">
                            <input type="hidden" name="checked_user_coupanName" id="checked_user_coupanName">
                            <input type="hidden" name="checked_user_shippingCost" id="checked_user_shippingCost">
                            <input type="hidden" name="checked_user_bftAmount" id="checked_user_bftAmount">
                            <input type="hidden" name="checked_user_gstAmount" id="checked_user_gstAmount">
                        </form>
                        <?php include('pay.php'); ?>
                    </div>
                </div>
            </div>

        </div>



    </div>
    <div class="modal fade show" id="alertinfo">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

               
                <div class="modal-body">
                    <h6 class="mb-0 text-center">Your pincode changed.</h6>
                    <h6 class="mb-0 text-center">New Billing cost is <span>&#8377;</span> <span id="new-amount">500</span></h6>
                </div>
                <div class="modal-footer">
                    <a  class="flex-grow yes">Yes</a>
                    <a  class="flex-grow no">No</a>


                </div>

            </div>
        </div>
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
    <script src="https://kit.fontawesome.com/2918a48001.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets1/css/myorder.css">

    <link rel="stylesheet" href="assets1/css/mediaquery.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script src="assets1/js/saveadd.js"></script>
    
    <script>
        $(document).on("click", '.checkedAddress', function(){
            var selPincode = $(this).data("selpincode");
            var seluserid = $(this).data("seluserid");
            var coupanRate = <?php echo $cpdtl_CP_Id; ?>;
            var saveaddressid = $(this).data("saveaddressid");
             
            $.ajax({
               url: "action.php",
               type: "POST",
               data:{
                   selPincode: selPincode,
                   seluserid: seluserid,
                   coupanRate: coupanRate,
                   ischnagedAddress: true
               },
               success: function(data){
                    let alertinfoactive= new bootstrap.Modal(alertinfo)

                    alertinfoactive.show()
                    $("#new-amount").html(data)
                    
                    $(document).on("click", '.yes', function(){
                        // console.log(saveaddressid);
                        $.ajax({
                            url: "action.php",
                            type: "POST",
                            data: {
                               selPincode:selPincode,
                               seluserid:seluserid,
                               yeschangPincode: true
                            },
                            success: function(data){
                                if(data==1){
                                    $("#save-address-"+saveaddressid).prop('checked', true);
                                alertinfoactive.hide()
                                }
                                $("#save-address-"+saveaddressid).prop('checked', true);
                                alertinfoactive.hide()
                                location.reload();
                            }
                        });
                        $("#save-address-"+saveaddressid).prop('checked', true);
                        // $("#save-address-"+saveaddressid).checked = true;
                       alertinfoactive.hide()
                    });
                    $(document).on("click", '.no', function(){
                        // $("#save-address-"+saveaddressid).prop('checked', false);
                       alertinfoactive.hide() 
                    });
               }
            });
        });
        
    </script>
    
    
     <script>
    var options = <?php echo $json?>;
    options.handler = function(response) {
        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
        document.getElementById('razorpay_signature').value = response.razorpay_signature;
        document.razorpayform.submit();
    };
    options.theme.image_padding = false;
    options.modal = {
        ondismiss: function() {
            console.log("This code runs when the popup is closed");
        },
        escape: true,
        backdropclose: false
    };
    var rzp = new Razorpay(options);
    document.getElementById('rzp-button1').onclick = function(e) {

        var checkedAdd = $('input[name="addresssame"]:checked').val();
        var coupanAmount = <?php echo $coupanRate; ?>;
        var coupanName = $('#coupandataname').text();
        var totalAmount = $("#payableAmount").text();
        if ($("#payOnline").is(":checked")) {
            $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                checkedAdd: checkedAdd,
                coupanAmount: coupanAmount,
                totalAmount: totalAmount,
                coupanName: coupanName,
                ischeckedAdd: true
            },
            success: function(data) {
                // console.log(data);

                if (data == 2) {
                    alert("We are not available on this address. we are comming soon!");
                } else {
                    // console.log(data);
                    var check = JSON.parse(data);
                    $("#login_user_id").val(check[0]);
                    $("#checked_user_name").val(check[1]);
                    $("#checked_user_email").val(check[2]);
                    $("#checked_user_mobile").val(check[3]);
                    $("#checked_user_address1").val(check[4]);
                    $("#checked_user_address2").val(check[5]);
                    $("#checked_user_pincode").val(check[6]);
                    $("#checked_user_city").val(check[7]);
                    $("#checked_user_state").val(check[8]);
                    $("#checked_user_country").val(check[9]);
                    $("#checked_user_coupanrate").val(check[10]);
                    $("#checked_user_finalcost").val(check[11]);
                    $("#checked_user_coupanName").val(check[12]);
                    $("#checked_user_shippingCost").val(check[13]);
                    $("#checked_user_bftAmount").val(check[14]);
                    $("#checked_user_gstAmount").val(check[15]);
                    rzp.open();
                    e.preventDefault();
                    
                }
            }
        });
        }else{
            $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                checkedAdd: checkedAdd,
                coupanAmount: coupanAmount,
                totalAmount: totalAmount,
                coupanName: coupanName,
                ischeckedAddCOD: true
            },
            success: function(data) {

                if (data == 2) {
                    alert("We are not available on this address. we are comming soon!");
                } else {
                    // console.log(data);
                    
                    window.location.href = "myorders.php";
                    
                }
            }
            });
        }

        // rzp.open();
        // e.preventDefault();
    }
    </script>
     <script>
    // $(document).ready(function() {
    //     $(document).on('click', '.proceedpay-btn', function() {

    //         var checkedAdd = $('input[name="addresssame"]:checked').val();
    //         var coupanAmount = <?php echo $coupanRate; ?>;
    //         var coupanName = $('#coupandataname').text();
    //         var totalAmount = $("#payableAmount").text();
    //         // console.log(coupanAmount);
    //         $.ajax({
    //             url: 'action.php',
    //             type: 'POST',
    //             data: {
    //                 checkedAdd: checkedAdd,
    //                 coupanAmount: coupanAmount,
    //                 totalAmount: totalAmount,
    //                 coupanName: coupanName,
    //                 ischeckedAdd: true
    //             },
    //             success: function(data) {
    //                 // console.log(data);
    //                 if(data == 2){
    //                     alert("We are not available on this address. we are comming soon!");
    //                 }else{
    //                   window.location.href = "myorders.php";
    //                 }
    //             }
    //         });
    //     });
    // });
    </script>


</body>

</html>