<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Coupen Detail";
include_once 'header.php';
$strPageTitle = 'Manage Coupen Detail';


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
	$sqlUpdateData = ' UPDATE coupandtl SET status= (CASE WHEN status=1 THEN 0 ELSE 1 END) WHERE CpDtl_Id =' . $_GET['id'];
	$strRes = $dbh->query($sqlUpdateData);
	$_SESSION['success_size_msg'] = 'Status Updated successfully.';
	redirect('manage_cpDtl.php');
}
if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	$sqlTrashData = ' DELETE FROM coupandtl WHERE 1 AND CpDtl_Id = ' . $_GET['id'];
	$dbh->query($sqlTrashData);
	$_SESSION['success_size_msg'] = 'Record Delete Successfully.';
	redirect('manage_cpDtl.php');
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
                                class="text-semibold">Coupan Detail </span> - Manage Coupan Detail</h4>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </div>


                </div>

                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>

                        <li class="active">Manage Coupan Detail</li>
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
                        <h5 class="panel-title">Coupan Detail Listing</h5>
                        <div class="heading-elements">

                            <a href="add_cpDtl.php" class="btn btn-info btn-xs"><b><i class="icon-plus3"></i></b> Add
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


                                            <th style="text-align:center">Coupan Code </th>
                                            <th style="text-align:center">Item Name </th>
                                            <th style="text-align:center">User Name</th>
                                            <th style="text-align:center">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody class=" replaceResponse ">
                                        <?php
										$count = 0;
										$strLoadConditions = ' ORDER BY CpDtl_Id DESC ';
                                        $strFileds = 'coupandtl.*, coupen.*, item.*, mstuser.*';
                                        $strJoinCondition = "LEFT JOIN coupen ON coupandtl.CpDtl_CPID = coupen.Cp_ID LEFT JOIN item ON coupandtl.CpDtl_itemID = item.ite_Id LEFT JOIN mstuser ON coupandtl.CpDtl_UserID = mstuser.us_Id";
                                        $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, $strJoinCondition, 1, 'catpagination', 'coupandtl');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
										?>


                                        <tr class="clsparentinformation">


                                            <td style="text-align:center; width:10px">
                                                <?php echo $count; ?>
                                            </td>


                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowSize['CP_Code']; ?></td>
                                            <td style="min-width:30px;text-align:center">
                                            <?php 
                                                    if($rowSize['CpDtl_itemID'] != '0'){
                                                        // echo "Available for All User";
                                                        echo $rowSize['ite_Name'];
                                                    }else{
                                                        echo "Valid for All Items";
                                                    }
                                                ?>
                                                <?php// echo $rowSize['ite_Name']; ?></td>


                                            <td style="min-width:30px;text-align:center">
                                            <?php 
                                                    if($rowSize['CpDtl_UserID'] != '0'){
                                            if($rowSize['us_UserName'] == ''){
                                                echo $rowSize['us_EmailID'];
                                            }else{
                                                echo $rowSize['us_UserName']."(".$rowSize['us_EmailID']."}"; 
                                            }
                                                        // echo "Available for All User";
                                                       
                                                    }else{
                                                        echo "Available for All User";
                                                    }
                                                ?>
                                                <?php //echo $rowSize['us_UserName']; ?></td>


                                            <td style="text-align: center;">
                                                <a href="add_cpDtl.php?id=<?php echo $rowSize['CpDtl_Id']; ?>&mode=edit"
                                                    class="btn btn-primary" title=""> <i class="icon-pencil7"></i></a>



                                                <a onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger"
                                                    href="manage_cpDtl.php?id=<?php echo $rowSize['CpDtl_Id'] ?>&mode=delete">
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