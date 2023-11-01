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
    <title>Grofkit | Return Policy</title>
    
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
        <header  class="container-fluid faltu-header position-sticky top-0  bg-black ">

            <div class="row">
                <div class="col-12 position-relative d-flex align-items-center justify-content-center">
                    <a class="las la-arrow-left btn-back text-white text-decoration-none fw-bolder" href="<?php echo $backtoPage; ?>">


                    </a>
                    <span class="fc-1 logo fw-600">G<span class="text-white">ROFKIT</span> </span>
                </div>
            </div>

                

            
           

        </header>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h6 class="mb-3 fs-3  text-center fw-bold mt-3">Return/Refunds & Shipping Policy</h6>
                </div>
                 <div class="col-12">
                    <section class="ref-pol-1  faq-policy">

                       
                        <h5 class="mb-0">
                            Returns/Refunds Policy 
                        </h5>
                        <ul>
                           
                             
    
                                <li class="fc-2">
                              
                                    <span class=" d-block">
                                        Intention to return or exchange items must be made via email within 7 days of receiving items . If 7 days have gone by since your purchase, unfortunately we can’t offer you a refund or return. 
                                    </span>

                                    <span class="my-2 d-block">
                                    Refunds and Returns are depends on the project. Some products do not have the return and refunds.

                                    </span>
                                  <span class="my-2 d-block">
                                    Product must be returned unmarked and in their original, undamaged product box as this is considered part of the product. Product must be returned in suitable outer box packaging to ensure they are fully protected in transit as Grofkit does not accept liability for any returned items until they are safely received at the returns address.
                                  </span>

                                  
                                   
                                </li>
                            

                           
                            <div class="">
                                <h5 class="mb-0">
                                    Exceptions / non-returnable items 
                                </h5>
    
                                <li class="fc-2">
                              
                                    Certain types of items cannot be returned, like perishable goods (such as food, flowers, or plants), custom products (such as special orders or personalized items), and personal care goods (such as beauty products). We also do not accept returns for hazardous materials, flammable liquids, or gases. Please get in touch if you have questions or concerns about your specific item. 

                                    <div class="my-2">
                                        Unfortunately, we cannot accept returns on sale items or gift cards.

                                    </div>
                                    
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    Refunds
                                </h5>
    
                                <li class="fc-2">
                                    Once your return is received and inspected, we will send you an email to notify you that we have received your returned item. We will also notify you of the approval or rejection of your refund. 
                                    <div class="my-2">
                                        If approved, then your refund will be processed, and a credit will automatically be applied to your credit card or original method of payment, within a certain amount of days. 
                                    </div>
                              
                                 
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    Late or missing refunds
                                </h5>
    
                                <li class="fc-2">
                              
                                    If you haven’t received a refund yet, contact your debit/credit card company, it may take some time before your refund is officially posted. 
                                    <div class="my-2">
                                        Next, contact your bank. There is often some processing time before a refund is posted. 
                                        If you’ve done all of this and you still have not received your refund yet, please contact us at info@niana.co 
                                    </div>
                                    <div class="my-2">
                                        All exchanges and returns purchased on this website must be returned to this website.
                                    </div>
                                   
                                    
                                </li>
                            </div>
                            <div class=" py-2">
                                <h5 class="mb-0">Shipping Policy
                                </h5>

                                <ul class="py-2" style="padding-left: 2rem !important; list-style-type: disc !important;">
                                    <p class="fc-2 my-2" style="font-weight: 500;">
                                        All Products purchased from Grofkit shall be delivered to the User by ourselves only.
                                    </p>
                                    <li class="fc-2">
                                        	All deliveries where applicable shall be made on a best effort’s basis, and while the Website will endeavor to deliver the Products on the dates intimated, the Website disclaims any claims or liabilities arising from any delay in this regard.
                                    </li>
                                    <li class="fc-2">
                                        In case of cash on delivery (“COD”) orders a nominal fee may be charged on all COD orders. The COD charge can be viewed at the time of placing the order and in all order related emails. This charge shall not be refunded if an item is returned or if the cancellation request is raised after the order is shipped.
                                    </li>
                                    <li class="fc-2">
                                        The deliver agent will make a maximum of three attempts to deliver your order. In case the User is not reachable or does not accept delivery of products in these attempts the respective Grofkit reserves the right to cancel the order(s) at its discretion.
                                    </li>
                                    <li class="fc-2">
                                        	On placing your order, you will receive an email containing a summary of the order.
                                    </li>
                                    <li class="fc-2">
                                        	Sometimes, delivery may take longer due to inter alia: bad weather, flight delays, political disruptions and other unforeseen circumstances.
                                    </li>
                                </ul>

                                <p class="fc-2 mb-2" style="font-weight: 500;">
                                    The Website shall not be held responsible and will bear no liability in case of failure or delay of delivering the Products including any damage or loss caused to the Products.
                                </p>

                                
    
                              
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    FREE SHIPPING
                                </h5>
    
                                <li class="fc-2">
                              
                                    We offer free shipping on some products. Product will get delivered to your door-step within 5 to 8 business days
                                </li>
                                <li class="fc-2">
                                  <strong>NOTE -</strong>   We Provide 24/7 shipping and product delivery services
                                </li>
                                <li class="fc-2">
                                    For Indian customers, the shipping charge is Rs 30 for all orders.
                                </li>
                                <li class="fc-2">
                                    We do not ship products out of India. For multiple products ordered the program adds up the weight of all the units ordered and charges a single delivery fee.  
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    CONTACT US FOR MORE INFORMATION
                                </h5>
    
                                <li class="fc-2">
                              
                                    If you have any further question or comments, you may contact us by-
                                </li>
                                <li class="fc-2">
                              
                                   <strong>Email -</strong> <a href="" class="text-decoration-none text-theme">Grofkit@gmail.com</a>
                                </li>
                                <li class="fc-2">
                              
                                   <strong>Online contact form -</strong> <a href="" class="text-decoration-none text-theme">Grofkit@gmail.com</a>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets1/css/myorder.css">

    <link rel="stylesheet" href="assets1/css/mediaquery.css">




    
</body>
</html>