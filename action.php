<?php 
include_once('./config/config.php');
include_once './classes/Class_common.php';
include_once './classes/class_getvaluesamount.php';

/* ================================================================ 
------------- Add To Cart From Product Details Page ---------------
====================================================================*/

if(isset($_POST['isaddCartFromProductDtl'])){
    
    $cartItemId = $_POST['cartItemId'];
    $userID = $_POST['userid'];
    $unitId = $_POST['unitId'];
    
    // $cartAtt = $_POST['cartAtt'];
    if(empty($_POST['cartAtt'])){
        $cartAtt = array('0'); 
    }else{
        $cartAtt = $_POST['cartAtt'];
    }
    // print_r($cartAtt);
    // die();
    if(empty($_POST['cartattvalues'])){
        $cartAttValues = array('0');
    }else{
        $cartAttValues = $_POST['cartattvalues'];
    }
    $array = array_combine($cartAttValues, $cartAtt);
    // if(!in_array(0,$array)){
    //     echo "0 exists";
    // }else{
    //     echo "not exists";
    // }
    // print_r($array);
    // die();

    $sql= "INSERT INTO cart (cart_UserID, cart_itemId, cart_volume, cart_UnitId) 
    VALUES('$userID', '$cartItemId', '1', '$unitId')";
    $result=$dbh->query($sql);
    $lastInsertCartId = 
    $lastInsertId= $dbh->lastInsertId();
    // echo $lastInsertId;
    if(!in_array(0,$array)){
        foreach($array as $key => $value){

        $cartdtlsql = "INSERT INTO `cartdtl` (cartDtl_cartid,cartDtl_attid, cartDtl_attvalue) VALUES ('$lastInsertId','$value','$key')";
        // echo $cartdtlsql;
        $cartdtlresult = $dbh->query($cartdtlsql);
            
        }
    }
    
    if($result){
        $sql1 = "SELECT COUNT(*) as totalcart, SUM(item.ite_MRP * cart.cart_volume) as TotalitemCost FROM cart LEFT JOIN item ON cart.cart_itemId = item.ite_Id WHERE cart.cart_UserID = '$userID'";
  
        $result1=$dbh->query($sql1);
        $resUserItem = $result1->fetch();
        echo $resUserItem['totalcart'];
    }else{
        echo "Error";
    }
}

/* ================================================================ 
------------- Add To Cart From Index Page ---------------
====================================================================*/

if(isset($_POST['isaddCart'])){
    
    $cartItemId = $_POST['cartItemId'];
    $userID = $_POST['userid'];
    $unitId = $_POST['unitId'];

    
    

    $sql= "INSERT INTO cart (cart_UserID, cart_itemId, cart_volume, cart_UnitId) 
    VALUES('$userID', '$cartItemId', '1', '$unitId')";
    $result=$dbh->query($sql);
    $lastInsertCartId = 
    $lastInsertId= $dbh->lastInsertId();
    $AttributeSQl = $dbh->query("SELECT iteAtt_attid, iteAtt_value FROM attributeitem WHERE iteAtt_itemID=$cartItemId AND isdefault=1");
    
    $AttributeRes = $AttributeSQl->fetchAll();
    if(count($AttributeRes) > 0){
        foreach($AttributeRes as $value){
            $attributId = $value['iteAtt_attid'];
            $attributeValue = $value['iteAtt_value'];
            $cartdtlsql = "INSERT INTO `cartdtl` (cartDtl_cartid,cartDtl_attid, cartDtl_attvalue) VALUES ('$lastInsertId','$attributId','$attributeValue')";
            $cartdtlresult = $dbh->query($cartdtlsql);    
        }
    }
    
    
    if($result){
        $sql1 = "SELECT COUNT(*) as totalcart, SUM(item.ite_MRP * cart.cart_volume) as TotalitemCost FROM cart LEFT JOIN item ON cart.cart_itemId = item.ite_Id WHERE cart.cart_UserID = '$userID'";
  
        $result1=$dbh->query($sql1);
        $resUserItem = $result1->fetch();
        echo $resUserItem['totalcart'];
    }else{
        echo "Error";
    }
}


/* ================================================================ 
------------- Increase Or Decrease Added Cart Item Value ---------------
====================================================================*/

if(isset($_POST['isaddCartvalue'])){
    $itemVol = $_POST['itemVol'];
    $cartId = $_POST['cartId'];
    $userid = $_POST['userid'];
    $pincode = $_POST['pincode'];
    // echo $pincode;
    // die();
    $coupanCode = $_POST['coupanCode'];
    
    
    $sql = "UPDATE cart SET cart_volume = '$itemVol' WHERE cart_Id  = '$cartId'"; 
    
    $itemids = array();
    $strLoadConditions = " AND cart_UserID = '$userid' ";
    $strFileds = 'item.*, itemimage.*, unit.*, cart.*';
    $strJoinCondition = "LEFT JOIN itemimage ON cart.cart_itemId = itemimage.itimg_itemID LEFT JOIN unit ON cart.cart_UnitId = unit.un_ID LEFT JOIN item ON cart.cart_itemId = item.ite_Id";
    $resSelectCartList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, $strJoinCondition, 0, '', 'cart');
    if (count($resSelectCartList) > 0) {
        foreach ($resSelectCartList as $rowSize) { 
            $itemids[]=$rowSize['ite_Id'];
        }
    }
    $result = $dbh->query($sql);
    $cartVolSql = "SELECT cart_volume FROM `cart` WHERE cart_Id = '$cartId'";
    $cartVolRes=$dbh->query($cartVolSql);
    $resCartItemVol = $cartVolRes->fetch();
    $cartVolItemRes = $resCartItemVol['cart_volume'];
    $ItemstotalCost = $GetValuesAmount->GetItemsTotalCost($userid);
    $getGstcost = $GetValuesAmount->GetGstCost($itemids);
    $finalCost = $GetValuesAmount->GetFinalCost($itemids,$pincode,$coupanCode,$userid);
    $coupnaCodeAmount = $GetValuesAmount->GetDiscountAmount($itemids,$coupanCode,$userid);
    if($result){
        // echo $GetValuesAmount->GetGstCost($itemids,'');
        echo json_encode(array($getGstcost,$ItemstotalCost,$finalCost,$cartVolItemRes,$coupnaCodeAmount));
       
    }else{
        echo "Updation Error";
    }
}
// if(isset($_POST['issubCartvalue'])){
//     $itemVol = $_POST['itemVol'];
//     $cartId = $_POST['cartId'];
//     $sql = "UPDATE cart SET cart_volume = '$itemVol'-1 WHERE cart_Id  = '$cartId'"; 
    
//     $result = $dbh->query($sql);
//     if($result){
//         echo "Updated";
//     }else{
//         echo "Updation Error";
//     }
// }


/* ================================================================ 
------------- Remove Added Cart Item  ---------------
====================================================================*/

if(isset($_POST['isdeleteCart'])){
    $cartId = $_POST['cartId'];
    $userid = $_POST['userid'];
    $coupanCode = $_POST['coupanCode'];
    $pincode = $_POST['pincode'];
    // $coupanIs = $_POST['coupanIs'];
    $sql = "DELETE FROM cart WHERE cart_Id = '$cartId'";
    
    $itemids = array();
    
    
    $strLoadConditions = " AND cart_UserID = '$userid' ";
    $strFileds = 'item.*, itemimage.*, unit.*, cart.*';
    $strJoinCondition = "LEFT JOIN itemimage ON cart.cart_itemId = itemimage.itimg_itemID LEFT JOIN unit ON cart.cart_UnitId = unit.un_ID LEFT JOIN item ON cart.cart_itemId = item.ite_Id";
    $resSelectCartList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFileds, $strJoinCondition, 0, '', 'cart');
    
    if (count($resSelectCartList) > 0) {
        foreach ($resSelectCartList as $rowSize) { 
            $itemids[]=$rowSize['ite_Id'];
        }
    }
    
    $cartdtlSQl = "DELETE FROM cartdtl WHERE cartDtl_cartid = '$cartId'";
    $cartdtlRes = $dbh->query($cartdtlSQl);
    
    // $coupanSQl = "SELECT `coupandtl`.`CpDtl_itemID` FROM coupandtl WHERE CpDtl_CPID=$coupanIs";
    
    $result=$dbh->query($sql);
    if($result){
        $sql1 = "SELECT COUNT(*) as totalcart, SUM(item.ite_MRP * cart.cart_volume) as TotalitemCost FROM cart LEFT JOIN item ON cart.cart_itemId = item.ite_Id WHERE cart.cart_UserID = '$userid'";
  
        $result1=$dbh->query($sql1);
        $resUserItem = $result1->fetch();
        $getAmount = $GetValuesAmount->GetGstCost($itemids);
        $totalcart =  $resUserItem['totalcart'];
        $finalCost = $GetValuesAmount->GetFinalCost($itemids,$pincode,$coupanCode,$userid);
        echo json_encode(array($totalcart,$getAmount,$finalCost));
        
    }else{
        echo "Deletion Error";
    }

}

/* ================================================================ 
--------------------------- Book Order ----------------------------
==================================================================== */
if(isset($_POST['ischeckedAdd'])){
    $checkedAdd = $_POST['checkedAdd'];
    $finalcost = $_POST['totalAmount'];
    $discountRate = $_POST['coupanAmount'];
    
    if($_POST['coupanName'] === 'no'){
        $coupanName = '';
    }else{
        $coupanName = $_POST['coupanName'];
        
    }
    
     $Coupansql ="SELECT coupandtl.*, coupen.* FROM coupandtl LEFT JOIN coupen ON CpDtl_CPID = Cp_ID WHERE CP_Code = '$coupanName'";
   
    
    $coupanresult = $dbh->query($Coupansql);
    
    if($coupanresult->rowCount() > 0){
        
        $coupanrow = $coupanresult->fetch();
        $cpdtl_CP_Id = $coupanrow['CpDtl_Id'];
    }else{
        $cpdtl_CP_Id = 0;
    }
    
                            // $coupanName = $row['CP_Code'];
                            // $cpdtl_CP_Id = $row['CpDtl_CPID'];
    
    date_default_timezone_set('Asia/Kolkata');
    $date = date('jnY');
    
    $sql = "SELECT * FROM mstaddress WHERE ad_ID = '$checkedAdd'";
    $result = $dbh->query($sql);
    $rowResult = $result->fetch();
    
    $userID = $rowResult['ad_UserID'];
    $userName = $rowResult['ad_name'];
    $emailAdd = $rowResult['ad_EmailID'];
    $mobileNo = $rowResult['ad_MobileNo'];
    $address1 = $rowResult['ad_address1'];
    $address2 = $rowResult['ad_address2'];
    $pinCode = $rowResult['ad_postalCode'];
    $City = $rowResult['ad_City'];
    $state = $rowResult['ad_StateName'];
    $country = $rowResult['ad_country'];
    // $cpdtl_CP_Id = '';
    $checkPincode = "SELECT * FROM pincode_onavailable WHERE Pin_PinCode = '$pinCode'";
    $checkPincodeRes = $dbh->query($checkPincode);
    $checkPincodeRow = $checkPincodeRes->fetch();
    if($checkPincodeRes->rowCount() > 0){
        
        $itemids = array();
            $cartLoadConditions = ' AND cart_UserID = '.$userID.'';
            $cartFileds = 'item.*, cart.*';
            $cartJoinCondition = "LEFT JOIN item ON cart.cart_itemId = item.ite_Id";
            $cartSelectCartList = $class_common->loadMultipleDataByTableName($cartLoadConditions, $cartFileds, $cartJoinCondition, 0, '', 'cart');
            if (count($cartSelectCartList) > 0) {
                foreach ($cartSelectCartList as $cartSize) { 
                    $itemids[]=$cartSize['ite_Id'];
                }
            }
        $finalAMount = $GetValuesAmount->GetFinalCost($itemids,$pinCode,$cpdtl_CP_Id,$userID);
        $scost=$GetValuesAmount->GetShippingCost($itemids,$pinCode,$userID);
        $totalbftAmount = $GetValuesAmount->GetItemsTotalCost($userID);
        $totalGstAmount = $GetValuesAmount->GetGstCost($itemids);
        // echo $finalAMount;
        // die();
        
        $array = json_encode(array($userID,$userName,$emailAdd,$mobileNo,$address1,$address2,$pinCode,$City,$state,$country,$discountRate,$finalcost,$coupanName,$scost,$totalbftAmount,$totalGstAmount));
        // print_r($array);
        echo $array;
        die();
    $itemId = '';
    $items = array();
    $itemList = array();
   
    
    $sql1 = "INSERT INTO `order` (ord_userid, ord_userName, ord_emailid, ord_mobilNo, ord_AddressLine1, ord_AddressLine2, ord_country, ord_State, ord_City, ord_postalcode, OrderTotalAmount, ord_TotalDiscount) VALUES('$userID', '$userName', '$emailAdd', '$mobileNo', '$address1', '$address2', '$country', '$state', '$City', '$pinCode','$finalcost', '$discountRate')";
    $result1 =  $dbh->query($sql1);
    $lastInsertId= $dbh->lastInsertId();
    if($result1){
        
        
        $sql2 ="UPDATE `order` SET ord_OrderNo = '$lastInsertId$date', OrderStatusID = '1' WHERE ord_id = '$lastInsertId'";
        $result2 =  $dbh->query($sql2);
        if($result2){
            $sql3 = "SELECT cart.*, item.*, unit.* FROM cart LEFT JOIN item ON cart_itemId = ite_Id LEFT JOIN unit ON cart_UnitId = un_ID WHERE cart_UserID = '$userID'";
            $result3 =  $dbh->query($sql3);
            $resultIs = $result3->fetchAll();
            foreach($resultIs as $rowResultdata){
                $itemId = $rowResultdata['ite_Id'];
                $itemName =$rowResultdata['ite_Name'];
                $unitId = $rowResultdata['un_ID'];
                $unitName = $rowResultdata['un_Code'];
                $volume = $rowResultdata['cart_volume'];
                $rate = $volume*$rowResultdata['ite_Rate'];
                $cartID = $rowResultdata['cart_Id'];
                // $items[] = $rowResultdata['ite_Name'];
                // 
                $sql4 = "INSERT INTO orderdtl(`ordDtl_OrderId`, `ordDtl_itemID`, `OrdDtlUnitId`, `OrdDtl_itemName`, `OrdDtl_UnitName`, `OrdDtl_Volumen`, `OrdDtl_Rate`, `OrdDtl_DIscountAmount`, `OrdDtl_DIscountCode`) VALUES('$lastInsertId', '$itemId', '$unitId', '$itemName', '$unitName', '$volume', '$rate', '$discountRate','$coupanName')";
                $result4 =  $dbh->query($sql4);
                
                $stockUpdateSQl = "UPDATE stock SET stl_Volumns = stl_Volumns-$volume WHERE stk_itemid = $itemId";
                $stockUpdateRes = $dbh->query($stockUpdateSQl);
                
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
            
            
           
        }  
        
        
    }
    echo $lastInsertId;
    $Ordmailsql = "SELECT `order`.*, orderdtl.* FROM orderdtl LEFt JOIN `order` ON ordDtl_OrderId=ord_id WHERE ord_id='$lastInsertId'";
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
      
    //   $price = $GetValuesAmount->GetItemsTotalCost($userID) + $GetValuesAmount->GetShippingCost($itemList,$pincode) + $GetValuesAmount->GetGstCost($itemList)-$discount;
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
    }else{
        echo "2";
    }

}

/* ================================================================================ 
--------------------------- Email Validation On Signup ----------------------------
=================================================================================== */

if(isset($_POST['isvalidemail'])){
    $email=$_POST['email'];
    //echo json_encode($email);
    $sql="select * from mstuser where us_EmailID='$email'";
    $re = $dbh->query($sql);
    $c=$re->rowCount();
    if($c==0)
    {
        echo json_encode("This email is not registered");
    }
    else
    {
        echo json_encode("This email is already registered");
    }
}

/* ================================================================================ 
--------------------------- Email Validation On Signup ----------------------------
=================================================================================== */

if(isset($_POST['isvalidphone'])){
    $phone=$_POST['phone'];
    //echo json_encode($email);
    $sql="select * from mstuser where us_mobileNo='$phone'";
    $re = $dbh->query($sql);
    $c=$re->rowCount();
    if($c==0)
    {
        echo json_encode("This Mobile Number is not registered");
    }
    else
    {
        echo json_encode("This Mobile Number is already registered");
    }
}

/* ================================================================================ 
--------------------------- Order Cancel Request ----------------------------
=================================================================================== */

if(isset($_POST['isordeCancel'])){
    // echo "Hello";
    $orderId = $_POST['orderId'];
    $userId = $_POST['userId'];

    $sql = "INSERT INTO cancellationrequest(cancelResq_OderId, cancelResq_userId) VALUES('$orderId', '$userId')";
    $result =  $dbh->query($sql);
    
     $sql1 = "SELECT ord_DeliverDate,ord_userName,ord_emailid,ord_OrderNo,OrderStatusID,OrderTotalAmount FROM `order` WHERE ord_id  = '$orderId'";
    $res = $dbh->query($sql1);
    $row = $res->fetch();
    $orderNo = $row['ord_OrderNo'];
    $email = $row['ord_emailid'];
    $userName = ucfirst($row['ord_userName']);
    $price= $row['OrderTotalAmount'];
    
     $Ordmailsql = "SELECT `order`.*, orderdtl.* FROM orderdtl LEFt JOIN `order` ON ordDtl_OrderId=ord_id WHERE ord_id='$orderId'";
    $OrdmailRes =  $dbh->query($Ordmailsql);
    $OrdmailResIs = $OrdmailRes->fetchAll();
     foreach($OrdmailResIs as $rowmaildata){
         $items[] = $rowmaildata['OrdDtl_itemName'];
        //  $itemList[] = $rowmaildata['ordDtl_itemID'];
     }
     $itemname = implode(',',$items);
    
    if($result){
        
    /* --------- Send Cancellation Email to the user ------------------- */
        
        $to = $email;
        $subject = "Order No. #$orderNo requested for cancellation on Gorfkit.in";
        
         $message= "<html>
      <head>
      <style>

      </style>
      </head>
      <body>

      <p>Dear $userName,</p>
      <p>Your order no. #$orderNo has requested for cancellation. You can remove the cancellation request from your order section on Grofkit.in</p>
      <p>Please find order details:</p><br>
      <p style='margin-bottom:10px'></p>
      <p><b>Order No. :</b> #$orderNo </p>
      <p><b>Item  Name. :</b> $itemname </p>
      <p><b>Price :</b> ₹ $price </p><br>

      <p>You can write us to grofkit@gmail.com or 8521985288
Thank You for giving your precious time to us. </p>
<p>Happy Shopping!</p>

      
      </body>
      </html>";
      $headers1[] = 'MIME-Version: 1.0';
      $headers1[] = 'Content-type: text/html; charset=iso-8859-1';
      // Additional headers
      $headers1[] = 'To:'.$email;
      $headers1[] = 'From: no-reply@grofkit.in';
        
        if(mail($email,$subject,$message,implode("\r\n", $headers1))){
            echo "Mail Send to the user";
        }
        
    
     /* --------- Send Cancellation Email to the Admin ------------------- */
     
     $subject1 = "Order No. #$orderNo requested for cancellation on Gorfkit.in";
        
         $message1= "<html>
      <head>
      <style>

      </style>
      </head>
      <body>

      <p>Dear Admin,</p>
      <p>Order no. #$orderNo has requested for cancellation. Kindly check and take further action.</p>
      <p>Please find order details:</p><br>
      <p style='margin-bottom:10px'></p>
      <p><b>Order No. :</b> #$orderNo </p>
      <p><b>Item  Name. :</b> $itemname </p>
      <p><b>Price :</b> ₹ $price </p><br>

      <p>Thank You!</p>

      
      </body>
      </html>";
      $headers2[] = 'MIME-Version: 1.0';
      $headers2[] = 'Content-type: text/html; charset=iso-8859-1';
      // Additional headers
      $headers2[] = 'To: menol51945@roxoas.com';
      $headers2[] = 'From: no-reply@grofkit.in';
        
        
        if(mail("menol51945@roxoas.com",$subject1,$message1,implode("\r\n", $headers2))){
            echo "Mail send to the Admin";
        }
        
        echo "Order Cancel";
        
    }else{
        echo "Order Cancellation request FAiled";
    }
}

/* ================================================================================ 
--------------------------- Order Cancellation Request Cancel ----------------------------
=================================================================================== */


if(isset($_POST['isordeCancelRequest'])){
    // echo "Hello";
    $orderId = $_POST['orderId'];
    $sql1 = "SELECT count(*) as cancelReq,`cancelResq_Iscancel` FROM `cancellationrequest` WHERE 1=1 AND `cancelResq_OderId` = '$orderId'";
    $result1 =  $dbh->query($sql1);
    $row = $result1->fetch();
    if($row['cancelResq_Iscancel'] == 1){
        echo "1";
    }else{
        
    
    
    $sql = "DELETE FROM cancellationrequest WHERE cancelResq_OderId = '$orderId'";
    $result =  $dbh->query($sql);
    if($result){
        echo "Order Cancel";
    }else{
        echo "Order Cancellation request FAiled";
    }
    }
}


/* =========================================================================== 
    --------------------------- Pincode Set ----------------------------
=============================================================================== */
if(isset($_POST['ispincodeSet'])){
    $pincode= $_POST['pincode'];
    $userId = $_POST['userid'];
    $sql = "UPDATE mstuser SET us_postalCode ='$pincode' WHERE us_Id = '$userId'";
    // echo $sql;
    // die();
    $result =  $dbh->query($sql);
    if($result){
        echo "1";
    }else{
        echo "0";
    }
}



/* =========================================================================== 
    --------------------------- Pincode Update ----------------------------
===============================================================================
 */
if(isset($_POST['pinUpdate_userid']) AND isset($_POST['pinUpdate_pincode'])){
     $pincode= $_POST['pinUpdate_pincode'];
     $userId = $_POST['pinUpdate_userid'];
    
    $sql = "UPDATE mstuser SET us_postalCode ='$pincode' WHERE us_Id = '$userId'";
    // echo $sql;
    // die();
     $result =  $dbh->query($sql);
    if($result){
        echo "1";
    }else{
        echo "0";
    }
 }

/* =========================================================================== 
    --------------------------- Address Pincode changed Select open Model Box ----------------------------
===============================================================================
*/
 if(isset($_POST['ischnagedAddress'])){
     $selPincode = $_POST['selPincode'];
     $seluserID = $_POST['seluserid'];
     $cpdtl_CP_Id = $_POST['coupanRate'];
    //  echo gettype($selPincode);
    //  die();
     
     $sql = "SELECT us_postalCode FROM mstuser WHERE us_Id='$seluserID'";
     
     $res = $dbh->query($sql);
     $row = $res->fetch();
     
     if($selPincode==$row['us_postalCode']){
         echo 2;
     }else{
        //  echo $row['us_postalCode']."==".$selPincode;
        //  die();
         $itemids = array();
            $cartLoadConditions = ' AND cart_UserID = '.$seluserID.'';
            $cartFileds = 'item.*, cart.*';
            $cartJoinCondition = "LEFT JOIN item ON cart.cart_itemId = item.ite_Id";
            $cartSelectCartList = $class_common->loadMultipleDataByTableName($cartLoadConditions, $cartFileds, $cartJoinCondition, 0, '', 'cart');
            if (count($cartSelectCartList) > 0) {
                foreach ($cartSelectCartList as $cartSize) { 
                    $itemids[]=$cartSize['ite_Id'];
                }
            }
        $finalAMount = $GetValuesAmount->GetFinalCost($itemids,$selPincode,$cpdtl_CP_Id,$seluserID);
        echo number_format($finalAMount,2);
     }
 }
/* ===========================================================================
----------------------- Chnage Pincode Before Shopping -----------------------
==============================================================================*/

if(isset($_POST['yeschangPincode'])){
     $selPincode = $_POST['selPincode'];
     $seluserID = $_POST['seluserid'];
     
      $sql = "UPDATE mstuser SET us_postalCode = '$selPincode' WHERE us_Id='$seluserID'";
     
     $res = $dbh->query($sql);
     if($res){
         echo 1;
     }else{
          echo 0;
     }
     
}

/* ================================================================ 
------------- Check Add To Cart Item, is in Stock or not ---------------
====================================================================*/

if(isset($_POST['isinStockcheck'])){
    $userid = $_POST['userid'];
    $sql = "SELECT `cart`.`cart_itemId`,`cart`.`cart_volume`,`item`.`ite_Name` FROM cart LEFT JOIN item ON `cart`.`cart_itemId` = `item`.`ite_Id` WHERE `cart`.`cart_UserID`=$userid";
   
   $res = $dbh->query($sql);
   $cartfetchdata = $res->fetchAll();
   $checkdata = array();
   foreach($cartfetchdata as $cartRow){
       $itemId = $cartRow['cart_itemId'];
       $itemName = $cartRow['ite_Name'];
       
       $stockSql = "SELECT stl_Volumns FROM stock WHERE stk_itemid=$itemId";
       $stockRes = $dbh->query($stockSql);
       $stockRow=$stockRes->fetch();
       $stockVolume = $stockRow['stl_Volumns'];
       if($cartRow['cart_volume'] <= $stockRow['stl_Volumns']){
        //   $checkdata[] = "yes";
          $checkdata['yes'] = array(
            "itemname" => $itemName,
            "stockvolume" =>$stockVolume
            );
       }else{
        //   $checkdata[]= "no";
          $checkdata['no'] = array(
            "itemname" => $itemName,
            "stockvolume" =>$stockVolume
            );
       }
   }
  echo json_encode($checkdata);
//   print_r($checkdata);

}

/* ================================================================== 
---------------- Book Order For Cash On Delivery  -------------------
====================================================================*/

if(isset($_POST['ischeckedAddCOD'])){
    $checkedAdd = $_POST['checkedAdd'];
    $finalcost = $_POST['totalAmount'];
    $discountRate = $_POST['coupanAmount'];
    
    if($_POST['coupanName'] === 'no'){
        $coupanName = '';
    }else{
        $coupanName = $_POST['coupanName'];
        
    }
    
     $Coupansql ="SELECT coupandtl.*, coupen.* FROM coupandtl LEFT JOIN coupen ON CpDtl_CPID = Cp_ID WHERE CP_Code = '$coupanName'";
   
    
    $coupanresult = $dbh->query($Coupansql);
    
    if($coupanresult->rowCount() > 0){
        
        $coupanrow = $coupanresult->fetch();
        $cpdtl_CP_Id = $coupanrow['CpDtl_Id'];
    }else{
        $cpdtl_CP_Id = 0;
    }
    
    date_default_timezone_set('Asia/Kolkata');
    $date = date('jnY');
    
    $sql = "SELECT * FROM mstaddress WHERE ad_ID = '$checkedAdd'";
    $result = $dbh->query($sql);
    $rowResult = $result->fetch();
    
    $userID = $rowResult['ad_UserID'];
    $userName = $rowResult['ad_name'];
    $emailAdd = $rowResult['ad_EmailID'];
    $mobileNo = $rowResult['ad_MobileNo'];
    $address1 = $rowResult['ad_address1'];
    $address2 = $rowResult['ad_address2'];
    $pinCode = $rowResult['ad_postalCode'];
    $City = $rowResult['ad_City'];
    $state = $rowResult['ad_StateName'];
    $country = $rowResult['ad_country'];
    $checkPincode = "SELECT * FROM pincode_onavailable WHERE Pin_PinCode = '$pinCode'";
    $checkPincodeRes = $dbh->query($checkPincode);
    $checkPincodeRow = $checkPincodeRes->fetch();
    if($checkPincodeRes->rowCount() > 0){
        
        $itemids = array();
            $cartLoadConditions = ' AND cart_UserID = '.$userID.'';
            $cartFileds = 'item.*, cart.*';
            $cartJoinCondition = "LEFT JOIN item ON cart.cart_itemId = item.ite_Id";
            $cartSelectCartList = $class_common->loadMultipleDataByTableName($cartLoadConditions, $cartFileds, $cartJoinCondition, 0, '', 'cart');
            if (count($cartSelectCartList) > 0) {
                foreach ($cartSelectCartList as $cartSize) { 
                    $itemids[]=$cartSize['ite_Id'];
                }
            }
        $finalAMount = $GetValuesAmount->GetFinalCost($itemids,$pinCode,$cpdtl_CP_Id,$userID);
        $scost=$GetValuesAmount->GetShippingCost($itemids,$pinCode,$userID);
        $totalbftAmount = $GetValuesAmount->GetItemsTotalCost($userID);
        $totalGstAmount = $GetValuesAmount->GetGstCost($itemids);
        
        
        // $array = json_encode(array($userID,$userName,$emailAdd,$mobileNo,$address1,$address2,$pinCode,$City,$state,$country,$discountRate,$finalcost,$coupanName,$scost,$totalbftAmount,$totalGstAmount));
        // // print_r($array);
        // echo $array;
        // die();
    $itemId = '';
    $items = array();
    $itemList = array();
   
    
    $sql1 = "INSERT INTO `order` (ord_userid, ord_userName, ord_emailid, ord_mobilNo, ord_AddressLine1, ord_AddressLine2, ord_country, ord_State, ord_City, ord_postalcode, OrderTotalAmount, ord_TotalDiscount,OrderTotalBftAmount,OrdertaxAmount,ord_DeliveryCost,ord_paymentMethod) VALUES('$userID', '$userName', '$emailAdd', '$mobileNo', '$address1', '$address2', '$country', '$state', '$City', '$pinCode','$finalcost', '$discountRate','$totalbftAmount','$totalGstAmount',$scost,0)";
    
    $result1 =  $dbh->query($sql1);
    $lastInsertId= $dbh->lastInsertId();
    if($result1){
        
        
        $sql2 ="UPDATE `order` SET ord_OrderNo = '$lastInsertId$date', OrderStatusID = '1' WHERE ord_id = '$lastInsertId'";
        $result2 =  $dbh->query($sql2);
        if($result2){
            $sql3 = "SELECT cart.*, item.*, unit.* FROM cart LEFT JOIN item ON cart_itemId = ite_Id LEFT JOIN unit ON cart_UnitId = un_ID WHERE cart_UserID = '$userID'";
            $result3 =  $dbh->query($sql3);
            $resultIs = $result3->fetchAll();
            foreach($resultIs as $rowResultdata){
                $itemId = $rowResultdata['ite_Id'];
                $itemName =$rowResultdata['ite_Name'];
                $unitId = $rowResultdata['un_ID'];
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
                
                
                $stockUpdateSQl = "UPDATE stock SET stl_Volumns = stl_Volumns-$volume WHERE stk_itemid = $itemId";
                $stockUpdateRes = $dbh->query($stockUpdateSQl);
                
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
            
            
           
        }  
        
        
    }
    
    $Ordmailsql = "SELECT `order`.*, orderdtl.* FROM orderdtl LEFt JOIN `order` ON ordDtl_OrderId=ord_id WHERE ord_id='$lastInsertId'";
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
      
    //   $price = $GetValuesAmount->GetItemsTotalCost($userID) + $GetValuesAmount->GetShippingCost($itemList,$pincode) + $GetValuesAmount->GetGstCost($itemList)-$discount;
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
    }else{
        echo "2";
    }
    
    
}


/* ================================================================== 
---------------- Give Review For Item  -------------------
====================================================================*/

if(isset($_POST['isitemReview'])){
    $itemId = $_POST['itemId'];
    $userid = $_POST['userid'];
    $rating = $_POST['rating'];
    $isapproved = $_POST['idapprovedReview'];
    $description = mysql_real_escape_string_port($_POST['description']);

    $sql ="INSERT INTO item_reviews SET itemRev_itemId= $itemId, itemRev_userId=$userid, itemRev_Rating=$rating,itemRev_desc='$description', itemRev_isApproved=$isapproved";
    $res = $dbh->query($sql);
    if($res){
        echo 1;
    }else{
        echo 0;
    }
}
if(isset($_POST['isitemrateget'])){
    $itemId = $_POST['itemId'];
    $attids = $_POST['attvalues'];
    $sql ="Select ifnull((SELECT attPrice_Price FROM `attributeprice` WHERE attributeprice.attPrice_itemId=". $itemId ." and attributeprice.attPrice_attvaluesId='".$attids."' limit 1),
                  (Select item.ite_Rate from item where item.ite_Id=". $itemId ." LIMIT 1)) as Rate";
    $res = $dbh->query($sql);
    $resultIs = $res->fetch();
    echo  number_format($resultIs[0],2);
}
?>