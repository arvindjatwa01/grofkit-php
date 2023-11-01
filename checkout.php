<?php include_once './admin/connection_handle.php';
$class_user_login->checkuserLoggedIn();
$strLoadAdminCondition = ' AND us_Id=' . $class_user_login->getCurrentLoginAdminId();
$rowAdminInfo = $class_common->loadSingleDataBy($strLoadAdminCondition, '', '', TABLE_USER);


$checkloginadmin = $class_user_login->checkuserLoggedIn();

if ($checkloginadmin == '') {
	redirect('loginsignup.php');
}
$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}

$aryErrors = $class_checkout->sizeProcessRequest('', $strMode);

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND ad_ID=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'mstaddress');
}

if (isset($_POST['size'])) {

	$rowsizeData = $_POST;
}

?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery</title>
   
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
<body class="checkoutform ">


    <div class=" d-flex flex-column justify-content-between">
        <?php 
            if(isset($_GET['cp'])){
                $cart = $_GET['cp'];
                $applyedCoupan = "?cart=$cart";
            }else{
                $cart = "";
                $applyedCoupan = ''; 
            }
        ?>
        <header  class="container-fluid d-flex flex-column justify-content-center  position-sticky top-0  bg-black ">

            <div class="row align-items-center justify-content-between">
                <div class="col-12 position-relative d-flex align-items-center justify-content-center">
                    <a class="las la-arrow-left btn-back text-white text-decoration-none fw-bolder" href="selectaddress.php<?php echo $applyedCoupan; ?>">


                    </a>
                    <span class="fc-1 fw-600"> Checkout
                </span>
                </div>
            </div>

        

                

            
           

        </header>



        <div class="container-fluid h-100 ">
            <div class="row justify-content-center position-relative checkout-main no-scrollbar">
                <div class="col-md-6 shadow  px-0">

                    <!-- <div class="d-flex py-3 shadow-sm bg-white justify-content-between align-items-center">
                        <h6 class="mb-0 fw-600 text-theme fs-3">
                            CHECKOUT
    
                        </h6>

                        <a href="cart.php" class="backtocart">Back to cart</a>
                    </div> -->
                   

                 <form action="" class="checkout-form no-scrollbar pt-4 pb-2" method="POST">
                        <div class="name-address d-flex same-form-style  flex-column">
                            <div class="first-name-address">
                                <input type="hidden" name="applyCoupanName" value="<?php echo $applyedCoupan; ?>">
                                
                                <label for="Name" class="form-label"> Name<span class="req">*</span></label>
                                <input type="text" class="form-control" id="Name" autocomplete="off" name="AdduserName" autocomplete="off"
                                    value="<?php if (isset($rowsizeData['ad_name']) && '' != $rowsizeData['ad_name']) {
																							echo $rowsizeData['ad_name'];
																						} ?>">
																	
    <input type="hidden" class="form-control" name="AdduserID"
                                    value="<?php echo $_SESSION['USER']['ID']; ?>">                            
                            </div>
                            <div class="email-address">
                                <label for="Email" class="form-label">Email<span class="req">*</span></label>
                                <input autocomplete="off"  type="text" class="form-control" id="Email" name="Adduseremail" value="<?php if (isset($rowsizeData['ad_EmailID']) && '' != $rowsizeData['ad_EmailID']) {
																							echo $rowsizeData['ad_EmailID'];
																						} ?>">
                            </div>
                            <div class="phone-address">
                                <label for="Mobile" class="form-label">Phone Number<span class="req">*</span></label>
                                <input autocomplete="off" type="text" class="form-control" id="Mobile" name="Adduserphone" maxlength="10" value="<?php if (isset($rowsizeData['ad_MobileNo']) && '' != $rowsizeData['ad_MobileNo']) {
																							echo $rowsizeData['ad_MobileNo'];
																						} ?>">
                            </div>
                        </div>
                        <div class="address-address d-flex same-form-style flex-md-row flex-column">
                            <div class="">
                                <label for="address" class="form-label">Address 1<span class="req">*</span></label>
                                <input autocomplete="off" type="text" name="AdduserAdd1" class="form-control" id="address" value="<?php if (isset($rowsizeData['ad_address1']) && '' != $rowsizeData['ad_address1']) {
																							echo $rowsizeData['ad_address1'];
																						} ?>">
                            </div>
                            
                               
                                
                            
                        </div>

                        <div class="address-address2 d-flex same-form-style flex-md-row flex-column">
                            <div class="">
                                <label for="address2" class="form-label">Address 2 (optional)</label>
                                <input autocomplete="off" type="text" name="AdduserAdd2" class="form-control" id="address2" value="<?php if (isset($rowsizeData['ad_address2'])) {
																							echo $rowsizeData['ad_address2'];
																						} ?>">
                            </div>
                           
                            
                               
                                
                            
                        </div>

                        <div class="city-address d-flex same-form-style flex-md-row flex-column">
                          
                            <div class="zipcode">
                                <label for="zipcode" class="form-label">Zip Code<span class="req">*</span></label>
                                <input  type="text" maxlength="6" class="form-control" name="Addzipcode" id="zipcode" autocomplete="off" value="<?php if (isset($rowsizeData['ad_postalCode']) && '' != $rowsizeData['ad_postalCode']) {
																							echo $rowsizeData['ad_postalCode'];
																						} ?>">
                            </div>
                            <div class="city">
                                <label for="city" class="form-label">City<span class="req">*</span></label>
                                <input autocomplete="off" type="text" class="form-control" id="city" name="AddCity" value="<?php if (isset($rowsizeData['ad_City']) && '' != $rowsizeData['ad_City']) {
																							echo $rowsizeData['ad_City'];
																						} ?>" readonly>
                            </div>
                           
                            
                               
                                
                            
                        </div>

                        <div class="country-address d-flex same-form-style flex-md-row flex-column">

                            <div class="state">
                                <label for="state" class="form-label">State<span class="req">*</span></label>
                                <input autocomplete="off" type="text" class="form-control" id="state" name="AddState" value="<?php if (isset($rowsizeData['ad_StateName']) && '' != $rowsizeData['ad_StateName']) {
																							echo $rowsizeData['ad_StateName'];
																						} ?>" readonly>
                            </div>
                            <div class="country">
                                <label for="country" class="form-label">Country<span class="req">*</span></label>
                                <input autocomplete="off" type="text" class="form-control" id="country" name="AddCountry" value="<?php if (isset($rowsizeData['ad_country']) && '' != $rowsizeData['ad_country']) {
																							echo $rowsizeData['ad_country'];
																						} ?>" readonly>
                            </div>
                            
                           
                            
                               
                                
                            
                        </div>

                        <div class=" d-flex same-form-style  flex-column">

                            <div class="d-flex flex-column  address-type">
                            <label for="">Address Type<span class="req">*</span></label>
                            <div class="d-flex mt-2">
                                <?php
                                    $Homechecked = '';
                                    $Officechecked = '';
                                    if (isset($rowsizeData['ad_addressType'])) {
                                        if($rowsizeData['ad_addressType'] == 1){
                                            $Homechecked = 'checked';
                                            $Officechecked = '';
                                        }else{
                                            $Homechecked = '';
                                            $Officechecked = 'checked';
                                        }
                                    }else{
                                        $Homechecked = 'checked';
                                    }
                                    ?>
                                <div class="home flex-grow-1 d-flex align-items-center ">
                                    
                                    <input type="radio"  id="home" name="add-type" value="1"
                                            <?php echo $Homechecked; ?>>

                                    <label for="home" class="form-label" >Home</label>
                                </div>
                                <div class="work flex-grow-1 d-flex align-items-center "">
                                    <input type="radio"  id="work" name="add-type" value="0" <?php echo $Officechecked; ?>>
                                    <label for="work" class="form-label" >Work</label>

                                </div>
                            </div>

                              
                                
                            </div>

                           
                           
                            
                               
                                
                            
                        </div>

                         <div class="save-canc-btn w-100 d-flex same-form-style flex-md-row flex-column payment-small-det">

                            <div class="d-flex">
                                <input type="submit" class="saveadd form-control" id="saveadd" value="Save Address">
                                <input type="reset" class="canceladd form-control" id="canceladd" value="Cancel" onclick="window.location.href='selectaddress.php<?php echo $applyedCoupan; ?>'">

                               
                            </div>
                           
                            
                           
                            
                               
                                
                            
                        </div>   
                        
                    </form> 

                    <!-- <div class="d-flex justify-content-between align-items-center payment-small-det">
                        <div class="total-amount"> <span>&#8377;</span>957</div>
                        <a  class="proceedpay-btn">Continue</a>
                    </div> -->

                   
                </div>

               
            </div>
        </div>



 

        


    

        <footer class="container-fluid border-top-0 p-foot-2 fixed-bottom">

            <div class="row">
                <a class="col " href="index.php">
                    <img src="assets1/images/home (1)inactive.png" alt="">
                    <span>Home</span>

                </a>
                <a class="col active-footer position-relative" href="cart.php">
                    <img src="assets1/images/shopping-cartactive.png" alt="">
                    <span>Cart</span>
                    <?php if ($checkloginadmin) { 
                    $userId = $_SESSION['USER']['ID'];
                    $sql1 = "SELECT COUNT(*) as totalcart, SUM(item.ite_Rate * cart.cart_volume) as TotalitemCost FROM cart LEFT JOIN item ON cart.cart_itemId = item.ite_Id WHERE cart.cart_UserID = '$userId'";
                    $result1=$dbh->query($sql1);
                    $resUserItem = $result1->fetch();
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
                    <?php if ($checkloginadmin) {
                        $userId = $_SESSION['USER']['ID'];
                     $sql2 = "SELECT COUNT(*) as totalorder FROM `order` WHERE ord_userid = '$userId' AND OrderStatusID < 4";
            $result2 = $dbh->query($sql2);
            $rezultTotalOrder = $result2->fetch();
                    ?>
                    <span class="cart-items-badge my-orders-value  rounded-pill bg-theme2 position-absolute top-0 translate-middle-y start-50  text-white">
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


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2918a48001.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets1/css/mediaquery.css">


    <script src="assets1/js/checkoutform.js"></script>

    
</body>
</html>