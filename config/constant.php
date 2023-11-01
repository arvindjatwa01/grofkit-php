<?php
define('SITE_TITLE','Grofkit');

define('SITE_ADMIN','admin/');
define('SITE_ADMIN_URL',SITE_URL.SITE_ADMIN);
define('SITE_ADMIN_PATH',SITE_PATH.SITE_ADMIN);

define('SITE_FRONT_INCLUDE','includes/');
/************Table constants********************/
// define('TABLE_ROOMIMAGE','vg_room_images');
define('TABLE_ADMIN','admin');
define('TABLE_USER','mstuser');
// define('TABLE_BLOG', 'vg_blog');
// define('TABLE_PAGES','vg_pages');
// define('TABLE_MEDIA','vg_media');
// define('TABLE_NEWS','vg_news');
// define('TABLE_STATE','vg_state');
// define('TABLE_BOOKING','vg_booking');
// define('TABLE_TESTIMONIAL','vg_testimonial');
// define('TABLE_COUPON','vg_coupon');
// define('TABLE_CONTACT','vg_contact_us');
// define('TABLE_GALLERY','vg_gallery');
// define('TABLE_ENQUIRY','vg_side_enquiry');
// define('TABLE_ROOM_FEATURE','vg_room_feature');
// define('TABLE_ROOM','vg_room');
define('TABLE_CATEGORY','country');
// define('TABLE_SOCIAL_SETTING','vg_social_setting');
define('TABLE_THEME_SETTING','theme_setting');
// define('TABLE_FOOTER_SETTING','vg_footer_setting');
// define('TABLE_SLIDER','vg_slider');
// define('TABLE_LOCATION','vg_location');
/************Table constants********************/

define('SITE_CLASSES',SITE_PATH.'classes/');

/************Table constants********************/
//upload   directory
define('SITE_UPLOAD','uploads/');
define('SITE_UPLOAD_URL',SITE_URL.SITE_UPLOAD);
define('SITE_UPLOAD_PATH',SITE_PATH.SITE_UPLOAD);

//upload  directory SITE_SLIDER_IMAGE_PATH
define('SITE_ADMIN_IMAGE_PATH','admin_image/');
define('SITE_NEWS_IMAGE_PATH','news_image/');
define('SITE_LOCATION_IMAGE_PATH','location_image/');
define('SITE_THEME_IMAGE_PATH','theme_image/');
define('SITE_POST_IMAGE_PATH','post_image/');

define('SITE_BLOG_IMAGE_PATH','blog_image/');
define('SITE_BUSINESS_IMAGE_PATH','business_image/');
define('SITE_MEDIA_IMAGE_PATH','media_image/');
define('SITE_GALLERY_IMAGE_PATH','gallery_image/');
define('SITE_TESTIMONIAL_IMAGE_PATH','testimonial_image/');
define('SITE_CATEGORY_ICON_PATH','category_icon/');
define('SITE_FEATURE_IMAGE_PATH','feature_image/');

define('SITE_SLIDER_IMAGE_PATH','slider_image/');
define('SITE_ROOM_IMAGE_PATH','room_image/');
define('SITE_COMPANY_PATH','company_image/');
define('SITE_ITEM_IMAGE_PATH','item_image/');
// define('VARIENT_IMAGE','varient_image/');
$aryGlobalStatus = array('<span class="label label-sm label-danger">Inactive</span> ','<span class="label label-sm label-success">Active</span> ');
?>