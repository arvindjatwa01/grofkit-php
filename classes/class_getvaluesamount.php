<?php 

Class class_getvaluesamount
{
    
    
    function GetItemsTotalCost($userId)
    {
        global $dbh;
        // $query = "SELECT ifnull(SUM(item.ite_Rate * cart.cart_volume),0) as TotalitemCost FROM cart LEFT JOIN item ON cart.cart_itemId = item.ite_Id WHERE cart.cart_UserID IN($userId)";
        $query = "SELECT 
        ifnull(SUM(ifnull((SELECT attributeprice.attPrice_Price from attributeprice 
         where attributeprice.attPrice_attvaluesId=(SELECT GROUP_CONCAT(cartdtl.cartDtl_attvalue ORDER BY cartDtl_attvalue asc) from cartdtl where cartdtl.cartDtl_cartid=cart.cart_Id)),item.ite_Rate)*cart.cart_volume),0) as Rate,
        item.ite_MRP from cart left join item on cart.cart_itemId=item.ite_Id WHERE cart.cart_UserID=$userId";
        $strRes=$dbh->query($query);
        return $strRes->fetch()[0];
        // $finalAmount = $this->GetShippingCost($ItemList,$pincode) + $this->GetGstCost($ItemList) - $this->GetDiscountAmount($ItemList,$coupanid,$userId);
        // return $finalAmount;
    }

    function GetItems_TotalCost($userId,$itemid)
    {
        global $dbh;
        $query = "SELECT ifnull(SUM(item.ite_Rate * cart.cart_volume),0) as TotalitemCost FROM cart LEFT JOIN item ON cart.cart_itemId = item.ite_Id WHERE cart.cart_UserID=$userId and item.ite_Id=$itemid";
        $strRes=$dbh->query($query);
        return $strRes->fetch()[0];
        
    }
	function GetShippingCost($ItemList,$pincode,$userId)
    {
        global $dbh;
        $pincodeQuery = "SELECT pin_MinCartValue FROM pincode_onavailable WHERE  Pin_PinCode='".$pincode."' LIMIT 1";
        $pincodeRes=$dbh->query($pincodeQuery);
        $picodeDelivartCost = $pincodeRes->fetch()[0];
        
        if($this->GetItemsTotalCost($userId) >= $picodeDelivartCost){
            $Query="select sum(dcost) from (SELECT sum(ifnull(product.prod_DeliveryCost,0)) as dcost
        FROM item left join product on item.ite_ProdId=product.prod_Id
        where item.ite_Id IN(".implode(',',$ItemList).")) as dd";
        }else{
           $Query="select sum(dcost) from (SELECT sum(ifnull(product.prod_DeliveryCost,0)) as dcost
        FROM item left join product on item.ite_ProdId=product.prod_Id
        where item.ite_Id IN(".implode(',',$ItemList).")
        union all
        (SELECT ifnull(Pin_delivaryCost,0) as dcost FROM `pincode_onavailable` where Pin_PinCode='".$pincode."' LIMIT 1)) as dd"; 
        }
        
      $strRes=$dbh->query($Query);
      return $strRes->fetch()[0];
    // return $Query;
    }
    function GetGstCost($ItemList)
    {
        global $dbh;
        // $query = "SELECT sum(ifnull(producttax.Prot_Cgst,0)) as Dcost
        // FROM item left join producttax on item.ite_ProdId=producttax.Prot_ProdID
        // where item.ite_Id IN(".implode(',',$ItemList).")";
        $query = "SELECT ROUND(sum(ifnull(producttax.Prot_Cgst*item.ite_Rate*cart.cart_volume/100,0))+sum(ifnull(producttax.Prot_Sgst*item.ite_Rate*cart.cart_volume/100,0)),2) as Dcost FROM item left join producttax on item.ite_ProdId=producttax.Prot_ProdID LEFT JOIN cart ON ite_Id = cart_itemId where item.ite_Id IN(".implode(',',$ItemList).")";
        $strRes=$dbh->query($query);
        return $strRes->fetch()[0];
        // echo $query;
    }
    
    function GetDiscountAmount($ItemList,$coupanid,$userId)
    {
        global $dbh;
       $Query = "SELECT coupen.Cp_ID, coupandtl.CpDtl_itemID, coupen.CP_Volumn,coupen.CP_IsInAmount,coupen.cp_Minamount,coupen.cp_Maxamount,item.ite_Rate FROM `coupandtl` LEFT JOIN coupen ON coupandtl.CpDtl_CPID = coupen.Cp_ID LEFT JOIN item ON coupandtl.`CpDtl_itemID`=item.ite_Id WHERE coupandtl.CpDtl_itemID IN (0,".implode(',',$ItemList).") AND coupandtl.CpDtl_UserID IN (0,'$userId') AND coupen.Cp_ID ='$coupanid' limit 1"; 
        // echo $Query;
        // die();
        
        $strRes=$dbh->query($Query);
        $row = $strRes->fetch();
        if($strRes->rowCount()>0)
        {   
             $isinAmount=$row['CP_IsInAmount'];
             $CartVolume=$row['CP_Volumn'];
             $MinAmount = $row['cp_Minamount'];
             $MaxAmount = $row['cp_Maxamount'];
             $itemID = $row['CpDtl_itemID'];
             
             $totaldiscountPrice=$itemID==0?$this->GetItemsTotalCost($userId):$this->GetItems_TotalCost($userId,$itemID);
             
             if($MaxAmount == 0){
                 $maxCondition = 1==1;
             }else{
                  $maxCondition = $totaldiscountPrice <= $MaxAmount;
             }
             if($MinAmount==0){
                 $minCondition = 1==1;
             }else{
                 $minCondition = $totaldiscountPrice >= $MinAmount;
             }
             if($minCondition AND $maxCondition){
                 
             
            if($isinAmount==1)
                {
                    return $CartVolume;
                }
            $itemID=$row['CpDtl_itemID'];
            
            $totalAmount=$itemID==0?$this->GetItemsTotalCost($userId):$this->GetItems_TotalCost($userId,$itemID);
            return ($totalAmount*$CartVolume/100); 
            
        }
        }
        return 0;
    }
    function GetFinalCost($ItemList,$pincode,$coupanid,$userId){
        // $finalAmount = $this->GetItemsTotalCost($userId) + $this->GetShippingCost($ItemList,$pincode) + $this->GetGstCost($ItemList) - $this->GetDiscountAmount($ItemList,$coupanid,$userId);
        $finalAmount = $this->GetItemsTotalCost($userId) + $this->GetShippingCost($ItemList,$pincode,$userId) + $this->GetGstCost($ItemList) - $this->GetDiscountAmount($ItemList,$coupanid,$userId);
        return $finalAmount;
    }
}

$GetValuesAmount = new class_getvaluesamount;

?>