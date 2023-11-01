<?php
include_once('./config/config.php');


try{
    if(isset($_REQUEST["term"])){
        // create prepared statement
        $sql = "SELECT * FROM pincode_onavailable WHERE Pin_PinCode LIKE :term";
        $stmt = $dbh->prepare($sql);
        $term = $_REQUEST["term"] . '%';
        // bind parameters to statement
        $stmt->bindParam(":term", $term);
        // execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                echo "<p>" . $row["Pin_PinCode"] . "</p>";
            }
        } else{
            echo "<p>No matches found</p>";
        }
    }  
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close statement
unset($stmt);
?>