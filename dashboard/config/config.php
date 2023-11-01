<?php session_start();
ob_start();



define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'grofkitstore');

$hostname = DB_HOST;
$username = DB_USER;
$password = '';

try {
    $dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

// define('SITE_ABS_PATH', '/grofkit/');
define('SITE_ABS_PATH', '/grofkitStore/');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . SITE_ABS_PATH);
// define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . SITE_ABS_PATH);

define('SITE_PATH', $_SERVER['DOCUMENT_ROOT'] . SITE_ABS_PATH);


include_once 'constant.php';
include_once 'functions.php';
