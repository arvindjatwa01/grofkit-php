<?php
require("./config/config.php");
require('pay_config.php');

// session_start();

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)

        
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    date_default_timezone_set('Asia/Kolkata');
    $date = date('jnY');
    $razorpay_order_id = $_SESSION['razorpay_order_id'];
    $razorpay_payment_id= $_POST['razorpay_payment_id'];
    $razorpay_signature = $_POST['razorpay_signature'];
    $userID =  $_POST['login_user_id'];
    
    $userName =  $_POST['checked_user_name'];
    $emailAdd =  $_POST['checked_user_email'];
    $ordered_user_mobile =  $_POST['checked_user_mobile'];
    $ordered_user_address1 =  $_POST['checked_user_address1'];
    $ordered_user_address2 =  $_POST['checked_user_address2'];
    $ordered_user_pincode =  $_POST['checked_user_pincode'];
    $ordered_user_city =  $_POST['checked_user_city'];
    $ordered_user_state =  $_POST['checked_user_state'];
    $ordered_user_country =  $_POST['checked_user_country'];
    $finalcost =  $_POST['checked_user_finalcost'];
    $discountRate =  $_POST['checked_user_coupanrate'];
    $coupanName = $_POST['checked_user_coupanName'];
    
    $shippingCost = $_POST['checked_user_shippingCost'];
    $totalBftAmount = $_POST['checked_user_bftAmount'];
    $gstAmount = $_POST['checked_user_gstAmount'];
    
    $sql1 = "INSERT INTO `order` (ord_userid, ord_userName, ord_emailid, ord_mobilNo, ord_AddressLine1, ord_AddressLine2, ord_country, ord_State, ord_City, ord_postalcode, OrderTotalAmount, ord_TotalDiscount,razorpay_order_id,razorpay_signature,razorpay_payment_id,OrderTotalBftAmount,OrdertaxAmount,ord_DeliveryCost,ord_paymentMethod) VALUES('$userID', '$userName', '$emailAdd', '$ordered_user_mobile', '$ordered_user_address1', '$ordered_user_address2', '$ordered_user_country', '$ordered_user_state', '$ordered_user_city', '$ordered_user_pincode','$finalcost', '$discountRate','$razorpay_order_id','$razorpay_signature','$razorpay_payment_id','$totalBftAmount','$gstAmount','$shippingCost',1)";
    
    $result1 =  $dbh->query($sql1);
    $lastInsertId= $dbh->lastInsertId();
    if($result1){
        
    /* ==================== Update Order Number =================== */
    
    $sql2 ="UPDATE `order` SET ord_OrderNo = '$lastInsertId$date', OrderStatusID = '1' WHERE ord_id = '$lastInsertId'";
    $result2 =  $dbh->query($sql2);
    
    if($result2){
            $sql3 = "SELECT cart.cart_Id, cart.cart_UserID, cart.cart_itemId, cart.cart_volume, cart.cart_UnitId,cart.cart_volume, item.ite_Name, item.ite_Rate, unit.un_Code FROM cart LEFT JOIN item ON cart_itemId = ite_Id LEFT JOIN unit ON cart_UnitId = un_ID WHERE cart_UserID =$userID";
            
            $result3 =  $dbh->query($sql3);
            $resultIs = $result3->fetchAll();
            foreach($resultIs as $rowResultdata){
                $itemId = $rowResultdata['cart_itemId'];
                $itemName =$rowResultdata['ite_Name'];
                $unitId = $rowResultdata['cart_UnitId'];
                $unitName = $rowResultdata['un_Code'];
                $volume = $rowResultdata['cart_volume'];
                $rate = $volume*$rowResultdata['ite_Rate'];
                $cartID = $rowResultdata['cart_Id'];
                
                
                $sql4 = "INSERT INTO orderdtl(`ordDtl_OrderId`, `ordDtl_itemID`, `OrdDtlUnitId`, `OrdDtl_itemName`, `OrdDtl_UnitName`, `OrdDtl_Volumen`, `OrdDtl_Rate`, `OrdDtl_DIscountAmount`, `OrdDtl_DIscountCode`) VALUES('$lastInsertId', '$itemId', '$unitId', '$itemName', '$unitName', '$volume', '$rate', '$discountRate','$coupanName')";
                $result4 =  $dbh->query($sql4);
                
                
            
            
            $orderdtlSQl = "SELECT orderdtl.ordDtl_id FROM orderdtl WHERE ordDtl_OrderId=$lastInsertId ORDER BY `orderdtl`.`ordDtl_id` DESC LIMIT 1";
            $orderdtlRes = $dbh->query($orderdtlSQl);
            $orderdtlFetchdata = $orderdtlRes->fetch();
            $orderdtlId = $orderdtlFetchdata['ordDtl_id'];
            
            
            $cartdtlSQl = "SELECT cartdtl.cartDtl_Id,cartdtl.cartDtl_attid,cartdtl.cartDtl_attvalue FROM cartdtl WHERE cartdtl.cartDtl_cartid =$cartID";
            $cartdtlRes = $dbh->query($cartdtlSQl);
            $cartdtsR = $cartdtlRes->fetchAll();
            
            foreach($cartdtsR as $cartdtsRow){
                    $orderDtl_Id = $cartdtsRow['ordDtl_id'];
                
                $cartDtlID = $cartdtsRow['cartDtl_Id'];
                $AttId= $cartdtsRow['cartDtl_attid'];
                $AttValue = $cartdtsRow['cartDtl_attvalue'];
                $orderdtlAttSql = "INSERT INTO orderdtl_att(orderdtl_att_itemId,orderdtl_att_AttId,orderdtl_att_AttValue,orderdtl_att_orddtlId) VALUES('$itemId','$AttId', '$AttValue','$orderdtlId')";
                $orderdtlAttRes = $dbh->query($orderdtlAttSql);
                $deleteFRomcartdtl = "DELETE FROM cartdtl WHERE cartDtl_Id=$cartDtlID";
                $result6 =  $dbh->query($deleteFRomcartdtl);
                }
                
                
                // $orderdtlAttSql = "INSERT INTO orderdtl_att(orderdtl_att_itemId,orderdtl_att_AttId,orderdtl_att_AttValue,orderdtl_att_orddtlId) VALUES('$itemId','$AttId', '$AttValue','$orderDtl_Id')";
                // $orderdtlAttRes = $dbh->query($orderdtlAttSql);
                
                
                $stockUpdateSQl = "UPDATE stock SET stl_Volumns = stl_Volumns-$volume WHERE stk_itemid = $itemId";
                $stockUpdateRes = $dbh->query($stockUpdateSQl);
                
                // $cartDtlID = $rowResultdata['cartDtl_Id'];
                // $AttId= $rowResultdata['cartDtl_attid'];
                // $AttValue = $rowResultdata['cartDtl_attvalue'];
                
                
                // $sql6 = "DELETE FROM cartdtl WHERE cartDtl_Id='$cartDtlID'";
                // $result6 =  $dbh->query($sql6);
                
                if($result4){
                    $sql5 = "DELETE FROM cart WHERE cart_Id='$cartID'";
                    $result5 =  $dbh->query($sql5);
                    if($result5){
                        echo "";
                    }
                    else{
                        echo "Failed";
                    }
                } 
            }
            
            // die();
           
        }  
        
        
    }
   
    $Ordmailsql = "SELECT `order`.*, orderdtl.* FROM orderdtl LEFT JOIN `order` ON ordDtl_OrderId=ord_id WHERE ord_id='$lastInsertId'";
    $ordersingalfetch = $dbh->query($Ordmailsql);
    $OrdmailRes =  $dbh->query($Ordmailsql);
    $rowEmail = $ordersingalfetch->fetch();
    $OrdmailResIs = $OrdmailRes->fetchAll();
    foreach($OrdmailResIs as $rowmaildata){
         $items[] = $rowmaildata['OrdDtl_itemName'];
         $itemList[] = $rowmaildata['ordDtl_itemID'];
     }
    $orderNumber = $rowEmail['ord_OrderNo'];
    $itemname = implode(',',$items);
    $cpdtl_CP_Id = $rowEmail['ord_OrderNo'];
    $place = $rowEmail['ord_AddressLine1'].",".$rowEmail['ord_AddressLine1']."-".$rowEmail['ord_postalcode'].",".$rowEmail['ord_City'];
    $date = $rowEmail['ord_Date'];
    $orderDate = new DateTime($date);
    $pincode = '';
     

     $format = $orderDate->format('M d, Y h:i:sa');
     $coupan = "select SUM(OrdDtl_DIscountAmount) as discount FROM orderdtl WHERE ordDtl_OrderId='$lastInsertId'";
     $coupanRes = $dbh->query($coupan);
      $discountRow = $coupanRes->fetch();
      $discount = $discountRow['discount'];
     
    $price = $rowEmail['OrderTotalAmount'];
      
      
      
            
/* Send Ordred Successfully Email Message to Admin */
    // $adminMail = "no-reply@grofkit.in"
        
    // $to = "no-reply@grofkit.in";
        $subject = "Order No. #$orderNumber placed by ".ucfirst($userName);
        
        $message= "<html>
      <head>
      <style>

      </style>
      </head>
      <body>

      <p>Dear Admin,</p>
      <p>Order no. #$orderNumber has been placed successfully on Grofkit.in. Kindly confirm the order.</p>
      <p>Please find order details:</p><br>
      <p style='margin-bottom:10px'></p>

      <p><b>Order No. :</b> #$orderNumber </p>
      <p><b>Item  Name. :</b> $itemname </p>
      <p><b>Price :</b> ₹ $price </p>
      <p><b>Order date and Time :</b> $format </p>
        <p>Thank You</p>

      
      </body>
      </html>";
    //   echo $message;
      
      $headers1[] = 'MIME-Version: 1.0';
      $headers1[] = 'Content-type: text/html; charset=iso-8859-1';
      // Additional headers
      $headers1[] = 'To: aditya@grofkit.in';
      $headers1[] = 'From: no-reply@grofkit.in';
        
        // echo $emailAdd;
        // die();
        
    mail("no-reply@grofkit.in",$subject,$message,implode("\r\n", $headers1));
    
    $subject1 = "Order No. #$orderNumber placed successfully on Gorfkit.in";
    $message1= "<html>
      <head>
      <style>

      </style>
      </head>
      <body>

      <p>Dear ".ucfirst($userName).",</p>
      <p>Your order no. #$orderNumber has been placed successfully on Grofkit.in. </p>
      <p>Please find order details:</p><br>
      <p style='margin-bottom:10px'></p>
      
      <p><b>Order No. :</b> #$orderNumber </p>
      <p><b>Item  Name. :</b> $itemname </p>
      <p><b>Price :</b> ₹ $price </p>

      <p>You can write us to grofkit@gmail.com or 8521985288
Thank You for giving your precious time to us. </p>
<p>Happy Shopping!</p>

      
      </body>
      </html>";
       $headers2[] = 'MIME-Version: 1.0';
      $headers2[] = 'Content-type: text/html; charset=iso-8859-1';
      // Additional headers
      $headers2[] = 'To:'. $emailAdd;
      $headers2[] = 'From: no-reply@grofkit.in';
      
      mail($emailAdd,$subject1,$message1,implode("\r\n", $headers2));
    
    
    
    // $result1 =  $dbh->query($sql1);
    // $lastInsertId= $dbh->lastInsertId();
    
    // $OrderwithRazorPaySql = "UPDATE `order` SET razorpay_order_id='$razorpay_order_id', razorpay_signature='$razorpay_signature', razorpay_payment_id='$razorpay_payment_id' WHERE ord_id= $ordered_Id";
    // $OrderwithRazorPayRes = $dbh->query($OrderwithRazorPaySql);
    // $html = "<p>Your payment was successful</p>
    //          <p>Payment ID: {$_POST['razorpay_payment_id']}</p>
    //          <p>Payment Signature: {$_POST['razorpay_signature']}</p>
    //          <p>Razor Pay Ordered ID: {$_SESSION['razorpay_order_id']}</p>
    //          <p>Checked User Details: {$_POST['last_orded_id']}</p>";
    $html = "1";
//     $html .= $OrderwithRazorPaySql;
//     if($OrderwithRazorPayRes){
//         $html = 1;
//     }
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

if($html ==1){
    redirect("myorders.php");
}else{
    echo $html;
}
// echo $html;
