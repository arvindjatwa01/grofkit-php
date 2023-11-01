<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Main Category";
include_once 'header.php';
$strPageTitle = 'Manage Main Category';


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
	$sqlUpdateData = ' UPDATE maincategory SET status= (CASE WHEN status=1 THEN 0 ELSE 1 END) WHERE Mcat_Id=' . $_GET['id'];
	$strRes = $dbh->query($sqlUpdateData);
	$_SESSION['success_Mcategory_msg'] = 'Status Updated successfully.';
	redirect('manage_Maincategory.php');
}
if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {

	try {
		$dbh->query("DELETE FROM maincategory WHERE 1 AND Mcat_Id= '". $_GET['id']."'");
		$_SESSION['success_Mcategory_msg'] = 'Record Delete Successfully.';
		redirect('manage_Maincategory.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_Mcategory_msg'] = "Record used anywhere";
			redirect('manage_Maincategory.php');
		}
	}
	
	// $sqlTrashData = ' DELETE FROM maincategory WHERE 1 AND Mcat_Id= ' . $_GET['id'];
	// $dbh->query($sqlTrashData);
	// $_SESSION['success_Mcategory_msg'] = 'Record Delete Successfully.';
	// redirect('manage_Maincategory.php');
}

if (isset($_POST['bulkaction']) && 0 < $_POST['bulkaction']) {


	$intBulkAction = $_POST['bulkaction'];
	$strURL = 'manage_Maincategory.php';

	if (isset($_POST['id']) && 0 < count($_POST['id'])) {
		$strBulkServiceIds = implode(',', $_POST['id']);
		$strWhereCond = 'WHERE Mcat_id IN(' . $strBulkServiceIds . ')';

		if (1 == $intBulkAction) {
			$sqlDeleteSelected = 'DELETE FROM maincategory ' . $strWhereCond;
			$dbh->query($sqlDeleteSelected);
			$_SESSION['success_Mcategory_msg'] = 'Selected Entry removed successfully.';
		}

		if (2 == $intBulkAction) {
			$sqlActiveUpdateSelected = 'UPDATE  maincategory SET  status=1 ' . $strWhereCond;

			$dbh->query($sqlActiveUpdateSelected);
			$_SESSION['success_Mcategory_msg'] = 'Selected Entry active successfully.';
		}

		if (3 == $intBulkAction) {
			$sqlInActiveUpdateSelected = 'UPDATE  maincategory SET  status=0 ' . $strWhereCond;

			$_SESSION['success_Mcategory_msg'] = 'Selected Entry Inactive successfully.';
			$dbh->query($sqlInActiveUpdateSelected);
		}


		redirect($strURL);
	}
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
                                class="text-semibold">Main Category</span> - Manage Main Category</h4>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </div>


                </div>

                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>

                        <li class="active">Manage Main Category</li>
                    </ul>


                </div>
            </div>



            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <?php successmessage('success_Mcategory_msg') ?>
                <?php duplicatedataErr('error_Mcategory_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Main Category Listing</h5>
                        <div class="heading-elements">

                            <a href="add_Maincategory.php" class="btn btn-info btn-xs"><b><i class="icon-plus3"></i></b>
                                Add New</a>
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


                                            <th style="text-align:center">Category Name </th>
                                            <th style="text-align: center;">Image</th>
                                            <th style="text-align:center">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody class=" replaceResponse ">
                                        <?php
										$count = 0;
										$strLoadConditions = ' ORDER BY Mcat_Id DESC ';
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'maincategory');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
										?>


                                        <tr class="clsparentinformation">


                                            <td style="text-align:center; width:10px">
                                                <?php echo $count; ?>
                                            </td>


                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowSize['Mcat_Name']; ?></td>
                                            <td style="min-width:30px;text-align:center"><img
                                                    src="<?php echo $rowSize['Mcat_Image']; ?>" alt="Item Image"
                                                    width="100"></td>

                                            <td style="text-align: center;">
                                                <a href="add_Maincategory.php?id=<?php echo $rowSize['Mcat_Id']; ?>&mode=edit"
                                                    class="btn btn-primary" title=""> <i class="icon-pencil7"></i></a>



                                                <a onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger"
                                                    href="manage_Maincategory.php?id=<?php echo $rowSize['Mcat_Id'] ?>&mode=delete">
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