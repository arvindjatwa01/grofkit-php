<?php 

    include_once 'admin/connection_handle.php';
    if(isset($_POST['itemVol'])){


    $class_user_login->checkuserLoggedIn();
$strLoadAdminCondition = ' AND us_Id=' . $class_user_login->getCurrentLoginAdminId();
$rowAdminInfo = $class_common->loadSingleDataBy($strLoadAdminCondition, '', '', TABLE_USER);


$checkloginadmin = $class_user_login->checkuserLoggedIn();

$loginuser = $_SESSION['USER']['ID'];
   $sql1 = "SELECT COUNT(*) as totalcart, SUM(item.ite_MRP * cart.cart_volume) as TotalitemCost FROM cart LEFT JOIN item ON cart.cart_itemId = item.ite_Id WHERE cart.cart_UserID = '$loginuser'";
  
   $result1=$dbh->query($sql1);
   $resUserItem = $result1->fetch();
   echo $resUserItem['totalcart'];
    }
?>