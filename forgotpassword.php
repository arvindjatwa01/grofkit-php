<?php
session_start();
include_once('./config/config.php');
$errEmail = "d-none";
if(isset($_POST['forgotpassword'])){
    if(empty($_POST['forgot_user_email'])){
        // echo "Please Enter Email here";
        $errEmail = "text-danger";
    }else{
      $errEmail = "d-none";
    
    $user_email = $_POST['forgot_user_email'];
    // echo $user_id;
    $query = "SELECT * FROM mstuser where us_EmailID='" . $_POST['forgot_user_email'] . "'";
    $result=$dbh->query($query);
    $row = $result->fetch();
    $email_id=$row['us_EmailID'];
    $password =$row['us_Password'];-
             
    $login_otp = rand(100000,999999);
    $sql = "UPDATE mstuser SET token =  $login_otp WHERE us_EmailID='" . $_POST['forgot_user_email'] . "'" ;
    $otpRes = $dbh->query($sql);
    if($user_email==$email_id){
        $to = $email_id;
        $subject = "OTP from Gorfkit.in ";
        
         $message= "<html>
      <head>
      <style>

      </style>
      </head>
      <body>

      <p>Dear $email_id,</p>
      <p>You have requested for the password change. Your 6 digit OTP is $login_otp.</p><br>
      <p style='margin-bottom:10px'></p>

      <p>You can write us to grofkit@gmail.com or 8521985288
Thank You for giving your precious time to us. </p>
<p>Happy Shopping!</p>

      
      </body>
      </html>";
      $headers1[] = 'MIME-Version: 1.0';
      $headers1[] = 'Content-type: text/html; charset=iso-8859-1';
      // Additional headers
      $headers1[] = 'To:'.$email_id;
      $headers1[] = 'From: no-reply@grofkit.in';
        
        
        
        mail($to,$subject,$message,implode("\r\n", $headers1));
        // mail($to,$subject,$txt,$headers);
        // echo "Mail send";
        redirect("verifyotp.php?email=$email_id");
    }else{
        echo "Mail not send";
    }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grofkit | Forgot Password</title>
    <script src="assets1/js/loader.js"></script>
    <style>
        .loader{
    background: black;
    position: fixed !important;
    display: flex;
    z-index: 99999999999999;
}
    </style>

</head>
<body class="forgot-password  ">


    <div class="container-fluid forgot-div">
        <div class="row justify-content-center my-1">
            <div class="col-md-6 d-flex flex-column justify-content-start align-items-start">
                <a class="las la-arrow-left fw-bolder btn-back forgot-back text-decoration-none fw-bolder" href="loginsignup.php">
                    </a>

                <span class="text-dark fs-13 fw-600 mt-4 mb-2">Forgot Password?</span>
                <span class="text-dark fs-7 fw-500 mb-3 ">Enter the Phone number associated with your account.</span>

              
            </div>
        </div>
        <div class="row justify-content-center forgot_input_div">
             <form action="" method="post" class="col-md-5  d-flex col-11 forgot_form">
                 <div class="d-flex flex-column  flex-grow-1">
                    <!--<input type="text" class="forgot_input same_input_style  form-control focusdisabled" maxlength="10"  placeholder="Email or Phone Number" name="forgotemail" >-->
                    <input type="text" class="forgot_input same_input_style  form-control focusdisabled"  placeholder="Email or Phone Number" name="forgot_user_email" >
                    <span class="<?php echo $errEmail; ?>" role="alert">Please Enter your registerd email address</span>
                <input type="submit" value="Get OTP" name="forgotpassword" class="forgot_btn ">

                 </div>
            </form>
        </div>
    </div>

    
 <div  class="loader   top-0 start-0  flex-column align-items-center justify-content-center bottom-0 end-0">
        <span class="text-white fs-4 mb-2">Loading</span>
        <div class=" spinner-border text-theme-3  "></div>

    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/2918a48001.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets1/css/login.css">
    <link rel="stylesheet" href="assets1/css/mediaquery.css">


    <script src="assets1/js/forgotform.js"></script>

    
</body>
</html>