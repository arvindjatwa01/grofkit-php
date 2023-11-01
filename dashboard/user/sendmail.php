<?php


if (isset($_POST['isset'])) {
    $res_email = $_POST['res_email'];

    $bodydat = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div style="background-color: #e2e1e0; font-family: Open Sans, sans-serif; font-size: 100%; font-weight: 400; line-height: 1.4; color: #000;">
        <table style="max-width: 670px;
                    margin: 20px auto 10px;
                    background-color: #fff;
                    padding: 20px;
                    -webkit-border-radius: 3px;
                    -moz-border-radius: 3px;
                    border-radius: 0px;
                    -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                    -moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                    border-top: solid 10px rgb(226 225 224); border-bottom: solid 10px rgb(226 225 224);">
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
    $mail = new PHPMailer;
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'shopxct2@gmail.com';                   // SMTP username
    $mail->Password = 'Rohit@123';                             // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom($res_email);
    $mail->addAddress('joe@example.com');     // Add a recipient
    $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('info@example.com');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    // Add attachments
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Cart-logo';
    $mail->Body    = $bodydat;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}
