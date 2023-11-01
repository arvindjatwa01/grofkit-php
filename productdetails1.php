<?php 
include_once 'admin/connection_handle.php';
$class_user_login->checkuserLoggedIn();
$strLoadAdminCondition = ' AND us_Id=' . $class_user_login->getCurrentLoginAdminId();
$rowAdminInfo = $class_common->loadSingleDataBy($strLoadAdminCondition, '', '', TABLE_USER);


$checkloginadmin = $class_user_login->checkuserLoggedIn();
?>
<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
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

<body class="out-stock-product">


    <div class="h-100 d-flex flex-column justify-content-between ">
        <header
            class="container-fluid d-flex flex-column justify-content-center cart-header position-sticky top-0  bg-black ">

            <div class="row align-items-center justify-content-between">
                <div class="col-lg-2 w-auto col-md-3 col-4 d-flex  align-items-center ">

                    <!-- <img src="assets1/images/WhatsApp_Image_2022-03-27_at_21.40.45-removebg-preview.png" alt="" class="img-fluid logo-img"> -->
                    <div class="logo"><span>G</span>ROFKIT</div>
                </div>

                <div class="pincode w-auto col-lg-2 col-md-3 col-4 d-flex align-items-center">

                    <img src="assets1/images/location-pointer.png" alt="" class="pincode-img">
                    <span class="pincode-value">302002</span>

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

        <div class="container-fluid">
            <div class="row justify-content-center border-bottom">
                <?php 
                    $itemName = $_GET['item'];
                    $strLoadConditions = " AND ite_Name ='". base64_decode($itemName)."'";
                    $strFileds = 'item.*, itemimage.*, product.*, cart.*';
                    $strJoinCondition = "LEFT JOIN itemimage ON item.ite_Id = itemimage.itimg_itemID LEFT JOIN product ON item.ite_ProdId = product.prod_Id LEFT JOIN cart ON item.ite_Id = cart.cart_itemId";
                    $resSelectCouponList = $class_common->loadSingleDataBy($strLoadConditions, $strFileds, $strJoinCondition, 'item');
                    $rowSize = $resSelectCouponList;
                    $itemId = $rowSize['ite_Id'];
                    $unitId = $rowSize['prod_unitId'];
                ?>
                <div class="col-lg-6 ">

                    <span class="out-stock" style="z-index: 90; color: white ; font-size: .9rem;">Out of Stock</span>



                    <div id="carouselExampleIndicators"
                        class="carousel py-lg-5  py-3 product-img-slider  bg-light slide" data-bs-ride="carousel">

                        <div class="carousel-inner">
                            <?php
                            $itemImageSql = "SELECT * FROM item LEFT JOIN itemimage ON item.ite_Id = itemimage.itimg_itemID WHERE ite_Id =".$rowSize['ite_Id'];
                            
                            $itemImageRes = $dbh->query($itemImageSql);
                            $itemImageData = $itemImageRes->fetchAll();
                            foreach($itemImageData as $itemImageRow){
                                if($itemImageRow['itimg_IsMainImage'] == 1){
                                    $active = "active";
                                }else{
                                    $active = ""; 
                                }
                            ?>
                            <div class="carousel-item <?php echo $active; ?>">
                                <img src="dashboard/uploads/item_image/<?php echo $itemImageRow['itimg_path']; ?>"
                                    class="d-block  img-fluid mx-auto" alt="...">
                            </div>
                            <?php }?>
                        </div>
                        <div class="carousel-indicators mt-3 position-relative mb-0">
                            <?php
                            $count = 0;
                            if(isset($_SESSION['USER']['ID'])){
                                $userId = $_SESSION['USER']['ID'];
                            }else{
                                $userId = 0;
                            }
                            
                            $itemImageSql = "SELECT * FROM item LEFT JOIN itemimage ON item.ite_Id = itemimage.itimg_itemID WHERE ite_Id =".$rowSize['ite_Id'];
                            
                            $itemImageRes = $dbh->query($itemImageSql);
                            $itemImageData = $itemImageRes->fetchAll();
                            foreach($itemImageData as $itemImageRow){
                                if($count){
                                    $carusalActive = "";
                                }else{
                                    $carusalActive = "active";
                                }
                            ?>
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="<?php echo $count; ?>" class="<?php echo $carusalActive; ?>"
                                aria-current="true" aria-label="Slide <?php echo $count+1; ?>"></button>
                            <?php $count++; } ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
                <div class="col-lg-4 about-product-detail py-lg-3 pt-4 pb-3">
                    <h6 class="fs-4 fw-500 mb-2 position-relative"><?php echo $rowSize['ite_Name']; ?> <span
                            class="out-stock top-50 ms-4 translate-middle-y text-white" style="font-size: .85rem;">Out
                            of Stock</span> </h6>
                    <h6 class="fs-4 text-theme mb-2 fw-500">
                        <span>&#8377;</span><?php echo number_format($rowSize['ite_Rate'], 2); ?>
                    </h6>
                    <h6 class="fs-7 text-theme-3 mb-2 fw-500">
                        <div class="d-flex text-theme-3 flex-wrap justify-content-between align-items-center fs-7">

                            <div class="d-flex fs-7 rating text-theme-3">
                                <i class="bi bi-star-fill"></i>

                                <i class="bi bi-star-fill"></i>

                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill "></i>
                                <i class="bi bi-star-half"></i>
                            </div>





                            <div class="d-flex text-muted fw-400 align-items-center">
                                <span class="px-1">4.5/5 </span>
                                <span class="fw-400 text-muted">| </span>
                                <span class="px-1"> <span>73</span> Reviews </span>

                            </div>

                        </div>
                    </h6>




                    <div class="categories-about-detail-page my-3 pt-1 border-top border-bottom">

                        <div class="d-flex ">
                            <span class="fs-7 fw-500">Category:</span>
                            <?php 
                                $catName  = array();
                                $sql = "SELECT cat_Name FROM product LEFT JOIN category ON prod_CatID=cat_Id WHERE prod_Id =". $rowSize['ite_ProdId'];
                                $query = $dbh->query($sql);
                                $catData = $query->fetchAll();
                                foreach($catData as $row){
                                    $catName[] = $row['cat_Name'];
                                }
                                // print_r($catName);
                               
                            ?>
                            <span class="fs-7 fw-500 text-theme"><?php  echo implode(',',$catName); ?>.</span>
                        </div>

                        <div class="d-flex">


                            <span class="fs-7 fw-500">About:</span>

                            <span class="fs-7">
                                <?php echo $rowSize['ite_Descripton']; ?>

                            </span>

                        </div>

                    </div>


                    <div class="quantity-detail-product d-inline-flex align-items-center ">

                        <h6 class="mb-0 fs-7 fw-400">

                            Quantity:

                        </h6>

                        <div class="d-flex">


                            <div class="cart-item-quantity  d-flex justify-content-end align-items-center"
                                id="cart-item-quantity">
                                <i class="fa-solid fa-minus  sub" id="add-item"></i>

                                <span class="item-value">1</span>
                                <i class="fa-solid fa-plus add " id="sub-item"></i>
                            </div>


                        </div>

                    </div>
                    <?php 

                        $strLoadConditionsAtt = " AND iteAtt_itemID ='". ($rowSize['ite_Id'])."' GROUP BY att_Name";
                        $strFiledsAtt = ' iteAtt_attid,`attributeitem`.`iteAtt_attid`,attribute.*';
                        $strJoinConditionAtt = "LEFT JOIN attribute ON iteAtt_attid = att_Id LEFT JOIN item ON iteAtt_itemID = item.ite_Id";
                        $resSelectAttList = $class_common->loadMultipleDataByTableName($strLoadConditionsAtt, $strFiledsAtt, $strJoinConditionAtt, 0, '', 'attributeitem');
                        foreach($resSelectAttList as $rowAtt){
                            if($rowAtt['att_IsMultiple'] == 1){
                                $mainClass = "multi_select";
                            }elseif($rowAtt['att_isSingalChoise'] == 1){
                                $mainClass = "single_select";
                            }else if($rowAtt['att_IsonView'] == 1){
                                $mainClass = "";
                            }

                    ?>
                    <div
                        class="weight-products <?php echo $mainClass; ?> same-style-details d-flex align-items-start flex-wrap my-3">


                        <div class="d-flex">
                            <span class="fs-7"><?php echo $rowAtt['att_Name']; ?>:</span>
                        </div>

                        <div class="d-flex flex-wrap">
                            <?php
                            $strLoadAttValueCondition = " AND iteAtt_itemID ='". ($rowSize['ite_Id'])."' AND `iteAtt_attid`='". ($rowAtt['iteAtt_attid'])."' GROUP BY attd_value";
                            $strAttValueFileds = "attributedtl.attd_value,`attributeitem`.`iteAtt_attid`,`attributedtl`.`attd_id`";
                            $strAttValueJoinCondition ="LEFT JOIN attribute ON iteAtt_attid = att_Id LEFT JOIN attributedtl ON `iteAtt_value`= attributedtl.attd_id LEFT JOIN item ON iteAtt_itemID = item.ite_Id";
                            $resSelectedAttValuseList =$class_common->loadMultipleDataByTableName($strLoadAttValueCondition, $strAttValueFileds, $strAttValueJoinCondition, 0, '', 'attributeitem');
                                foreach($resSelectedAttValuseList as $rowAttValue){
                        ?>
                            <a class="" data-attid="<?php echo $rowAttValue['iteAtt_attid']; ?>"
                                data-attvalue="<?php echo $rowAttValue['attd_id']; ?>"><?php echo $rowAttValue['attd_value']; ?></a>
                            <?php }?>

                        </div>

                    </div>
                    <?php }?>
                    <!-- <div
                        class="flavoured-products single_select same-style-details  d-flex align-items-start flex-wrap my-3">


                        <div class="d-flex">
                            <span class="fs-7">Flavour:</span>
                        </div>

                        <div class="d-flex flex-wrap">
                            <a class="">Cream n Onion</a>
                            <a class="">Tom-Chi</a>
                            <a class="">Magic Masala</a>

                        </div>

                    </div> -->


                    <div class="d-flex justify-content-center mt-4">
                        <?php
                    $stockSql = "SELECT * FROM stock WHERE stk_itemid = '$itemId'";
                    $stockRes = $dbh->query($stockSql);
                    $stockRow = $stockRes->fetch();
                    if($stockRow['stl_Volumns'] <= 0){
                        $outofStock = "out-stock-card";
                        $outofStockStyle = "style='pointer-events: none;'";
                    }else{
                        $outofStock = "";
                        $outofStockStyle ="";
                    }
                    if($checkloginadmin){
                        $sql1 = "SELECT * FROM cart WHERE cart_UserID = '$userId' AND cart_itemId = '$itemId'";
                       $result1=$dbh->query($sql1);
                       $resUserItem = $result1->fetch();
                        
                       if($resUserItem){
                    ?>
                        <a href="cart.php"
                            class=" fs-6 add-cart-btn d-flex justify-content-center align-items-center <?php echo $outofStock; ?>"
                            <?php echo $outofStockStyle; ?> data-value="Added to cart"> Add to
                            Cart <img src="assets1/images/shopping-cart.png" alt=""> </a>
                        <?php }else{ ?>
                        <a class=" fs-6 add-cart-btn d-flex justify-content-center align-items-center <?php echo $outofStock; ?>"
                            <?php echo $outofStockStyle; ?> data-itemid='<?php echo $itemId; ?>'
                            data-unitid='<?php echo $unitId; ?>' data-value="Add to cart"> <span>Add to
                                Cart</span> <img src="assets1/images/shopping-cart.png" alt=""> </a>
                        <?php }
                        }else{?>
                        <a class=" fs-6 add-cart-btn d-flex justify-content-center align-items-center <?php echo $outofStock; ?>"
                            <?php echo $outofStockStyle; ?> data-value="Add to cart"> Add to
                            Cart <img src="assets1/images/shopping-cart.png" alt=""> </a>
                        <?php } 
                            
                        ?>
                    </div>

                </div>
            </div>

            <div class="row justify-content-center ">



                <div class="col-lg-6 py-lg-4 py-3">
                    <h4 class="mb-2 ">Rating & Reviews</h4>
                    <?php if ($checkloginadmin) {
                        $userid = $_SESSION['USER']['ID'];
                        $loginuserSql = "SELECT us_block FROM mstuser WHERE us_Id = $userid";
                        $loginuserRes = $dbh->query($loginuserSql);
                        $loginuserRow = $loginuserRes->fetch();
                        if($loginuserRow['us_block'] != 1){
                            $AnyOneCanReviewSql = "SELECT appSetting_Action FROM appsetting WHERE appSetting_Id =1";
                            $AnyOneCanReviewRes = $dbh->query($AnyOneCanReviewSql);
                            $AnyOneCanReviewRow = $AnyOneCanReviewRes->fetch();
                            if($AnyOneCanReviewRow['appSetting_Action'] == 1){
                    ?>
                    <div class="row my-3">
                        <div class="col-12">
                            <div class="accordion py-2" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed  fw-500 your-review-btn" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <i class="fa-solid fa-pen-to-square me-3 text-theme-3"></i> <span class=""
                                                style="font-weight: 500;">Write a Review</span>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse "
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <form class="accordion-body " action="">

                                            <div class="rate-product mb-3  fw-500">
                                                <h6 class="mb-1" style="font-weight: 400;">Rate our Product</h6>
                                                <div class="d-flex fs-7 your-rating text-theme-3">
                                                    <i class="bi bi-star"></i>

                                                    <i class="bi bi-star"></i>

                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star "></i>
                                                    <i class="bi bi-star"></i>

                                                    <span class="your-rating-points text-black ms-3"
                                                        id="your-rating-points"></span>
                                                </div>
                                            </div>

                                            <textarea name="" class="review-textarea fs-7 mb-3  form-control" id=""
                                                cols="30" rows="5" placeholder="Write Review"></textarea>

                                            <div class="d-flex ">
                                                <input type="submit" class="review-submit border-0" value="Submit">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php 
                            }
                        }
                    }
                    ?>
                    <div class="row mb-3">
                        <div class="col-12 rounded-3 ">

                            <div class="user-review-sec">
                                <div class="d-flex justify-content-between border-bottom pb-2">
                                    <?php 
                                        $countReview = "SELECT COUNT(*) as totalReview, SUM(itemRev_Rating)/COUNT(*) as ReviewRatio FROM `item_reviews` WHERE itemRev_itemId=$itemId";
                                        $CountRes = $dbh->query($countReview);
                                        $countRow = $CountRes->fetch();
                                    ?>
                                    <h6 class="d-flex mb-0">User Reviews
                                        (<span><?php echo $countRow['totalReview']; ?></span>)</h6>
                                    <h6 class="mb-0"><?php echo number_format($countRow['ReviewRatio'],1); ?>/5</h6>



                                </div>

                                <div class="d-flex  flex-column all-review-block">
                                    <?php
                                    
                                    if($checkloginadmin){
                                        $loginUserId = $_SESSION['USER']['ID'];
                                    }else{
                                        $loginUserId = 0;
                                    }

                                    $ratingSql ="SELECT item_reviews.itemRev_userId, mstuser.us_UserName, item_reviews.itemRev_Rating, item_reviews.itemRev_isRemove, item_reviews.itemRev_desc,item_reviews.itemRev_Time FROM item_reviews LEFT JOIN mstuser ON item_reviews.itemRev_userId= mstuser.us_Id WHERE item_reviews.itemRev_itemId=$itemId ORDER BY itemRev_id DESC";
                                    $ratingRes = $dbh->query($ratingSql);
                                    $ratingData = $ratingRes->fetchAll();
                                    foreach($ratingData as $ratingrow){
                                        if($ratingrow['itemRev_isRemove'] == 0){
                                ?>
                                    <div class="user-review-box d-flex flex-grow-1 <?php echo $reviewDisplay; ?>">

                                        <div class="d-flex review-content flex-column flex-wrap flex-grow-1">

                                            <div class="d-flex">
                                                <div class="d-flex review-img">
                                                    <div class="">
                                                        <img src="assets1/images/image.jpg" alt="" class="img-fluid">
                                                    </div>

                                                </div>

                                                <h6 class="mb-0 fs-7 d-flex justify-content-between  flex-grow-1">
                                                    <span
                                                        class="d-flex  flex-column"><?php echo $ratingrow['us_UserName']; ?>
                                                        <span class="mt-05">
                                                            <div class="d-flex   fs-8 rating text-theme-3">
                                                                <div class="Stars1"
                                                                    style="--rating: <?php echo $ratingrow['itemRev_Rating']; ?>;"
                                                                    aria-label="Rating of this product is <?php echo $ratingrow['itemRev_Rating']; ?> out of 5.">
                                                                </div>

                                                                <span
                                                                    class="ms-2 text-black"><?php echo number_format($ratingrow['itemRev_Rating'],1); ?></span>

                                                            </div>
                                                        </span> </span>
                                                    <?php 
                date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
                
                $date1 = $ratingrow['itemRev_Time'];
                $date2 = date('Y-m-d');
                
                $diff = abs(strtotime($date2) - strtotime($date1));
                
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                
                if($years>0){
                    $ReviewOn = $years." year ago";
                }else if($months >0){
                    $ReviewOn = $months." month ago";
                }else if($days >0){
                    $ReviewOn = $days." day ago";
                }else{
                    $ReviewOn = "Today";
                }
                
                ?>
                                                    <span class="text-muted review-time"><?php echo $ReviewOn; ?></span>
                                                </h6>
                                            </div>



                                            <p class="mb-0 py-2">
                                                <?php echo $ratingrow['itemRev_desc']; ?>
                                            </p>







                                        </div>

                                    </div>
                                    <?php }else if($ratingrow['itemRev_isRemove'] == 1 AND 
 $loginUserId==$ratingrow['itemRev_userId']
){ ?>

                                    <div class="user-review-box d-flex flex-grow-1 <?php echo $reviewDisplay; ?>">

                                        <div class="d-flex review-content flex-column flex-wrap flex-grow-1">

                                            <div class="d-flex">

                                                <div class="d-flex review-img">
                                                    <div class="">
                                                        <img src="assets1/images/image.jpg" alt="" class="img-fluid">
                                                    </div>

                                                </div>

                                                <h6 class="mb-0 fs-7 d-flex justify-content-between  flex-grow-1">
                                                    <span
                                                        class="d-flex  flex-column"><?php echo $ratingrow['us_UserName']; ?>
                                                        <span class="mt-05">
                                                            <div class="d-flex   fs-8 rating text-theme-3">
                                                                <div class="Stars1"
                                                                    style="--rating: <?php echo $ratingrow['itemRev_Rating']; ?>;"
                                                                    aria-label="Rating of this product is <?php echo $ratingrow['itemRev_Rating']; ?> out of 5.">
                                                                </div>

                                                                <span
                                                                    class="ms-2 text-black"><?php echo number_format($ratingrow['itemRev_Rating'],1); ?></span>


                                                            </div>
                                                        </span>
                                                        <p class="mb-0 py-2 text-danger reviewRemoved">This Review is
                                                            Removed By Admin.Only you can see</p>
                                                    </span>
                                                    <?php 
                                                        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
                                                        
                                                        $date1 = $ratingrow['itemRev_Time'];
                                                        $date2 = date('Y-m-d');
                                                        
                                                        $diff = abs(strtotime($date2) - strtotime($date1));
                                                        
                                                        $years = floor($diff / (365*60*60*24));
                                                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                                        
                                                        if($years>0){
                                                            $ReviewOn = $years." year ago";
                                                        }else if($months >0){
                                                            $ReviewOn = $months." month ago";
                                                        }else if($days >0){
                                                            $ReviewOn = $days." day ago";
                                                        }else{
                                                            $ReviewOn = "Today";
                                                        }
                                                        
                                                    ?>
                                                    <span class="text-muted review-time"><?php echo $ReviewOn; ?></span>
                                                </h6>
                                            </div>



                                            <p class="mb-0 py-2">
                                                <?php echo $ratingrow['itemRev_desc']; ?>
                                            </p>

                                        </div>

                                    </div>

                                    <?php }
                                }?>
                                </div>
                            </div>



                        </div>
                    </div>





                </div>

                <div
                    class="col-lg-4 border-start order-lg-last order-first  d-flex flex-column py-lg-5 py-4 align-items-center">

                    <span class="fs-3 fw-600"><?php echo number_format($countRow['ReviewRatio'],1); ?></span>
                    <div class="d-flex fs-6 rating text-theme-3">
                        <div class="Stars" style="--rating: <?php echo $countRow['ReviewRatio']; ?>;"
                            aria-label="Rating of this product is <?php echo $countRow['ReviewRatio']; ?> out of 5.">
                        </div>
                    </div>
                    <span class="fs-8 my-1 text-muted">Based on <?php echo $countRow['totalReview']; ?> reviews</span>


                    <div class="d-flex flex-column my-2  w-100">

                        <div class="d-flex w-100 justify-content-center align-items-center">
                            <span class="fs-7 fw-500">5</span>
                                <?php 
                                    $Rating5 = "SELECT COUNT(*) as ratingFive FROM `item_reviews` WHERE itemRev_itemId=$itemId AND itemRev_Rating=5";

                                    $Rating5Res = $dbh->query($Rating5);
                                    $Rating5Row = $Rating5Res->fetch();
                                ?>
                            <div class="progress w-60 ms-2">
                                <div class="progress-bar  bg-success" role="progressbar" style="width:<?php echo ($Rating5Row['ratingFive']/$countRow['totalReview'])*100; ?>%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="d-flex w-100 justify-content-center align-items-center">
                            <span class="fs-7 fw-500">4</span>
                                <?php 
                                    $Rating4 = "SELECT COUNT(*) as ratingFour FROM `item_reviews` WHERE itemRev_itemId=$itemId AND itemRev_Rating=4";

                                    $Rating4Res = $dbh->query($Rating4);
                                    $Rating4Row = $Rating4Res->fetch();
                                ?>
                            <div class="progress w-60 ms-2">
                                <div class="progress-bar  bg-1" role="progressbar" style="width:<?php echo ($Rating4Row['ratingFour']/$countRow['totalReview'])*100; ?>%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="d-flex w-100 justify-content-center align-items-center">
                            <span class="fs-7 fw-500">3</span>
                                <?php 
                                    $Rating3 = "SELECT COUNT(*) as ratingThree FROM `item_reviews` WHERE itemRev_itemId=$itemId AND itemRev_Rating=3";

                                    $Rating3Res = $dbh->query($Rating3);
                                    $Rating3Row = $Rating3Res->fetch();
                                ?>
                            <div class="progress w-60 ms-2">
                                <div class="progress-bar  bg-2" role="progressbar" style="width:<?php echo ($Rating3Row['ratingThree']/$countRow['totalReview'])*100; ?>%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="d-flex w-100 justify-content-center align-items-center">
                            <span class="fs-7 fw-500">2</span>
                                <?php 
                                    $Rating2 = "SELECT COUNT(*) as ratingTwo FROM `item_reviews` WHERE itemRev_itemId=$itemId AND itemRev_Rating=2";

                                    $Rating2Res = $dbh->query($Rating2);
                                    $Rating2Row = $Rating2Res->fetch();
                                ?>
                            <div class="progress w-60 ms-2">
                                <div class="progress-bar  bg-3" role="progressbar" style="width:<?php echo ($Rating2Row['ratingTwo']/$countRow['totalReview'])*100; ?>%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="d-flex w-100 justify-content-center align-items-center">
                            <span class="fs-7 fw-500">1</span>
                                <?php 
                                    $Rating1 = "SELECT COUNT(*) as ratingOne FROM `item_reviews` WHERE itemRev_itemId=$itemId AND itemRev_Rating=1";

                                    $Rating1Res = $dbh->query($Rating1);
                                    $Rating1Row = $Rating1Res->fetch();
                                ?>
                            <div class="progress w-60 ms-2">
                                <div class="progress-bar  bg-4" role="progressbar" style="width:<?php echo ($Rating1Row['ratingOne']/$countRow['totalReview'])*100; ?>%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>



                    </div>




                </div>

            </div>
        </div>

        <?php 
         
         if(isset($_SESSION['USER']['ID'])){
            $loginuser = $_SESSION['USER']['ID'];
         }else{
           $loginuser= 0;  
         }
            $sql1 = "SELECT COUNT(*) as totalcart, SUM(item.ite_MRP * cart.cart_volume) as TotalitemCost FROM cart LEFT JOIN item ON cart.cart_itemId = item.ite_Id WHERE cart.cart_UserID = '$loginuser'";
            $result1=$dbh->query($sql1);
            $resUserItem = $result1->fetch();

            $sql2 = "SELECT COUNT(*) as totalorder FROM `order` WHERE ord_userid = '$loginuser'";
            
            $result2 = $dbh->query($sql2);
            $rezultTotalOrder = $result2->fetch();
        ?>

        <footer class="container-fluid border-top-0 p-foot-2 fixed-bottom">

            <div class="row">
                <a class="col active-footer" href="index.php">
                    <img src="assets1/images/home (1).png" alt="">
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
                        class="cart-items-badge my-cart-value rounded-pill bg-theme2 position-absolute top-0 translate-middle-y start-50  text-white">
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



        <div class="modal fade show" id="img-modal">
            <div class="modal-dialog modal-fullscreen" style="width:100%; max-width:
            100%;">
                <div class="modal-content">

                    <div class="modal-header border-bottom-0">
                        <div class="btn-close close-product-img ms-auto" data-bs-dismiss="modal"
                            style="cursor: pointer;"></div>

                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center">

                        <img src="assets1/images/yellow-diamond-cream-n-onion-chips-500x500.png" alt=""
                            class="img-fluid">

                    </div>
                </div>
            </div>
        </div>





    </div>


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

    <link rel="stylesheet" href="assets1/css/myorder.css">

    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets1/css/mediaquery.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script src="assets1/js/productdet.js"></script>
    <script>
    $(document).on("click", ".cartlink", function() {

        var carttotal = $('.totalcarfooter').text();
        // var href = $('.cartlink').prop('href');
        if (carttotal == 0) {
            alert("Add item into cart");
            $(".cartlink").attr("href", "");
        } else {
            // alert("go to page");
            $(".cartlink").attr("href", "cart.php");
        }
    });
    </script>
    <script>
    $(document).on("click", ".add-cart-btn", function() {
        var userid = <?php if($checkloginadmin){ echo $_SESSION['USER']['ID']; }else{
            echo '0';
        } ?>;
        if (userid == 0) {
            window.location.href = "loginsignup.php";
        } else {
            var cartItemId = $(this).data("itemid");

            var unitId = $(this).data("unitid");
            // // var editdata = $('.add-cart-btn');

            // var editbtn1 = $(this).data("value");
            var editdata = $('.add-cart-btn span');

            var editbtn1 = editdata.html();


            var cartAtt = [];
            var attvalues = [];

            $("a").each(function() { // loop through all li
                if ($(this).hasClass("active")) { // check if li has active class
                    var resultAttvalues = ($(this).data(
                        "attvalue")); // get the value of data-interest attribute
                    var resultAtt = ($(this).data("attid"));
                    attvalues.push(resultAttvalues);
                    cartAtt.push(resultAtt);
                }
            });
            // console.log(attvalues);
            // console.log(cartAtt);

            if (editbtn1 == 'Add to Cart') {
                // console.log("ADd to cart")
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        cartItemId: cartItemId,
                        userid: userid,
                        unitId: unitId,
                        cartAtt: cartAtt,
                        cartattvalues: attvalues,
                        isaddCartFromProductDtl: true
                    },
                    success: function(data) {
                        // console.log(data);
                        $(".totalcarfooter").html(data);
                        $(".add-cart-btn span").html("Added to Cart");
                        $(".add-cart-btn").attr("href", "cart.php");

                    }
                });
            } else {
                // console.log("cart")
                window.location.href = "cart.php";
            }
        }

    });
    $(document).on("click", '#reviewbutton', function() {

        var rating = $("#your-rating-points").text();
        var description = $(".review-textarea").val();
        var userid = <?php if($checkloginadmin){ echo $_SESSION['USER']['ID']; }else{
            echo '0';
        } ?>;
        
        var idapprovedReview = <?php if($checkloginadmin){ echo $_SESSION['USER']['Approved']; }else{
            echo '0';
        } ?>;
        var itemName = <?php echo $itemId; ?>;
        // alert(itemName);
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                rating: rating,
                description: description,
                userid: userid,
                itemId: itemName,
                idapprovedReview: idapprovedReview,
                isitemReview: true
            },
            success: function(data) {
                // console.log(data);
                if (data == 1) {
                    location.reload();
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
    </script>


</body>

</html>