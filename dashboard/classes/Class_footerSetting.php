<?php 


Class class_footer_setting
{
	public function SocialFooterProcessRequest($aryData)
	{   global $dbh;
		if($_SERVER['REQUEST_METHOD']='POST')
		{
			if('' == $aryData)
			{
				$aryData=$_POST;
			}
			
			$aryErrors=array();
			if(0<count($aryData))
			{
				if(0==count($aryErrors))
				{
                   $strRes=FALSE;
					
				 	$sqlUpdateFooterData=' UPDATE '.TABLE_FOOTER_SETTING.' SET 
						footer_setting_copyright=\''.mysql_real_escape_string_port($aryData['footer_setting_copyright']).'\',
						footer_setting_address=\''.mysql_real_escape_string_port($aryData['footer_setting_address']).'\',
					footer_setting_land_number=\''.mysql_real_escape_string_port($aryData['footer_setting_land_number']).'\',
					footer_setting_company_name=\''.mysql_real_escape_string_port($aryData['footer_setting_company_name']).'\',

						footer_setting_email=\''.mysql_real_escape_string_port($aryData['footer_setting_email']).'\',
						footer_setting_website=\''.mysql_real_escape_string_port($aryData['footer_setting_website']).'\',
						footer_setting_number=\''.mysql_real_escape_string_port($aryData['footer_setting_number']).'\' WHERE footer_setting_id=1'; 
						
                        $strRes=$dbh->query($sqlUpdateFooterData);
				}
                  if($strRes)
{
             $_SESSION['success_setting_message']='Settings Updated Successfully';
}
			}
return $aryErrors;
		}
	}
}
$class_footer_setting = new class_footer_setting;

?> 


