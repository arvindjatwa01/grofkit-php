<?php include_once 'connection_handle.php';

if($class_login->checkAdminLoggedIn())
{
	redirect(SITE_ADMIN_URL.'index.php');
}

// $strloadCondition='AND theme_setting_id=1';
// $rowThemeSettingInfo=$class_common->loadSingleDataBy($strloadCondition,'','',TABLE_THEME_SETTING);
// echo $rowThemeSettingInfo;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Grofkit</title>
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
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
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script type="text/javascript" src="assets/js/pages/login.js"></script>
	<!-- /theme JS files -->
	 <link rel="icon" href="" type="images/png" sizes="16x16"> 
	 <link rel="shortcut icon" href="<?php if(is_file(SITE_UPLOAD_PATH.SITE_THEME_IMAGE_PATH.$rowThemeSettingInfo['theme_setting_favicon'])){ echo SITE_UPLOAD_URL.SITE_THEME_IMAGE_PATH.$rowThemeSettingInfo['theme_setting_favicon']; }?>"/>
</head>

<body class="login-container bg-slate-800">
	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Advanced login -->
					<form action="javascript:void(0)" method="post" id="loginform">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<img src="<?php echo SITE_URL?>images/logo.jpg" style="width:50%">
								<h5 class="content-group-lg">Login to your account <small class="display-block">Enter your credentials</small></h5>
							</div>
							
							<div class="alert alert-danger" id="errormessage"  style="display:none" role="alert">
  Enter Valid Usernme and Password!
</div>
<div class="alert alert-success" id="successmessage" style="display:none" role="alert">
   Well Done!Login Successful
</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" value="" name="username" placeholder="Username">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" value="" name="password" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

						<!--	<div class="form-group login-options">
								<div class="row">
									<div class="col-sm-6">
										<label class="checkbox-inline">
											<input type="checkbox" class="styled" checked="checked">
											Remember
										</label>
									</div>

									<div class="col-sm-6 text-right">
										<a href="login_password_recover.html">Forgot password?</a>
									</div>
								</div>
							</div> -->

							<div class="form-group">
								<button type="button" class="btn bg-blue btn-block" onclick=" return loginadmin($(this))">Login <i class="icon-circle-right2 position-right"></i></button>
							</div>

							

							
						</div>
					</form>
					<!-- /advanced login -->

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



<script>


function loginadmin(objvalue)

{  
	objvalue.replaceWith('<button id="login1" type="submit" class="btn bg-pink-400 btn-block" >Processing... <i class="icon-circle-right2 position-right"></i></button>');
	var datastrings= $('#loginform').serialize();
	$.post('ajaxloginadmin.php',datastrings,function(response)
	
	{
		// console.log(response);
		var object= jQuery.parseJSON(response);
		if(object.message=='ok')
		{
			$('#errormessage').hide();
			$('#successmessage').show();
			setTimeout(function(){
			window.location.href='index.php'; }, 2000);
			
		}
	
	else{
	$('#login1').replaceWith('<button type="submit" class="btn bg-blue btn-block" onclick="loginadmin($(this))">Login <i class="icon-circle-right2 position-right"></i></button>');
			$('#errormessage').show();
	}
	});
}


</script>

