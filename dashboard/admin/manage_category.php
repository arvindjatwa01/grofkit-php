<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Category";
include_once 'header.php';
$strPageTitle = 'Manage Category';


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
	$sqlUpdateData = ' UPDATE category SET status= (CASE WHEN status=1 THEN 0 ELSE 1 END) WHERE cat_Id=' . $_GET['id'];
	$strRes = $dbh->query($sqlUpdateData);
	$_SESSION['success_category_msg'] = 'Status Updated successfully.';
	redirect('manage_category.php');
}
if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {

	try {
		$dbh->query("DELETE FROM category WHERE 1 AND cat_Id= '". $_GET['id']."'");
		$_SESSION['success_category_msg'] = 'Record Delete Successfully.';
		redirect('manage_category.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_category_msg'] = "Record used anywhere";
			redirect('manage_category.php');
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
                                class="text-semibold">Category</span> - Manage Category</h4>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </div>


                </div>

                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>

                        <li class="active">Manage Category</li>
                    </ul>


                </div>
            </div>



            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <?php successmessage('success_category_msg') ?>
                <?php duplicatedataErr('error_category_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Category Listing</h5>
                        <div class="heading-elements">

                            <a href="add_category.php" class="btn btn-info btn-xs"><b><i class="icon-plus3"></i></b> Add
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


                                            <th style="text-align:center">Category Name </th>
                                            <th style="text-align:center">Under Category Name </th>
                                            <th style="text-align:center">Category Image </th>
                                            <th style="text-align:center">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody class=" replaceResponse ">
                                        <?php
										$count = 0;
										$strLoadConditions = 'ORDER BY category.cat_Id DESC';
                                        $strFields = "category.*, cat.cat_Name as underCatName";
										$strJoinCondition = " LEFT JOIN category as cat ON cat.cat_Id = category.cat_UnderCatID";
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFields, $strJoinCondition, 1, 'catpagination', 'category');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
										?>


                                        <tr class="clsparentinformation">


                                            <td style="text-align:center; width:10px">
                                                <?php echo $count; ?>
                                            </td>


                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowSize['cat_Name']; ?></td>
                                            <td style="min-width:30px;text-align:center"><?php 
														if($rowSize['cat_UnderCatID'] == 0){
															echo "Main Category";
														}else{
															
															echo $rowSize['underCatName'];
														}
													 ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <img src="../uploads/category_icon_image/<?php echo $rowSize['cat_Image']; ?>" alt="category Image"
                                                    width="100">
                                            </td>

                                            <td style="text-align: center;">
                                                <a href="add_category.php?id=<?php echo $rowSize['cat_Id']; ?>&mode=edit"
                                                    class="btn btn-primary" title=""> <i class="icon-pencil7"></i></a>



                                                <a onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger"
                                                    href="manage_category.php?id=<?php echo $rowSize['cat_Id'] ?>&mode=delete">
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