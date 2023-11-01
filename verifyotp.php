<?php 
session_start();
include_once('./config/config.php');
$otpErr='';
if(isset($_POST['Verify'])){
    $email = $_GET['email'];
    $query = "SELECT * FROM mstuser where us_EmailID='" . $email . "'";
    $result=$dbh->query($query);
    $row = $result->fetch();
    $loginotp = $row['token'];
    
    $inputotp = $_POST['otpis1'].$_POST['otpis2'].$_POST['otpis3'].$_POST['otpis4'].$_POST['otpis5'].$_POST['otpis6'];
    if($_POST['otpis1'] == '' OR $_POST['otpis2'] == '' OR $_POST['otpis3'] == '' OR$_POST['otpis4'] == '' OR$_POST['otpis5'] =='' OR $_POST['otpis6'] == ''){
        $otpErr = "<span class='new_same mt-2 text-danger' role='alert'>Please Enter 6 digit OTP number code</span>";
    }else{
        
   
    if($inputotp ==  $loginotp){
        redirect("newpassword.php?email=$email");
    }else{
        // echo 'otp is wrong';
        $otpErr = "<span class='new_same text-danger' role='alert'>Please Enter correct 6 digit OTP number code</span>";
    }
    }
}
$otpResend = '';
if(isset($_POST['resend-otp'])){
    $email = $_GET['email'];
    $login_otp = rand(100000,999999);
    $sql = "UPDATE mstuser SET token =  $login_otp WHERE us_EmailID='" . $email . "'" ;
    $otpRes = $dbh->query($sql);
        $to = $email;
        // $subject = "You Otp is ";
        // $txt = "OTP is : $login_otp.";
        // $headers = "From:  no-reply@grofkit.in";
        // mail($to,$subject,$txt,$headers);
        
        // $to = $email_id;
        $subject = "OTP from Gorfkit.in ";
        
         $message= "<html>
      <head>
      <style>

      </style>
      </head>
      <body>

      <p>Dear $email,</p>
      <p>You have requested for the password change. Your 6 digit New OTP is $login_otp.</p><br>
      <p style='margin-bottom:10px'></p>

      <p>You can write us to grofkit@gmail.com or 8521985288
Thank You for giving your precious time to us. </p>
<p>Happy Shopping!</p>

      
      </body>
      </html>";
      $headers1[] = 'MIME-Version: 1.0';
      $headers1[] = 'Content-type: text/html; charset=iso-8859-1';
      // Additional headers
      $headers1[] = 'To:'.$email;
      $headers1[] = 'From: no-reply@grofkit.in';
        
        
        
        // mail($to,$subject,$message,implode("\r\n", $headers1));
        
        
        if(mail($to,$subject,$message,implode("\r\n", $headers1))){
            $otpResend= "<span class='text-center text-success' role='alert'>OTP re-send on your Email</span>";
        }else{
            $otpResend= "<span class='new_same text-danger' role='alert'>Something Went Wrong.! Please check your Email address</span>";
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grofkit | Verify OTP</title>
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
                <a class="las la-arrow-left fw-bolder btn-back forgot-back text-decoration-none fw-bolder" href="forgotpassword.php">
                    </a>

                <span class="text-dark fs-13 fw-600 mt-4 mb-2">OTP Verification</span>
                <span class="text-dark fs-7 fw-500 mb-3 ">Enter the 6 digit number code that we sent to :  <span class="emailorphone fw-bold d-flex"> ( <div class="opt">+91</div>  )- <div class="epvalue">896786868688</div> </span> .</span>

              
            </div>
        </div>
        <div class="row justify-content-center forgot_input_div">
             <form action="" method="post" class="col-md-5  d-flex col-12 otp_form">
                 <div class="d-flex flex-column  flex-grow-1">
                    <div class="otp-block d-flex justify-content-around">
                        <input type="text" name="otpis1" class="firstchar" maxlength="1" id="firstchar" >
                        <input type="text" name="otpis2" maxlength="1" >
                        <input type="text" name="otpis3" maxlength="1" >
                        <input type="text" name="otpis4" maxlength="1" >
                        <input type="text" name="otpis5" maxlength="1" >
                        <input type="text" name="otpis6" maxlength="1" >
                    </div>
                    <?php echo $otpErr; ?>

                    <div class="dont-recieve-otp mt-4 d-flex justify-content-center fw-500">
                        <span class="">Don't recieve the OTP ? </span>
                        <!--<a class="text-uppercase text-decoration-none text-theme fw-600 ms-1 hover-style-none" href=""> resend otp </a>-->
                        <input type="submit" value="resend otp" class="text-uppercase text-decoration-none text-theme fw-600 ms-1 hover-style-none bg-transparent border-0" name="resend-otp">

                    </div>
                    <?php echo $otpResend; ?>
                <input type="submit" value="Verify" name="Verify" class="forgot_btn " >

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

    <script src="assets1/js/verifyotp.js"></script>

    
</body>
</html>