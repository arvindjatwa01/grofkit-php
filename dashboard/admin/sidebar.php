<?php include_once 'connection_handle.php';
$class_login->checkAdminLoggedIn();
$strLoadAdminCondition = ' AND admin_id=' . $class_login->getCurrentLoginAdminId();
$rowAdminInfo = $class_common->loadSingleDataBy($strLoadAdminCondition, '', '', TABLE_ADMIN);

?>

<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!------------ Main Side bar Options ----------->

                    <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Dashboard') {echo 'active';} ?>">
                        <a href="<?php echo SITE_ADMIN_URL; ?>"><i class="icon-home4"></i> <span>Dashboard</span></a>
                    </li>
                    <li
                        class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Orders') { echo 'active'; } ?>">
                        <a href="manage_order.php"><i class="icon-copy "></i> <span>Orders</span></a>
                    </li>
                    <li
                        class="<?php if (isset($strPageTitle) && $strPageTitle == 'Cancellation Request Orders') { echo 'active'; } ?>">
                        <a href="manage_cancellationrequest.php"><i class="icon-copy "></i> <span>cancellation
                                request</span></a>
                    </li>
                    <!--<li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Status Code') { echo 'active'; } ?>">-->
                    <!--    <a href="statusCode.php"><i class="icon-copy "></i> <span>Status Code</span></a>-->
                    <!--</li>-->

                    <li
                        class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Stock') { echo 'active'; } ?>">
                        <a href="manage_stock.php"><i class="icon-copy "></i> <span>Stock</span></a>
                        <!--<ul>-->
                        <!--    <li class="<?php if ($strPageTitle == 'Add Stock') { ?> active <?php } ?>">-->
                        <!--        <a href="add_stock.php" id="">Add Stock</a>-->
                        <!--    </li>-->
                        <!--    <li class="<?php if ($strPageTitle == 'Manage Stock') { ?> active <?php } ?>">-->
                        <!--        <a href="manage_stock.php" id="">Manage Stock</a>-->
                        <!--    </li>-->
                        <!--</ul>-->
                    </li>
                    <li class="<?php if (isset($strPageTitle) && ($strPageTitle == 'Manage Main Category' || $strPageTitle == 'Manage Main Category')) {
									echo 'active';
								} ?>">
                        <a href="#"><i class="icon-copy "></i> <span>Master</span></a>
                        <ul>
                            <!-- <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Main Category' || $strPageTitle == 'Manage Main Category') {
									echo 'active';
								} ?>">
                                <a href="manage_Maincategory.php">Main Category</a>
                            </li> -->
                            <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Category' || $strPageTitle == 'Add Category') {
									echo 'active';
								} ?>">
                                <a href="manage_category.php">Category</a>

                            </li>
                            <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Product' || $strPageTitle == 'Add Product') {
									echo 'active';
								} ?>">
                                <a href="manage_product.php">Product</a>
                            </li>
                            <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Product Tax' || $strPageTitle == 'Add Product Tax') {
									echo 'active';
								} ?>">
                                <a href="add_proTax.php">Product Tax</a>
                            </li>
                            <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Item' || $strPageTitle == 'Add Item' || $strPageTitle == 'Add Attribute Price') {
									echo 'active';
								} ?>">
                                <a href="manage_item.php">Item</a>
                            </li>
                            <!--<li class="<?php //if (isset($strPageTitle) && $strPageTitle == 'Manage Item Image' || $strPageTitle == 'Add Item Imgage') {
                                                    //echo 'active';
                                            //} ?>"> -->
                            <!-- <a href="manage_itemImg.php"> <span>Item Image</span></a>

                            </li> -->
                            <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Attribute' || $strPageTitle == 'Add Attribute') {
									echo 'active';
								} ?>">
                                <a href="manage_attribute.php">Attribute</a>
                            </li>
                            <!-- <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Attribute Detail' || $strPageTitle == 'Add Attribute Detail') {
									echo 'active';
								} ?>">
                                <a href="manage_attdetail.php">Attribute Details</a>
                            </li> -->
                            <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Attribute Item' || $strPageTitle == 'Add Attribute Item') {
									echo 'active';
								} ?>">
                                <a href="manage_attItem.php">Attribute Item</a>
                            </li>
                            <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Unit' || $strPageTitle == 'Add Unit') {
									echo 'active';
								} ?>">
                                <a href="manage_unit.php">Unit</a>
                            </li>
                        </ul>

                    </li>
                    <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Mst User' || $strPageTitle == 'Add Mst User') {
									echo 'active';
								} ?>">
                        <a href="manage_mstuser.php"><i class="icon-copy "></i> <span>Mst User</span></a>
                    </li>
                    <!--            <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Mst User' || $strPageTitle == 'Add Mst User') {
									echo 'active';
								} ?>">-->
                    <!--                <a href="#"><i class="icon-copy "></i> <span>Mst User</span></a>-->
                    <!--<ul>-->
                    <!--<li class="<?php if ($strPageTitle == 'Add Mst User') { ?> active <?php } ?>"><a-->
                    <!--        href="add_mstuser.php" id="">Add Mst User</a></li>-->
                    <!--<li class="<?php if ($strPageTitle == 'Manage Mst User') { ?> active <?php } ?>"><a-->
                    <!--        href="manage_mstuser.php" id="">Manage Mst User</a></li>-->

                    <!--</ul>-->
                    <!--</li>-->

                    <!-- <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Item Image' || $strPageTitle == 'Add Item Imgage') {
                                                    echo 'active';
                                            } ?>">
                        <a href="#"><i class="icon-copy "></i> <span>Item Image</span></a>
                        <ul>
                            <li class="<?php if ($strPageTitle == 'Add Item Image') { ?> active <?php } ?>"><a
                                    href="add_itemImg.php" id="">Add Item Image</a></li>
                            <li class="<?php if ($strPageTitle == 'Manage Item Image') { ?> active <?php } ?>"><a
                                    href="manage_itemImg.php" id="">Manage Item Image</a></li>

                        </ul>
                    </li> -->

                    <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Coupen') {
				echo 'active';
			} ?>">
                        <a href="manage_coupan.php"><i class="icon-copy "></i> <span>Coupen</span></a>
                        <!--<ul>-->
                        <!--    <li class="<?php if ($strPageTitle == 'Add Coupen') { ?> active <?php } ?>"><a-->
                        <!--            href="add_coupan.php" id="">Add Coupan</a></li>-->
                        <!--    <li class="<?php if ($strPageTitle == 'Manage Coupen') { ?> active <?php } ?>"><a-->
                        <!--            href="manage_coupan.php" id="">Manage Coupan</a></li>-->

                        <!--</ul>-->
                    </li>

                    <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Coupen Detail') {
                                        echo 'active';
                                } ?>">
                        <a href="manage_cpDtl.php"><i class="icon-copy "></i> <span>Coupen Detail</span></a>
                        <!--<ul>-->
                        <!--    <li class="<?php if ($strPageTitle == 'Add Coupen Detail') { ?> active <?php } ?>"><a-->
                        <!--            href="add_cpDtl.php" id="">Add Coupan Detail</a></li>-->
                        <!--    <li class="<?php if ($strPageTitle == 'Manage Coupen Detail') { ?> active <?php } ?>"><a-->
                        <!--            href="manage_cpDtl.php" id="">Manage Coupan Detail</a></li>-->

                        <!--</ul>-->
                    </li>



                    <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Country') {
									echo 'active';
								} ?>">
                        <a href="manage_country.php"><i class="icon-copy "></i> <span>Country </span></a>
                        <!--<ul>-->
                        <!--    <li class="<?php if ($strPageTitle == 'Add Country') { ?> active <?php } ?>"><a-->
                        <!--            href="add_country.php" id="">Add Country </a></li>-->
                        <!--    <li class="<?php if ($strPageTitle == 'Manage Country') { ?> active <?php } ?>"><a-->
                        <!--            href="manage_country.php" id="">Manage Country</a></li>-->

                        <!--</ul>-->
                    </li>
                    <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage state') {
									echo 'active';
								} ?>">
                        <a href="manage_state.php"><i class="icon-copy "></i> <span>State</span></a>
                        <!--<ul>-->
                        <!--<li class="<?php if ($strPageTitle == 'Add State') { ?> active <?php } ?>"><a-->
                        <!--        href="add_state.php" id="">Add State</a></li>-->
                        <!--<li class="<?php if ($strPageTitle == 'Manage State') { ?> active <?php } ?>"><a-->
                        <!--        href="manage_state.php" id="">Manage State</a></li>-->

                        <!--</ul>-->
                    </li>
                    <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage city') {
									echo 'active';
								} ?>">
                        <a href="manage_city.php"><i class="icon-copy "></i> <span>City</span></a>
                        <!--<ul>-->
                        <!--<li class="<?php if ($strPageTitle == 'Add City') { ?> active <?php } ?>"><a-->
                        <!--        href="add_city.php" id="">Add City</a></li>-->
                        <!--<li class="<?php if ($strPageTitle == 'Manage City') { ?> active <?php } ?>"><a-->
                        <!--        href="manage_city.php" id="">Manage City</a></li>-->

                        <!--</ul>-->
                    </li>
                    <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Manage Pincode') {
									echo 'active';
								} ?>">
                        <a href="manage_pincode.php"><i class="icon-copy "></i> <span>Pincode</span></a>
                        <!--<ul>-->
                        <!--<li class="<?php if ($strPageTitle == 'Add Pincode') { ?> active <?php } ?>"><a-->
                        <!--        href="add_pincode.php" id="">Add Pincode</a></li>-->
                        <!--<li class="<?php if ($strPageTitle == 'Manage Pincode') { ?> active <?php } ?>"><a-->
                        <!--        href="manage_pincode.php" id="">Manage Pincode</a></li>-->

                        <!--</ul>-->
                    </li>
                    <li class="<?php if (isset($strPageTitle) && $strPageTitle == 'Review Setting' || $strPageTitle == 'Item Review' || $strPageTitle == 'Block User Review') {
									echo 'active';
								} ?>">
                        <a href="reviewsetting.php"><i class="icon-copy "></i> <span>Review</span></a>
                       
                    </li>


                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->