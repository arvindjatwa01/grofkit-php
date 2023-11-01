<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Mst User";
include_once 'header.php';
$strPageTitle = 'Manage Mst User';


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
	$sqlUpdateData = ' UPDATE mstuser SET us_active= (CASE WHEN st_status=1 THEN 0 ELSE 1 END) WHERE us_Id=' . $_GET['id'];
	$strRes = $dbh->query($sqlUpdateData);
	$_SESSION['success_cat_image'] = 'Status Updated successfully.';
	redirect('manage_mstuser.php');
}
if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	$sqlTrashData = ' DELETE FROM mstuser WHERE 1 AND us_Id= ' . $_GET['id'];
	$dbh->query($sqlTrashData);
	$_SESSION['success_cat_image'] = 'Record Delete Successfully.';
	redirect('manage_mstuser.php');
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
                                class="text-semibold">User</span> - Manage User</h4>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </div>


                </div>

                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>

                        <li class="active">Manage User</li>
                    </ul>


                </div>
            </div>



            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <?php successmessage('success_cat_image') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">User Listing</h5>
                        <div class="heading-elements">

                            <a href="add_mstuser.php" class="btn btn-info btn-xs"><b><i class="icon-plus3"></i></b> Add
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
                                            <th style="text-align:center">Email </th>
                                            <th style="text-align:center">Mobile No. </th>
                                            <th style="text-align:center">Password </th>
                                            <th style="text-align:center">Gender </th>
                                            <th style="text-align:center">Dob </th>
                                            <th style="text-align:center">Block</th>
                                            <th style="text-align:center">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody class=" replaceResponse ">
                                        <?php
										$count = 0;
										$strLoadConditions = ' ORDER BY us_Id DESC ';
										
										
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 1, 'catpagination', 'mstuser');
										
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowCompany) {
												$count++;
										?>


                                        <tr class="clsparentinformation">


                                            <td style="text-align:center; width:10px">
                                                <?php echo $count; ?> </td>


                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowCompany['us_UserName']; ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowCompany['us_EmailID']; ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowCompany['us_mobileNo']; ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowCompany['us_Password']; ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowCompany['us_gender']; ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php 
                                                $date= $rowCompany['us_dob']; 
                                                $c_date = new DateTime($date);
                                                echo $c_date->format('M d, Y '); ?></td>

                                            <td style="text-align: center;">
                                                <select name="" id=""
                                                    onchange="status('<?php echo $rowCompany['us_Id']; ?>',this.value)"
                                                    class="form-control">
                                                    <?php 
                                                   
                                                        if($rowCompany['us_block'] == NULL){
                                                            $select = "";
                                                            $declineselect = "";
                                                        }else if($rowCompany['us_block'] == 1){
                                                            $select = "selected";
                                                            $declineselect = "";
                                                        }else{
                                                            $select = "";
                                                            $declineselect = "selected"; 
                                                        }
                                                    ?>
                                                    <option value="">select an Option</option>
                                                    <option <?php echo $select; ?> value="1">Yes</option>
                                                    <option <?php echo $declineselect; ?> value="0">No</option>
                                                </select>
                                            </td>




                                            <td style="text-align: center;">
                                                <a href="add_mstuser.php?id=<?php echo $rowCompany['us_Id']; ?>&mode=edit"
                                                    class="btn btn-primary" title=""> <i class="icon-pencil7"></i></a>



                                                <a onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger"
                                                    href="manage_mstuser.php?id=<?php echo $rowCompany['us_Id'] ?>&mode=delete">
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

    <script>
        function status(id, value){
        userid = id;
        statusvalue = value;
        // alert(action);
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {
                userid: userid,
                statusvalue: statusvalue,
                isblockedUserbyadmin: true
            },
            success: function(data){
                console.log(data);
            },
            error: function(data){
                console.log(data);
            }
        });
    }
    </script>

    </body>

    </html>

    <!-- pincode_onavailable -->