<?php include_once 'connection_handle.php';
$strPageTitle = "Manage Coupen";
include_once 'header.php';
$strPageTitle2 = "Manage Coupen";

if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'delete') {
    try {
		$dbh->query("DELETE FROM coupan WHERE 1 AND Cp_ID= '". $_GET['id']."'");
		$_SESSION['success_coupan_msg'] = 'Record Delete Successfully.';
		redirect('manage_coupan.php');
	} catch (Exception $e) {
		if ($e->getCode() == '23000') {
			$_SESSION['error_coupan_msg'] = "Record used anywhere";
			redirect('manage_coupan.php');
		}
	}
}

$strMode = 'new';

if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
	$strMode = $_GET['mode'];
}

$aryErrors = $class_coupan->sizeProcessRequest('', $strMode);


if (isset($_GET['id']) && '' != $_GET['id'] && $_GET['mode'] == 'edit') {
	$strLoadCondition = ' AND Cp_ID=' . $_GET['id'];
	$rowsizeData = $class_common->loadSingleDataBy($strLoadCondition, '', '', 'coupen');
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
                        <h4><a href="manage_coupan.php"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Coupan";
								} ?></h4>
                    </div>


                </div>

                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo SITE_ADMIN_URL; ?>"><i class="icon-home2 position-left"></i> Home</a>
                        </li>
                        <li>
                            <a href="#">
                                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
									echo $strPageTitle2;
								} else {
									echo "Add Coupen";
								} ?>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <?php successmessage('success_coupan_msg') ?>
                <?php duplicatedataErr('error_coupan_msg') ?>
                <!-- Both borders -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <?php if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
								echo $strPageTitle2;
							} else {
								echo "Add Coupan";
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


                            <div class="col-lg-12">
                                <div class="row">
                                    <label class="col-lg-2 control-label">Coupan Code<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="cpCode" id="cpCode" value="<?php if (isset($rowsizeData['CP_Code']) && '' != $rowsizeData['CP_Code']) {
																							echo $rowsizeData['CP_Code'];
																						} ?>" class="form-control" placeholder="Enter Coupan Code">

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <label class="col-lg-4 control-label">Coupan Volume<span class="required"
                                                    style="color:red ;">*</span> :</label>
                                            <div class="col-lg-8 mb-5">
                                                <input type="text" name="cpVolumn" id="cpVolumn" value="<?php if (isset($rowsizeData['CP_Volumn']) && '' != $rowsizeData['CP_Volumn']) {
																							echo $rowsizeData['CP_Volumn'];
																						} ?>" class="form-control allowdecimaldigit" placeholder="Enter Coupan Amount"
                                                    >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <label class="col-lg-4 control-label">Volume In<span class="required"
                                                    style="color:red ;">*</span> :</label>
                                            <div class="col-lg-8 mb-5">
                                                <?php 
                                                    $rupee = "";
                                                    $per = "";
                                                    if (isset($rowsizeData['CP_IsInAmount'])){
                                                        
                                                        if($rowsizeData['CP_IsInAmount'] == 1){
                                                            $rupee = "selected";
                                                            $per = "";
                                                        }else{
                                                            $rupee = "";
                                                            $per = "selected";
                                                        }
                                                    }
                                                    ?>
                                                <select class="form-control" name="cpAmount" id="cpAmount">
                                                    <option <?php echo $rupee; ?> value="1">Volume in Rupee(₹)
                                                    </option>
                                                    <option <?php echo $per; ?> value="0">Volume in Percentage(%)
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <label class="col-lg-4 control-label">Minimum Amount<span class="required"
                                                    style="color:red ;">*</span> :</label>
                                            <div class="col-lg-8 mb-5">
                                                <input type="text" name="cpMinAmount" id="cpMinAmount" value="<?php if (isset($rowsizeData['cp_Minamount']) && '' != $rowsizeData['cp_Minamount']) {
																							echo $rowsizeData['cp_Minamount'];
																						} ?>" class="form-control allowdecimaldigit" placeholder="Enter Coupan's Minimum Amount"
                                                    >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <label class="col-lg-4 control-label">Maximum Amount<span class="required"
                                                    style="color:red ;">*</span> :</label>
                                            <div class="col-lg-8 mb-5">
                                                <input type="text" name="cpMaxAmount" id="cpMaxAmount" value="<?php if (isset($rowsizeData['cp_Maxamount']) && '' != $rowsizeData['cp_Maxamount']) {
																							echo $rowsizeData['cp_Maxamount'];
																						} ?>" class="form-control allowdecimaldigit" placeholder="Enter Coupan's Maximum Amount"
                                                   >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <label class="col-lg-2 control-label">Coupan Description<span class="required"
                                            style="color:red ;">*</span> :</label>
                                    <div class="col-lg-10 mb-5">
                                        <input type="text" name="cpDesc" id="cpDesc" value="<?php if (isset($rowsizeData['CP_description']) && '' != $rowsizeData['CP_description']) {
																							echo $rowsizeData['CP_description'];
																						} ?>" class="form-control" placeholder="Enter Coupan Description">

                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="col-lg-2 control-label">Coupan Amount<span class="required"
                                        style="color:red ;">*</span> :</label>
                                <div class="col-lg-10 mb-5">
                                    <input type="text" name="cpVolumn" id="cpVolumn" value="<?php if (isset($rowsizeData['CP_Volumn']) && '' != $rowsizeData['CP_Volumn']) {
																							echo $rowsizeData['CP_Volumn'];
																						} ?>" class="form-control" placeholder="Enter Coupan Amount"
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                </div>
                            </div> -->

                            <!-- <div class="form-group">
                                <label class="col-lg-2 control-label">Coupan Amount In<span class="required"
                                        style="color:red ;">*</span> :</label>
                                <div class="col-lg-10 mb-5">
                                    <?php 
                                        $rupee = "";
                                        $per = "";
                                        if (isset($rowsizeData['CP_IsInAmount'])){
                                            
                                            if($rowsizeData['CP_IsInAmount'] == 1){
                                                $rupee = "selected";
                                                $per = "";
                                            }else{
                                                $rupee = "";
                                                $per = "selected";
                                            }
                                        }
                                        ?>
                                    <select class="form-control" name="cpAmount" id="cpAmount">
                                        <option <?php echo $rupee; ?> value="1">Amount in Rupee(₹)</option>
                                        <option <?php echo $per; ?> value="0">Amount in Percentage(%)</option>
                                    </select>
                                    

                                </div>
                            </div> -->

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

<!-- *********** Input tag Take only Number and decimal Point ********* -->

<script type="text/javascript">

$(function() {
    $('.allowdecimaldigit').keypress(function(event) {
        var $this = $(this);
        if ((event.which != 46 || $this.val().indexOf('.') != -1) && ((event.which < 48 || event.which >
                57) && (event.which != 0 && event.which != 8))) {
            event.preventDefault();
        }
        var text = $(this).val();
        if (text.length === 18) {
            $(this).val(text + ".")
        }
        if ((event.which == 46) && (text.indexOf('.') == -1)) {
            setTimeout(function() {
                if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                    $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
                }
            }, 1);
        }
        if ((text.indexOf('.') == 18 && text.substring(text.indexOf('.')).length > 2)) {
            event.preventDefault();
        }
        if (((text.indexOf('.') != -1) && (text.substring(text.indexOf('.')).length > 2) && (event
                .which != 0 && event.which != 8) && ($(this)[0].selectionStart >= text.length - 2))) {
            event.preventDefault();
        }
    });
});
</script>

</body>

</html>