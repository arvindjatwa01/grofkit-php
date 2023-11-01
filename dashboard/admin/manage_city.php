<?php include_once 'connection_handle.php';
$strPageTitle = "Manage city";
include_once 'header.php';
$strPageTitle = 'Manage city';


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
	$sqlUpdateData = ' UPDATE city SET ct_status= (CASE WHEN st_status=1 THEN 0 ELSE 1 END) WHERE ct_Id=' . $_GET['id'];
	$strRes = $dbh->query($sqlUpdateData);
	$_SESSION['success_city_msg'] = 'Status Updated successfully.';
	redirect('manage_city.php');
}
if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	try {
		$dbh->query("DELETE FROM city WHERE 1 AND ct_Id= '". $_GET['id']."'");
		$_SESSION['success_city_msg'] = 'Record Delete Successfully.';
		redirect('manage_city.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_city_msg'] = "Record used anywhere";
			redirect('manage_city.php');
		}
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
                                class="text-semibold">City</span> - Manage City</h4>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </div>


                </div>

                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>

                        <li class="active">Manage City</li>
                    </ul>


                </div>
            </div>



            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <?php successmessage('success_city_msg') ?>
                <?php duplicatedataErr('error_city_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">City Listing</h5>
                        <div class="heading-elements">

                            <a href="add_city.php" class="btn btn-info btn-xs"><b><i class="icon-plus3"></i></b> Add
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


                                            <th style="text-align:center">Name </th>
                                            <th style="text-align:center">State </th>
                                            <th style="text-align:center">Country </th>
                                            <th style="text-align:center">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody class=" replaceResponse ">
                                        <?php
										$count = 0;
										$strLoadConditions = ' ORDER BY ct_Id DESC ';
										$strFields = "city.*,state.*, country.*";
										$strJoinCondition = " LEFT JOIN state ON city.ct_StateId = state.st_Id LEFT JOIN country ON city.ct_CountryID = country.cu_Id";
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFields, $strJoinCondition, 1, 'catpagination', 'city');
										
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowCompany) {
												$count++;
										?>


                                        <tr class="clsparentinformation">


                                            <td style="text-align:center; width:10px">
                                                <?php echo $count; ?> </td>


                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowCompany['ct_Name']; ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowCompany['st_Name']; ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowCompany['cu_Name']; ?></td>





                                            <td style="text-align: center;">
                                                <a href="add_city.php?id=<?php echo $rowCompany['ct_Id']; ?>&mode=edit"
                                                    class="btn btn-primary" title=""> <i class="icon-pencil7"></i></a>



                                                <a onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger"
                                                    href="manage_city.php?id=<?php echo $rowCompany['ct_Id'] ?>&mode=delete">
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