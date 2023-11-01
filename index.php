<?php 
include_once 'admin/connection_handle.php';
$class_user_login->checkuserLoggedIn();
$strLoadAdminCondition = ' AND us_Id=' . $class_user_login->getCurrentLoginAdminId();
$rowAdminInfo = $class_common->loadSingleDataBy($strLoadAdminCondition, '', '', TABLE_USER);


$checkloginadmin = $class_user_login->checkuserLoggedIn();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="shortcut icon" />
    
    <title>Grofkit | Home</title>
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
        <header
            class="container-fluid home-header d-flex flex-column justify-content-center position-sticky top-0  bg-black ">

            <div class="row align-items-center justify-content-between">
                <div class="col-lg-2 col-md-3 col-4 d-flex  align-items-center ">

                    <!-- <img src="assets1/images/WhatsApp_Image_2022-03-27_at_21.40.45-removebg-preview.png" alt="" class="img-fluid logo-img"> -->
                    <div class="logo"><span>G</span>ROFKIT</div>
                </div>

                <a class="col-lg-2 col-md-3 col-4 d-flex  align-items-center text-decoration-none text-white  justify-content-end pincode-sec"
                    href="pincode.php">

                    <img src="assets1/images/location-pointer.png" alt="" class="img-fluid pincode-img">

                    <div class="d-flex flex-column justify-content-between">
                        <span class="pincode-value "> <?php
                        if(isset($_SESSION['USER']['ID'])){

                        
                        $loginUserId = $_SESSION['USER']['ID'];
                        $pincodeSql = "SELECT us_postalCode FROM mstuser WHERE us_Id = '$loginUserId'";
                        $pincodeRes = $dbh->query($pincodeSql);
                        $pincodeRow =  $pincodeRes->fetch();
                        if($pincodeRes->rowCount() >0){
                           echo $pincodeRow['us_postalCode'];
                        }
                    }else{
                            echo "Pincode";
                        }
                        
                        //echo $_SESSION['USER']['pincode']; 
                        ?></span>

                    </div>



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

            <div class="row  justify-content-center">
                <div class="col d-flex align-items-center justify-content-evenly">

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get"
                        class="search-products flex-grow-1 d-flex align-items-stretch justify-content-evenly">

                        <!-- <div class="shop-category">
                                <a class="text-decoration-none text-white shop-category-main">Shop by Category <img src="assets1/images/drop-down-arrow.png" alt=""> </a>
        
                                <div class="shop-category-list">
                                    <a href="">Fruits</a>
                                    <a href="">Vegetables</a>
                                    <a href="">Masala,Oil & more</a>
                                    <a href="">Tea & Coffee</a>
                                    <a href="">Dairy Products</a>
                                    <a href="">Cold drinks & Juices</a>
                                </div>
        
        
                            </div> -->

                        <div class="search-bar flex-grow-1 flex-searchbox d-flex align-items-stretch">
                            <input type="search" class="form-control searchValue" name="search"
                                placeholder="Search Products..">

                            <a id="search" class="search text-white fw-500">
                                <i class="bi bi-search "></i>
                            </a>
                            <!-- <input type="submit" value="" class="search text-white fw-500"> -->
                        </div>



                    </form>

                </div>
            </div>




        </header>


        <div class="container-fluid sub-header position-sticky">

            <div class="row  ">
                <div class="col category-carousel">
                    <div class="row row-cols-lg-5 row-cols-md-4 row-cols-3 flex-nowrap fsz-1 nav nav-tabs border-0">
                        <?php
                            $catFilter = '';
                            $catActive = '';
                            $urlcatId = '';
                            $searchCat = '';
                            if(isset($_GET['cat'])){
                                $urlcatId = base64_decode($_GET['cat']);
                                $catFilter = "AND prod_CatID = ".base64_decode($_GET['cat']);
                                $allCatD = "";
                                
                            }else{
                                $catFilter = "";
                                $allCatD = "active";
                            }
                            if(isset($_GET['search'])){
                                $itemRes =  $_GET['search'];
                                $searchCat = "AND cat_Name LIKE '%{$itemRes}%'";
                                $searchAllCat = 'd-none';
                            }else{
                                $searchCat = '';
                                $searchAllCat = '';
                            }
                        ?>
                        <a class="col <?php echo $allCatD. " " .$searchAllCat; ?>" href="index.php"> <img
                                src="assets1/images/grocery.png" alt=""> All Categories</a>
                        <?php 
                        $strLoadCategoryConditions = " $searchCat GROUP BY cat_name ORDER BY category.cat_Id DESC ";
                        $strFileds = "category.* ";
                        $strJoinConnditions = " LEFT JOIN `category` ON product.prod_CatID = category.cat_Id RIGHT JOIN item ON prod_Id = item.ite_ProdId";
                        $resSelectCategoryList = $class_common->loadMultipleDataByTableName($strLoadCategoryConditions, $strFileds, $strJoinConnditions, 0, '', 'product');
                        if (count($resSelectCategoryList) > 0) {
                            foreach ($resSelectCategoryList as $rowCetegory) {
                                $catId = base64_encode($rowCetegory['cat_Id']);
                                if($urlcatId == $rowCetegory['cat_Id']){
                                    $catActive = 'active';
                                }else{
                                    $catActive = '';
                                }
                                
                        ?>
                        <a class="col <?php echo $catActive; ?>" href="index.php?cat=<?php echo $catId; ?>"> <img
                                src="dashboard/uploads/category_icon_image/<?php echo $rowCetegory['cat_Image']; ?>" alt="">
                            <?php echo $rowCetegory['cat_Name']; ?></a>
                        <?php }
                                }?>



                    </div>



                </div>

                <i class="las la-chevron-circle-left position-absolute d-none   left-arr-car"></i>

                <i class="las la-chevron-circle-right position-absolute  right-arr-car"></i>



            </div>

        </div>



        <div class="tab-content  container-fluid">
            <div class="tab-pane fade show row active main-content-index" id="main-content-index">



                <div class="col-12 sec-margin" id="pop-item-sec">
                    <h6 class="fsz-2 mb-0 itemchng-content">Popular Items</h6>

                    <div class="row items-first-sec items-sec d-flex  align-items-sm-stretch row-cols-lg-4 row-cols-md-3 row-cols-2"
                        id="items-first-sec">
                        <?php
                        $catFilter = '';
                        $search = '';
                        if(isset($_GET['cat'])){
                            $catFilter = "AND prod_CatID = ".base64_decode($_GET['cat']);
                            
                        }else{
                            $catFilter = '';
                        }
                        if(isset($_GET['search'])){
                            $itemRes =  $_GET['search'];
                            $search = "AND ite_Name LIKE '%{$_GET['search']}%' OR prod_CatID IN (SELECT cat_Id FROM category WHERE cat_Name LIKE '%{$itemRes}%')";
                        }else{
                            $search = ''; 
                        }
				// 			$strLoadConditions = $catFilter. $search .' GROUP BY ite_Name ORDER BY ite_Id DESC ';
    //                         $strFileds = 'item.*, itemimage.*, product.*, cart.*';
    //                         $strJoinCondition = "LEFT JOIN itemimage ON item.ite_Id = itemimage.itimg_itemID LEFT JOIN product ON item.ite_ProdId = product.prod_Id LEFT JOIN cart ON item.ite_Id = cart.cart_itemId";
                            $strLoadConditions = $catFilter. $search ." AND itimg_IsMainImage = 1 GROUP BY ite_Name ORDER BY stk_Id DESC";
                            $strFileds="stock.*, item.*, itemimage.*, product.*, cart.*, unit.*";
                            $strJoinCondition = "LEFT JOIN item ON stk_itemid = ite_Id LEFT JOIN itemimage ON stk_itemid = itimg_itemID LEFT JOIN product ON stk_prodid = prod_Id LEFT JOIN cart ON stk_itemid = cart_itemId LEFT JOIN unit ON stk_unitid = un_ID";
                            $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, $strJoinCondition, 0, '', 'stock');
							if (count($resSelectCouponList) > 0) {
								foreach ($resSelectCouponList as $rowSize) {
								    if($rowSize['stl_Volumns'] <= 0){
								        $outOfStock = "out-stock-card";
								        $outofStockspan= "<span class='out-stock'>Out of Stock</span>" ;
								        $addTocartLink = "";
								        $addtoCartDis = "disabled";
								    }else{
								        $outOfStock = "";
								        $outofStockspan = "";
								        $addTocartLink = "href='loginsignup.php'";
								        $addtoCartDis = "";
								    }
                                    
						?>
                        <div class="col <?php echo $outOfStock; ?>  card-primary d-flex flex-column shadow px-0">
                            <?php echo $outofStockspan; ?>
                            <div class="same-ratio mx-auto">
                                
                            <a href="productdetails.php?item=<?php echo base64_encode($rowSize['ite_Name']); ?>&id=<?php echo base64_encode($rowSize['ite_Id']); ?>">
                                <img src="dashboard/uploads/item_image/<?php echo $rowSize['itimg_path']; ?>" alt="" class="w-100">
                                </a>
                            </div>
                              

                            <div class="prod-info ">
                                <a href="productdetails.php?item=<?php echo base64_encode($rowSize['ite_Name']); ?>&id=<?php echo base64_encode($rowSize['ite_Id']); ?>">
                                <div class="prod-name d-flex ">
                                    <span class=" text-uppercase">
                                        <?php echo $rowSize['ite_Name']; ?> - <span class="text-lowercase">1
                                            <?php echo $rowSize['un_Code']; ?></span>
                                    </span>
                                </div>
                                </a>

                                <span class="prod-price">
                                    <?php 
                                    $selectAttPriceSql = "SELECT GROUP_CONCAT(iteAtt_value ORDER BY iteAtt_value ASC) as defaultAtt FROM `attributeitem` WHERE `isdefault` =1 AND `iteAtt_itemID`='".$rowSize['ite_Id']."'";
                                    $selectAttPriceRes = $dbh->query($selectAttPriceSql);
                                    $selectAttPriceData = $selectAttPriceRes->fetch();

                                    $itemAttributePriceSql = $dbh->query("SELECT attPrice_Price FROM attributeprice WHERE attPrice_itemId='".$rowSize['ite_Id']."' AND attPrice_attvaluesId='".$selectAttPriceData['defaultAtt']."'");
                                    if($itemAttributePriceSql->rowCount() > 0){
                                        $itemAttributePriceRes = $itemAttributePriceSql->fetch();
                                        $itemPrice = $itemAttributePriceRes['attPrice_Price'];
                                    }else{
                                        $itemPrice = $rowSize['ite_Rate'];
                                    }

                                    if($rowSize['ite_MRP'] != $itemPrice){ ?>
                                    <span class="outoffer-price">
                                        &#8377;<?php echo $rowSize['ite_MRP']; ?>
                                    </span>
                                    <span class="withoffer-price">
                                        &#8377;<?php echo $itemPrice; ?>
                                    </span>
                                    <?php }else{ ?>
                                    <span class="withoffer-price">
                                        &#8377;<?php echo $rowSize['ite_Rate']; ?>
                                    </span>
                                    <?php } ?>
                                </span>

                                <!-- <span class="prod-price">
                                    &#8377;<?php echo $rowSize['ite_MRP']; ?>
                                </span> -->

                                <div class="prod-add-now  d-flex justify-content-between align-items-center">
                                    <?php 
                                    $unitId = "";
                                    $userId = '';

                                    if ($checkloginadmin) {
	                                    $userId = $_SESSION['USER']['ID'];
	                                    $itemId = $rowSize['ite_Id'];
	                                    $unitId = $rowSize['un_ID'];
                                        $spanText ="";
                                        $sql1 = "SELECT * FROM cart WHERE cart_UserID = '$userId' AND cart_itemId = '$itemId'";
                                        $result1=$dbh->query($sql1);
                                        $resUserItem = $result1->fetch();
                                        if($resUserItem){
                                            echo "<a class='addprod-btn addtocart-btn editbtn-style flip-180' data-itemid='$itemId' data-unitid='$unitId' id='$itemId'>
                                            <span class=''>Edit</span>";
                                            
                                        }else{
                                            echo "<a class='addprod-btn addbtn-style addtocart-btn $addtoCartDis' data-itemid='$itemId' data-unitid='$unitId' id='$itemId' >
                                            <span class=''>Add to cart </span>";
                                            
                                            
                                        }

                                        
                                    }else{
                                        
                                        echo "<a $addTocartLink class='addprod-btn addbtn-style $addtoCartDis' >
                                        <span class=''>Add to cart </span>";

                                    }
                                    
                                     ?>
                                    <div class="d-flex align-items-center d-none">

                                        <i class="las la-minus flex-grow-1 sub-item"></i>

                                        <span class="flex-grow-1 item-value">0</span>


                                        <i class="las la-plus flex-grow-1 add-item"></i>

                                    </div>



                                    </a>
                                </div>

                            </div>
                          


                        </div>
                        <?php 
                            }
                        }
                        ?>

                    </div>


                </div>

                <div class="col-12 sec-margin" id="most-buy-sec">
                    <h6 class="fsz-2 mb-0 itemchng-content">Most Buy Items</h6>

                    <div class="row  d-flex  align-items-sm-stretch row-cols-lg-4 items-sec items-second-sec row-cols-md-3 row-cols-2"
                        id="items-second-sec">
                        <?php
// ========================== Most Buy Items Query Data By Order DTl Table ========= //

                        $strLoadConditionaOrd = " AND itimg_IsMainImage=1 AND ite_Id IS NOT NULL GROUP BY OrdDtl_itemName ORDER BY mostbuy DESC ";
                        $strFiledsOrd = "count(ordDtl_itemID) as mostbuy, `unit`.*, item.*, itemimage.*, stock.*";
                        $strJoinConditionOrd = "LEFT JOIN unit ON `stock`.`stk_unitid`= `unit`.`un_ID` LEFT JOIN item ON `stk_itemid` = ite_Id LEFT JOIN itemimage ON `stk_itemid` = itimg_itemID LEFT JOIN orderdtl ON `stk_itemid`=ordDtl_itemID";
                        $resSelectOrdList = $class_common->loadMultipleDataByTableName($strLoadConditionaOrd, $strFiledsOrd, $strJoinConditionOrd, 0, '', 'stock');
                        if (count($resSelectOrdList) > 0) {
                            foreach ($resSelectOrdList as $rowOrd) {
                                if($rowOrd['stl_Volumns'] <= 0){
								        $outOfStock = "out-stock-card";
								        $outofStockspan= "<span class='out-stock'>Out of Stock</span>" ;
								        $addTocartLink = "";
								        $addtoCartDis = "disabled";
								    }else{
								        $outOfStock = "";
								        $outofStockspan = "";
								        $addTocartLink = "href='loginsignup.php'";
								        $addtoCartDis = "";
								    }
                        ?>
                        <div class="col <?php echo $outOfStock; ?>  card-primary d-flex flex-column shadow px-0">
                            <?php echo $outofStockspan; ?>
                            <div class="same-ratio mx-auto">
                                <a href="productdetails.php?item=<?php echo base64_encode($rowOrd['ite_Name']); ?>&id=<?php echo base64_encode($rowOrd['ite_Id']); ?>">
                                <img src="dashboard/uploads/item_image/<?php echo $rowOrd['itimg_path']; ?>" alt="" class="w-100">
                                </a>
                            </div>

                            <div class="prod-info ">
                                <a href="productdetails.php?item=<?php echo base64_encode($rowOrd['ite_Name']); ?>&id=<?php echo base64_encode($rowOrd['ite_Id']); ?>">
                                <div class="prod-name d-flex ">
                                    <span class=" text-uppercase">
                                        <?php echo $rowOrd['ite_Name']; ?> - <span class="text-lowercase">1
                                            <?php echo $rowOrd['un_Code']; ?></span>
                                    </span>
                                </div>
                                </a>

                                <span class="prod-price">
                                    <?php 
                                     $selectAttPriceSql = "SELECT GROUP_CONCAT(iteAtt_value ORDER BY iteAtt_value ASC) as defaultAtt FROM `attributeitem` WHERE `isdefault` =1 AND `iteAtt_itemID`='".$rowOrd['ite_Id']."'";
                                     $selectAttPriceRes = $dbh->query($selectAttPriceSql);
                                     $selectAttPriceData = $selectAttPriceRes->fetch();
 
                                     $itemAttributePriceSql = $dbh->query("SELECT attPrice_Price FROM attributeprice WHERE attPrice_itemId='".$rowOrd['ite_Id']."' AND attPrice_attvaluesId='".$selectAttPriceData['defaultAtt']."'");
                                     if($itemAttributePriceSql->rowCount() > 0){
                                         $itemAttributePriceRes = $itemAttributePriceSql->fetch();
                                         $itemPrice = $itemAttributePriceRes['attPrice_Price'];
                                     }else{
                                         $itemPrice = $rowSize['ite_Rate'];
                                     }
                                    if($rowOrd['ite_MRP'] != $itemPrice){ ?>
                                    <span class="outoffer-price">
                                        &#8377;<?php echo $rowOrd['ite_MRP']; ?>
                                    </span>
                                    <span class="withoffer-price">
                                        &#8377;<?php echo $itemPrice; ?>
                                    </span>
                                    <?php }else{ ?>
                                    <span class="withoffer-price">
                                        &#8377;<?php echo $rowOrd['ite_Rate']; ?>
                                    </span>
                                    <?php } ?>
                                </span>

                                <!-- <span class="prod-price">
                                    &#8377;<?php echo $rowOrd['ite_MRP']; ?>
                                </span> -->

                                <div class="prod-add-now  d-flex justify-content-between align-items-center">
                                    <?php 
                                    $unitId = "";
                                    $userId = '';

                                    if ($checkloginadmin) {
	                                    $userId = $_SESSION['USER']['ID'];
	                                    $itemId = $rowOrd['ite_Id'];
	                                    $unitId = $rowOrd['un_ID'];
                                        $spanText ="";
                                        $sql1 = "SELECT * FROM cart WHERE cart_UserID = '$userId' AND cart_itemId = '$itemId'";
                                        $result1=$dbh->query($sql1);
                                        $resUserItem = $result1->fetch();
                                        if($resUserItem){
                                            echo "<a class='addprod-btn addtocart-btn editbtn-style flip-180' data-itemid='$itemId' data-unitid='$unitId' id='$itemId'>
                                            <span class=''>Edit</span>";
                                            
                                        }else{
                                            echo "<a class='addprod-btn addbtn-style addtocart-btn $addtoCartDis' data-itemid='$itemId' data-unitid='$unitId' id='$itemId'>
                                            <span class=''>Add to cart </span>";
                                            
                                            
                                        }

                                        
                                    }else{
                                        
                                        echo "<a $addTocartLink class='addprod-btn addbtn-style $addtoCartDis'>
                                        <span class=''>Add to cart </span>";

                                    }
                                    
                                     ?>
                                    <div class="d-flex align-items-center d-none">

                                        <i class="las la-minus flex-grow-1 sub-item"></i>

                                        <span class="flex-grow-1 item-value">0</span>


                                        <i class="las la-plus flex-grow-1 add-item"></i>

                                    </div>



                                    </a>
                                </div>

                            </div>


                        </div>
                        <?php }
                        }else{
                        ?>
                        <?php
							$strLoadConditions = ' GROUP BY ite_Name ORDER BY ite_Id DESC ';
                            $strFileds = 'item.*, itemimage.*, product.*, cart.*';
                            $strJoinCondition = "LEFT JOIN itemimage ON item.ite_Id = itemimage.itimg_itemID LEFT JOIN product ON item.ite_ProdId = product.prod_Id LEFT JOIN cart ON item.ite_Id = cart.cart_itemId";
                            $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, $strJoinCondition, 0, '', 'item');
							if (count($resSelectCouponList) > 0) {
								foreach ($resSelectCouponList as $rowSize) {
                                    
						?>
                        <div class="col  card-primary d-flex flex-column shadow px-0">
                            
                            <div class="same-ratio mx-auto">
                                <img src="dashboard/uploads/item_image/<?php echo $rowSize['itimg_path']; ?>" alt="" class="w-100">
                            </div>

                            <div class="prod-info ">
                                <div class="prod-name d-flex ">
                                    <span class=" text-uppercase">
                                        <?php echo $rowSize['ite_Name']; ?> - <span class="text-lowercase">1
                                            <?php echo $rowSizeUnit['un_Code']; ?></span>
                                    </span>
                                </div>

                                <span class="prod-price">
                                    <?php if($rowSize['ite_MRP'] != $rowSize['ite_Rate']){ ?>
                                    <span class="outoffer-price">
                                        &#8377;<?php echo $rowSize['ite_MRP']; ?>
                                    </span>
                                    <span class="withoffer-price">
                                        &#8377;<?php echo $rowSize['ite_Rate']; ?>
                                    </span>
                                    <?php }else{ ?>
                                    <span class="withoffer-price">
                                        &#8377;<?php echo $rowSize['ite_Rate']; ?>
                                    </span>
                                    <?php } ?>
                                </span>

                                <!-- <span class="prod-price">
                                    &#8377;<?php echo $rowSize['ite_MRP']; ?>
                                </span> -->

                                <div class="prod-add-now  d-flex justify-content-between align-items-center">
                                    <?php 
                                    $unitId = "";
                                    $userId = '';

                                    if ($checkloginadmin) {
	                                    $userId = $_SESSION['USER']['ID'];
	                                    $itemId = $rowSize['ite_Id'];
	                                    $unitId = $rowSizeUnit['un_ID'];
                                        $spanText ="";
                                        $sql1 = "SELECT * FROM cart WHERE cart_UserID = '$userId' AND cart_itemId = '$itemId'";
                                        $result1=$dbh->query($sql1);
                                        $resUserItem = $result1->fetch();
                                        if($resUserItem){
                                            echo "<a class='addprod-btn addtocart-btn editbtn-style flip-180' data-itemid='$itemId' data-unitid='$unitId' id='$itemId'>
                                            <span class=''>Edit</span>";
                                            
                                        }else{
                                            echo "<a class='addprod-btn addbtn-style addtocart-btn' data-itemid='$itemId' data-unitid='$unitId' id='$itemId'>
                                            <span class=''>Add to cart </span>";
                                            
                                            
                                        }

                                        
                                    }else{
                                        
                                        echo "<a href='loginsignup.php' class='addprod-btn addbtn-style'>
                                        <span class=''>Add to cart </span>";

                                    }
                                    
                                     ?>
                                    <div class="d-flex align-items-center d-none">

                                        <i class="las la-minus flex-grow-1 sub-item"></i>

                                        <span class="flex-grow-1 item-value">0</span>


                                        <i class="las la-plus flex-grow-1 add-item"></i>

                                    </div>



                                    </a>
                                </div>

                            </div>


                        </div>
                        <?php }
                        }
                        }
                        ?>

                    </div>


                </div>
            </div>


        </div>

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
        </footer>  -->

        <?php 
         $loginuser = $_SESSION['USER']['ID'];
            $sql1 = "SELECT COUNT(*) as totalcart, SUM(item.ite_MRP * cart.cart_volume) as TotalitemCost FROM cart LEFT JOIN item ON cart.cart_itemId = item.ite_Id WHERE cart.cart_UserID = '$loginuser'";
            $result1=$dbh->query($sql1);
            $resUserItem = $result1->fetch();

            $sql2 = "SELECT COUNT(*) as totalorder FROM `order` WHERE ord_userid = '$userId' AND OrderStatusID < 4";
            $result2 = $dbh->query($sql2);
            $rezultTotalOrder = $result2->fetch();
        ?>
        <footer class="container-fluid position-fixed bottom-0">

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

    </div>
    
    <!-- pincode modal -->
<?php if ($checkloginadmin) { 
//   echo  "Pncode is : ".$_SESSION['USER']['pincode'];
if($pincodeRow['us_postalCode'] == '' OR $pincodeRow['us_postalCode'] == NULL){?>
    <div class="modal pincode-modal" id="pincode-modal">
        <div class="modal-dialog modal-dialog-centered ">
            <form class="modal-content">
                <div class="modal-header fs-6 fw-600 text-theme">
                    Select Your Pincode 
                </div>

                <div class="modal-body  px-2 py-3">
                    <div class="pincode-search mb-2">
                        
                        <div class="search-bar flex-grow-1 flex-searchbox d-flex align-items-stretch pincodesearch">
                            <input type="text" class="form-control" placeholder="Search Pincode.." maxlength="6">
                            <a class="search pincode-search text-white fw-500">
                                <i class="bi bi-search "></i>
                            </a> 
                        </div>
                        <div class="search-bar result"></div>
                    </div>
                    <ul class="list-unstyled mb-0 pincode-list">
                        <li class="text-theme fw-600">Near by Pincodes :</li>

                        <div class="d-flex flex-column justify-content-center">
                            <?php
                            $strPinLoadConditions = ' ORDER BY Pin_Id DESC ';
								// 		$strPinFields = "country.*, state.*, city.*,pincode_onavailable.*";
								// 		$strPinJoinCondition = " LEFT JOIN city ON pincode_onavailable.Pin_CityId = city.ct_Id LEFT JOIN country ON pincode_onavailable.Pin_CountryId = country.cu_Id LEFt JOIN state ON pincode_onavailable.Pin_StateId = state.st_Id";
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strPinLoadConditions, '', '', 1, 'catpagination', 'pincode_onavailable');
										
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowPincode) {
                            ?>
                            <input class="text-decoration-none text-reset setpincode pincodelist"  type="button" data-pincode="<?php echo $rowPincode['Pin_PinCode']; ?>" value="<?php echo $rowPincode['Pin_PinCode']; ?>">
                            <!--<a class="text-decoration-none text-reset" href="#" ><?php echo $rowPincode['Pin_PinCode']; ?></a>-->
                            <?php } 
                            }?>
                            <li></li>
                           
                        </div>
                        
                    </ul>
                </div>


                <!-- <div class="modal-footer pincode-footer">

                    <a class="">OK</a>

                </div> -->
                
            </form>
        </div>
        
    </div>
<?php }}?>


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

    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets1/css/mediaquery.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="assets1/js/index.js"></script>

    <script>
   $(document).ready(function(){
        $('.pincodesearch input[type="text"]').on("keyup input", function(){
            /* Get input value on change */
            var inputVal = $(this).val();
            
            // var resultDropdown = $(this).siblings(".result");
             var resultDropdown = $(".result");
            if(inputVal.length){
                // console.log(inputVal);
                $.get("pincodesearch.php", {term: inputVal}).done(function(data){
                    // Display the returned data in browser
                    resultDropdown.html(data);
                    // console.log(resultDropdown);
                });
            } else{
                resultDropdown.empty();
            }
        });

    });
    $(document).on("click", ".addtocart-btn", function() {
        var userid = <?php if($checkloginadmin){ echo $_SESSION['USER']['ID']; }else{
            echo '0';
        } ?>;
        if (userid == 0) {
            window.location.href = "loginsignup.php";
        } else {
            var cartItemId = $(this).data("itemid");

            var unitId = $(this).data("unitid");
            var editdata = $('a#' + cartItemId + ' span');

            var editbtn1 = editdata.html();


            if (editbtn1 == 'Add to cart ') {

                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        cartItemId: cartItemId,
                        userid: userid,
                        unitId: unitId,
                        isaddCart: true
                    },
                    success: function(data) {
                        console.log(data);
                        $(".totalcarfooter").html(data);

                    }
                });
            } else {
                window.location.href = "cart.php";
            }
        }

    });

    $(document).on("click", "#search", function() {
        search = $('.searchValue').val();
        if (search != '') {
            window.location.href = 'index.php?search=' + search;
        }

    });
    $(document).on("click",".cartlink", function(){
        
        var carttotal = $('.totalcarfooter').text();
        // var href = $('.cartlink').prop('href');
        <?php if($checkloginadmin){ ?>
            if(carttotal == 0){
            alert("Add item into cart");
            $(".cartlink").attr("href", "");
        }else{
            // alert("go to page");
            $(".cartlink").attr("href", "cart.php");
        }
        <?php }?>
        
    });
    $(document).on("click", ".setpincode", function() {
        var pincode = $(this).data("pincode");
        var userid = <?php if($checkloginadmin){ echo $_SESSION['USER']['ID']; }else{
            echo '0';
        } ?>;
        $.ajax({
            url: "action.php",
            type: "POST",
            data:{
               pincode: pincode,
               userid: userid,
               ispincodeSet: true
            },
            success: function(data){
                // console.log(data);
                if(data == 1){
                    $("#pincode-modal").hide();
                    $(".modal-backdrop ").hide();
                   location.reload();
                }
            }
        });

    });

    </script>
</body>

</html>