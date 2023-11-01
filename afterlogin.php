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
    <title>Grofkit after Login</title>

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
<body class="after-login ">

    <div class="container-fluid d-flex flex-column after-login-profile">

        <div class="row justify-content-center align-items-center flex-column flex-grow-1">
            <div class="col-md-9 px-0 shadow d-flex flex-column h-100 flex-grow-1">

                <div class="d-flex flex-column z-99 bg-white stick-profile position-sticky top-0">
                    <div class=" back-btn d-flex">
                        <div class="back-btn-img">
                            <a class="las la-arrow-left" href="index.php"></a>
                        </div>
    
                    </div>
    
                    <div class=" profile-sec  d-flex align-items-center">
                        <div class=" d-flex justify-content-center align-items-center">
                            <div class="user-profile-img  d-flex">
                                <img src="assets1/images/Blank-Male-Profile1-e1463076107379.png" alt="" class="img-fluid w-100 object-fit rounded-circle">
    
                            </div>
                            
    
                        </div>
    
                        <div class="">
                            <span class="mobile-email-user fw-600">
                            <?php echo $rowAdminInfo['us_EmailID']; ?>
                            </span>
                        </div>
    
                    </div>
                </div>

                

                <div class="user-profile-options d-flex flex-column">
                    <a class=" common-login-style my-orders-profile  d-flex align-items-center" href="myorders.php">
                        <div class=" d-flex justify-content-center align-items-center">
                            <div class="user-profile-option-img">
                                <img src="assets1/images/baggold.png" alt="" class="img-fluid object-fit">
    
                            </div>
                            
    
                        </div>
    
                        <div class="">
                            <span class=" fw-600">
                               My orders
                            </span>
                        </div>


                        <div class=" d-flex justify-content-center align-items-center ms-auto">
                            <div class="user-profile-right-option-img">
                                <img src="assets1/images/next1.png" alt="" class="img-fluid object-fit ">
    
                            </div>
                            
    
                        </div>
    
                    </a>

                   
                    <a class=" common-login-style settings-profile  d-flex align-items-center">
                        <div class=" d-flex justify-content-center align-items-center">
                            <div class="user-profile-option-img">
                                <img src="assets1/images/cogwheel.png" alt="" class="img-fluid object-fit ">
    
                            </div>
                            
    
                        </div>
    
                        <div class="">
                            <span class=" fw-600">
                                Settings
                            </span>
                        </div>
                        <div class=" d-flex justify-content-center align-items-center ms-auto">
                            <div class="user-profile-right-option-img">
                                <img src="assets1/images/next1.png" alt="" class="img-fluid object-fit ">
    
                            </div>
                            
    
                        </div>
    
                    </a>
                    <a class=" common-login-style contactus-profile  d-flex align-items-center" href="#cont-collapse" data-bs-toggle="collapse">
                        <div class=" d-flex justify-content-center align-items-center">
                            <div class="user-profile-option-img">
                                <img src="assets1/images/phone-call1.png" alt="" class="img-fluid object-fit ">
    
                            </div>
                            
    
                        </div>
    
                        <div class="">
                            <span class=" fw-600">
                                Contact us
                            </span>
                        </div>
                        <div class=" d-flex justify-content-center align-items-center ms-auto">
                            <div class="user-profile-right-option-img">
                                <img src="assets1/images/next1.png" alt="" class="img-fluid object-fit ">
    
                            </div>
                            
    
                        </div>


    
                    </a>
                    <div class="collapse " id="cont-collapse" style="">
                        <a class="cont-info" href="tel:+91-9734878789">
                            <div class=" d-flex justify-content-center align-items-center">
                                <div class="user-profile-option-img">
                                    <img src="assets1/images/phone-call1.png" alt="" class="img-fluid object-fit ">
        
                                </div>
                                
        
                            </div>
        
                            <div class="">
                                <span class=" fw-600">
                                    +91-9734878789
                                </span>
                            </div>
                           

                        </a>
                        <a class="cont-info" href="mailto: abchasjh87@gmail.com">
                            <div class=" d-flex justify-content-center align-items-center">
                                <div class="user-profile-option-img">
                                    <img src="assets1/images/email.png" alt="" class="img-fluid object-fit ">
        
                                </div>
                                
        
                            </div>
        
                            <div class="">
                                <span class=" fw-600">
                                   abchasjh87@gmail.com
                                </span>
                            </div>
                           

                        </a>
                    </div>
                    <a class=" common-login-style tandc-profile  d-flex align-items-center" href="termsofuse.php">
                        <div class=" d-flex justify-content-center align-items-center">
                            <div class="user-profile-option-img">
                                <img src="assets1/images/terms-and-conditions.png" alt="" class="img-fluid object-fit ">
    
                            </div>
                            
    
                        </div>
    
                        <div class="">
                            <span class=" fw-600">
                               Terms of use
                            </span>
                        </div>

                        <div class=" d-flex justify-content-center align-items-center ms-auto">
                            <div class="user-profile-right-option-img">
                                <img src="assets1/images/next1.png" alt="" class="img-fluid object-fit ">
    
                            </div>
                            
    
                        </div>
    
                    </a>

                    <a class=" common-login-style faq-profile  d-flex align-items-center" href="faq.php">
                        <div class=" d-flex justify-content-center align-items-center">
                            <div class="user-profile-option-img">
                                <img src="assets1/images/information.png" alt="" class="img-fluid object-fit">
    
                            </div>
                            
    
                        </div>
    
                        <div class="">
                            <span class=" fw-600">
                               FAQ
                            </span>
                        </div>


                        <div class=" d-flex justify-content-center align-items-center ms-auto">
                            <div class="user-profile-right-option-img">
                                <img src="assets1/images/next1.png" alt="" class="img-fluid object-fit ">
    
                            </div>
                            
    
                        </div>
    
                    </a>
                    <a class=" common-login-style privacypolicy-profile  d-flex align-items-center" href="privacypolicy.php">
                        <div class=" d-flex justify-content-center align-items-center">
                            <div class="user-profile-option-img">
                                <img src="assets1/images/privacy.png" alt="" class="img-fluid object-fit ">
    
                            </div>
                            
    
                        </div>
    
                        <div class="">
                            <span class=" fw-600">
                                Privacy Policy
                            </span>
                        </div>
                        <div class=" d-flex justify-content-center align-items-center ms-auto">
                            <div class="user-profile-right-option-img">
                                <img src="assets1/images/next1.png" alt="" class="img-fluid object-fit ">
    
                            </div>
                            
    
                        </div>
    
                    </a>
                    <a class=" common-login-style refundandshippingpolicy-profile  d-flex align-items-center" href="returnpolicy.php">
                        <div class=" d-flex justify-content-center align-items-center">
                            <div class="user-profile-option-img">
                                <img src="assets1/images/money-back.png" alt="" class="img-fluid object-fit ">
    
                            </div>
                            
    
                        </div>
    
                        <div class="">
                            <span class=" fw-600 text-wrap">
                               Returns/Refunds & Shipping policy
                            </span>
                        </div>
                        <div class=" d-flex justify-content-center align-items-center ms-auto">
                            <div class="user-profile-right-option-img">
                                <img src="assets1/images/next1.png" alt="" class="img-fluid object-fit ">
    
                            </div>
                            
    
                        </div>


    
                    </a>
                    <a href="Userlogout.php" class=" common-login-style logout-profile  d-flex align-items-center">
                        <div class=" d-flex justify-content-center align-items-center">
                            <div class="user-profile-option-img">
                                <img src="assets1/images/log-out.png" alt="" class="img-fluid object-fit ">
    
                            </div>
                            
    
                        </div>
    
                        <div class="">
                            <span class=" fw-600">
                               Log out
                            </span>
                        </div>

                        <div class=" d-flex justify-content-center align-items-center ms-auto">
                            <div class="user-profile-right-option-img">
                                <img src="assets1/images/next1.png" alt="" class="img-fluid object-fit ">
    
                            </div>
                            
    
                        </div>
    
                    </a>
                </div>
               

            </div>
        </div>
    </div>

    <footer class="container-fluid position-fixed bottom-0">

        <div class="row">
            <a class="col " href="index.php">
                <img src="assets1/images/home (1)inactive.png" alt="">
                <span>Home</span>

            </a>
            <a class="col position-relative" href="cart.php">
                <img src="assets1/images/shopping-cart.png" alt="">
                <span>Cart</span>
                <?php if ($checkloginadmin) { 
                    $userId = $_SESSION['USER']['ID'];
                    
                    $sql1 = "SELECT COUNT(*) as totalcart, SUM(item.ite_Rate * cart.cart_volume) as TotalitemCost FROM cart LEFT JOIN item ON cart.cart_itemId = item.ite_Id WHERE cart.cart_UserID = '$userId'";
                    $result1=$dbh->query($sql1);
                    $resUserItem = $result1->fetch();

                    $sql2 = "SELECT COUNT(*) as totalorder FROM `order` WHERE ord_userid = ' $userId' AND OrderStatusID < 4";
                    $result2 = $dbh->query($sql2);
                    $rezultTotalOrder = $result2->fetch();
                ?>
                <span class="cart-items-badge my-cart-value rounded-pill bg-theme2 position-absolute top-0 translate-middle-y start-50  text-white">
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
                <?php if ($checkloginadmin) { ?>
                <span class="cart-items-badge my-orders-value  rounded-pill bg-theme2 position-absolute top-0 translate-middle-y start-50  text-white">
                <?php echo $rezultTotalOrder['totalorder']; ?>
                </span>
                <?php }?>
            </a>
          
            <a class="col active-footer" href="loginsignup.php">
                <img src="assets1/images/userinactive.png" alt="">
                <span>Profile</span>

            </a>
            <!-- <a class="col">
                <img src="assets1/images/userinactive.png" alt="">
                <span>Profile</span>

            </a> -->
        </div>

    </footer>
 <div  class="loader   top-0 start-0  flex-column align-items-center justify-content-center bottom-0 end-0">
        <span class="text-white fs-4 mb-2">Loading</span>
        <div class=" spinner-border text-theme-3  "></div>

    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets1/css/login.css">
    <link rel="stylesheet" href="assets1/css/mediaquery.css">

   


    <script src="assets1/js/afterlogin.js"></script>

    
</body>
</html>