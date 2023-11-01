<?php class class_common
{


	public  function loadSingleDataBy($strLoadCondition, $strFields = '', $strJoinCondition = '', $strTableName)
	{
		global $dbh;
		if ('' == $strFields) {
			$strFields = '*';
		}

		$sqlSelectCategory = 'SELECT ' . $strFields . ' FROM ' . $strTableName . ' ' . $strJoinCondition . ' WHERE 1 ' . $strLoadCondition;
// 		print_r($sqlSelectCategory);
		$resSelectCategory = $dbh->query($sqlSelectCategory);
		$rowSelectCategory = $resSelectCategory->fetch();

		return $rowSelectCategory;
	}


	function loadMultipleDataByTableName($strLoadCondition = '', $strFields = '', $strJoinCondition = '', $intPagiantion = 0, $strPaginationName = '', $strTableName)
	{

		global $dbh;
		if ('' == $strFields) {
			$strFields = '*';
		}

		$sqlSelectCategory  = 'SELECT ' . $strFields . ' FROM ' . $strTableName . ' ' . $strJoinCondition . ' WHERE 1=1  ' . $strLoadCondition;

// 		print_r($sqlSelectCategory);
		// die();
		$sqlSelectCategory = $dbh->query($sqlSelectCategory);
		$intTotalRecord = $sqlSelectCategory->rowCount();
		if ($intPagiantion == 1) {
			$sqlSelectCategory  = 'SELECT ' . $strFields . '  FROM ' . $strTableName . ' ' . $strJoinCondition . ' WHERE 1  ' . $strLoadCondition;

			

			$aryPagination  = sitePagination($intTotalRecord, $strRedirect = '');

			$sqlSelectCategory .= ' ' . $aryPagination['limit'];

			$_SESSION[$strPaginationName] = $aryPagination['pagination'];
			$sqlSelectCategory = $dbh->query($sqlSelectCategory);
		} else {
			if (isset($_SESSION[$strPaginationName])) {
				unset($_SESSION[$strPaginationName]);
			}
		}
		$rowSelectPostCategory = $sqlSelectCategory->fetchAll();

		return $rowSelectPostCategory;
	}


	function getHtmlParseByDatabase($tablename, $strWhere, $strFieldName, $strHtml, $strHtmlParser, $strExtraHtml)
	{
		global $dbh;


		$sqlSelectCategory  = 'SELECT *  FROM ' . $tablename . ' WHERE 1  ' . $strWhere;
		$resSelectField  = $dbh->query($sqlSelectCategory);
		$resSelect = $resSelectField->fetchAll();
		$strHtmlContent = '';
		$intTotalCount =  count($resSelect);
		foreach ($resSelect as $rowSelect) {

			$strHtmlContent .= str_replace($strHtmlParser, $rowSelect[$strFieldName], $strHtml);
			if ($intTotalCount != 1) {
				$strHtmlContent .= $strExtraHtml;
			}
			$intTotalCount--;
		}

		return $strHtmlContent;
	}
}
$class_common = new class_common;
