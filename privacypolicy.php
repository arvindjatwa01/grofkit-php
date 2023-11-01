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
   
    <title>Grofkit | Privacy Policy</title>
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
                    <h6 class="mb-0 fs-3  text-center fw-bold mt-3">PRIVACY POLICY</h6>
                </div>
                <div class="col-12">

                    <section class="policy-tu-1 ">
                        <h6 class="fc-2">Grofkit takes the privacy of your information seriously. This Privacy Notice describes the types of personal information we collect from you through our website (including sub-domains and microsites) and mobile applications. It also describes the purposes for which we collect that personal information, the other parties with whom we may share it and the measures we take to protect the security of your data. It also tells you about your rights and choices with respect to your personal information, and how you can contact us about our privacy practices. </h6>
                        <h6 class="fc-2">You are advised to carefully read this Privacy Notice before using or availing any of our products and/or services. <br>
                            We use SSL technology to protect the security of your credit card information as it is transmitted to us. SSL is the gold standard in encryption technology.
                             </h6>
                     
                    </section>

                    <section class="policy-tu-2 pr-po ">
                        <h5 class="mb-0 text-decoration-underline">YOUR CONSENT</h5>
                        <ul>
                            <li class="fc-2">
                                	Data protection is a matter of trust and your privacy is important to us. We shall therefore only use your name and other information which relates to you in the manner set out in this Privacy Policy. We will only collect information where it is necessary for us to do so and we will only collect information if it is relevant to our dealings with you.
                            </li>
                            <li class="fc-2">
                                	We collect personally identifiable information, which includes but is not limited to names, email addresses, phone no etc. which related to You in the manner set out in this Privacy Policy. We will only collect information where it is necessary for us to do so and we will only collect information if it is relevant to our dealings with You.
                            </li>
                            <li class="fc-2">	We shall use the information collected from You in accordance with applicable laws including but not limited to the Information Technology Act, 2000 and the rules made there under and use the data only for the purpose of completing the transaction or for purposes as may be required under the laws.</li>
                          
                        </ul>
                    </section>

<section class="policy-tu-3 pr-po ">
                        <h5 class="mb-0">DEFINITIONS</h5>

                        <ul class="list-unstyled">
                            <li class="fc-2">
                                In this Privacy Notice, the following definitions are used:


                            </li>
                           
                        </ul>

                        <div class="my-2">
                            <h6 class="mb-0">Cookies</h6>

                            <ul class="list-unstyled">
                                <li class="fc-2">
                                    a small file placed on your device by our website or mobile application when you either visit or use certain features of our website or mobile application. A cookie generally allows a website to remember your actions or preference for a certain period of time.
    
    
                                </li>
                               
                            </ul>
                        </div>
                        <div class="my-2">
                            <h6 class="mb-0">Data</h6>

                            <ul class="list-unstyled">
                                <li class="fc-2">
                                    includes non-personal information, personal information and sensitive personal information about you, which either directly or indirectly in combination with other information, could allow you to be identified when you visit our stores, website and/or mobile application.
    
    
                                </li>
                               
                            </ul>
                        </div>
                        <div class="my-2">
                            <h6 class="mb-0">Data Protection Laws</h6>

                            <ul class="list-unstyled">
                                <li class="fc-2">
                                    any applicable law for the time being in force relating to the processing of Data.
    
    
                                </li>
                               
                            </ul>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-0">User or you</h6>

                            <ul class="list-unstyled">
                                <li class="fc-2">
                                    the natural person who accesses our stores, website or mobile application.
    
    
                                </li>
                               
                            </ul>
                        </div>

                       
                    </section>  

                     <section class="policy-tu-4 pr-po policy-same">
                        <h5 class="mb-0">WHAT DATA DO WE COLLECT ABOUT YOU</h5>

                       
                        <ul class="">
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                Grofkit collects Data for various purposes set out in this Privacy Notice.
                              
	

                            </p>

                            <p class="fc-2 mb-0 my-2 d-inline-block" style="font-weight: 500;">
                                This Data includes, without limitation, the following categories:
	

                            </p>

                            <li class="fc-2"> <strong>Contact information:</strong>  first and last name, email address, postal address, country, phone number and other similar contact data.</li>
                            <li class="fc-2"> <strong> Financial information:</strong> payment instrument information, transactions, transaction history, preferences, method, mode and manner of payment, spending pattern or trends, and other similar data.</li>
                            <li class="fc-2"> <strong> Technical information:</strong> website, device and mobile app usage, Internet Protocol (IP) address and similar information collected via automated means, such as cookies, pixels and similar technologies.</li>
                            <li class="fc-2">  <strong>Transaction information:</strong>  the date of the transaction, total amount, transaction history and preferences and related details.</li>
                            <li class="fc-2">  <strong> Product and service information:</strong>  Your account membership number, registration and payment information, and program-specific information, when you request products and/or services directly from us, or participate in marketing programs.</li>
                            <li class="fc-2"> <strong>Personal information:</strong>  Age, sex, date of birth, marital status, nationality, details of government identification documents provided, occupation, ethnicity, religion, travel history or any other personal information provided in responses to surveys or questionnaires.</li>
                            <li class="fc-2">Your reviews, feedback and opinions about our products, programmes and services.</li>

                            <li class="fc-2 mb-0  " style="font-weight: 500;">
                              <strong> Loyalty programme information:</strong>  your loyalty membership information, account details, profile or password details and any frequent flyer or travel partner programme affiliation.
	

                            </li>
                        </ul>
                    </section>
                    <section class="policy-tu-5 pr-po policy-same">
                        <h5 class="mb-0">HOW WE COLLECT DATA</h5>

                       
                        <ul class="">
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                We collect Data in the following ways:
                              
	

                            </p>

                         

                            <li class="fc-2"> <strong>Information You Give Us: </strong>We receive and store any information you enter on our website or mobile application. Please see the section titled “Data Shared by You” for more information.</li>

                            <li class="fc-2"> <strong>	Automatic Information We Collect:</strong>We use “cookies”, pixels and similar technologies to receive and store certain types of information whenever you interact with us. Please see the section below, titled “Data that is Collected Automatically” for more information.</li>


                            <li class="fc-2"> <strong> 	E-mail Communications: </strong>To help us make e-mails more relevant and interesting, we often receive a confirmation (if your device supports such capabilities) when you open e-mail from us or click on a link in the e-mail. You can choose not to receive marketing emails from us by clicking on the unsubscribe link in any marketing email.</li>


                            <li class="fc-2">  <strong>	Automatic Information We Collect from Other Websites: </strong> We receive and store certain types of information when you interact with third-party websites that use our technology or with whom we have a specific agreement. Because we process this information on behalf of the applicable website operators, collection, processing, and use of such information is subject to the applicable website operators’ privacy policies and is not covered by our Privacy Notice.</li>



                            <li class="fc-2">  <strong>	Information from Other Sources: </strong>  We may obtain information from other sources. An example of this is when you authorize a third-party website, to interact directly with our website or mobile application to provide or receive Data about you. In that case, we might receive such Data used by that third-party website to identify your account with that website.</li>
                           
                            <li class="fc-2">You can make choices about our collection and use of your Data. For example, you may want to access, edit or remove your Data on our website or mobile application. When you are asked to provide Data, you may decline.</li>

                           
                        </ul>
                    </section>


                    <section class="policy-tu-6 pr-po policy-same">
                        <h5 class="mb-0">DATA SHARED BY YOU</h5>

                       
                        <ul class="">
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                Grofkit may collect your Data in several ways from your use of our website or mobile application. For instance:
                              
	

                            </p>

                         

                            <li class="fc-2">	when you register with us to receive our products and/or services;</li>

                            <li class="fc-2"> 	when you conduct a transaction with us or attempt a transaction on our website or mobile application;</li>


                            <li class="fc-2"> 	when you complete surveys conducted by or for us;</li>


                            <li class="fc-2">	when you elect to receive any communications (including promotional offers) from us;</li>



                            <li class="fc-2">	from the information gathered by your visit to our website or mobile application;</li>
                           
                            <li class="fc-2">You can make choices about our collection and use of your Data. For example, you may want to access, edit or remove your Data on our website or mobile application. When you are asked to provide Data, you may decline.</li>

                           
                        </ul>
                    </section>
                    <section class="policy-tu-7 pr-po policy-same">
                        <h5 class="mb-0">DATA THAT IS COLLECTED AUTOMATICALLY</h5>

                       
                        <ul class="">
                           

                         

                            <li class="fc-2">	We automatically collect some information when you visit our website or use our mobile application. This information helps us to make improvements to our content and navigation. The information collected automatically includes your IP address.</li>

                            <li class="fc-2"> 	Our web servers or affiliates who provide analytics and performance enhancement services collect IP addresses, operating system details, browsing details, device details and language settings. This information is aggregated to measure the number of visits, average time spent on the site, pages viewed and similar information. Grofkit uses this information to measure the site usage, improve content and to ensure safety and security, as well enhance performance of our website or mobile application.</li>


                            <li class="fc-2"> 	We may collect your Data automatically via Cookies, pixels and similar technologies in line with settings on your browser. For more information about Cookies, please see the section below, titled “Cookies”.</li>


                            

                           
                        </ul>
                    </section>



                  <section class="policy-tu-8 pr-po policy-same">
                        <h5 class="mb-0">OUR USE OF DATA</h5>

                       
                        <ul class="">
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                Any or all the above Data may be required by us from time to time to provide information relating to Grofkit and to work on the experience when using our website or mobile application. Specifically, Data may be used by us for the following reasons:
                              
	

                            </p>

                         

                            <li class="fc-2">	carry out our obligations arising from any contract entered into between you and us;</li>

                            <li class="fc-2">	provide products and/or services and communicate with you about products and/or services offered by us;</li>


                            <li class="fc-2">	enable Grofkit to offer their products and/or services and communicate with you about such products and/or services;</li>


                            <li class="fc-2">	provide you with offers (including for financial products and/or services), personalized services and recommendations and improve your experience on our website and mobile application;</li>



                            <li class="fc-2">	operate, evaluate and improve our business, website and mobile application;</li>
                           
                            <li class="fc-2">	generate aggregated data to prepare insights to enable us to understand customer behaviour, patterns and trends with a view to learning more about your preferences or other characteristics;</li>
                            <li class="fc-2">provide privileges and benefits to you, marketing and promotional campaigns based on your profile;</li>
                            <li class="fc-2">		communicate with you (including to respond to your requests, questions, feedback, claims or
                                disputes) and to customize and improve our services;
                                </li>
                            <li class="fc-2">	protect against and prevent fraud, illegal activity, harm, financial loss and other legal or information security risks; and</li>
                            <li class="fc-2">	serve other purposes for which we provide specific notice at the time of collection, and as otherwise authorized or required by applicable law.</li>
                            <p class="fc-2 mb-0 my-2 fw-500 " style="font-weight: 500;">	We treat these inferences as personal information (or sensitive personal information, as the case may be), where required under applicable law. Some of the above grounds for processing will overlap and there may be several grounds which justify our use of your personal information.</p>
                            <p class="fc-2 mb-0 my-2 fw-500 " style="font-weight: 500;">Where required under applicable law, we will only use your personal information with your consent; as necessary to provide you with products and/or services; to comply with a legal obligation; or when there is a legitimate interest that necessitates the use.</p>

                           
                        </ul>
                    </section>

                    <section class="policy-tu-9 pr-po policy-same">
                        <h5 class="mb-0">MINORS</h5>

                       
                        
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                Our website and mobile application do not offer products or services for use by minors. If you are under 18, you may use our website or mobile application only with the involvement of a parent or guardian.
                              
	

                            </p>

                         


                           
                      
                    </section>
                    <section class="policy-tu-10 pr-po policy-same">
                        <h5 class="mb-0">KEEPING DATA SECURE</h5>

                       
                        
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                We will use technical and organisational measures to safeguard your Data and we store your Data on secure servers. Technical and organisational measures include measures to deal with any suspected data breach. If you suspect any misuse or loss or unauthorised access to your Data, please let us know immediately by contacting us by e-mail.
                              
	

                            </p>

                         


                           
                      
                    </section>
                    <section class="policy-tu-11 pr-po policy-same">
                        <h5 class="mb-0">RETENTION OF DATA</h5>

                       
                        
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                Grofkit retains Data for as long as necessary for the use of our products and/or services or to provide access to and use of our website or mobile application, or for other essential purposes such as complying with our legal obligations, resolving disputes, enforcing our agreements and as long as processing and retaining your Data is necessary for our legitimate interests. Because these needs can vary for different data types and purposes, actual retention periods can vary significantly.
                              
	

                            </p>
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                Even if we delete your Data, including on account of exercise of your right under Clause 12 below, it may persist on backup or archival media for audit, legal, tax or regulatory purposes.
                              
	

                            </p>

                         


                           
                      
                    </section>

                    

                


                    <section class="policy-tu-12 list-style-dot pr-po policy-same">
                        <h5 class="mb-0">YOUR RIGHTS AND CHOICES</h5>

                       
                         <ul class="">
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                When we process Data about you, we do so with your consent and/or as necessary to operate our business, meet our contractual and legal obligations, protect the security of our systems and our customers, or fulfil other legitimate interests of Grofkit as described in this Privacy Notice.
                              
	

                            </p>
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                Depending on which Data Protection Laws are applicable to you, you may have the right or choice to:
                              
	

                            </p>

                         

                            <li class="fc-2">	opt-out of some collection or uses of your Data, including the use of cookies, pixels and similar technologies and the use of your Data for marketing purposes.</li>

                            <li class="fc-2">	access your Data, rectify it, restrict or object to its processing, or request its deletion or anonymization.</li>


                            <li class="fc-2">	receive the Data you provided to us to transmit it to another company.</li>


                            <li class="fc-2">	withdraw any consent provided or alter your preferences.</li>



                            <li class="fc-2">	where applicable, lodge a complaint with your supervisory authority.</li>


                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                You may submit a request as described in the “How to Contact Us” section below. We will not charge you for any request. Where we are legally permitted to do so, we may refuse your request. If we refuse your request, we will tell you the reasons why.
                                
                                
                              
	

                            </p>
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                Below, you will find additional privacy information that you may find important. Data Protection Laws, depending on your country, may include the following rights in relation to your Data:
                              
	

                            </p>
                           
                             <ul class=" ps-0">
                                
    
                             
    
                                    <li class="fc-2 "> <strong class="fst-italic">Right to Confirmation and Access -</strong>	 the right to confirm our methods of processing and request <br>
                                   <span class="my-2 d-inline-block">
                                    (i) copies of the information we hold about you at any time, or
                                   </span> <br>
                                   <span class="my-2">
                                    (ii) that we modify, update or delete such information.

                                   </span>
                                    </li> 
    
                                  

                                         <li class="fc-2"> <strong class="fst-italic">	Right to Correction -</strong>the right to have your Data rectified if it is inaccurate or incomplete. 
                                            
                                             </li>

                                             <li class="fc-2"> <strong class="fst-italic">	Right to be Forgotten  -</strong>the right to request that we delete or remove your Data from our systems. 
                                            
                                             </li>

                                             <li class="fc-2"> <strong class="fst-italic">	Right to Restrict / Object to Our Use of your Data - </strong>the right to limit the way in which we can use it.
                                            
                                             </li>
                                             <li class="fc-2"> <strong class="fst-italic">	Right to Withdraw Consent - </strong>the right to request that we move, copy or transfer your Data.
                                            
                                             </li>
                                             <li class="fc-2"> <strong class="fst-italic">	Right to File Complaints -</strong>the right to raise complaints to a regulatory authority. 
                                            
                                             </li>

                                             <p class="fc-2 mb-0 word-wrap my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                                For information about managing your Data and promotional communications, please e-mail us at <a href=""  class=" text-decoration-none text-theme text-break">grievanceofficer@grofkit.com</a>. 
                                                
                                                
                                              
                    
                
                                            </p>
                                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                                It is important that the Data we hold about you is accurate and current. Please keep us informed if your personal information changes during the period for which we hold it. 
                                              
                    
                
                                            </p>
    
    
                               
                               
    
                               
                            </ul> 

                           
                        </ul> 
                    </section>

                    <section class="policy-tu-pri-13  pr-po  policy-same">
                        <h5>WHERE WE STORE DATA
                            
                            
                            </h5>
                        <ul class="list-unstyled">

                               
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                Data collected under this Privacy Notice is hosted on servers located in India.

                              
	

                            </p>
                            
                        </ul>
                    </section>

                    <section class="policy-tu-pri-14  pr-po  policy-same">
                        <h5>PROCESSING YOUR DATA
                            
                            
                            </h5>
                        <ul class="list-unstyled">
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                We take steps to ensure that the Data we collect under this Privacy Notice is processed according to the provisions of this Privacy Notice and the requirements of applicable law.

                              
	

                            </p>
                           
                        </ul>
                    </section>

                    <section class="policy-tu-pri-15  pr-po  policy-same">
                        <h5>SEVERABILITY
                            
                            
                            </h5>
                        <ul class="list-unstyled">
                            
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                If any court or competent authority finds that any provision of this Privacy Notice (or part of any provision) is invalid, illegal or unenforceable, that provision or part-provision will, to the extent required, be deemed to be deleted, and the validity and enforceability of the other provisions of this Privacy Notice will not be affected.

                              
	

                            </p>
                        </ul>
                    </section>
                    <section class="policy-tu-16 pr-po policy-same">
                        <h5 class="mb-0">DISCLOSURES OF YOURE INFORMATION</h5>

                       
                        <ul class="">
                            

                         

                            <li class="fc-2">		We may share your information collected from You with our affiliates, employees, agents, service provider, sellers, suppliers, banks, payment gateway operators and such other individuals and institutions like judicial, quasi-judicial law enforcement agencies to:</li>

                            <li class="fc-2">		You may be linked to our website from our advertisers, network partners or any other third party. We hereby declare that we hold no liability or responsibility for the ‘Privacy Policies’ and ‘Terms & Conditions’ of these web sites. Please read their policies carefully before sharing any of your details.</li>


                            <li class="fc-2">		Notwithstanding anything to the contrary, the Website shall not be held responsible for any loss, damage or misuse of the information provided by You.</li>


                            
                    

                           
                        </ul>
                    </section>
                    <section class="policy-tu-17 pr-po policy-same">
                        <h5 class="mb-0">CHANGES TO THIS PRIVACY NOTICE
                            
                            </h5>
                        <ul class="list-unstyled">
                            <li class="fc-2">
                                Our business changes constantly and our Privacy Notice will change also. We may e-mail periodic reminders of our notices and conditions, unless you have instructed us not to, but you should check our website and mobile application frequently to see recent changes. The updated version will be effective as soon as it is accessible. Any changes will be immediately posted on our website and mobile application and you are deemed to have accepted the terms of the updated Privacy Notice on your first use of our website or mobile application or first purchase of the products and/or services following the alterations. We encourage you to review this Privacy Notice frequently to be informed of how we are protecting your information.
                            </li>
                        </ul>
                    </section>
                   
                     <section class="policy-tu-pri-18  pr-po  policy-same">
                        <h5>HOW TO CONTACT US
                            
                            
                            </h5>
                        <ul class="list-unstyled">
                            
                            <p class="fc-2 mb-0 my-2  fw-500 d-inline-block" style="font-weight: 500;">
                                To request to review, update, or delete your personal information or to otherwise reach us, please submit a request by e-mailing us at: <a href="" class="text-decoration-none text-theme text-break">Grofkit@gmail.com</a>. You may contact us for information. We will respond to your request within 30 days.

                              
	

                            </p>
                        </ul>
                    </section> 
                     <section class="policy-tu-pri-19  pr-po  policy-same">
                        <h5>GRIEVANCE OFFICER
                            
                            
                            </h5>
                        <ul class="list-unstyled">
                            
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                Please see below the details of our grievance officer:
	

                            </p> <br>
                            <p class="fc-2 mb-0 my-2 fw-500 d-inline-block" style="font-weight: 500;">
                                Name: Aditya mishra
	

                            </p> <br> 
                            <p class="fc-2 mb-0 my-2 text-break fw-500 d-inline-block" style="font-weight: 500;">
                                Email: <a href="" class="text-decoration-none text-break text-break text-theme">aditya@grofkit.in </a> 
                                <!--<br> prabhakaran.krishnan@bigbasket.com -->
	

                            </p> <br>
                            <p class="fc-2 mb-0 my-2 fw-500 text-wrap d-inline-block" style="font-weight: 500;">
                                Address: balughat dhalan muzaffarpur bihar-842001
	

                            </p>
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