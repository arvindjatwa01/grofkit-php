<?php 
session_start();
include_once('./config/config.php');
$passErr = '';
if(isset($_POST['confirmnewpass'])){
    $email = $_GET['email'];
    $password = $_POST['newpass'];
    $cpassword = $_POST['newcpass'];
    if($password == '' OR $cpassword == ''){
        $passErr = "<span class='new_same text-danger' role='alert'>Please Enter a your new password </span>";
    }else if($password != $cpassword ){
         $passErr = "<span class='new_same text-danger' role='alert'>Confirm password are not matched to new password</span>";
    }else{
        $passErr = '';
   
    $query = "UPDATE mstuser SET us_Password = '$password' where us_EmailID='" . $email . "'";
    $result=$dbh->query($query);
    
    $to = $email;
        $subject = "Password changed successfully on Gorfkit.in";
        
         $message= "<html>
      <head>
      <style>

      </style>
      </head>
      <body>

      <p>Dear $email,</p>
      <p>Your account password has been changed successfully on Grofkit.in.</p><br>
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
        
        
        
        mail($to,$subject,$message,implode("\r\n", $headers1));
    
    if($result){
        redirect("loginsignup.php");
    }else{
       $passErr = "<span class='new_same text-danger' role='alert'>Something went wrong please re-fill password details</span>";
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
    <title>Grocery Login</title>
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
                <a class="las la-arrow-left fw-bolder btn-back forgot-back text-decoration-none fw-bolder" href="verifyotp.php">
                    </a>

                <span class="text-dark fs-13 fw-600 mt-4 mb-2">Create New Password</span>
                <span class="text-dark fs-7 fw-500 mb-3 ">Create your new password so you can login to your account.</span>

              
            </div>
        </div>
        <div class="row justify-content-center forgot_input_div">
             <form  action="" method="POST" class="col-md-5  d-flex col-11 new_password">
                 <div class="d-flex flex-column  flex-grow-1 align-items-center">
                    <input type="password" class="new_password new_same same_input_style  form-control focusdisabled"   placeholder="New Password" name="newpass">
                    <input type="password" class="confirm_newpassword mt-3  new_same same_input_style  form-control focusdisabled"  placeholder="Confirm Password" name="newcpass" >
                    <?php echo $passErr; ?>
                <input type="submit" name="confirmnewpass" value="Generate Password" class="forgot_btn ">

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