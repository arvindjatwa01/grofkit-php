<?php include_once 'admin/connection_handle.php';

if($class_user_login->checkuserLoggedIn()){
    redirect('afterlogin.php');
}
$class_user_login->checkuserLoggedIn();

$strMode = 'new';

$aryErrors = $class_country->sizeProcessRequest('', $strMode);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grofkit Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

<body class="login_signup_body bg-black">

    <div
        class="container-fluid position-absolute top-40 translate-middle-y bg-black d-flex flex-column justify-content-center">

        <div class="row justify-content-center logsign-logo">
            <div class="col-lg-2 col-md-3 col-5">
                <!-- <img src="assets1/images/WhatsApp_Image_2022-03-27_at_21.40.45-removebg-preview.png" alt="" class="img-fluid logo-img"> -->
                <div class="logo d-flex justify-content-center"><span>G</span> <span>ROFKIT</span> </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4 col-9 login-signup-card px-0">
                <div class="nav nav-tabs log-intabs">
                    <a href="#login_sec" class="nav-link active fw-600" data-bs-toggle="tab">Log in </a>
                    <a href="#signup_sec" class="nav-link fw-600" data-bs-toggle="tab">Sign up</a>
                </div>

                <div class="tab-content loginsignuptab-content position-relative">
                    <div class="tab-pane fade show active container-fluid " id="login_sec">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger" id="errormessage" style="display:none" role="alert">
                                    Enter Valid Usernme and Password!
                                </div>
                                <div class="alert alert-success" id="successmessage" style="display:none" role="alert">
                                    Login Successfully
                                </div>
                                <?php //print_r($aryErrors); ?>
                                <?php if(count($aryErrors) == 1){ ?>

                                <div class="alert alert-danger" id="SignUpsuccessmessage" role="alert">
                                    <?php print_r($aryErrors['countryName']); ?>
                                </div>
                                <?php }
                                if(count($aryErrors) == 2){ ?>
                                    <div class="alert alert-success" id="SignUperrormessage" role="alert">
                                        <?php print_r($aryErrors['countryName']); ?>
                                    </div>
                                <?php }?>
                                <form action="javascript:void(0)" method="post" id="loginform"
                                    class="login-form d-flex flex-grow-1 flex-column">
                                    <div class="email-sec d-flex login-signup-field flex-grow-1">
                                        <i class="las la-envelope"></i>
                                        <input type="email" placeholder="Email" name="useremail" id="useremail">
                                    </div>




                                    <div class="password-sec  login-signup-field d-flex flex-grow-1">
                                        <i class="las la-lock"></i>
                                        <input type="password" placeholder="Password" name="userpassword">
                                        <i class="las la-eye d-none"></i>

                                    </div>

                                    <a class="forgot" href="forgotpassword.php">
                                        Forgot Password?
                                    </a>



                                    <a class="login-btn login-signupbtn" onclick=" return loginadmin($(this))">
                                        Log in
                                    </a>

                                    <span class="add-option text-center">
                                        <span>Dont't have an account? <a class="alt_signbtn">Sign up</a> </span>
                                    </span>
                                </form>
                            </div>
                            <div class="col-12"></div>
                        </div>



                    </div>
                    <div class="tab-pane fade show container-fluid " id="signup_sec">
                        <div class="row">
                            <div class="col-12">
                                <form action="" method="POST" class="login-form d-flex flex-grow-1 flex-column">
                                    <div class="email-sec d-flex login-signup-field flex-grow-1">
                                        <i class="las la-user"></i>
                                        <input type="text" placeholder="Full Name" name="signupName" id="signupName">
                                    </div>
                                    <div class="email-sec d-flex login-signup-field flex-grow-1">
                                        <i class="las la-envelope"></i>
                                        <input type="email" placeholder="Email" name="signupEmail" id="signupEmail">
                                    </div>
                                    <span id="error"></span>

                                    <div class="mobile-sec d-flex login-signup-field flex-grow-1">
                                    <i class="las la-phone"></i>
                                        <input type="text" maxlength="10" placeholder="Phone Number" name="signupPhone"
                                            id="signupPhone">
                                        
                                    </div>
                                    <span id="errorphone"></span>

                                    <div class="password-sec  login-signup-field d-flex flex-grow-1">
                                        <i class="las la-lock"></i>
                                        <input type="password" placeholder="Password" name="signupPass" id="signupPass">
                                        <i class="las la-eye d-none"></i>
                                    </div>

                                    <div class="confirm-password-sec  login-signup-field d-flex flex-grow-1">
                                        <i class="las la-lock"></i>
                                        <input type="password" placeholder="Confirm password" name="signupCPass" id="signupCPass">
                                        <i class="las la-eye d-none"></i>
                                    </div>
                                    <span id="errorpassword"></span>
                                    <input type="submit" class="login-btn login-signupbtn sgn_up" value="Sign up">


                                </form>
                            </div>
                            <div class="col-12"></div>
                        </div>

                    </div>

                    <div
                        class="d-flex justify-content-between position-absolute top-100  end-0 start-0 tandc align-items-center">
                        <a class="text-decoration-none text-reset" href="termsofuse.php">Terms of Use</a><a
                            class="text-decoration-none text-reset" href="contactus.php">Contact us</a><a
                            href="privacypolicy.php" class="text-decoration-none text-reset">Privacy Policy</a>
                    </div>

                    <div
                        class="d-flex justify-content-between position-absolute top-100  end-0 start-0 faq align-items-center">
                        <a class="text-decoration-none text-reset" href="faq.php">FAQ</a><a
                            class="text-decoration-none text-reset" href="aboutus.php">About us</a><a
                            href="returnpolicy.php" class="text-decoration-none text-reset">Returns/Refunds & Shipping
                            Policy</a>
                    </div>
                </div>


            </div>
        </div>


    </div>

    <footer class="container-fluid position-fixed bottom-0">

        <div class="row">
            <a class="col " href="index.php">
                <img src="assets1/images/home (1)inactive.png" alt="">
                <span>Home</span>

            </a>
            <a class="col position-relative" href="cart.php">
                <img src="assets1/images/shopping-cart.png" alt="">
                <span>Cart</span>
                <!-- <span
                    class="cart-items-badge my-cart-value rounded-pill bg-theme2 position-absolute top-0 translate-middle-y start-50  text-white">
                    1
                </span> -->

            </a>

            <!-- <a class="col">
                <img src="assets1/images/bag.png" alt="">
                <span>Cart</span>

            </a> -->


            <a class="col position-relative" href="myorders.php">
                <img src="assets1/images/bag.png" alt="">
                <span>My Orders</span>
                <!-- <span
                    class="cart-items-badge my-orders-value  rounded-pill bg-theme2 position-absolute top-0 translate-middle-y start-50  text-white">
                    1
                </span> -->

            </a>

            <a class="col active-footer" href="loginsignup.php">
                <img src="assets1/images/userinactive.png" alt="">
                <span>Profile</span>

            </a>
            <!-- <a class="col">
                <img src="assets1/images/userinactive.png" alt="">
                <span>Profile</span>

            </a> -->
        </div>

    </footer>
     <div  class="loader   top-0 start-0  flex-column align-items-center justify-content-center bottom-0 end-0">
        <span class="text-white fs-4 mb-2">Loading</span>
        <div class=" spinner-border text-theme-3  "></div>

    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets1/css/login.css">
    <link rel="stylesheet" href="assets1/css/mediaquery.css">


    <script src="assets1/js/logsignup.js"></script>


</body>

</html>
<script>
function loginadmin(objvalue)

{
    // console.log(objvalue);background-color: var(--primary-color);

    objvalue.replaceWith(
        '<button id="login1" type="submit" class="btn bg-pink-400 btn-block" style="background-color: var(--primary-color); color: white;" >Processing... <i class="icon-circle-right2 position-right"></i></button>'
    );
    var datastrings = $('#loginform').serialize();
    // console.log(datastrings)

    $.post('admin/ajaxloginuser.php', datastrings, function(response)

        {
            // console.log(response);
            var object = jQuery.parseJSON(response);
            // console.log(object.message);
            if (object.message == 'ok') {

                $('#errormessage').hide();
                $('#successmessage').show();
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 2000);

            } else {
                $('#login1').replaceWith(
                    '<button type="submit" class="login-btn login-signupbtn" onclick="loginadmin($(this))">Login <i class="icon-circle-right2 position-right"></i></button>'
                );
                $('#errormessage').show();
            }
        });
}
$(function() {
    setTimeout(function() {
        $("#SignUpsuccessmessage").fadeOut(1500);
    }, 3000)

});
$(function() {
    setTimeout(function() {
        $("#SignUperrormessage").fadeOut(1500);
    }, 3000)

});
</script>
<script>
    var validate_email = function(email) {
        var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9-])+(?:\.[a-zA-Z])+/;
        var is_email_valid = false;
        if (email.match(pattern) != null) {
            is_email_valid = true;
        }
        return is_email_valid;
    }
$(document).on("keyup", "#signupEmail", function() {
    var input_val = $(this).val();
    var is_success = validate_email(input_val);
    // var email = $("#signupEmail").val();
    if (!is_success) {
            $("#signupEmail").focus();
            // $("#step1btn").attr("disabled", true);
            error.textContent = "Please enter a valid email address";
            error.style.color = "red"
        } else {
              //
              var email=$("#signupEmail").val();
              //checking for email is already registered or not
              $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {email:email,isvalidemail: true},
                    dataType: "json",
                    async:false,
                    success: function(data)
                    {
                        console.log(data);
                        if(data=='This email is already registered')
                        {
                            //alert("This email is already registered");
                            $('#signupEmail').focus();
                             error.textContent = "This email is already registered with us. Please try with different email";
                             error.style.color = "red";
                            //  $("#step1btn").attr("disabled", true);
                        }
                        else
                        {
                            //   $("#step1btn").attr("disabled", false);
                              error.textContent = "";
                          
                        }
                    },
                    error:function(data)
                    {
                        console.log("error showing");
                    }
                });
            // end 
            
        }
});
$(document).on("keyup", "#signupPhone", function() {
    var input_val = $(this).val();
    if (input_val.length < 10) {
            $("#signupPhone").focus();
            // $("#step1btn").attr("disabled", true);
            errorphone.textContent = "Please enter a valid Mobile Number";
            errorphone.style.color = "red"
        } else {
              //
              var phone=$("#signupPhone").val();
              //checking for Mobile Number is already registered or not
              $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {phone:phone,isvalidphone: true},
                    dataType: "json",
                    async:false,
                    success: function(data)
                    {
                        console.log(data);
                        if(data=='This Mobile Number is already registered')
                        {
                            //alert("This email is already registered");
                            $('#signupPhone').focus();
                            errorphone.textContent = "This Mobile Number is already registered with us. Please try with different email";
                            errorphone.style.color = "red";
                            //  $("#step1btn").attr("disabled", true);
                        }
                        else
                        {
                            //   $("#step1btn").attr("disabled", false);
                            errorphone.textContent = "";
                          
                        }
                    },
                    error:function(data)
                    {
                        console.log("error showing");
                    }
                });
            // end 
            
        }
});

$(document).on("keyup", "#signupCPass", function() {
    var cpassword = $(this).val();
    var password = $('#signupPass').val();
    if(password != cpassword){
        errorpassword.textContent = "Password Don't Match Please check";
        errorpassword.style.color = "red";
    }else{
        errorpassword.textContent = '';
    }
});


</script>