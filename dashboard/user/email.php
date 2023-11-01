
<?php
include '../admin/connection_handle.php';

if (isset($_POST['isset'])) {

    $logogrid = $_POST['logogrid'];
    $logoformat = $_POST['logoformat'];
    $borderbox = $_POST['borderbox'];
    $logosize = $_POST['logosize'];
    $acc_terms = $_POST['acc_terms'];
    $download_local = $_POST['download_local'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_website = $_POST['user_website'];

    $sqlInsertMediaData = "INSERT INTO `download_history`(`logogrid`, `logoformat`, `borderbox`, `logosize`, `acc_terms`, `download_local`, `username`, `user_email`, `user_website`, `logo_path`) VALUES ('$logogrid','$logoformat','$borderbox','$logosize','$acc_terms','$download_local','$username','$user_email','$user_website','not available')";
    $truedata = $dbh->query($sqlInsertMediaData);
    if ($truedata) {

        date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
        $datetime = date("Y-m-d H:i:s");

        echo $user_email;
    } else {

    }
}





?>
