<?php
// PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Base files 
require './src/Exception.php';
require './src/PHPMailer.php';
require './src/SMTP.php';
// create object of PHPMailer class with boolean parameter which sets/unsets exception.


if (isset($_POST['isset'])) {
    $res_email = $_POST['res_email'];


    $mail = new PHPMailer(true);
    try {
        // $Name =$_REQUEST['fname']." ".$_REQUEST['lname'];
        // $Email =$_REQUEST['email'];
        // $Moblie =$_REQUEST['mobile'];
        // $Project_interest =$_REQUEST['project'];
        // $Messages =$_REQUEST['message'];

        $mail->isSMTP(); // using SMTP protocol                                     
        $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
        $mail->SMTPAuth = true;  // enable smtp authentication                             
        $mail->Username = 'shopxct2@gmail.com';  // sender gmail host              
        $mail->Password = 'Rohit@123'; // sender gmail host password                          
        $mail->SMTPSecure = 'tls';  // for encrypted connection                           
        $mail->Port = 587;   // port for SMTP     

        $mail->setFrom('shopxct2@gmail.com', "Sender"); // sender's email and name
        $mail->addAddress($res_email, "Receiver");  // receiver's email and name
        $mail->addAttachment('C:/xampp/htdocs/imageediter/uploads/company_image/1648216979879-master.png');
        $mail->isHTML(true);
        $mail->Subject = "Cart-logo";
        $mail->Body = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    
    <body>
        <div style="background-color: #e2e1e0; font-family: Open Sans, sans-serif; font-size: 100%; font-weight: 400; line-height: 1.4; color: #000;">
            <table style="
                        max-width: 670px;
                        margin: 20px auto 10px;
                        background-color: #fff;
                        padding: 20px;
                        -webkit-border-radius: 3px;
                        -moz-border-radius: 3px;
                        border-radius: 0px;
                        -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                        -moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                        border-top: solid 10px rgb(226 225 224); border-bottom: solid 10px rgb(226 225 224);
                    ">
                <thead>
                    <tr>
                        <th style="text-align: left;">
                            <img style="max-width: 150px;" src="https://app.card-logo.com/frontend/img/logo-kortlogo.png" alt=" fantasylawn " />
                        </th>
                        <th style="text-align: right; font-weight: 400; ">
                            <p>Leveret af </p>
                            <img src="http://localhost:8090/imageediter/user/assets/logo-kortlogo.png" alt="">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 10px; "></td>
                    </tr>
    
                    <tr>
                        <td colspan="2 ">
                            <p style="padding: 0; font-size: 14px; ">
                                <strong>Thank you for choosing to use <a href="# ">kortlogo.dk</a></strong>
                            </p>
                            <p style="padding: 0; font-size: 14px; ">
                                <strong> Your Cart Logos are attached to the email,</strong> so If you do not want to read that email, then you have received your card logos that your Came for :)
                            </p>
    
                            <p style="padding: 0; font-size: 14px; ">
                                Kortlogo is developed by <a href="# "> Bulldesign</a> -a 360 full-service web agency with a focus on e-commerce, digital design, development and conversion optimization. We are your innovative partner that can solve your digital
                                challenges.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style=" padding: 15px; vertical-align: top; " colspan="2 ">
                            <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px; ">
                                We specialize in e-commerce and work, among other things. wit
                            </p>
                            <p style="padding: 0; font-size: 14px; "> - prestashop (We are a Certified PrestaShop Partner)</p>
                            <p style="padding: 0; font-size: 14px; "> - Shopify, WooCommerce and custom PHP shops </p>
                            <p style="padding: 0; font-size: 14px; "> - PHP / Laravel system development</p>
                            <p style="padding: 0; font-size: 14px; "> - UI /UX design</p>
                            <p style="padding: 0; font-size: 14px; "> - System design, dashboard design administration design ETC.</p>
                        </td>
                    </tr>
    
                </tbody>
                <tfooter>
                    <tr>
                        <td colspan="2 " style="font-size: 14px; padding: 50px 15px 0 15px; border-top: 1px solid #cbcbcb; text-align: center; ">
                            <p>Lang mail . If You came down here, then we just want to say thank you again </p>
                            <p>because you used Kortlogo.dk</p>
                            <br />
                            <img src="http://localhost:8090/imageediter/user/assets/logo-kortlogo.png" alt=" ">
                        </td>
                    </tr>
                </tfooter>
            </table>
        </div>
    </body>
    </html>';
        $mail->AltBody = "This is the plain text version of the email content";

        $mail->send();
        echo 'Message has been sent';

        echo '<script> window.location="thank.php"; </script> ';
    } catch (Exception $e) { // handle error.
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
