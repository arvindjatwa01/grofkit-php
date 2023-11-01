<?php
include_once 'admin/connection_handle.php';
$class_user_login->checkuserLoggedIn();
$strLoadAdminCondition = ' AND us_Id=' . $class_user_login->getCurrentLoginAdminId();
$rowAdminInfo = $class_common->loadSingleDataBy($strLoadAdminCondition, '', '', TABLE_USER);

$checkloginadmin = $class_user_login->checkuserLoggedIn();
$backtoPage = '';
if ($checkloginadmin == '') {
	$backtoPage = 'loginsignup.php';
}else{
    $backtoPage = 'afterlogin.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grofkit | contact us</title>

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

<body>


    <div class="">
        <header class="container-fluid faltu-header position-sticky top-0  bg-black ">

            <div class="row">
                <div class="col-12 position-relative d-flex align-items-center justify-content-center">
                    <a class="las la-arrow-left btn-back text-white text-decoration-none fw-bolder"
                        href="<?php echo $backtoPage; ?>">


                    </a>
                    <span class="fc-1 logo fw-600">G<span class="text-white">ROFKIT</span> </span>
                </div>
            </div>






        </header>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h6 class="mb-0 fs-3  text-center fw-bold mt-3">Contact us</h6>
                </div>
                <!-- <div class="position-relative">
                    <div class="position-absolute">
                        <div class="col-12">
                            <h4>Email:</h4>
                            <p></p>
                        </div>
                    </div>

                </div> -->
                <div class="col-12">
                    <section class="ref-pol-1  faq-policy contact-us">


                       
                        <ul>
                            <div class="">
                                <li class="fc-2">

                                    <strong>Email -</strong> <a href=""
                                        class="text-decoration-none text-theme">Grofkit@gmail.com
</a>
                                </li>
                                <li class="fc-2">

                                    <strong>Contact No. -</strong> <a href=""
                                        class="text-decoration-none text-theme">
                                        8603079079</a>
                                </li>
                                <li class="fc-2">

                                    <strong>Address -</strong> <a href=""
                                        class="text-decoration-none text-theme">
                                        balughat dhalan muzaffarpur bihar pincode-842001
</a>
                                </li>
                            </div>


                        </ul>

                    </section>
                </div>
            </div>
        </div>




    </div>

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
    <link rel="stylesheet" href="assets1/css/myorder.css">

    <link rel="stylesheet" href="assets1/css/mediaquery.css">





</body>

</html>