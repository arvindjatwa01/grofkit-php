<?php




function dates_month($month, $year)
{
	$num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	$dates_month = array();

	for ($i = 1; $i <= $num; $i++) {
		$mktime = mktime(0, 0, 0, $month, $i, $year);
		$date = date("d-M-Y", $mktime);
		$dates_month[$i] = $date;
	}

	return $dates_month;
}




function siteDateFormatDisplay($strDate)
{
	$strDate = date('jS F Y (l)', strtotime($strDate));
	return $strDate;
}







function redirect($strURL)
{
	header('location:' . $strURL);
	die();
}

/**
 *  20141206:NK:start:upload document
 *@param $strSourcePath <p>Source path</p>
 *@param $strDestPath    <p>Destination Path</P>
 *@param $strFileName <p>File Name</p>
 */
function uploadDocument($strSourcePath, $strDestPath, $strName)
{
	//die($strDestPath);
	if (!is_dir($strDestPath)) {
		mkdir($strDestPath, 775);
	}
	move_uploaded_file($strSourcePath, $strDestPath . $strName);
}
//20141206:NK:end:upload document

function sitePagination($intTotalPage, $strRedirect = '')
{



	/*
		Place code to connect to your DB here.
	*/
	//include('config.php');	// include your code to connect to DB.

	$tbl_name = "";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;

	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/

	$total_pages = $intTotalPage;
	$strQueryString = '';
	/* Setup vars for query. */
	$aryPage = array();
	if ('' == $strRedirect) {
		$aryURLData = explode('?', $_SERVER['REQUEST_URI']);

		$targetpage = $aryURLData[0]; 	//your file name  (the name of this file)
		$strQueryString = '';

		if (isset($aryURLData[1])) {
			$strQueryString = $aryURLData[1];
			$aryURLParam = explode('&', $strQueryString);
			$strQueryString = '';

			foreach ($aryURLParam as $strURLParam) {
				if (strpos($strURLParam, 'page=') === false) {

					$strQueryString .= $strURLParam . '&';
				} else {
					$aryPage['page'] = str_replace('page=', '', $strURLParam);
				}
			}
			//$strQueryString =rtrim($strQueryString,'&');



		}
	} else {

		$targetpage = $strRedirect;
	}

	$limit = 10;

	if (isset($_SESSION['pageRecordLimit']) && -1 == $_SESSION['pageRecordLimit']) {

		$limit = $total_pages;
	} else
	if (isset($_SESSION['pageRecordLimit']) && 0 < $_SESSION['pageRecordLimit']) {

		$limit = $_SESSION['pageRecordLimit'];
	}
	if (!isset($_SESSION['pageRecordLimit'])) {

		$_SESSION['pageRecordLimit']  =  $limit;
	}
	//how many items to show per page
	$page = 1;
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}

	if ($page)
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0

	/* Get data. */
	$aryPageLimit['limit'] = ' LIMIT ' . $start . ', ' . $limit;
	//$sql = "SELECT column_name FROM $tbl_name LIMIT $start, $limit";
	//$result = mysql_query($sql);

	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages / $limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1

	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	if (strpos($_SERVER['REQUEST_URI'], 'admin/') !== false) {

		$intEndRecord = ($start + $limit);
		if ($intEndRecord > $intTotalPage) {
			$intEndRecord = $intTotalPage;
		}
		$pagination = "";
		if ($lastpage > 1) {
			$pagination .= "<div class=\"row\"><div class=\"col-md-6 col-sm-12\">Showing result   " . ($start + 1) . " - " . $intEndRecord . " from " . $intTotalPage . "    </div><div cla
ss=\"col-md-6 col-sm-12\" style=\"float:right;\"><ul class=\"pagination bootpag\" style=\"float:right;\">";
			//previous button
			if ($page > 1)
				$pagination .= "<li><a  class=\"previous\" href=\"$targetpage?page=$prev$strQueryString\"><i class=\"fa fa-angle-left\"></i>Previous</a></li>";
			else
				$pagination .= "<li><span class=\"disabled\" style=\"display: none;\"><i class=\"fa fa-angle-left\"></i>Previous</span></li>";

			//pages	
			$pagination .= '';
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{
				for ($counter = 1; $counter <= $lastpage; $counter++) {
					if ($counter == $page)
						$pagination .= "<li class=\"active\"><span >$counter</span></li>";
					else
						$pagination .= "<li><a href=\"$targetpage?page=$counter$strQueryString\">$counter</a></li>";
				}
			} elseif ($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if ($page < 1 + ($adjacents * 2)) {
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
						if ($counter == $page)
							$pagination .= "<li class=\"active\"><span >$counter</span></li>";
						else
							$pagination .= "<li><a href=\"$targetpage?page=$counter$strQueryString\">$counter</a></li>";
					}

					$pagination .= "<li><a href=\"$targetpage?page=$lpm1$strQueryString\">$lpm1</a></li>";
					$pagination .= "<li><a href=\"$targetpage?page=$lastpage$strQueryString\">$lastpage</a></li>";
				}
				//in middle; hide some front and some back
				elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
					$pagination .= "<li><a href=\"$targetpage?page=1$strQueryString\">1</a></li>";
					$pagination .= "<li><a href=\"$targetpage?page=2$strQueryString\">2</a></li>";

					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
						if ($counter == $page)
							$pagination .= "<li class=\"active\"><span >$counter</span></li>";
						else
							$pagination .= "<li><a href=\"$targetpage?page=$counter$strQueryString\">$counter</a></li>";
					}

					$pagination .= "<li><a href=\"$targetpage?page=$lpm1$strQueryString\">$lpm1</a></li>";
					$pagination .= "<li><a href=\"$targetpage?page=$lastpage$strQueryString\">$lastpage</a></li>";
				}
				//close to end; only hide early pages
				else {
					$pagination .= "<li><a href=\"$targetpage?page=1$strQueryString\">1</a></li>";
					$pagination .= "<li><a href=\"$targetpage?page=2$strQueryString\">2</a></li>";

					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
						if ($counter == $page)
							$pagination .= "<li class=\"active\"><span >$counter</span></li>";
						else
							$pagination .= "<li><a href=\"$targetpage?page=$counter$strQueryString\">$counter</a></li>";
					}
				}
			}
			$pagination .= '';
			//next button
			if ($page < $counter - 1)
				$pagination .= "<li><a href=\"$targetpage?page=$next$strQueryString\" class=\"next\">Next<i class=\"fa fa-angle-right\"></i></a></li>";
			else
				$pagination .= "<li><span class=\"disabled\" style=\"display: none;\">Next<i class=\"fa fa-angle-right\"></i></span></li>";
			$pagination .= "</ul></div></div>\n";
		}
	} else {
		$pagination = "";

		$intEntryDisplay = $start + $limit;
		if ($intEntryDisplay > $intTotalPage) {
			$intEntryDisplay = $intTotalPage;
		}
		if ($lastpage > 1) {
			$pagination .= '<div class="row-fluid"><div class="span6"><div class="dataTables_info" id="data-table_info">
		<div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"><ul class="list-inline list-unstyled">';
			//previous button
			if ($page > 1)
				$pagination .= '<li class="prev"><a href="' . $targetpage . '?' . $strQueryString . 'page=' . $prev . '">← Previous</a></li>';
			else
				$pagination .= '<li class="prev disabled" style=\"display: none;\"><a href="javascript:void(0);">← Previous</a></li>';

			//pages	
// 			echo $page;
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{
				for ($counter = 1; $counter <= $lastpage; $counter++) {
					if ($counter == $page)
						$pagination .= '<li class="active"><a href="javascript:void(0);">' . $counter . '</a></li>';
					else
						$pagination .= '<li ><a href="' . $targetpage . '?' . $strQueryString . 'page=' . $counter . '">' . $counter . '</a></li>';
				}
			} elseif ($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if ($page < 1 + ($adjacents * 2)) {
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
						if ($counter == $page)
							$pagination .= '<li class="active"><a href="javascript:void(0);">' . $counter . '</a></li>';
						else
							$pagination .= '<li ><a href="' . $targetpage . '?' . $strQueryString . 'page=' . $counter . '">' . $counter . '</a></li>';
					}
					$pagination .= "...";
					$pagination .= '<li ><a href="' . $targetpage . '?' . $strQueryString . 'page=' . $lpm1 . '">' . $lpm1 . '</a></li>';
					$pagination .= '<li ><a href="' . $targetpage . '?' . $strQueryString . 'page=' . $lastpage . '">' . $lastpage . '</a></li>';
				}
				//in middle; hide some front and some back
				elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
					$pagination .= '<li ><a href="' . $targetpage . '?' . $strQueryString . 'page=1">1</a></li>';
					$pagination .= '<li ><a href="' . $targetpage . '?' . $strQueryString . 'page=2">2</a></li>';

					$pagination .= "...";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {

						if ($counter == $page)
							$pagination .= '<li class="active"><a href="javascript:void(0);">' . $counter . '</a></li>';
						else
							$pagination .= '<li ><a href="' . $targetpage . '?' . $strQueryString . 'page=' . $counter . '">' . $counter . '</a></li>';
					}
					$pagination .= "...";
					$pagination .= '<li ><a href="' . $targetpage . '?' . $strQueryString . 'page=' . $lpm1 . '">' . $lpm1 . '</a></li>';
					$pagination .= '<li ><a href="' . $targetpage . '?' . $strQueryString . 'page=' . $lastpage . '">' . $lastpage . '</a></li>';
				}
				//close to end; only hide early pages
				else {
					$pagination .= '<li ><a href="' . $targetpage . '?' . $strQueryString . 'page=1">1</a></li>';
					$pagination .= '<li ><a href="' . $targetpage . '?' . $strQueryString . 'page=2">2</a></li>';
					$pagination .= "...";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {

						if ($counter == $page)
							$pagination .= '<li class="active"><a href="javascript:void(0);">' . $counter . '</a></li>';
						else
							$pagination .= '<li ><a href="' . $targetpage . '?' . $strQueryString . 'page=' . $counter . '">' . $counter . '</a></li>';
					}
				}
			}

			//next button
			if ($page < ($counter - 1)) {
				$pagination .= '<li class="next"><a href="' . $targetpage . '?' . $strQueryString . 'page=' . $next . '">Next → </a></li>';
			} else {
				$pagination .= '<li class="next disabled" style=\"display: none;\"><a href="javascript:void(0);">Next → </a></li>';
			}

			$pagination .= "</ul></div></div></div>";
		}
	}
	$aryPageLimit['pagination'] = $pagination;
	return $aryPageLimit;
// return $pagination;
}


/****************************/











/****************************/









function prepareIdentifier($strTitle)
{
	$strIdentifier = '';
	$strTitle = strtolower($strTitle);
	$strIdentifier = str_replace('-', ' ', $strTitle);
	$strIdentifier = preg_replace("/[^a-zA-Z0-9]+/", ' ', $strIdentifier);
	$strIdentifier = str_replace(' ', '-', $strIdentifier);
	$strIdentifier = rtrim($strIdentifier, '-');
	$strIdentifier = ltrim($strIdentifier, '-');
	return  $strIdentifier;
}


/**
 *20140327:NK:start:send mail used for email from app 
 *@param array $aryEmails<p>pass single of multiple email address</p>
 *@param string $strSubject<p>Subject of email</p>
 *@param string $strMessage<p>Message of email</p>
 * @param string $strHeaders<p>Header information if required</p>
 *@param array $aryAttachments <p> array of attachments</p>
 */
function cmnSendMail($aryEmails, $strSubject, $strMessage, $strHeaders = '', $aryAttachments = array())
{

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From:' . EMAIL_SENDER . '' . "\r\n";

	mail($aryEmails, $strSubject, $strMessage, $headers);
}
//20140327:NK:end:send mail  used for email from app

/**
 *20140328:NK:start: for generating random password
 *@param int $intLength <p>Length of passsword required</p>
 */

//20140328:NK:end: for generating random password


function checkPageLinkup($urlprefix)
{
	global $config;
	$urlprefix = str_replace(SITE_ABS_PATH, '', $urlprefix);
	$urlprefix = str_replace('.html', '', $urlprefix);
	$urlprefix = explode('?', $urlprefix);
	if ($urlprefix[0] == '') {
		$strPage = 'index';
	} else {

		$strPage = $urlprefix[0];
	}

	if (isset($config[$strPage])) {

		$pageinclude = $config[$strPage];
	} else {
		$pageinclude = SITE_VIEW . '404.php';
	}
	return $pageinclude;
}

function mysql_real_escape_string_port($string)
{
	return addcslashes($string, "\x00\n\r\\'\"\x1a");
}


function successmessage($sessionmessagename)
{
	if (isset($_SESSION[$sessionmessagename])) {
		echo '<div class="alert alert-success">
				<span class="text-semibold" style="padding-bottom:10px;"
				style="padding:30px;"
				style="margin-bottom:9px;">Success!</span> ' . $_SESSION[$sessionmessagename] . '
			</div>';
		unset($_SESSION[$sessionmessagename]);
	}
}
function errormessage($sessionmessagename)
{
	if (isset($sessionmessagename) && count($sessionmessagename) > 0) {
		echo '<div class="alert alert-danger">
				<span class="text-semibold" style="padding-bottom:10px;"
				style="padding:30px;"
				style="margin-bottom:9px;">Error!</span> ' . implode('<br />', $sessionmessagename) . '
			</div>';
	}
}
function duplicatedataErr($sessionmessagename){
	if (isset($_SESSION[$sessionmessagename])) {
		echo '<div class="alert alert-danger" style="background: red !important; color: white; font-size: 14px; font-weight: 500;">
				<span class="text-semibold" style="padding-bottom:10px;"
				style="padding:30px;"
				style="margin-bottom:9px;">Error!</span> ' . $_SESSION[$sessionmessagename] . '
			</div>';
		unset($_SESSION[$sessionmessagename]);
	}
}