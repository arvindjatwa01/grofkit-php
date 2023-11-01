<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Country";
include_once 'header.php';
$strPageTitle = 'Manage Country';


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'status') {
	$sqlUpdateData = ' UPDATE country SET status= (CASE WHEN status=1 THEN 0 ELSE 1 END) WHERE cu_id=' . $_GET['id'];
	$strRes = $dbh->query($sqlUpdateData);
	$_SESSION['success_country_msg'] = 'Status Updated successfully.';
	redirect('manage_country.php');
}
if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	try {
		$dbh->query("DELETE FROM country WHERE cu_id= '". $_GET['id']."'");
		$_SESSION['success_country_msg'] = 'Record Delete Successfully.';
		redirect('manage_country.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_country_msg'] = "Country Data used anywhere";
			redirect('manage_country.php');
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
                                class="text-semibold">Country</span> - Manage Country</h4>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </div>


                </div>

                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>

                        <li class="active">Manage Country</li>
                    </ul>


                </div>
            </div>



            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <?php successmessage('success_country_msg') ?>
                <?php duplicatedataErr('error_country_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Country Listing</h5>
                        <div class="heading-elements">
                                <label>Search :</label>
                                <input type="text" id="search" autocomplete="off">&ensp;&ensp;&ensp;

                            <a href="add_country.php" class="btn btn-info btn-xs"><b><i class="icon-plus3"></i></b> Add
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


                                            <th style="text-align:center">Country Name </th>
                                            <th style="text-align:center">Country Code </th>
                                            <!--<th style="text-align:center">Status </th>-->
                                            <th style="text-align:center">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody class=" replaceResponse ">
                                        <?php
										$count = 0;
										$strLoadConditions = ' ORDER BY cu_id DESC ';
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 1, 'catpagination', 'country');
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowSize) {
												$count++;
										?>


                                        <tr class="clsparentinformation">


                                            <td style="text-align:center; width:10px">
                                                <?php echo $count; ?>
                                            </td>


                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowSize['cu_Name']; ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo "+".$rowSize['cu_Code']; ?></td>
                                            <!--<td style="min-width:30px;text-align:center">-->
                                                <?php //echo "<select id='selectstatus".$rowSize['cu_Id']."' onchange='status(".$rowSize['cu_Id'].",this.value)' class='form-control'>
  	                		            //<option selected disabled>Select</option>
  	                		            //<option value='0'";if($rowSize['cu_active'] == '0'){echo "selected";}echo " >Inactive</option>
  	                		            //<option value='1'";if($rowSize['cu_active']=='1'){echo "selected";}echo ">Active</option>
  	                		           //</select> ";
										 ?>
                                                <!-- <?php if($rowSize['cu_active'] == '1'){
														echo "Active";
													}else{
														echo "Inactive";
													} ?> -->
                                            <!--</td>-->

                                            <td style="text-align: center;">
                                                <a href="add_country.php?id=<?php echo $rowSize['cu_Id']; ?>&mode=edit"
                                                    class="btn btn-primary" title=""> <i class="icon-pencil7"></i></a>



                                                <a onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger"
                                                    href="manage_country.php?id=<?php echo $rowSize['cu_Id'] ?>&mode=delete">
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
    function status(a, value) {
        var cid = a;
        var status = value;
        // console.log(cid);
        // console.log(value);
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                cid: cid,
                status: status
            },
            // dataType: "JSON",
            success: function(data) {
                // console.log(data);
                // $('#result').html(data);  
            },
            error: function(data) {
                console.log(data);
            }
        });

    }
    </script>

    </body>

    </html>