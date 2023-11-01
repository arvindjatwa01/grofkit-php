<?php  
 //action.php  
 include 'Crud.php';  
 $object = new Crud();  
 if(isset($_POST["action"]))  
 {  
      if($_POST["action"] == "Load")  
      {  
           echo $object->get_data_in_table("SELECT * FROM producttax ORDER BY Prot_Id DESC");  
      }  
      if($_POST["action"] == "Insert")  
      {  
           $prodName = mysqli_real_escape_string($object->connect, $_POST["prodName"]);  
           $taxName = mysqli_real_escape_string($object->connect, $_POST["proTaxName"]); 
           $taxFrom = mysqli_real_escape_string($object->connect, $_POST["proTaxFrom"]);  
           $taxTo = mysqli_real_escape_string($object->connect, $_POST["proTaxTo"]);
           $CGST = mysqli_real_escape_string($object->connect, $_POST["proCgst"]);  
           $SGST = mysqli_real_escape_string($object->connect, $_POST["proSgst"]); 
           $LGST = mysqli_real_escape_string($object->connect, $_POST["proLgst"]);   
           $query = "
           INSERT INTO producttax  
           (Prot_ProdID, Prot_Name, Prot_RateFrom, Prot_RateTo, Prot_Cgst, Prot_Sgst, Prot_Lgst)   
           VALUES ('".$prodName."', '".$taxName."', '".$taxFrom."', '".$taxTo."', '".$CGST."', '".$SGST."', '".$LGST."')  
           ";  
           $object->execute_query($query);  
           echo 'Data Inserted';  
      }  
 }  
 ?>  