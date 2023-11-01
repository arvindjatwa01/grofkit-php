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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Login</title>
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
<body class="promocode  ">


    <div class="container-fluid promocode-div">
        <div class="row justify-content-center">
            <div class="col-md-6 d-flex justify-content-between">
                <span>Apply Promocode</span>
                <a href="cart.php" class="close-promo ">
                    <img src="assets1/images/close1.png" alt="">
                </a>
            </div>
        </div>
        <!-- <div class="row justify-content-center">
             <form class="col-md-5  d-flex col-11">
                 <div class="d-flex  flex-grow-1">
                    <input type="search" class="promocode_input same_input_style form-control focusdisabled" placeholder="Enter Promocode">
                <input type="submit" value="Apply" class="apply_btn" disabled>

                 </div>
            </form>
        </div> -->
        <div class="row flex-column justify-content-center align-items-center">
        <?php
            $userId = $_SESSION['USER']['ID'];
            $itemids = array();
            // $cartItemprice = array();
            $cartLoadConditions = ' AND cart_UserID = '.$userId.'';
            $cartFileds = 'item.*, cart.*';
            $cartJoinCondition = "LEFT JOIN item ON cart.cart_itemId = item.ite_Id";
            $cartSelectCartList = $class_common->loadMultipleDataByTableName($cartLoadConditions, $cartFileds, $cartJoinCondition, 0, '', 'cart');
            if (count($cartSelectCartList) > 0) {
                foreach ($cartSelectCartList as $cartSize) { 
                    $itemids[]=$cartSize['ite_Id'];
                    // $cartItemprice[] = $cartSize['cart_volume']*$cartSize['ite_Rate'];
                }
            }
            // print_r($cartItemprice);
            $strLoadConditions = " AND CpDtl_UserID IN (0,'$userId') AND CpDtl_itemID IN(0,".implode(',',$itemids).")  GROUP BY Cp_ID ORDER BY CpDtl_Id DESC ";
            $strFileds = 'coupandtl.*, coupen.*';
            $strJoinCondition = "LEFT JOIN coupen ON CpDtl_CPID = Cp_ID";
            $resSelectCartList = $class_common->loadMultipleDataByTableName($strLoadConditions,  $strFileds, $strJoinCondition, 0, '', 'coupandtl');
            if (count($resSelectCartList) > 0) {
                foreach ($resSelectCartList as $rowSize) {
                    // echo $rowSize['cp_Maxamount'];
            ?>
            <div class= "col-md-6 d-flex promo-details">

                <div class="promo-img">
                    <img src="assets1/images/money-back1.png" alt="">
                </div>

                <div class="promo-info">
                   <h6 class="mb-0 fw-600 text-theme"><?php echo $rowSize['CP_Code']; ?></h6>
                   <p class="mb-0 word-break"><?php echo $rowSize['CP_description']; ?>.</p>
                </div>

                <div class="promo-btn d-flex justify-content-center align-items-start">
                    <a href="cart.php?cp=<?php echo base64_encode($rowSize['CpDtl_Id']); ?>" class="text-decoration-none text-reset">Apply</a>

                </div>

            </div>
            <?php }
            }?>
            <!-- <div class= "col-md-6 d-flex promo-details">

                <div class="promo-img">
                    <img src="assets1/images/money-back1.png" alt="">
                </div>

                <div class="promo-info">
                   <h6 class="mb-0 fw-600 text-theme">OFFER50</h6>
                   <p class="mb-0 word-break">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam, ipsam! Aliquid magnam tempore rem nemo architecto? Eum quaerat, aliquam culpa.</p>
                </div>

                <div class="promo-btn d-flex justify-content-center align-items-start">
                    <a href="cart       " class="text-decoration-none text-reset">Apply</a>

                </div>

            </div>
            <div class= "col-md-6 d-flex promo-details">

                <div class="promo-img">
                    <img src="assets1/images/money-back1.png" alt="">
                </div>

                <div class="promo-info">
                   <h6 class="mb-0 fw-600 text-theme">WELCOME50</h6>
                   <p class="mb-0 word-break">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam, ipsam! Aliquid magnam tempore rem nemo architecto? Eum quaerat, aliquam culpa.</p>
                </div>

                <div class="promo-btn d-flex justify-content-center align-items-start">
                    <a href="cart.php" class="text-decoration-none text-reset">Apply</a>

                </div>

            </div>

            <div class= "col-md-6 d-flex promo-details">

                <div class="promo-img">
                    <img src="assets1/images/money-back1.png" alt="">
                </div>

                <div class="promo-info">
                   <h6 class="mb-0 fw-600 text-theme">MONDAY30</h6>
                   <p class="mb-0 word-break">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam, ipsam! Aliquid magnam tempore rem nemo architecto? Eum quaerat, aliquam culpa.</p>
                </div>

                <div class="promo-btn d-flex justify-content-center align-items-start">
                    <a href="cart.php" class="text-decoration-none text-reset">Apply</a>

                </div>

            </div> -->
        </div>
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
    <link rel="stylesheet" href="assets1/css/login.css">
    <link rel="stylesheet" href="assets1/css/mediaquery.css">


   


    <!-- <script src="assets1/js/main.js"></script> -->

    
</body>
</html>



