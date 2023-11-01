<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Attribute Item";
include_once 'header.php';
$strPageTitle = 'Manage Attribute Item';


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
	$sqlUpdateData = ' UPDATE attributeitem SET status= (CASE WHEN status=1 THEN 0 ELSE 1 END) WHERE iteAtt_id=' . $_GET['id'];
	$strRes = $dbh->query($sqlUpdateData);
	$_SESSION['success_size_msg'] = 'Status Updated successfully.';
	redirect('manage_attItem.php');
}
if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	
	$sqlTrashData = ' DELETE FROM attributeitem WHERE 1 AND iteAtt_id= ' . $_GET['id'];
	$dbh->query($sqlTrashData);
	$_SESSION['success_size_msg'] = 'Record Delete Successfully.';
	redirect('manage_attItem.php');
	
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
                                class="text-semibold">Attribute Item </span> - Manage Attribute Item</h4>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </div>


                </div>

                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>

                        <li class="active">Manage Attribute Item</li>
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
                        <h5 class="panel-title">Attribute Item Listing</h5>
                        <div class="heading-elements">

                            <a href="add_attItem.php" class="btn btn-info btn-xs"><b><i class="icon-plus3"></i></b> Add
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


                                            <th style="text-align:center">Item Name </th>
                                            <th style="text-align:center">Attribute Name </th>
                                            <th style="text-align:center">Value </th>
                                            <th style="text-align:center">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody class=" replaceResponse ">
                                        <?php
										$count = 0;
										$strLoadConditions = ' ORDER BY iteAtt_id DESC ';
                                        $strFileds = "attributeitem.*, attributedtl.*, attribute.*, item.*";
                                        $strJoinCondition = "LEFT JOIN attribute ON attributeitem.iteAtt_attid = attribute.att_Id LEFT JOIN item ON attributeitem.iteAtt_itemID = item.ite_Id LEFT JOIN attributedtl ON attributeitem.iteAtt_value  = attributedtl.attd_id ";
                                        $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, $strJoinCondition, 1, 'catpagination', 'attributeitem');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
										?>


                                        <tr class="clsparentinformation">


                                            <td style="text-align:center; width:10px">
                                                <?php echo $count; ?>
                                            </td>


                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowSize['ite_Name']; ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowSize['att_Name']; ?></td>


                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowSize['attd_value']; ?></td>


                                            <td style="text-align: center;">
                                                <a href="add_attItem.php?id=<?php echo $rowSize['iteAtt_id']; ?>&mode=edit"
                                                    class="btn btn-primary" title=""> <i class="icon-pencil7"></i></a>



                                                <a onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger"
                                                    href="manage_attItem.php?id=<?php echo $rowSize['iteAtt_id'] ?>&mode=delete">
                                                    <i class="icon-trash"></i></a>



                                            </td>

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