<?php include_once 'connection_handle.php';
$strPageTitle = "Add Mst User";
include_once 'header.php';
$strPageTitle2 = "Edit Mst User";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
	$sqlTrashRecord = ' DELETE FROM mstuser WHERE 1 AND us_Id=' . $_GET['id'];
	$dbh->query($sqlTrashRecord);
	$_SESSION['success_cat_image'] = 'Selected Entry removed successfully.';
	redirect('manage_mstuser.php');
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}


$aryErrors = $class_mstuser->catProcessRequest('', $strMode);




if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND us_Id=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'mstuser');
	// print_r($strLoadCondition);
}

if (isset($_POST['size'])) {

	$rowsizeData = $_POST;
}

?>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->

        <?php include("sidebar.php"); ?>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header page-header-default">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><a href="manage_mstuser.php"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Mst User";
								} ?></h4>
                    </div>


                </div>

                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL; ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>
                        <li><a href="#">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Mst User";
								} ?></a></li>

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
                        <h5 class="panel-title"><?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
													echo $strPageTitle2;
												} else {
													echo "Add Mst User";
												} ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                        <div class="heading-elements">



                        </div>
                        <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                    </div>

                    <div class="alert alert-warning" id="success" style="display:none">
                        <span class="text-semibold" style="padding-bottom:10px;">Warning!</span> For Complete Upload
                        Please Click Save Image Button.
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="panel-body">

                            <div class="row">

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">User Name<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="userName" id="userName" value="<?php if (isset($rowsizeData['us_UserName']) && '' != $rowsizeData['us_UserName']) {
																												echo $rowsizeData['us_UserName'];
																											} ?>" class="form-control" placeholder="Enter User Name">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Email Id<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="EmailId" id="EmailId" value="<?php if (isset($rowsizeData['us_EmailID']) && '' != $rowsizeData['us_EmailID']) {
																												echo $rowsizeData['us_EmailID'];
																											} ?>" class="form-control" placeholder="Enter User Email">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Mobile No<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="mobileNo" id="mobileNo" value="<?php if (isset($rowsizeData['us_mobileNo']) && '' != $rowsizeData['us_mobileNo']) {
																												echo $rowsizeData['us_mobileNo'];
																											} ?>" class="form-control" placeholder="Enter User Mobile No">


                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Password<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="password" id="password" value="<?php if (isset($rowsizeData['us_Password']) && '' != $rowsizeData['us_Password']) {
																												echo $rowsizeData['us_Password'];
																											} ?>" class="form-control" placeholder="Enter Password">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Choose User Gender<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <?php
                                        $Mselected ="";
                                        $Fselected = "";
                                        $Oselected = "";
                                        if(isset($rowsizeData['us_gender'])){
                                            $gender = $rowsizeData['us_gender'];
                                            switch($gender){
                                                case "male":
                                                    $Mselected =  "checked";
                                                    $Fselected = "";
                                                    $Oselected = "";
                                                    break;
                                                case "female":
                                                    $Mselected = "";
                                                    $Fselected =  "checked";
                                                    $Oselected = "";
                                                    break;
                                                case "other":
                                                    $Mselected ="";
                                                    $Fselected = "";
                                                    $Oselected= "checked";
                                            } 
                                        }
                                        ?>
                                        <input type="radio" name="gender" id="male"
                                            value="male" <?php echo $Mselected; ?>>
                                        <label for="male">Male</label>&emsp;&emsp;&emsp;&emsp;
                                        <input type="radio" name="gender" id="female"
                                            value="female" <?php echo $Fselected; ?>>
                                        <label for="female">Female</label>&emsp;&emsp;&emsp;&emsp;
                                        <input type="radio" name="gender" id="other" value="other"
                                        <?php echo $Oselected; ?>>
                                        <label for="other">Other</label>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">User DOB<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        
                                        <input type="date" name="userdob" id="userdob"
                                            value="<?php if (isset($rowsizeData['us_dob']) && '' != $rowsizeData['us_dob']) {
                                                $date= $rowsizeData['us_dob']; 
                                                $c_date = new DateTime($date);
                                                echo $c_date->format('Y-m-d');
																											} ?>" class="form-control" placeholder="Enter User DOB">
                                        

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group" style="margin-top:55px;">
                                        <label class="col-lg-2 control-label">&nbsp;</label>
                                        <div class="col-lg-6">
                                            <button type="submit" name="submit" onclick="" class="btn btn-primary"
                                                aria-expanded="false">Upload </button>
                                        </div>
                                    </div>
                                </div>



                            </div>
                    </form>

                </div>
            </div>
            <?php include_once "footer.php"; ?>
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