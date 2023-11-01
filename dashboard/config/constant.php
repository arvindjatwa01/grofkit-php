<?php
define('SITE_TITLE','Grofkit');
// define(SITE_URL)
define('SITE_ADMIN','dashboard/admin/');
define('SITE_ADMIN_URL',SITE_URL.SITE_ADMIN);
// echo SITE_ADMIN_URL;
// die();
define('SITE_ADMIN_PATH',SITE_PATH.SITE_ADMIN);

define('SITE_FRONT_INCLUDE','includes/');
/************Table constants********************/

define('TABLE_ADMIN','admin');

define('TABLE_CATEGORY','country');

define('TABLE_THEME_SETTING','theme_setting');

/************Table constants********************/

define('SITE_CLASSES',SITE_PATH.'dashboard/classes/');

/************Table constants********************/
//upload   directory
define('SITE_UPLOAD','dashboard/uploads/');
define('SITE_UPLOAD_URL',SITE_URL.SITE_UPLOAD);
define('SITE_UPLOAD_PATH',SITE_PATH.SITE_UPLOAD);

//upload  directory SITE_SLIDER_IMAGE_PATH
define('SITE_ADMIN_IMAGE_PATH','admin_image/');

define('SITE_ITEM_IMAGE_PATH','item_image/');
define('SITE_CATEGARY_IMAGE_PATH','category_icon_image/');

$aryGlobalStatus = array('<span class="label label-sm label-danger">Inactive</span> ','<span class="label label-sm label-success">Active</span> ');
?>