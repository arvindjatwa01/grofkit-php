<?php include_once 'connection_handle.php';
$class_login->checkAdminLoggedIn();
$strLoadAdminCondition = ' AND admin_id=' . $class_login->getCurrentLoginAdminId();
$rowAdminInfo = $class_common->loadSingleDataBy($strLoadAdminCondition, '', '', TABLE_ADMIN);


$checkloginadmin = $class_login->checkAdminLoggedIn();

if ($checkloginadmin == '') {
	redirect('login.php');
}

$strloadCondition = 'AND theme_setting_id=1';
$rowThemeSettingInfo = $class_common->loadSingleDataBy($strloadCondition, '', '', TABLE_THEME_SETTING);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php
			if (isset($strPageTitle)) {
				echo $strPageTitle . " | " . SITE_TITLE;
			} else {
				echo SITE_TITLE;
			} ?></title>

    <!-- Global stylesheets -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
        type="text/css">
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/js/core/app.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <script type="text/javascript"
        src="<?php echo SITE_URL . SITE_ADMIN; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL . SITE_ADMIN; ?>assets/js/pages/form_select2.js"></script>



    <!-- /theme JS files -->
    <link rel="icon" href="" type="images/png" sizes="16x16">
    <!-- <link rel="shortcut icon" href="<?php //if (is_file(SITE_UPLOAD_PATH . SITE_ADMIN_IMAGE_PATH . $rowThemeSettingInfo['admin_image'])) {
										//echo SITE_UPLOAD_URL . SITE_ADMIN_IMAGE_PATH . $rowThemeSettingInfo['admin_image'];
									//} ?>" /> -->

    <style>
    .sticky {
        position: fixed;
        width: 100%;
        z-index: 999;
    }

    .taxForm {
        position: fixed;
        z-index: 999;
        top: 24%;
        /* background: #F5F5F5 */
    }
    #proTax_table .theaddata{
        /* position: fixed; */
        z-index: 999;
    }
    /* .sidebar,
        .main {
            transition: all 0.3s ease-out;
            overflow-y: scroll;
            -webkit-overflow-scrolling: touch;
            position: absolute;
            top: 0px;
            bottom: 0;
        }
         */

    </style>
</head>

<body>

    <!-- *********** Header Navbar Start ************ -->

    <!-- Main navbar -->
    <div class="navbar navbar-inverse" style="position: sticky; top: 0; z-index: 999;">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">
                <img src="<?php if (is_file(SITE_UPLOAD_PATH . SITE_ADMIN_IMAGE_PATH . $rowAdminInfo['admin_image'])) {
								echo SITE_UPLOAD_URL . SITE_ADMIN_IMAGE_PATH . $rowAdminInfo['admin_image'];
							} else {
								echo 'assets/images/placeholder.jpg';
							} ?>" alt="">
            </a>

            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <span><?php echo $rowAdminInfo['admin_full_name']; ?></span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">

                        <li><a href="logout.php"><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->