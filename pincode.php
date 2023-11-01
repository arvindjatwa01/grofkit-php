<?php 
include_once 'admin/connection_handle.php';
$class_user_login->checkuserLoggedIn();
$strLoadAdminCondition = ' AND us_Id=' . $class_user_login->getCurrentLoginAdminId();
$rowAdminInfo = $class_common->loadSingleDataBy($strLoadAdminCondition, '', '', TABLE_USER);


$checkloginadmin = $class_user_login->checkuserLoggedIn();

if ($checkloginadmin == '') {
	redirect('loginsignup.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Pincode</title>
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

                <span class="text-dark fs-13 fw-600 mt-4 mb-2">Your Location</span>
                <span class="text-dark fs-7 fw-500 mb-3 ">Enter your pincode for your order delivery</span>

              
            </div>
        </div>
        <div class="row justify-content-center forgot_input_div">
             <form action="" method="POST" id="pincodeUpdate" class="col-md-5  d-flex col-11 forgot_form">
                 <div class="d-flex flex-column  flex-grow-1">
                     <input type="hidden" value="<?php echo $_SESSION['USER']['ID']; ?>" name="pinUpdate_userid">
                    <input type="text" class=" pincode_input same_input_style  form-control focusdisabled" maxlength="6"  placeholder="Enter Pincode"  name="pinUpdate_pincode">
                    <div class="result"></div>
                <input type="submit" value="Get my location" class="pincode_btn " >

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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

   <script>
$(document).ready(function(){
    $('.flex-column input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("pincodesearch.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".flex-column").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
    
     $("#pincodeUpdate").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "action.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if(data == 1){
                    window.location.href="index.php";
                }
            },
            error: function() {}
        });
     }));
    
});

    
</script>

    
</body>
</html>