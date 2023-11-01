    <?php 
    include_once('../config/config.php');

    /* ----------------------------------------
    ============= Country Select ==============
    ------------------------------------------- */

    if(isset($_POST['isCountry'])){
        $country_id = $_POST["country_id"];

        $result = "SELECT * FROM state where st_countryID = $country_id ORDER BY st_Name ASC";
        $resSelectCountry = $dbh->query($result);

        $resSelect = $resSelectCountry->fetchAll();
        if(count($resSelect) > 0){
            $options = "<option value='0'>Select State</option>";
            foreach($resSelect as $rowSelectCategory){
                $options .="<option value='".$rowSelectCategory['st_Id']."'>".$rowSelectCategory['st_Name']."</option>";
            }
            echo $options;
        }else{
            echo "<option value='0'>State Not Available</option>";
        }

    }

    /* ----------- Country Select End -------- */

    /* ----------------------------------------
    ============== Select State ===============
    ------------------------------------------- */

    if(isset($_POST['isState'])){
        $state_id = $_POST["state_id"];

        $result = "SELECT * FROM city where ct_StateId = $state_id ORDER BY ct_Name ASC";
        $resSelectCountry = $dbh->query($result);

        $resSelect = $resSelectCountry->fetchAll();

        if(count($resSelect) > 0){
            $options = "<option value='0'>Select City</option>";
            foreach($resSelect as $rowSelectCategory){
                $options .="<option value='".$rowSelectCategory['ct_Id']."'>".$rowSelectCategory['ct_Name']."</option>";
            }
            echo $options;
        }else{
            echo "<option value='0'>City Not Available</option>";
        }

    }

    /* ----------- State Select End -------- */

    /* ----------------------------------------
    ============== Select City ===============
    ------------------------------------------- */

    if(isset($_POST['isCityUpdate'])){
        $countryId = $_POST["countryId"];
        $stateId = $_POST["stateId"];
        $sql ="SELECT * FROM city WHERE ct_Id = '$stateId'";
        $resSelectstate = $dbh->query($sql);
        $resSelect = $resSelectstate->fetch();
        $selectedState = $resSelect['ct_StateId'];
        $selectedCountry = $resSelect['ct_CountryID'];

        $result = "SELECT * FROM state WHERE st_CountryID = '$selectedCountry'";
        $resSelectCountry = $dbh->query($result);
        $resSelect = $resSelectCountry->fetchAll();

        if(count($resSelect) > 0){
            $options = "<option value='0'>Select State</option>";
            foreach($resSelect as $rowSelectCategory){
                if($rowSelectCategory['st_Id'] == $selectedState){
                    $select = "selected";
                }else{
                    $select = "";
                }
                $options .="<option $select value='".$rowSelectCategory['st_Id']."'>".$rowSelectCategory['st_Name']."</option>";
            }
            echo $options;
        }else{
            echo "<option value='0'>State Not Available</option>";
        }
    }
    /* ------------- City Selecte End ---------------- */

    /* ------------------------------------------------
    ================= PinCode By State ================
    ------------------------------------------------- */

    if(isset($_POST['isPinCodeUpdate'])){
        $pinCodeId = $_POST["pinCodeId"];

        $sql ="SELECT * FROM pincode_onavailable WHERE Pin_Id = '$pinCodeId'";
        $resSelectstate = $dbh->query($sql);
        $resSelect = $resSelectstate->fetch();
        $selectedState = $resSelect['Pin_StateId'];
        $selectedCountry = $resSelect['Pin_CountryId'];
        $selectedCity = $resSelect['Pin_CityId'];

        $result = "SELECT * FROM state WHERE st_CountryID = '$selectedCountry'";
        $resSelectCountry = $dbh->query($result);
        $resSelect = $resSelectCountry->fetchAll();

        if(count($resSelect) > 0){
            $options = "<option value='0'>Select State</option>";
            foreach($resSelect as $rowSelectCategory){
                if($rowSelectCategory['st_Id'] == $selectedState){
                    $select = "selected";
                }else{
                    $select = "";
                }
                $options .="<option $select value='".$rowSelectCategory['st_Id']."'>".$rowSelectCategory['st_Name']."</option>";
            }
            echo $options;
        }else{
            echo "<option value='0'>State Not Available</option>";
        }
        
    }

    /* ------------------------------------------------
    ================= PinCode By City  ================
    ------------------------------------------------- */

    if(isset($_POST['isPinCodeCityUpdate'])){
        $pinCodeId = $_POST["pinCodeId"];

        $sql ="SELECT * FROM pincode_onavailable WHERE Pin_Id = '$pinCodeId'";
        $resSelectstate = $dbh->query($sql);
        $resSelect = $resSelectstate->fetch();
        $selectedState = $resSelect['Pin_StateId'];
        $selectedCountry = $resSelect['Pin_CountryId'];
        $selectedCity = $resSelect['Pin_CityId'];
        
        $result1 = "SELECT * FROM city WHERE ct_StateId = '$selectedState' AND ct_CountryID = '$selectedCountry'";
        $resSelectCity = $dbh->query($result1);
        $resCitySelect = $resSelectCity->fetchAll();
        if(count($resCitySelect) > 0){
            $options1 = "<option value='0'>Select State</option>";
            foreach($resCitySelect as $rowSelectCity){
                if($rowSelectCity['ct_Id'] == $selectedCity){
                    $select1 = "selected";
                }else{
                    $select1 = "";
                }
                $options1 .="<option $select1 value='".$rowSelectCity['ct_Id']."'>".$rowSelectCity['ct_Name']."</option>";
            }
            echo $options1;
        }else{
            echo "<option value='0'>State Not Available</option>";
        }
    }
    /* ==========================================================
    ------------ Country Activity Status Updation ----------------
    ============================================================= */

    if(isset($_POST['cid'])){
        $countryId = $_POST['cid'];
        $status = $_POST['status'];

        $sql = "UPDATE country SET cu_active= '$status' WHERE cu_Id = '$countryId'";
        $resSelectCountry = $dbh->query($sql);
        if($resSelectCountry){
            echo "Update";
        }else{
            echo "Failed";
        }

    }

    /* =============================================================
    -------------- Product Activity Status Updation ----------------
    ================================================================ */

    if(isset($_POST['pid'])){
        $productId = $_POST['pid'];
        $status = $_POST['status'];

        $sql = "UPDATE product SET prod_active= '$status' WHERE prod_Id = '$productId'";
        $resSelectCountry = $dbh->query($sql);
        if($resSelectCountry){
            echo "Update";
        }else{
            echo "Failed";
        }

    }

    /* ============================================================
    ---------------- Order Activity Status Updation ---------------
    =============================================================== */

    if(isset($_POST['Orderid'])){
        $items = array();
        $orderId = $_POST['Orderid'];
        $orderStatus = $_POST['Orderstatus'];
        $sql = "SELECT ord_DeliverDate,ord_userName,ord_emailid,ord_OrderNo,OrderStatusID,OrderTotalAmount FROM `order` WHERE ord_id  = '$orderId'";
        $res = $dbh->query($sql);
        $row = $res->fetch();
        $orderNo = $row['ord_OrderNo'];
        $email = $row['ord_emailid'];
        $userName = ucfirst($row['ord_userName']);
        $price= $row['OrderTotalAmount'];
        $delivaryDate = $row['ord_DeliverDate'];
        $Ordmailsql = "SELECT `order`.*, orderdtl.* FROM orderdtl LEFt JOIN `order` ON ordDtl_OrderId=ord_id WHERE ord_id='$orderId'";
        $OrdmailRes =  $dbh->query($Ordmailsql);
        $OrdmailResIs = $OrdmailRes->fetchAll();
        foreach($OrdmailResIs as $rowmaildata){
            $items[] = $rowmaildata['OrdDtl_itemName'];
            //  $itemList[] = $rowmaildata['ordDtl_itemID'];
        }
        $itemname = implode(',',$items);
        //  if(){
        //      echo "2";
        //  }
        if($row['OrderStatusID'] < $orderStatus){
            if($orderStatus == 3 OR $orderStatus == 4 AND $delivaryDate == '0000-00-00'){
                echo '1';
            }else{
                
        if(($row['OrderStatusID'] == 4 OR $row['OrderStatusID'] == 3) AND $orderStatus == 5){
            echo "2";
        }else{
            $sql = "UPDATE `order` SET OrderStatusID = '$orderStatus' WHERE ord_id  = '$orderId';";
            $sql .= "INSERT INTO orderstausTime SET ordTime_ordId='$orderId', ordTime_statusId = '$orderStatus'";
            $resSelectCountry = $dbh->query($sql);
            if($resSelectCountry){
                if($orderStatus == 2){
                    $to = $email;
            $subject = "Order No. #$orderNo has been accepted on Gorfkit.in";
            
            $message= "<html>
        <head>
        <style>

        </style>
        </head>
        <body>

        <p>Dear $userName,</p>
        <p>Your order no. #$orderNo has been accepted on Grofkit.in.</p>
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
            
            
            
        mail($email,$subject,$message,implode("\r\n", $headers1));
                }else if($orderStatus == 4){
                    $to = $email;
            $subject = "Order No. #$orderNo has been delivered | Gorfkit.in";
            
            $message= "<html>
        <head>
        <style>

        </style>
        </head>
        <body>

        <p>Dear $userName,</p>
        <p>Your order no. #$orderNo has been successfully  delivered  at your address. </p>
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
            
            
            
        mail($email,$subject,$message,implode("\r\n", $headers1));
                }else if($orderStatus == 5){
                    $to = $email;
            $subject = "Order No. #$orderNo cancelled By Admin on Gorfkit.in";
            
            $message= "<html>
        <head>
        <style>

        </style>
        </head>
        <body>

        <p>Dear $userName,</p>
        <p>Your order no. #$orderNo has been cancelled By Admin.</p>
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
        
        mail($email,$subject,$message,implode("\r\n", $headers1));
        
                }
                echo "Update";
            }else{
                echo "Failed";
            }
        }
        }
        }else{
            echo "Yoo Cant Update Now";
        }

    
    }

    /* ===============================================================
    ------------------ Product Tax Updation --------------------------
    ================================================================== */

    if(isset($_POST['isproductTax'])){
        // echo "Hello";
        $id = $_POST['protId'];
        $sql ="SELECT * FROM producttax WHERE Prot_Id = '$id'";
        $result = $dbh->query($sql);
        $row = $result->fetch();
        $taxName = $row['Prot_Name'];
        $taxFrom = $row['Prot_RateFrom'];
        $taxTo = $row['Prot_RateTo'];
        $taxCGST = $row['Prot_Cgst'];
        $taxSGST = $row['Prot_Sgst'];
        $taxLGST = $row['Prot_Lgst'];
        $taxProdId = $row['Prot_ProdID'];

        $myArr = array();
        $myarr[] = $taxName;
        $myarr[] = $taxFrom;
        $myarr[] = $taxTo;
        $myarr[] = $taxCGST;
        $myarr[] = $taxSGST;
        $myarr[] = $taxLGST;
        $myarr[] = $taxProdId;
        $myarr[] = $id;
        
        echo json_encode($myarr);
    }

    /* ==========================================================
    ------------------ Product Tax Deleation --------------------
    ============================================================ */

    if(isset($_POST['isproductDelteTax'])){
        $id = $_POST['protId'];
        
        $sql = "DELETE FROM producttax WHERE Prot_Id = '$id'";
    
        $result = $dbh->query($sql);

    }

    /* ==========================================================
    -------------- Show Selected Attribute Value -----------------
    ============================================================= */

    if(isset($_POST['isselAttValue'])){
        include '../classes/class_common.php';
        $attId = $_POST['attId'];
        $output6 = array();
        $strLoadConditions = " AND att_Id = '$attId' ORDER BY attd_id DESC ";
        $stFileds = " attribute.*, attributedtl.*";
        $strJoinCondition = " LEFT JOIN attribute ON attd_attid = att_Id";
        $resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $stFileds, $strJoinCondition, 0, '', 'attributedtl');
        // if (count($resSelectCouponList) > 0) {
            foreach ($resSelectCouponList as $rowSize) {
                $attValue = ucfirst($rowSize['attd_value']);
                $attdID = $rowSize["attd_id"];
                
                $output6[] = "<div class='col-lg-2 border-danger position-relative' id='$attdID' style='margin-right: 12px; margin-bottom: 5px; background: #1500D1; color: white; font-size: 15px;
                height: 3vh;'>$attValue<button type='button' Class='delete-btn position: absolute' style='position: absolute; top: 0; right: 0; border-radius: 14px; border: none; background: transparent; color: white;' data-id='$attdID'>X</button></div>";
            }
            $output = $output6;

        // }

        $sql = "SELECT attribute.*, attributedtl.* FROM attributedtl LEFT JOIN attribute ON attd_attid = att_Id  WHERE att_Id = '$attId'";
        $result = $dbh->query($sql);
        $row = $result->fetch();
            if($row['att_IsMultiple'] == 1){
                $output1 = '1';
                $output2 = '0';
                $output3 = '0';
            }elseif($row['att_isSingalChoise'] == 1){
                $output1 = '0';
                $output2 = '1';
                $output3 = '0';
            }else{
                $output1 = '0';
                $output2 = '0';
                $output3 = '1';
            }
            
            $output4 = '<label class="col-lg-2 control-label">Add Attribute Value<span class="required"
            style="color:red ;">*</span> :</label>
            <div class="col-lg-8">
                                        <input type="text" name="attValue" id="attValue" class="form-control"
                                            placeholder="Enter Attribute Value">
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="row">
                                            <label class="col-lg-2 control-label">&nbsp;</label>
                                            <div class="col-lg-6">
                                                <button type="button" name="addattValue" id="addattValue" onclick="" class="btn btn-primary"
                                                    aria-expanded="false">ADD </button>
                                            </div>
                                        </div>
                                    </div>';
            if($row['att_IsStockAtt'] == 1){
                $output5 = '1';
            }else{
                $output5 = '0';
            }
            
        echo json_encode(array($output1, $output2, $output3, $output4, $output5, $output));
        // }
    }

    /* ==========================================================
    ---------------- Attribute Value Deleation -------------------
    ============================================================= */

    if(isset($_POST['isDeleteData'])){
        $Id = $_POST['attdtlId'];
        $sql = "DELETE FROM attributedtl WHERE attd_id = '$Id'";
        $result = $dbh->query($sql);
        if($result){
            echo '1';
        }else{
            echo '0';
        }
    }

    /* ==========================================================
    ---------------- Attribute Detail Value Addition -------------------
    ============================================================= */

    if(isset($_POST['isAddAttData'])){
        $attId = $_POST['attSelVal'];
        $attVal = $_POST['attValue'];

        $sql = "INSERT INTO attributedtl SET attd_attid = '$attId', attd_value='$attVal'";
        $result = $dbh->query($sql);
        if($result){
            echo '1';
        }else{
            echo '0';
        }
    }

    /* ==================================================================
    ---------------- Display Attribute Value For Item -------------------
    ====================================================================== */

    if(isset($_POST['isItemAtt'])){
        include '../classes/class_common.php';
        $attribute = $_POST['selAttribute'];
        $item = $_POST['item'];

        $sql1 = "SELECT attributeitem.*, attributedtl.* FROM attributeitem LEFT JOIN attributedtl ON iteAtt_value = attd_id WHERE iteAtt_attid = '$attribute' AND iteAtt_itemID = '$item'";
    
        $result1 = $dbh->query($sql1);
        $resAttItem = $result1->fetchAll();
        $mydata1 = '';
        $mydata3 = '';
        if(count($resAttItem) >0){
            $mydataA = '';
            foreach($resAttItem as $rowSelectAttribute){
                $attributeSql = $dbh->query("SELECT `attribute`.`att_IsMultiple`, `attribute`.`att_isSingalChoise` FROM `attribute` WHERE `attribute`.`att_Id`=".$rowSelectAttribute['iteAtt_attid']);
                $attributeRes = $attributeSql->fetch();
                if($rowSelectAttribute['isdefault'] == 1){
                    $ischecked = 'checked';
                }else{
                    $ischecked = '';
                }
                if($attributeRes['att_IsMultiple'] == 1){
                    $inputTag = "<input $ischecked type='checkbox' value='1' class='isdefaultSetAtt ismultipleAtt' data-attitemid='".$rowSelectAttribute['iteAtt_id']."' style='position: absolute; top: 0; right: 20px;' name='isdefaultAtt'>";
                }else if($attributeRes['att_isSingalChoise'] == 1){
                    $inputTag = "<input $ischecked type='radio' data-itemid='".$rowSelectAttribute['iteAtt_itemID']."' data-attributeid='".$rowSelectAttribute['iteAtt_attid']."' data-attitemid='".$rowSelectAttribute['iteAtt_id']."' value='1' class='isdefaultSetAtt isSingleAtt' style='position: absolute; top: 0; right: 20px;' name='isdefaultAtt'>";
                }else{
                    $inputTag = '';
                }
                
                $mydataA .= "<div class='col-lg-2 border-danger position-relative' id='".$rowSelectAttribute['iteAtt_value']."' style='margin-right: 12px; margin-top: 3px; margin-bottom: 5px; background: #1500D1; color: white; font-size: 15px;height: 3vh;'>".$rowSelectAttribute['attd_value']."$inputTag<button type='button' Class='delete-btn position: absolute' style='position: absolute; top: 0; right: 0; border-radius: 14px; border: none; background: transparent; color: white;' data-id='".$rowSelectAttribute['iteAtt_value']."' data-attid='".$rowSelectAttribute['iteAtt_id']."'>X</button></div>"; 

            }
            $mydata1 = '1';
            $mydata3 =  $mydataA;
        }else{
            $mydata1 = '0';
            $mydata3 = '';
        }

        $sql = "SELECT attribute.*, attributedtl.* FROM attributedtl LEFT JOIN attribute ON attd_attid = att_Id WHERE att_Id = '$attribute' AND attd_id NOT IN ( SELECT iteAtt_value FROM attributeitem where iteAtt_attid='$attribute' AND iteAtt_itemID='$item')";
        $result = $dbh->query($sql);

        $resSelectAttVal = $result->fetchAll();
        if(count($resSelectAttVal) > 0){
        $options1 = "<option value='0'>Select Attribute Value</option>";
            foreach($resSelectAttVal as $rowSelectAtt){
                $attName = $rowSelectAtt['att_Name'];
                $options1 .="<option value='".$rowSelectAtt['attd_id']."'>".$rowSelectAtt['attd_value']."</option>";
            }
        }else{
            $options1 = "<option value='0'>No any Attribute Value</option>";
        }
        $result2 = $dbh->query($sql);
        $row = $result2->fetch();
        if($row['att_IsMultiple'] == 1 || $row['att_isSingalChoise']== 1){
            $selectName = 'attValues'.$row['att_Id'];
            $isbtnActive = "<button type='button' name='addattValue' id='addattValue' data-attid='".$row['att_Id']."' class='btn btn-primary addAttvalue'
            aria-expanded='false'>ADD </button>";
            $function='';
            $data ='';
            $data2 = '';
        }else{
            $selectName = 'SchoiseValues'.$row['attd_id'];
            $isbtnActive = '';
            $function ="schoisedata";
            $data = "data-idvalue='".$row['att_Id']."'";
            $data2 = "data-idvalue2='".$row['attd_id']."'";
        }
        $mydata2 =  "<div class='col-lg-3'>$attName</div>
        <div class='col-lg-7'><select name='$selectName' $data $data2 id='$selectName' class='form-control $function'>$options1</select></div>
        <div class='col-lg-2'>$isbtnActive</div>";
        

        echo json_encode(array($mydata1, $mydata2, $mydata3));
        
    }

    /* ============================================================
    --------------- Select Product For Add Stock ------------------
    =============================================================== */

    if(isset($_POST['isStockProdId'])){
        $productId = $_POST['productId'];
        $sql = "SELECT * FROM item WHERE ite_ProdId = $productId";
        $res = $dbh->query($sql);

        $unitSql = "select un_Code, un_ID FROM product LEFT JOIN unit on prod_unitId = un_ID WHERE prod_Id = '$productId'";
        // echo $unitSql;
        // die();
        $unitRes =  $dbh->query($unitSql);
        $unitRow = $unitRes->fetch();
        $unitoption = "<option value='".$unitRow['un_ID']."'>".$unitRow['un_Code']."</option>";
        // echo $unitoption;
        // die();
        $resProduct = $res->fetchAll();
        if(count($resProduct) > 0){
            $options = "<option value='0'>Select Item</option>";
            foreach($resProduct as $rowSelectproduct){
                $options .="<option value='".$rowSelectproduct['ite_Id']."'>".$rowSelectproduct['ite_Name']."</option>";
            }
            //  echo $options;
        }else{
            $options = "<option value='0'>Item not Available for this Product</option>";
        }
        echo json_encode(array($unitoption,$options));
    }


    /* ========================================================================
    --------------- Select Item Attribute Item For Add Stock ------------------
    ============================================================================ */

    if(isset($_POST['isStockItemId'])){
        $ItemId = $_POST['itemId'];
        $sql = "SELECT attributeitem.*, attribute.* FROM attributeitem LEFT JOIN attribute ON iteAtt_attid =att_Id WHERE iteAtt_itemID = '$ItemId' GROUP BY iteAtt_attid";
        $res = $dbh->query($sql);
        $resAttribute = $res->fetchAll();
        if(count($resAttribute) > 0){
            $options = "<option value='0'>Select Attribute</option>";
            foreach($resAttribute as $rowSelectItem){
                $options .="<option value='".$rowSelectItem['att_Id']."'>".$rowSelectItem['att_Name']."</option>";
            }
            //  echo $options;
        }else{
            $options = "<option value='0'>this Item have not any Attribute Value</option>";
        }
        echo $options;
    }

    /* =============================================================
    ---------------------- Add Attribute Item ----------------------
    ================================================================ */

    if(isset($_POST['isAddattributeItem'])){
        $attributeId = $_POST['attributeId'];
        $attVal = $_POST['attval'];
        $item = $_POST['item'];
        
        $sql1 = "SELECT * FROM attributeitem WHERE iteAtt_attid = '$attributeId' AND iteAtt_value = '$attVal' AND iteAtt_itemID = '$item'";
        $res1 = $dbh->query($sql1);
        $resAttItem = $res1->fetchAll();
        // if(count($resAttItem) > 0){
        //     echo "0";
        // }else{
            $sql2 = "SELECT * FROM attributedtl WHERE attd_id = '$attVal'";
            $res2 = $dbh->query($sql2);
            $row2 = $res2->fetch();
            $sql ="INSERT INTO attributeitem SET iteAtt_attid = '$attributeId', iteAtt_value = '$attVal', iteAtt_itemID = '$item'";
            $res = $dbh->query($sql);
            $lastId = $dbh->lastInsertId();
            if($res){
                // echo "1";
            echo $mydataA = "<div class='col-lg-2 border-danger position-relative' id='$attVal' style='margin-right: 12px; margin-top: 3px; margin-bottom: 5px; background: #1500D1; color: white; font-size: 15px;height: 3vh;'>".$row2['attd_value']."<button type='button' Class='delete-btn position: absolute' style='position: absolute; top: 0; right: 0; border-radius: 14px; border: none; background: transparent; color: white;' data-id='$attVal' data-attid='$lastId'>X</button></div>"; 
            }else{
                // echo "2";
            }
        // }
        
    }

    if(isset($_POST['iddelAttItem'])){
        $attItemID = $_POST['attId'];
        $sql = "DELETE FROM attributeitem WHERE iteAtt_id = '$attItemID'";
        $res = $dbh->query($sql);
        if($res){
            echo "Delete successfully";
        }else{
            echo "Failed";
        }
    }

    /* ============================================================
    ---------------- Order Cancellation Status Updation ---------------
    =============================================================== */

    if(isset($_POST['cancellationOrderid'])){
        $orderId = $_POST['cancellationOrderid'];
        $orderStatus = $_POST['cancellationOrderstatus'];
        
        $sql1 = "SELECT ord_DeliverDate,ord_userName,ord_emailid,ord_OrderNo,OrderStatusID,OrderTotalAmount FROM `order` WHERE ord_id  = '$orderId'";
    
        $res = $dbh->query($sql1);
        $row = $res->fetch();
        $orderNo = $row['ord_OrderNo'];
        $email = $row['ord_emailid'];
        $userName = ucfirst($row['ord_userName']);
        $price= $row['OrderTotalAmount'];
        
        $items =array();
        
        $Ordmailsql = "SELECT `order`.*, orderdtl.* FROM orderdtl LEFT JOIN `order` ON ordDtl_OrderId=ord_id WHERE ord_id='$orderId'";
        
        $OrdmailRes =  $dbh->query($Ordmailsql);
        $OrdmailResIs = $OrdmailRes->fetchAll();
        foreach($OrdmailResIs as $rowmaildata){
            $items[] = $rowmaildata['OrdDtl_itemName'];
            //  $itemList[] = $rowmaildata['ordDtl_itemID'];
        }
        $itemname = implode(',',$items);
        
        date_default_timezone_set("Asia/Kolkata");
        $updateDate = date('Y-m-d h:i:s');
        
        
        if($orderStatus == 'Yes'){
            // $date = date()
            $CancellationApprovedSql = "UPDATE `cancellationrequest` SET cancelResq_Iscancel = '1',cancelResq_ApprovedDate= '$updateDate' WHERE cancelResq_OderId = '$orderId'";
    
            $resCancellationApproved = $dbh->query($CancellationApprovedSql);
            
            $updateOrderStatus = "UPDATE `order` SET OrderStatusID=5 WHERE ord_id=$orderId";
            $updateOrderStatusRes = $dbh->query($updateOrderStatus);
            
            
            /* --------- Send Cancellation Request Approved Email to the user ------------------- */
            if($resCancellationApproved){
                $to = $email;
            $subject = "Order No. #$orderNo cancelled successfully on Gorfkit.in";
            
            $message= "<html>
        <head>
        <style>

        </style>
        </head>
        <body>

        <p>Dear $userName,</p>
        <p>Your order no. #$orderNo has been cancelled Successfully.</p>
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
                echo "Cancellation Request Approved Mail Send to the user";
            }else{
                echo "Cancellation Request Approved Mail Send Failed";
            } 
        }
        
            
        }else if($orderStatus == 'No'){
            $CancellationDeclineSql = "UPDATE `cancellationrequest` SET cancelResq_Iscancel = '0',cancelResq_DeclineDate= '$updateDate' WHERE cancelResq_OderId = '$orderId'";
            $resCancellationDecline = $dbh->query($CancellationDeclineSql);
            
            /* --------- Send Cancellation Request Decline Email to the user ------------------- */
            if($resCancellationDecline){
                $to = $email;
            $subject = "Order No. #$orderNo cancellation request is declined  on Gorfkit.in";
            
            $message= "<html>
        <head>
        <style>

        </style>
        </head>
        <body>

        <p>Dear $userName,</p>
        <p>Your order no. #$orderNo cancellation request is declined. This order cannot be cancelled.</p>
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
                echo "Cancellation Request Decline Mail Send to the user";
            }else{
                echo "Cancellation Request Decline Mail Send Failed";
            } 
        }
        }else{
        echo "Not updated"; 
        }

    }


    /* ============================================================
    --------------- Select Product For Add Stock ------------------
    =============================================================== */

    if(isset($_POST['isattributeValSel'])){
        $attributeId = $_POST['attributeId'];
        
        if($attributeId != 0){
            $sql = "SELECT * FROM attributedtl WHERE attd_attid = $attributeId";
            $res = $dbh->query($sql);

            $resProduct = $res->fetchAll();
            if(count($resProduct) > 0){
                $options = "<option value='0'>Select Attribute Value</option>";
                foreach($resProduct as $rowSelectproduct){
                    $options .="<option value='".$rowSelectproduct['attd_id']."'>".$rowSelectproduct['attd_value']."</option>";
                }
                echo $options;
            }else{
                echo "<option value='0'>Attribute  have not any Value </option>";
            }
        }else{
            echo "<option value='0'>Select Attribute Value</option>";
        }
    }


    /* ============================================================
    --------------- Set Order Delivary Date Time  ------------------
    =============================================================== */

    if(isset($_POST['isselDelivaryDateTime'])){
        // echo "Hello";
        $date = $_POST['delivarydate'];
        $orderDate = new DateTime($date);

        $NewOrderDate =  $orderDate->format('M d, Y'); 
        $timeFrom = $_POST['timefrom'];
        $timeTo = $_POST['timeto'];
        
        $DelivarytimeFrom = date("h:i A", strtotime($timeFrom));
        $Delivarytimeto = date("h:i A", strtotime($timeTo));
        $orderId = $_POST['orderId']; 
        $sql = "UPDATE `order` SET ord_DeliverDate = '$date', ord_deliveredTimeFrom='$timeFrom', ord_deliveredTimeTo='$timeTo',OrderStatusID=3 WHERE ord_id='$orderId'";
        $res = $dbh->query($sql);
        
        $dispatchSql = "INSERT INTO orderstausTime SET ordTime_ordId='$orderId',ordTime_statusId=3"; 
        $dispatchRes = $dbh->query($dispatchSql);
        
        // Dispatch Order Email Send //
        $items = array();
        $sql1 = "SELECT ord_DeliverDate,ord_userName,ord_emailid,ord_OrderNo,OrderStatusID,OrderTotalAmount FROM `order` WHERE ord_id  = '$orderId'";
        $res1 = $dbh->query($sql1);
        $row = $res1->fetch();
        $orderNo = $row['ord_OrderNo'];
        $email = $row['ord_emailid'];
        $userName = ucfirst($row['ord_userName']);
        $price= $row['OrderTotalAmount'];
        $delivaryDate = $row['ord_DeliverDate'];
        $Ordmailsql = "SELECT `order`.*, orderdtl.* FROM orderdtl LEFT JOIN `order` ON ordDtl_OrderId=ord_id WHERE ord_id='$orderId'";
        // echo $Ordmailsql;
        // die();
        $OrdmailRes =  $dbh->query($Ordmailsql);
        $OrdmailResIs = $OrdmailRes->fetchAll();
        foreach($OrdmailResIs as $rowmaildata){
            $items[] = $rowmaildata['OrdDtl_itemName'];
        }
        $itemname = implode(',',$items);
        
        // echo $itemname;
        // // print_r($items);
        // die();
        if($res){
            
            $to = $email;
            $subject = "Order No. #$orderNo has Dispatched on Gorfkit.in";
            
            $message= "<html>
        <head>
        <style>

        </style>
        </head>
        <body>

        <p>Dear $userName,</p>
        <p>Your order no. #$orderNo has been dispatched from its location. Your order  expected to deliver to you on <b>$NewOrderDate</b> between $DelivarytimeFrom to $Delivarytimeto. Please be available.</p>
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
            
            
            
        mail($email,$subject,$message,implode("\r\n", $headers1));
            
            echo "Updated";
        }else{
            echo "Faield";
        }
    }



    /* ============================================================
    --------------- Remove Item Image ------------------
    =============================================================== */

    if(isset($_POST['isremoveImg'])){
        $imgId = $_POST['imgId'];
        $sqlTrashRecord = ' DELETE FROM itemimage WHERE 1 AND itImg_Id =' . $imgId;
        $res = $dbh->query($sqlTrashRecord);
        if($res){
            echo "Deleted";
        }else{
            echo "Delation Failed";
        }
    }

    /* ============================================================
    --------------- Remove Item Image ------------------
    =============================================================== */

    if(isset($_POST['isCreateMainImg'])){
        $itemId= $_POST['itemId'];
        $isMainImg = $_POST['isMainImg'];
        $sqlTrashRecord= "UPDATE itemimage SET itimg_IsMainImage = 0 WHERE itimg_itemID = $itemId;"; 
        $res = $dbh->query($sqlTrashRecord);
        if($res){
            $UpdateRecord = ' UPDATE itemimage SET itimg_IsMainImage = 1 WHERE itImg_Id =' . $isMainImg;
            $UpdationRes = $dbh->query($UpdateRecord);
            if($UpdationRes){
                echo "Update";
            }else{
                echo "Updation Final Failed "; 
            }
        }else{
            echo "Updation Failed";
        }
    }


    /* ============================================================
    --------------- Set Order Invoice Number ------------------
    =============================================================== */

    if(isset($_POST['issetInvoice'])){
        $invoiceNo = $_POST['inVoiceNo'];
        $orderId = $_POST['orderId'];
        
        try {
            $dbh->query("UPDATE `order` SET ord_invoiceNo = '$invoiceNo' WHERE ord_id = $orderId");
                echo "1";
        } catch (Exception $e) {
            if ($e->getCode() == '23000') {
                echo "0";
            }
        }
        
        // $sql = "UPDATE `order` SET ord_invoiceNo = '$invoiceNo' WHERE ord_id = $orderId";
        
    }

    /* ============================================================
    --------------- Update Review Status By Admin ------------------
    =============================================================== */

    if(isset($_POST['isRejectReview'])){
        $reviewId = $_POST['reviewid'];
        $sql = "UPDATE item_reviews SET itemRev_isRemove = 1 WHERE itemRev_id=$reviewId";
        $res = $dbh->query($sql);
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }

    /* ============================================================
    --------------- Block User Status By Admin ------------------
    =============================================================== */

    if(isset($_POST['isblockedUserbyadmin'])){
        $userid = $_POST['userid'];
        $reviewstatus = $_POST['statusvalue'];
        $sql = "UPDATE mstuser SET us_block = $reviewstatus WHERE us_Id=$userid";

        $res = $dbh->query($sql);
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }


    /* ============================================================
    --------------- AnyOne Can Review Or Not ------------------
    =============================================================== */
    if(isset($_POST['isanyOnecanReview'])){
        $value= $_POST['value'];
        $sql = "UPDATE appsetting SET appSetting_Action=$value WHERE appSetting_Id=1";
        $res = $dbh->query($sql);
        if($res){
            echo 1;
        }else{
            echo 0;
        }

    }

    /* =======================================================================
    --------------- Approved Review By Admin for appsetting Table ------------
    ========================================================================== */
    if(isset($_POST['isApprovedReview'])){
        $value= $_POST['value'];
        $sql = "UPDATE appsetting SET appSetting_Action=$value WHERE appSetting_Id=2";
        $res = $dbh->query($sql);
        if($res){
            echo 1;
        }else{
            echo 0;
        }

    }


    /* ======================================================================
    ------ Approved Review Status By Admin for item_reviews Table -----------
    ========================================================================= */

    if(isset($_POST['isApprovedRev'])){
        $reviewId = $_POST['reviewid'];
        $sql = "UPDATE item_reviews SET itemRev_isApproved = 1 WHERE itemRev_id=$reviewId";
        $res = $dbh->query($sql);
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }

    /* ======================================================================
    -------------- select Attribute For Attribute wise Price ----------------
    ========================================================================= */

    if(isset($_POST['isSetattributePrice'])){
        $attributeVal = $_POST['attributeValue'];
        $itemId = $_POST['itemId'];
        $sql = "SELECT `attribute`.`att_Id`,`attribute`.`att_Name`,`attribute`.`att_IsMultiple` FROM attributedtl LEFT JOIN attribute ON `attributedtl`.`attd_attid`= `attribute`.`att_Id` WHERE attd_id=$attributeVal";
        $res = $dbh->query($sql);
        $row = $res->fetch();


        $attName = $row['att_Name'];
        $ismultiple = $row['att_IsMultiple'];
        $attID = $row['att_Id'];
        if($ismultiple != 1){
            $condtionAttName = "AND att_Id <> $attID";
        }else{
            $condtionAttName = "";
        }
        $newDiv = "
        <div class='col-lg-2 newaddeddiv'>
            <div class='row'>
                <div class='col-lg-12'>
                    <label><b id='attributeName'></b></label>
                </div>
                <div class='col-lg-12 mb-5 attselecter' id='attselecter'
                    style='position: absolute; top: 25px;'>
                    <select class='form-control attnameclass' name='attName' id='attName$attributeVal'>
                        <option value='0'>Select Attribute</option>";
                        
                        $sql1 = "SELECT `attribute`.`att_Id`,`attribute`.`att_Name`, `attribute`.`att_IsMultiple` FROM attributeitem LEFT JOIN attribute ON `attributeitem`.`iteAtt_attid`= `attribute`.`att_Id` WHERE iteAtt_itemID=$itemId $condtionAttName GROUP BY att_Id ORDER BY att_Id ASC";
                    //    die(); 
                        
                        $res1 = $dbh->query($sql1);
                        $resSelectAttNameList = $res1->fetchAll();                           
                        
                            if (count($resSelectAttNameList) > 0) {
                                foreach ($resSelectAttNameList as $rowAttName) {
                                        
                                    $newDiv .="<optgroup label=".$rowAttName['att_Name'].">";
                                        
                                        $sql3 = "SELECT `attributedtl`.`attd_id`, `attributedtl`.`attd_value` FROM attributeitem LEFT JOIN attributedtl ON `attributeitem`.`iteAtt_value`= `attributedtl`.`attd_id` WHERE iteAtt_attid=".$rowAttName['att_Id']." AND iteAtt_itemID=".$itemId." AND attd_id <> $attributeVal  ORDER BY attd_id ASC"; 
                                        
                                        $res3 = $dbh->query($sql3);
                                        $resSelectCouponList = $res3->fetchAll();  
                                    
                                        if (count($resSelectCouponList) > 0) {
                                            foreach ($resSelectCouponList as $rowSize) {
                                                $newDiv .="<option value=".$rowSize['attd_id'].">".
                                                $rowSize['attd_value']."</option>";
                                            }
                                        }

                                    $newDiv .="</optgroup>";
                                                    
                                }
                            }
                    $newDiv .="</select>
                </div>
            </div>
        </div>";

        echo json_encode(array($newDiv,$attName));
    }


    /* ======================================================================
    ------------- select New Attribute For Attribute wise Price -----------------
    ========================================================================= */

    if(isset($_POST['isSetNewattribute'])){
          $itemID=$_POST['itemId'];
          $SelectedAttValueIds= $_POST['newattValue'];
  
          $QueryForGetAttNames="SELECT attribute.att_Name,attribute.att_Id FROM `attributeitem` left join attribute on attribute.att_Id=attributeitem.iteAtt_attid where iteAtt_itemID=". $itemID." and iteAtt_value not in(".implode(',',$SelectedAttValueIds).")
          and attribute.att_Id  not in (SELECT attribute.att_Id FROM `attributeitem` left join attribute on attribute.att_Id=attributeitem.iteAtt_attid where iteAtt_itemID=". $itemID." and iteAtt_value in(".implode(',',$SelectedAttValueIds).")
          and attribute.att_isSingalChoise=1
          group by attribute.att_Id)
          and ifnull(attribute.att_IsonView,0)=0
          group by attribute.att_Name,attribute.att_Id";
          $res = $dbh->query($QueryForGetAttNames);
          $rows = $res->fetchAll();
          $newDiv = "
          <div class='col-lg-3'>
              <div class='row'>
                  <div class='col-lg-12'>
                      <label><b id='attributeName' class='attributeName'></b></label>
                  </div>
                  <div class='col-lg-12 mb-5 attselecter' id='attselecter'
                      >";
                      if(count($rows) > 0){
                      $newDiv .="<select class='form-control attnameclass' onchange='seleactatt(event)' name='attName[]' id='attName'>
                          <option value='0'>Select Attribute</option>";
          foreach($rows as $row)
          {
           
                        $newDiv .="<optgroup label=". $row['att_Name'].">";
                        $sql1 = "SELECT attributedtl.attd_id,attributedtl.attd_value FROM `attributeitem` left join attributedtl on attributedtl.attd_id=attributeitem.iteAtt_value  
                        where  attributeitem.iteAtt_itemID=".$itemID." and attributeitem.iteAtt_value not in (".implode(',',$SelectedAttValueIds).") and attributeitem.iteAtt_attid=".$row['att_Id']."
                        group by attributedtl.attd_id,attributedtl.attd_value";
                        $res1 = $dbh->query($sql1);
                        $resSelectAttNameList = $res1->fetchAll();                           
                        foreach ($resSelectAttNameList as $rowAttName)
                        {
                            $newDiv .="<option value=".$rowAttName['attd_id'].">".
                            $rowAttName['attd_value']."</option>";
                        }
                        $newDiv .="</optgroup>";
          }
          
          $newDiv .="</select>";
           }
        $newDiv .="</div>
  </div>
</div>";
          echo $newDiv; 
          
    }

if(isset($_POST['isMultipledefaultAttItemValue'])){
    $ischecked = $_POST['isdefault'];

    $itemAttVal = $_POST['itemAttid'];
    $sql = "UPDATE attributeitem SET isdefault= $ischecked WHERE iteAtt_id=$itemAttVal";
    
    $query = $dbh->query($sql);
    if($query){
        echo 1;
    }else{
        echo 0;
    }
}

if(isset($_POST['isSingledefaultAttItemValue'])){
    $ischecked = $_POST['isdefault'];


    $itemId = $_POST['itemid'];
    $Attribute = $_POST['Attributeid'];
    $itemAttVal = $_POST['itemAttid'];
    $update = $dbh->query("UPDATE attributeitem SET isdefault= 0 WHERE iteAtt_attid=$Attribute AND iteAtt_itemID = $itemId");

    $sql = "UPDATE attributeitem SET isdefault= $ischecked WHERE iteAtt_id=$itemAttVal";
    
    $query = $dbh->query($sql);
    if($query){
        echo 1;
    }else{
        echo 0;
    }
}

    ?>