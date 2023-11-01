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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Grofkit | Terms of use</title>

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
        <header  class="container-fluid position-sticky top-0  bg-black ">

            <div class="row">
                <div class="col-12 position-relative d-flex align-items-center justify-content-center">
                    <a class="las la-arrow-left btn-back text-white text-decoration-none fw-bolder" href="<?php echo $backtoPage; ?>"></a>


                    </a>
                    <span class="fc-1 fw-600">Terms Of Use </span>
                </div>
            </div>

                

            
           

        </header>

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <section class="policy-tu-1 ">
                        <h6 class="fc-2">The Grofkit is an all-in-one online marketplace that located in Bihar, India, this is a platform that provide the grocery and other products in local area. Customers will be able to shop for all type of products right from this platform. </h6>
                        <h6 class="fc-2">We’re committed to providing a secure and fair marketplace for our buyers. To support this commitment, we’ve put in place rules and policies that govern our expectations of buyers, the actions we’ll tale to keep you safe, and how Grofkit will protect you. </h6>
                        <h6 class="fc-2">By following our policies, you'll help us maintain a safe environment for all, and be able to avoid interruptions that might come from inadvertent violations of our rules.</h6>
                        <h6 class="fc-2">Some of our rules reflect local legal requirements, while others are based on our experience of how best to protect everyone using Grofkit services.</h6>
                        <h6 class="fc-2">In our policy section, you'll find information on items that can and can't be sold, guides to creating and maintaining listings, details on how we protect your personal details and more.</h6>
                        <h6 class="fc-2">You can also find our User Agreement, User Privacy Notice, and Cookie Notice. These lay out the most critical information around our terms of use, the information we collect from you, and how we keep that information safe.</h6>
                        <h6 class="fc-2">Grofkit is the licensed owner of the brand the website grofkit.in. As a visitor to the Site/ Customer you are advised to please read the Term & Conditions carefully. By accessing the services provided by the Site you agree to the terms provided in this Terms & Conditions document.</h6>
                    </section>

                    <section class="policy-tu-2 ">
                        <h6 class="mb-0">REGISTRATION & SECURITY</h6>
                        <ul>
                            <li class="fc-2">
                                	Any person may access the Website and the Products either by registering to the Website or using the Website as a guest.
                            </li>
                            <li class="fc-2">
                                	Once registered, you will receive a confirmation mail on your registered email address regarding the password and account designation upon completing the Website's registration process.
                            </li>
                            <li class="fc-2">	User are responsible for maintaining the confidentiality of the password and account and are fully responsible for all activities that occur under your password or account.</li>
                            <li class="fc-2">
                                	User will notify Grofkit of any unauthorized use of their password or account or any other breach of security.
                            </li>
                            <li class="fc-2">
                                	Grofkit cannot and will not be liable for any loss or damage arising from user’s failure to comply with the Terms and reasonably expected good practices in this regard.
                            </li>
                        </ul>
                    </section>

<section class="policy-tu-3 ">
                        <h6 class="mb-0">TERMS OF SALE</h6>

                        <ul>
                            <li class="fc-2">
                                	Once User place an order with Grofkit, you thus agree to abide by the following terms and conditions:


                            </li>
                            <li class="fc-2">All the orders placed with us are subject to availability of the desired product.</li>
                            <li class="fc-2">Once an order is placed, an acknowledgement e-mail stating the confirmation of User’s order will be received by the User. Please note that this acknowledgement does not mean the acceptance of User’s order. User’s order is only accepted once the payment is received from your credit/debit card/account.</li>
                            <li class="fc-2">A standard authorization check is carried out on your payment card once your order is received by us. This is done solely to make sure that you have sufficient funds and thus user’s transaction can be carried out without any hindrance.</li>
                            <li class="fc-2">We make our best efforts to ensure that the product descriptions and set prices are accurate. However, error may occur. If it is discovered by us that the mentioned price at which you placed the order is incorrect, user will be informed by us at the earliest. You will be given the following two options –</li>
                            <li class="fc-2">User can reconfirm your order at the corrected new price; If user does not wish to make the purchase any longer, you can cancel your order;</li>
                            <li class="fc-2">In case we are unable to contact you regarding the price change, your order will be considered as cancelled, and the debited amount will be refunded back to your respective account.</li>
                            <li class="fc-2">We offer you promotional discount codes that are applicable on the purchases made on this website. These discount codes can be applicable on all or certain specified products. Please note that use of only one discount code is permissible per order. You cannot use a discount code if an order is already placed.</li>
                        </ul>
                    </section>  

                     <section class="policy-tu-4 policy-same">
                        <h6>Personal Information</h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                As part of the registration process on the Site, Grofkit may collect the following personally identifiable information about you: Name including first and last name, alternate email address, mobile phone number and contact details, Postal code, Demographic profile (like your age, gender, occupation, education, address etc.) and information about the pages on the site you visit/access, the links you click on the site, the number of times you access the page and any such browsing information.
                            </li>
                        </ul>
                    </section>
                    <section class="policy-tu-5 policy-same">
                        <h6>Eligibility</h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                Services of the Site would be available to only select geographies in India. Persons who are "incompetent to contract" within the meaning of the Indian Contract Act, 1872 including un-discharged insolvents etc. are not eligible to use the Site. If you are a minor i.e. under the age of 18 years but at least 13 years of age you may use the Site only under the supervision of a parent or legal guardian who agrees to be bound by these Terms of Use. If your age is below 18 years your parents or legal guardians can transact on behalf of you if they are registered users. You are prohibited from purchasing any material which is for adult consumption and the sale of which to minors is prohibited
                            </li>
                        </ul>
                    </section>
                    <section class="policy-tu-6 policy-same">
                        <h6>License & Site access</h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                Grofkit grants you a limited sub-license to access and make personal use of this site and not to download (other than page caching) or modify it, or any portion of it, except with express written consent of Grofkit. This license does not include any resale or commercial use of this site or its contents; any collection and use of any product listings, descriptions, or prices; any derivative use of this site or its contents; any downloading or copying of account information for the benefit of another merchant; or any use of data mining, robots, or similar data gathering and extraction tools. This site or any portion of this site may not be reproduced, duplicated, copied, sold, resold, visited, or otherwise exploited for any commercial purpose without express written consent of Grofkit. You may not frame or utilize framing techniques to enclose any trademark, logo, or other proprietary information (including images, text, page layout, or form) of the Site or of Grofkit and its affiliates without express written consent. You may not use any meta tags or any other "hidden text" utilizing the Site’s or Grofkit’s name or trademarks without the express written consent of Grofkit. Any unauthorized use terminates the permission or license granted by Grofkit
                            </li>
                        </ul>
                    </section>
                    <section class="policy-tu-7 policy-same">
                        <h6>Account & Registration Obligations</h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                All shoppers have to register and login for placing orders on the Site. You have to keep your account and registration details current and correct for communications related to your purchases from the site. By agreeing to the terms and conditions, the shopper agrees to receive promotional communication and newsletters upon registration. The customer can opt out either by unsubscribing in "My Account" or by contacting the customer service. 
                            </li>
                        </ul>
                    </section>
                 <section class="policy-tu-8 policy-same">
                        <h6>Pricing</h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                All the products listed on the Site will be sold at MRP unless otherwise specified. The prices mentioned at the time of ordering will be the prices charged on the date of the delivery. Although prices of most of the products do not fluctuate on a daily basis but some of the commodities and fresh food prices do change on a daily basis. In case the prices are higher or lower on the date of delivery not additional charges will be collected or refunded as the case may be at the time of the delivery of the order.
                            </li>
                        </ul>
                    </section>

                    <section class="policy-tu-9 policy-same">
                        <h6>Cancellation by Site / Customer</h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                You as a customer can cancel your order anytime up to the cut-off time of the slot for which you have placed an order by calling our customer service. In such a case we will refund any payments already made by you for the order. If we suspect any fraudulent transaction by any customer or any transaction which defies the terms & conditions of using the website, we at our sole discretion could cancel such orders. We will maintain a negative list of all fraudulent transactions and customers and would deny access to them or cancel any orders placed by them. 
                            </li>
                            <li class="fc-2">
                                Unless an order is cancelled by you, the buyer,order acceptance does not occur until Grofkit has emailed you informing you that your order has been dispatched. Once this has occurred, the sale contract has concluded.
                            </li>
                        </ul>
                    </section>

                    

                 <section class="policy-tu-11 policy-same">
                        <h6>Return & Refunds
                            
                            </h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                We have a "no questions asked return and refund policy" which entitles all our members to return the product at the time of delivery if due to some reason they are not satisfied with the quality or freshness of the product. We will take the returned product back with us and issue a credit note for the value of the return products which will be credited to your account on the Site. This can be used to pay your subsequent shopping bills.
                            </li>
                        </ul>
                    </section>


                    <section class="policy-tu-12 policy-same">
                        <h6>You Agree and Confirm</h6>
                        <ul class="">
                            <li class="fc-2">
                                	That in the event that a non-delivery occurs on account of a mistake by you (i.e. wrong name or address or any other wrong information) any extra cost incurred by Grofkit for redelivery shall be claimed from you.
                            </li>

                            <li class="fc-2">
                            	That you will use the services provided by the Site, its affiliates, consultants and contracted companies, for lawful purposes only and comply with all applicable laws and regulations while using and transacting on the Site.
                            </li>

                            <li class="fc-2">
                                	You will provide authentic and true information in all instances where such information is requested of you. Grofkit reserves the right to confirm and validate the information and other details provided by you at any point of time. If upon confirmation your details are found not to be true (wholly or partly), it has the right in its sole discretion to reject the registration and debar you from using the Services and / or other affiliated websites without prior intimation whatsoever.
                            </li>


                            <li class="fc-2">
                                	You authorise Grofkit to contact you for any transactional purposes related to your order/account.
                            </li>


                            <li class="fc-2">
                                	That you are accessing the services available on this Site and transacting at your sole risk and are using your best and prudent judgment before entering into any transaction through this Site.
                            </li>



                            <li class="fc-2">
                                	That the address at which delivery of the product ordered by you is to be made will be correct and proper in all respects.
                            </li>


                            <li class="fc-2">
                                	That before placing an order you will check the product description carefully. By placing an order for a product you agree to be bound by the conditions of sale included in the item's description.
                            </li>


                        </ul>
                    </section>

                    <section class="policy-tu-13 policy-same">
                        <h6>You may not use the Site for any of the following purposes:</h6>
                        <ul class="">
                            <li class="fc-2">
                                	Disseminating any unlawful, harassing, libellous, abusive, threatening, harmful, vulgar, obscene, or otherwise objectionable material.
                               
                                
                                	
                                
                            </li>

                            <li class="fc-2">
                                Transmitting material that encourages conduct that constitutes a criminal offence or results in civil liability or otherwise breaches any relevant laws, regulations or code of practice.
                            </li>

                            <li class="fc-2">
                                Gaining unauthorized access to other computer systems.
                            </li>


                            <li class="fc-2">
                                	Interfering with any other person's use or enjoyment of the Site.

                            </li>


                            <li class="fc-2">
                                	Breaching any applicable laws;

                            </li>



                            <li class="fc-2">
                                	Interfering or disrupting networks or web sites connected to the Site.

                            </li>


                            <li class="fc-2">
                                Making, transmitting or storing electronic copies of materials protected by copyright without the permission of the owner.
                            </li>


                        </ul>
                    </section> 

                    <section class="policy-tu-14 policy-same">
                        <h6>Colours
                            
                            </h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                We have made every effort to display the colours of our products that appear on the Website as accurately as possible. However, as the actual colours you see will depend on your monitor, we cannot guarantee that your monitor's display of any colour will be accurate.
                            </li>
                        </ul>
                    </section>

                    <section class="policy-tu-15 policy-same">
                        <h6>Modification of Terms & Conditions of Service
                            
                            </h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                Grofkit may at any time modify the Terms & Conditions of Use of the Website without any prior notification to you. You can access the latest version of these Terms & Conditions at any given time on the Site. You should regularly review the Terms & Conditions on the Site. In the event the modified Terms & Conditions is not acceptable to you, you should discontinue using the Service. However, if you continue to use the Service you shall be deemed to have agreed to accept and abide by the modified Terms & Conditions of Use of this Site.
                            </li>
                        </ul>
                    </section>
                    <section class="policy-tu-16 policy-same">
                        <h6>Governing Law and Jurisdiction
                            
                            </h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                This User Agreement shall be construed in accordance with the applicable laws of India. The Courts at Bihar shall have exclusive jurisdiction in any proceedings arising out of this agreement. Any dispute or difference either in interpretation or otherwise, of any terms of this User Agreement between the parties hereto, the same shall be referred to an independent arbitrator who will be appointed by Grofkit and his decision shall be final and binding on the parties hereto. The above arbitration shall be in accordance with the Arbitration and Conciliation Act, 1996 as amended from time to time. The arbitration shall be held in Bihar. The High Court of judicature at Bihat alone shall have the jurisdiction and the Laws of India shall apply.
                            </li>
                        </ul>
                    </section>
                    <section class="policy-tu-17 policy-same">
                        <h6>Reviews, Feedback, Submissions
                            
                            </h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                              All reviews, comments, feedback, postcards, suggestions, ideas, and other submissions disclosed, submitted or offered to the Site on or by this Site or otherwise disclosed, submitted or offered in connection with your use of this Site (collectively, the "Comments") shall be and remain the property of Grofkit. Such disclosure, submission or offer of any Comments shall constitute an assignment to Grofkit of all worldwide rights, titles and interests in all copyrights and other intellectual properties in the Comments. Thus, Grofkit owns exclusively all such rights, titles and interests and shall not be limited in any way in its use, commercial or otherwise, of any Comments. Grofkit will be entitled to use, reproduce, disclose, modify, adapt, create derivative works from, publish, display and distribute any Comments you submit for any purpose whatsoever, without restriction and without compensating you in any way. Grofkit is and shall be under no obligation (1) to maintain any Comments in confidence; (2) to pay you any compensation for any Comments; or (3) to respond to any Comments. You agree that any Comments submitted by you to the Site will not violate this policy or any right of any third party, including copyright, trademark, privacy or other personal or proprietary right(s), and will not cause injury to any person or entity. You further agree that no Comments submitted by you to the Website will be or contain libelous or otherwise unlawful, threatening, abusive or obscene material, or contain software viruses, political campaigning, commercial solicitation, chain letters, mass mailings or any form of "spam".Please note all reviews submitted by customers are subject to checks and moderation by our content Team. Grofkit reserves the rights to moderate as well as publish/not publish the reviews. Grofkit reserves the rights to solicit or withhold reviews and ratings with no liability. Grofkit reserve the right to accept, reject, moderate, monitor & edit or remove any comment. You grant Grofkit the right to use the name that you submit in connection with any Comments. You agree not to use a false email address, impersonate any person or entity, or otherwise mislead as to the origin of any Comments you submit. You are and shall remain solely responsible for the content of any Comments you make, and you agree to indemnify Grofkit and its affiliates for all claims resulting from any Comments you submit. Grofkit and its affiliates take no responsibility and assume no liability for any Comments submitted by you or any third party.
                            </li>
                        </ul>
                    </section>
                    <section class="policy-tu-18 policy-same">
                        <h6>Copyright & Trademark
                            
                            </h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                              Grofkit, its suppliers and licensors expressly reserve all intellectual property rights in all text, programs, products, processes, technology, content and other materials, which appear on this Site. Access to this Website does not confer and shall not be considered as conferring upon anyone any license under any of Grofkit or any third party's intellectual property rights. All rights, including copyright, in this website are owned by or licensed to Grofkit . Any use of this website or its contents, including copying or storing it or them in whole or part, other than for your own personal, non-commercial use is prohibited without the permission of Grofkit . You may not modify, distribute or re-post anything on this website for any purpose.The names and logos and all related product and service names, design marks and slogans are the trademarks or service marks of Grofkit, its affiliates, its partners or its suppliers. All other marks are the property of their respective companies. No trademark or service mark license is granted in connection with the materials contained on this Site. Access to this Site does not authorize anyone to use any name, logo or mark in any manner.References on this Site to any names, marks, products or services of third parties or hypertext links to third party sites or information are provided solely as a convenience to you and do not in any way constitute or imply Grofkit  endorsement, sponsorship or recommendation of the third party, information, product or service. Grofkit is not responsible for the content of any third party sites and does not make any representations regarding the content or accuracy of material on such sites. If you decide to link to any such third party websites, you do so entirely at your own risk.All materials, including images, text, illustrations, designs, icons, photographs, programs, music clips or downloads, video clips and written and other materials that are part of this Website (collectively, the "Contents") are intended solely for personal, non-commercial use. You may download or copy the Contents and other downloadable materials displayed on the Website for your personal use only. No right, title or interest in any downloaded materials or software is transferred to you as a result of any such downloading or copying. You may not reproduce (except as noted above), publish, transmit, distribute, display, modify, create derivative works from, sell or participate in any sale of or exploit in any way, in whole or in part, any of the Contents, the Website or any related software. All software used on this Website is the property of Grofkit or its licensees and suppliers and protected by Indian and international copyright laws. The Contents and software on this Website may be used only as a shopping resource. Any other use, including the reproduction, modification, distribution, transmission, republication, display, or performance, of the Contents on this Website is strictly prohibited. Unless otherwise noted, all Contents are copyrights, trademarks, trade dress and/or other intellectual property owned, controlled or licensed by Grofkit, one of its affiliates or by third parties who have licensed their materials to Grofkit and are protected by Indian and international copyright laws. The compilation (meaning the collection, arrangement, and assembly) of all Contents on this Website is the exclusive property of Grofkit and is also protected by Indian and international copyright laws.
                            </li>
                        </ul>
                    </section>

                    <section class="policy-tu-19 policy-same">
                        <h6>Objectionable Material
                            
                            </h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                You understand that by using this Site or any services provided on the Site, you may encounter Content that may be deemed by some to be offensive, indecent, or objectionable, which Content may or may not be identified as such. You agree to use the Site and any service at your sole risk and that to the fullest extent permitted under applicable law, Grofkit and its affiliates shall have no liability to you for Content that may be deemed offensive, indecent, or objectionable to you.
                            </li>
                        </ul>
                    </section>

                    <section class="policy-tu-20 policy-same">
                        <h6>Indemnity
                            
                            </h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                You agree to defend, indemnify and hold harmless Grofkit, its employees, directors, officers, agents and their successors and assigns from and against any and all claims, liabilities, damages, losses, costs and expenses, including attorney's fees, caused by or arising out of claims based upon your actions or inactions, which may result in any loss or liability to Grofkit or any third party including but not limited to breach of any warranties, representations or undertakings or in relation to the non-fulfilment of any of your obligations under this User Agreement or arising out of the your violation of any applicable laws, regulations including but not limited to Intellectual Property Rights, payment of statutory dues and taxes, claim of libel, defamation, violation of rights of privacy or publicity, loss of service by other subscribers and infringement of intellectual property or other rights. This clause shall survive the expiry or termination of this User Agreement.
                            </li>
                        </ul>
                    </section>
                    
                    <section class="policy-tu-21 policy-same">
                        <h6>Termination
                            
                            </h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                This User Agreement is effective unless and until terminated by either you or Grofkit. You may terminate this User Agreement at any time, provided that you discontinue any further use of this Site. Grofkit may terminate this User Agreement at any time and may do so immediately without notice, and accordingly deny you access to the Site, Such termination will be without any liability to Grofkit. Upon any termination of the User Agreement by either you or Grofkit, you must promptly destroy all materials downloaded or otherwise obtained from this Site, as well as all copies of such materials, whether made under the User Agreement or otherwise. Grofkit’s right to any Comments shall survive any termination of this User Agreement. Any such termination of the User Agreement shall not cancel your obligation to pay for the product already ordered from the Website or affect any liability that may have arisen under the User Agreement. 
                            </li>
                        </ul>
                    </section>

                    <section class="policy-tu-22 policy-same">
                        <h6>- ENTIRE AGREEMENT
                            
                            </h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                The failure of us to exercise or enforce any right or provision of these Terms of Service shall not constitute a waiver of such right or provision.
                                These Terms of Service and any policies or operating rules posted by us on this site or in respect to The Service constitutes the entire agreement and understanding between you and us and govern your use of the Service, superseding any prior or contemporaneous agreements, communications and proposals, whether oral or written, between you and us (including, but not limited to, any prior versions of the Terms of Service).
                                Any ambiguities in the interpretation of these Terms of Service shall not be construed against the drafting party
                                
                            </li>
                        </ul>
                    </section>

                    <section class="policy-tu-23 policy-same">
                        <h6>Other terms
                            
                            </h6>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                We do not guarantee continuous, uninterrupted or secure access to our website and operation of our website may be interfered with or adversely affected by numerous factors or circumstances beyond of our control.
                                For further information, about any of the information in this statement, please contact us via email at 
                                <a href="mailto:Grofkit@gmail.com" class=" text-decoration-none text-theme">
                                    Grofkit@gmail.com
                                </a> 
                                From time to time we may change the Terms and Conditions on www.grofkit.in, so please make sure you have read our Terms and Conditions at the time of purchase. Your continued use of our site will signify your acceptance of these changes.
                                
                            </li>
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


    <script src="assets1/js/main.js"></script>

    
</body>
</html>