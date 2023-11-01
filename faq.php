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
    <title>Grocery</title>
    


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
                    <h6 class="mb-0 fs-3  text-center fw-bold mt-3">FAQ'S</h6>
                </div>
                 <div class="col-12">
                    <section class="faq-policy-1 faq-policy">

                        
                        <ul>
                            <li class="fc-2">
                                Kindly check the FAQ below if you are not very familiar with the functioning of this website. If your query is of urgent nature and is different from the set of questions then please contact us at: <br>
                                Email:  <a href="" class="text-decoraion-none text-theme">Grofkit@gmail.com </a> <br>
                                Call us:   <a href="" class="text-decoraion-none text-theme">8603079079</a> <br>


Chat with us in-app under customer service /Need Help section
from 6 am & 10 pm on all days including Sunday to get our immediate help
If you are not satisfied with the resolution provided by us, then please write to our Grievance Officer at
<a href="" class="text-decoraion-none text-theme">Grofkit@gmail.com.</a> 

                            </li>
                        </ul>

                    </section>
                    <section class="faq-policy-2 faq-policy">

                        <h4 class="mb-0 fw-600">
                            Registration
                        </h4>
                        <ul>
                            <div class="">
                                <h5 class="mb-0">
                                    How do i register?
                                </h5>
    
                                <li class="fc-2">
                              
                                  You can register by clicking on the "Register" link at the top right corner of the homepage. Please provide the information in the form that appears. You can review the terms and conditions, provide your payment mode details and submit the registration information.
                                </li>
                            </div>

                           
                            <div class="">
                                <h5 class="mb-0">
                                    Are there any charges for registration?
                                </h5>
    
                                <li class="fc-2">
                              
                                    No. Registration on grofkit.com is absolutely free.
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    Do I have to necessarily register to shop on grofkit?
                                </h5>
    
                                <li class="fc-2">
                              
                                    You can surf and add products to the cart without registration but only registered shoppers will be able to checkout and place orders. Registered members have to be logged in at the time of checking out the cart, they will be prompted to do so if they are not logged in.
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    Can I have multiple registrations?
                                </h5>
    
                                <li class="fc-2">
                              
                                    Each email address and contact phone number can only be associated with one grofkit account.
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    Can I add more than one delivery address in an account?
                                </h5>
    
                                <li class="fc-2">
                              
                                    Yes, you can add multiple delivery addresses in your grofkit account. However, remember that all items placed in a single order can only be delivered to one address. If you want different products delivered to different address you need to place them as separate orders.
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    Can I have multiple accounts with same mobile number and email id?
                                </h5>
    
                                <li class="fc-2">
                              
                                    Each email address and phone number can be associated with one Grofkit account only.
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    Can I have multiple accounts for members in my family with different mobile number and email address but same or common delivery address?
                                </h5>
    
                                <li class="fc-2">
                              
                                    Yes, we do understand the importance of time and the toil involved in shopping groceries. Up to three members in a family can have the same address provided the email address and phone number associated with the accounts are unique.
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    Can I have different city addresses under one account and still place orders for multiple cities?
                                </h5>
    
                                <li class="fc-2">
                              
                                    Yes, you can place orders for multiple cities.
                                </li>
                            </div>
                           
                        </ul>

                    </section>

                    <section class="faq-policy-3 faq-policy">

                        <h4 class="mb-0 fw-600">
                            Account Related
                        </h4>
                        <ul>
                            <div class="">
                                <h5 class="mb-0">
                                    What is My Account?
                                </h5>
    
                                <li class="fc-2">
                              
                                    My Account is the section you reach after you log in at grofkit.com. My Account allows you to track your active orders, credit note details as well as see your order history and update your contact details.
                                </li>
                            </div>

                           
                            <div class="">
                                <h5 class="mb-0">
                                    How do I reset my password?
                                </h5>
    
                                <li class="fc-2">
                              
                                    You need to enter your email address on the Login page and click on forgot password. An email with a reset password will be sent to your email address. With this, you can change your password. In case of any further issues please contact our customer support team.
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    What are credit notes & where can I see my credit notes?
                                </h5>
    
                                <li class="fc-2">
                                    Credit notes reflect the amount of money which you have pending in your grofkit account to use against future purchases. This is calculated by deducting your total order value minus undelivered value. You can see this in "My Account" under credit note details.
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    What is My Shopping List?
                                </h5>
    
                                <li class="fc-2">
                              
                                    My Shopping List is a comprehensive list of all the items previously ordered by you on Grofkit.in. This enables you to shop quickly and easily in future.
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    What are the modes of payment?
                                </h5>
    
                                <li class="fc-2">
                              
                                    a. Cash on delivery (COD). <br>
                                    b. Credit and debit cards (VISA / Mastercard / Rupay).<br>
                                        c. Paytm food wallet will be accepted only for food items.<br>

                                        <span class="mt-3 d-inline-block">
                                            If the order has to be left at the security gate, please continue to pay online via wallets, UPI, net banking, or cards as you are doing now. <br>
If you choose COD as the payment method, you will need to pay our delivery executive in cash at the time of delivery. <br>
To minimize contact, please give the executive the exact amount or the order total rounded up to the nearest hundred. For example, if your order value is Rs.1,235, please pay exactly this amount or Rs.1,300. <br>
The executive will not be able to return any change. Any balance due will be credited directly to your Grofkit wallet which you can utilise in your next order. <br>
The option is currently available only for Grofkit mobile app users. <br>

                                        </span>

                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    Are there any other charges or taxes in addition to the price shown? Is VAT added to the invoice?
                                </h5>
    
                                <li class="fc-2">
                              
                                    There is no VAT. However, GST will be applicable as per Government Regulations.
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    Is it safe to use my credit/ debit card on Grofkit?
                                </h5>
    
                                <li class="fc-2">
                              
                                    Yes it is absolutely safe to use your card on Grofkit.in. A recent directive from RBI makes it mandatory to have an additional authentication pass code verified by VISA (VBV) or MSC (Master Secure Code) which has to be entered by online shoppers while paying online using visa or master credit card. It means extra security for customers, thus making online shopping safer
                                </li>
                            </div>


                            <div class="">
                                <h5 class="mb-0">
                                    What is the meaning of cash on delivery?
                                </h5>
    
                                <li class="fc-2">
                              
                                    Cash on delivery means that you can pay for your order at the time of order delivery at your doorstep.
                                </li>
                            </div>
                            
                            <div class="">
                                <h5 class="mb-0">
                                    If I pay by credit card how do I get the amount back for items not delivered?
                                </h5>
    
                                <li class="fc-2">
                              
                                    If we are not able to delivery all the products in your order and you have already paid for them online, the balance amount will be refunded to your Grofkit account as store credit and you can use it at any time against your future orders. Should you want it to be credited to your bank account please contact our customer support team and we will refund it back on to your card.
                                </li>
                            </div>


                            <div class="">
                                <h5 class="mb-0">
                                    Where do I enter the coupon code?
                                </h5>
    
                                <li class="fc-2">
                              
                                    Once you are done selecting your products and click on checkout you will be prompted to select delivery slot and payment method. On the payment method page there is a box where you can enter any evoucher/ coupon code that you have. The amount will automatically be deducted from your invoice value.
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    What is Grofkit Wallet?
                                </h5>
    
                                <li class="fc-2">
                                    The Grofkit Wallet is a pre-paid credit account that is associated with your Grofkit account. This prepaid account allows you to pay a lump sum amount once to Grofkit and then shop multiple times without having to pay each time.
                                </li>
                            </div>

                           
                        </ul>

                    </section>
                    <section class="faq-policy-4 faq-policy">

                        <h4 class="mb-0 fw-600">
                            Delivery Related
                        </h4>
                        <ul>
                            <div class="">
                                <h5 class="mb-0">
                                    When will I receive my order?
                                </h5>
    
                                <li class="fc-2">
                              
                                    Once you are done selecting your products and click on checkout you will be prompted to select delivery slot. Your order will be delivered to you on the day and slot selected by you. If we are unable to deliver the order during the specified time duration (this sometimes happens due to unforeseen situations).
                                </li>
                            </div>

                           
                            <div class="">
                                <h5 class="mb-0">
                                    How are the fruits and vegetables packaged?
                                </h5>
    
                                <li class="fc-2">
                              
                                    Fresh fruits and vegetables are hand picked, hand cleaned and hand packed in reusable plastic trays covered with cling. We ensure hygienic and careful handling of all our products.
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    How are the fruits and vegetables weighed?
                                </h5>
    
                                <li class="fc-2">
                                    Every fruit and vegetable varies a little in size and weight. While you shop we show an estimated weight and price for everything priced by kilogram. At the time of delivery we weigh each item to determine final price. This could vary by a maximum of one unit weight depending on the article. In case the weight of the product is lesser than what you ordered, you will pay correspondingly less.
                                </li>
                            </div>
                            <div class="">
                                <h5 class="mb-0">
                                    How will the delivery be done?
                                </h5>
    
                                <li class="fc-2">
                              
                                    We have a dedicated team of delivery personnel and a fleet of vehicles operating across the city which ensures timely and accurate delivery to our customers.
                                </li>
                            </div>


                            <div class="">
                                <h5 class="mb-0">
                                    How do I change the delivery info (address to which I want products delivered)?
                                </h5>
    
                                <li class="fc-2">
                              
                                    You can change your delivery address on our website once you log into your account. Click on "My Account" at the top right hand corner and go to the "Update My Profile" section to change your delivery address.

                                </li>
                            </div>
                         

                           
                        </ul>

                    </section>

                    <section class="faq-policy-5 faq-policy">

                        
                        <ul>
                            <li class="fc-2">
                                If you have any complaints or suggestions about the content published on   
                                <a href="" class="text-decoraion-none text-theme">Grofkit@gmail.com </a> <br> please write to our Grievance Officer at
<a href="" class="text-decoraion-none text-theme">aditya@grofkit.in</a> 

                            </li>
                        </ul>

                    </section>
                   
                </div> 
            </div>
        </div>


        
    
    </div>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets1/css/myorder.css">

    <link rel="stylesheet" href="assets1/css/mediaquery.css">




    
</body>
</html>