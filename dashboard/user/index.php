<?php include '../admin/connection_handle.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="rk Shyopuria">
    <title>Album example · Bootstrap v5.0</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- main css -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- jquery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="cort-loger">
    <!-- navbar start -->
    <header>
        <div class="navbar shadow-sm sec-topbar">
            <div class="container">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <img src="./assets/logo-kortlogo.png" alt="" width="100">
                </a>
                <div class="d-flex align-items-center">
                    <p class="mb-0"><?php 
                    $down = $class_common->loadMultipleDataByTableName('', '', '', 0, '', 'download_history');
                    echo count($down);
                    
                    ?> kortlogo downloads</p>
                </div>
            </div>
        </div>
    </header>
    <!-- navbar end -->

    <main>
        <div class="">
            <div class="container">
                <div class="row ">
                    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
                        <div class=" pt-5">
                            <h3>Choose, combine and download free <span style="color: #1500f5;">card logos</span> for your webshop.</h3>
                            <div class="mt-4">
                                <div class="justify-content-space-between">
                                    <div class="mainnbox">
                                        <div>
                                            <img src="./assets/icon-right.png" alt="" width="10">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Choose your logos</h6>
                                            <small>Find the logos you receive</small>
                                        </div>
                                    </div>

                                    <div class="mainnbox">
                                        <div>
                                            <img src="./assets/icon-bar.png" alt="" width="10">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Sort and set </h6>
                                            <small>Select order and format</small>
                                        </div>
                                    </div>

                                    <div class="mainnbox">
                                        <div>
                                            <img src="./assets/icon-downlode.png" alt="" width="10">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Download and use</h6>
                                            <small>Download in .png or svg format</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="devider_box">

                            <div class="mt-5">
                                <div class="accordion" id="accordionPanelsStayOpenExample">

                                    <?php

                                    $count = 0;
                                    // $catagriesConduition = ' ';

                                    $catagriesRow = $class_common->loadMultipleDataByTableName('', '', '', 0, '', 'categories');
                                    $totalcat = count($catagriesRow);
                                    if ($totalcat > 0) {
                                        foreach ($catagriesRow as $catagries) {
                                            $CategoryId = $catagries['category_id'];
                                            $count++;
                                    ?>
                                            <!-- accordion Box -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-heading<?php echo $CategoryId ?>">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?php echo $CategoryId ?>" aria-expanded="true" aria-controls="panelsStayOpen-collapse<?php echo $CategoryId ?>">
                                                        <h5> <span class="logocount"><?php echo $count . '/' . $totalcat; ?> </span> <?php echo $catagries['category_name']; ?></h5>
                                                    </button>
                                                </h2>
                                                <div id="panelsStayOpen-collapse<?php echo $CategoryId ?>" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-heading<?php echo $CategoryId ?>">
                                                    <div class="accordion-body">
                                                        <ul class="imagesbox">
                                                            <?php
                                                            $strLoadConditions = ' AND category =' .  $CategoryId;

                                                            $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, '', '', 0, '', 'image');

                                                            if (count($resSelectCouponList) > 0) {
                                                                foreach ($resSelectCouponList as $rowCompany) {
                                                                    $ImageId = $rowCompany['id'];
                                                            ?>
                                                                    <li class="image_itam">
                                                                        <ul class="list-unstyled">
                                                                            <li class="checkbox" for="img<?php echo $ImageId; ?>">
                                                                                <div class="imagebox<?php echo $ImageId; ?>">
                                                                                    <img class="imgmain<?php echo $ImageId; ?>" src="../uploads/company_image/<?php echo $rowCompany['image']; ?>" alt="">

                                                                                    <?php
                                                                                    $varient = ' AND image_id =' . $ImageId;

                                                                                    $varient_IMG = $class_common->loadMultipleDataByTableName($varient, '', '', 0, '', 'varient_image');
                                                                                    $varintimg = count($varient_IMG);
                                                                                    if ($varintimg  > 0) {
                                                                                        foreach ($varient_IMG as $varient_IMGS) {
                                                                                            $varientId = $varient_IMGS['id'];
                                                                                    ?>
                                                                                            <img class="varientmain<?php echo $varientId; ?>" src="../uploads/company_image/<?php echo $varient_IMGS['image']; ?>" style="display: none" alt="">

                                                                                    <?php

                                                                                        }
                                                                                    }

                                                                                    ?>
                                                                                </div>

                                                                                <input type="checkbox" id="img<?php echo $ImageId; ?>" class="checkboxmain" />

                                                                            </li>

                                                                        </ul>
                                                                        <?php
                                                                        //  check varient image 
                                                                        if ($varintimg > 0) {
                                                                        ?>
                                                                            <span class="varient_img" onclick="next('imagebox<?php echo $ImageId; ?>')" title="Varient Image Here"> <i class='fa fa-angle-down'></i></span>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </li>

                                                            <?php
                                                                }
                                                            } ?>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- accordion Box -->
                                    <?php   }
                                    } ?>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        
                        <div class="bg-white shadow-sm p-5 h-100">
                        <form id="mainfom" method="POST">
                            <h5>Generate your card logos</h5>

                            <div class="mt-3">
                                <h6 class="mb-0">1. Sort the order</h6>
                                <small>Drag and drop the logos</small>
                            </div>

                            <div class="mt-3 djdfd" style="background-image: url('./assets/background.jpg');">
                                <ul id="artboard" class="show-labels list-unstyled artboard">

                                </ul>
                            </div>

                            <div class="mt-3">
                                <h6 class="mb-0">2. Logo grid</h6>
                                <small>How to set up the logos</small>
                                <div class="mt-1">
                                    <select class="form-select form-select-sm shadow-sm" name="logogrid" aria-label=".form-select-sm example">
                                        <option value="Horizontal">Horizontal</option>
                                        <option value="Vertical">Vertical</option>
                                        <option value="5 per. row">5 per. row</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-3">
                                <h6 class="mb-0">3. Select the file type</h6>
                                <small>Select the file type for download</small>
                                <div class="mt-1">
                                    <select class="form-select form-select-sm shadow-sm" name="logoformat" aria-label=".form-select-sm example">
                                        <option value="PNG">PNG</option>
                                        <option value="SVG">SVG</option>
                                    </select>
                                </div>
                            </div>

                            <!--  -->

                            <div class="mt-3">
                                <h6 class="mb-0">4. Select border line</h6>
                                <small>Should the logos have gray border lines?</small>
                                <div class="mt-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="borderbox" id="inlineRadio1" value="border">
                                        <label class="form-check-label" for="inlineRadio1"><small>Yes</small></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="borderbox" id="inlineRadio2" value="unborder">
                                        <label class="form-check-label" for="inlineRadio2"><small>No</small></label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">5. Logo size</h6>
                                <small>Choose how big the logos should be</small>
                                <div class="mt-1">
                                    <select class="form-select form-select-sm shadow-sm" name="logosize" aria-label=".form-select-sm example">
                                        <?php

                                        // $strLoadConditions = ' AND category =';
                                        $count = 0;
                                        $recom = '';
                                        $sizerow = $class_common->loadMultipleDataByTableName('', '', '', 0, '', 'size_of_cost');
                                        $totalsize = count($sizerow);
                                        if (count($sizerow) > 0) {
                                            foreach ($sizerow as $sizes) {
                                                $count++;
                                                if ($count == $totalsize) {
                                                    $recom = '(requires login)';
                                                }
                                                echo '<option value="' . $sizes['size'] . 'px">' . $sizes['size'] . 'px' .  $recom . '</option>';
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>

                            <div class="mt-3">
                                <h6 class="mb-0">Download logos</h6>
                                <small>Please read and accept our terms before you can download.</small>
                                <div class="mt-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="acc_terms" value="accept terms" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            <small>I accept the <a href="./terms-conditions.php" style="text-decoration: underline;" target="_blank">terms.</a> (read)</small>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="download_local" value="download local" id="defaultCheck2">
                                        <label class="form-check-label" for="defaultCheck2">
                                            <small>Check to Download Here</small>
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="mt-4">

                                <div class="mt-2">
                                    <input class="form-control form-control-sm" type="text" name="username" placeholder="Name" aria-label=".form-control-sm example">
                                </div>
                                <div class="mt-2">
                                    <input class="form-control form-control-sm" type="email" name="user_email" placeholder="Your e-mail address" aria-label=".form-control-sm example">
                                </div>
                                <div class="mt-2">
                                    <input class="form-control form-control-sm" type="text" name="user_website" placeholder="Your webshop URL" aria-label=".form-control-sm example">
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="col-auto">
                                    <button type="submit" id="submit" class="btn btn-color mb-3 w-100">Send mail with logos</button>
                                </div>

                                <div class="text-center">
                                    <small> You can download logos at most 3 times. If you want to do this several times, it requires a <a href="./partneraccount.php" title="partneraftale" target="_blank"> partner agreement. </a> </small>
                                </div>
                            </div>
                            </form>
                        </div>
                       
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script src="./assets/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#submit").click(function() {

                var logogrid = $('[name="logogrid"]').val();
                var logoformat = $('[name="logoformat"]').val();
                var borderbox = $('[name="borderbox"]').val();
                var logosize = $('[name="logosize"]').val();
                var acc_terms = $('[name="acc_terms"]').val();
                var download_local = $('[name="download_local"]').val();
                var username = $('[name="username"]').val();
                var user_email = $('[name="user_email"]').val();
                var user_website = $('[name="user_website"]').val();
                $('#mainfom').reset();

                $.ajax({
                    url: 'email.php',
                    data: {
                        logogrid: logogrid,
                        logoformat: logoformat,
                        borderbox: borderbox,
                        logosize: logosize,
                        acc_terms: acc_terms,
                        download_local: download_local,
                        username: username,
                        user_email: user_email,
                        user_website: user_website,
                        isset: 'true'
                    },
                    type: 'POST',
                    success: function(php_response) {
                        var res_email = php_response;

                        //email send
                        $.ajax({
                            url: 'PHPMailer/sendemail.php',
                            data: {
                                res_email: res_email,
                                isset: 'true'
                            },
                            type: 'POST',
                            success: function(response) {
                                console.log(response);

                            }

                        });

                    }

                });
            });
        });
    </script>
    <script>
        function next(obj) {
            var element = document.querySelector('.' + obj);
            for (var i = 0; i < element.children.length; i++) {
                if (element.children[i].style.display != "none") {

                    var classmain = element.children[i].getAttribute('class');
                    // $().style.display = "none";
                    $('.' + classmain).css("display", "none");

                    element.children[i].style.display = "none";
                    if (i == element.children.length - 1) {
                        var classmain = element.children[0].getAttribute('class');
                        $('.' + classmain).css("display", "block");

                        element.children[0].style.display = "block";
                    } else {
                        var classmain = element.children[i + 1].getAttribute('class');
                        $('.' + classmain).css("display", "block");

                        element.children[i + 1].style.display = "block";
                    }
                    break;
                }
            }
        }
    </script>
    <script>
        $(".checkbox input").on("change", function() {
            if ($(this).is(":checked")) {
                var label = $(this).closest("li").clone();
                $(".show-labels").append(label);
            } else {
                $(".show-labels")
                    .find('li[for="' + $(this).attr("id") + '"]')
                    .remove();
            }
        });

        $(".checkbox input").on("change", function() {
            if ($(this).is(":checked")) {
                var label = $(this).closest("li").text();
                $(".show-labelsonlytext").append(
                    "<span for=" + $(this).attr("id") + ">" + label + "</span>"
                );
            } else {
                $(".show-labelsonlytext")
                    .find('span[for="' + $(this).attr("id") + '"]')
                    .remove();
            }
        });
    </script>

    <script>
        $('[name="logogrid"]').on('change', function() {
            var selectvalue = this.value;
            // alert(selectvalue);
            if (selectvalue == "Horizontal") {
                $('#artboard').addClass("artboard");
                $('#artboard').removeClass("row5");
                $('#artboard').removeClass("inlinebox");
            }
            if (selectvalue == "Vertical") {
                $('#artboard').addClass("inlinebox");
                $('#artboard').removeClass("artboard");
                $('#artboard').removeClass("row5");
            }
            if (selectvalue == "5 per. row") {
                $('#artboard').addClass("row5");
                $('#artboard').removeClass("artboard");
                $('#artboard').removeClass("inlinebox");
            }

        });
    </script>

    <script>
        $('[name="borderbox"]').on('change', function() {
            var selectvalue = this.value;
            // alert(selectvalue);
            if (selectvalue == "border") {
                $('#artboard').addClass("imgborder");
            }
            if (selectvalue == "unborder    ") {
                $('#artboard').removeClass("imgborder");
            }
        });
    </script>

    <script>
        // $('#submit').on('click', function() {
        //     aelement = $('#artboard');
        //     console.log(aelement);
        //     //converting to canvas
        //     html2canvas(aelement, {
        //         onrendered: function(canvas) {

        //             append(canvas);
        //             getCanvas = canvas;
        //             // convrting canvas to image and appening
        //             var image = new Image();
        //             image.src = canvas.toDataURL("image/png");
        //             $('#submit').append(image);
        //             // setting geneated img url as href of #b
        //             // var foo = canvas.toDataURL("image/png");
        //             // $('#submit').attr("href", foo);
        //         }
        //     });
        // });
    </script>
</body>

</html>