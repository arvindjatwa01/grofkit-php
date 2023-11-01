<?php include_once 'connection_handle.php';
$strPageTitle = "Block User Review";
include_once 'header.php';
$strPageTitle = 'Block User Review';


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
	$sqlUpdateData = ' UPDATE stock SET status= (CASE WHEN status=1 THEN 0 ELSE 1 END) WHERE stk_Id =' . $_GET['id'];
	$strRes = $dbh->query($sqlUpdateData);
	$_SESSION['success_size_msg'] = 'Status Updated successfully.';
	redirect('manage_stock.php');
}
if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	
	$sqlTrashData = ' DELETE FROM stock WHERE 1 AND stk_Id = ' . $_GET['id'];
	$dbh->query($sqlTrashData);
	$_SESSION['success_size_msg'] = 'Record Delete Successfully.';
	redirect('manage_stock.php');
}


?>



<!-- Main content -->

<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <?php include_once 'sidebar.php' ?>

        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="page-header page-header-default">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><a href="index.php"><i class="icon-arrow-left52 position-left"></i> </a><span
                                class="text-semibold">Stock </span> - Manage Stock</h4>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </div>


                </div>

                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>

                        <li class="active">Manage Stock</li>
                    </ul>


                </div>
            </div>



            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <?php successmessage('success_size_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Stock Listing</h5>
                        <div class="heading-elements">

                            <a href="add_stock.php" class="btn btn-info btn-xs"><b><i class="icon-plus3"></i></b> Add
                                New</a>
                        </div>
                        <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                    </div>


                    <form action="" method="post">
                        <div class="panel-body">


                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered customemessage ">
                                    <thead>
                                        <tr>

                                            <th style="width:10px;" ;text-align:center">
                                                S.No </th>


                                            <!--<th style="text-align:center">User Name </th>-->
                                            <th style="text-align:center">Product Name </th>
                                            <th style="text-align:center">Item Name </th>
                                            <!--<th style="text-align:center">Attribute </th>-->
                                            <th style="text-align:center">Unit </th>
                                            <th style="text-align:center">Volume </th>
                                        </tr>
                                    </thead>


                                    <tbody class=" replaceResponse ">
                                        <?php
										$count = 0;
										$strLoadConditions = ' ORDER BY stk_Id  DESC ';
                                        $strFileds = 'stock.*, product.*, item.*, unit.*, mstuser.*, attribute.*';
                                        $strJoinCondition = "LEFT JOIN unit ON stock.stk_unitid = unit.un_Id LEFT JOIN item ON stock.stk_itemid = item.ite_Id LEFT JOIN mstuser ON stock.stk_UserID = mstuser.us_Id LEFT JOIN product ON stock.stk_prodid = product.prod_Id LEFT JOIN attribute ON stock.stk_attributid = attribute.att_Id";
                                        $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, $strJoinCondition, 1, 'catpagination', 'stock');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
										?>


                                        <tr class="clsparentinformation">
                                            <td style="text-align:center; width:10px">
                                                <?php echo $count; ?>
                                            </td>
                                            <!--<td style="min-width:30px;text-align:center">-->
                                            <!--    <?php echo $rowSize['us_UserName']; ?></td>-->
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowSize['prod_Name']; ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowSize['ite_Name']; ?></td>
                                            <!--<td style="min-width:30px;text-align:center">-->
                                            <!--    <?php echo $rowSize['att_Name']; ?></td>-->
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowSize['un_Code']; ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowSize['stl_Volumns']; ?></td>
                                        </tr>




                                        <?php
											}
										}
										?>


                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </form>
                    <div class="panel-body">
                        <?php
						if (isset($_SESSION['catpagination'])) {
							echo $_SESSION['catpagination'];
						}
						?>
                        <div>
                        </div>
                    </div>
                    <!-- /form horizontal -->

                    <!-- /both borders -->


                    <?php include_once 'footer.php'; ?>
                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

    </body>

    </html>