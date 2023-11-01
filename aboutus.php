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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Grofkit | About us </title>

    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets1/css/myorder.css">

    <link rel="stylesheet" href="assets1/css/mediaquery.css">
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
                    <h6 class="mb-0 fs-3  text-center fw-bold mt-3">About us</h6>
                </div>
                <div class="col-12">

                    <section class="policy-tu-1 ">
                        <h6 class="fc-2">The Grofkit is an all-in-one online marketplace that located in Bihar, India,
                            this is a platform that provide the grocery and other products in local area. Customers will
                            be able to shop for all type of products right from this platform. </h6>
                        <h6 class="fc-2">We’re committed to providing a secure and fair marketplace for our buyers. To
                            support this commitment, we’ve put in place rules and policies that govern our expectations
                            of buyers, the actions we’ll tale to keep you safe, and how Grofkit will protect you. </h6>
                    </section>
                </div>
            </div>
        </div>




    </div>


 <div  class="loader   top-0 start-0  flex-column align-items-center justify-content-center bottom-0 end-0">
        <span class="text-white fs-4 mb-2">Loading</span>
        <div class=" spinner-border text-theme-3  "></div>

    </div>

    <script src="assets1/js/main.js"></script>


</body>

</html>