<?php 

Class class_country
{
	function sizeProcessRequest($userData,$strMode)
	{
		global $dbh;
		
		if($_SESSION['REQUEST_METHOD']='POST')
		{
			if(''==$userData)
			{
				$userData=$_POST;
				// $countryCodeData = $_POST;
			}
			if(''==$strMode)
			{
				$strMode= $_REQUEST['mode'];
			}
            
			$aryErrors=array();
			if(0<count($userData))
			{
				if(isset($userData['signupEmail']) && '' == $userData['signupEmail'] || isset($userData['signupPass']) && '' == $userData['signupPass'] || isset($userData['signupCPass']) && '' == $userData['signupCPass'] || isset($userData['signupPhone']) && '' == $userData['signupPhone'] || isset($userData['signupName']) && '' == $userData['signupName'])
			    {
			       	$aryErrors['countryName']=' Signup Failed All Fields are required .';
				
			    }
                
				    $aryvranchId='';
                  

				if(0==count($aryErrors))
				{

					try {
						$dbh->query('INSERT INTO mstuser SET
						us_UserName=\''.mysql_real_escape_string_port($userData['signupName']).'\',
						us_EmailID=\''.mysql_real_escape_string_port($userData['signupEmail']).'\',
						us_mobileNo=\''.mysql_real_escape_string_port($userData['signupPhone']).'\',
						us_Password=\''.mysql_real_escape_string_port($userData['signupPass']).'\'');
						$aryErrors['countryName']=' Signup Successfully';
							$aryErrors['signupmsg'] ="a";
						
					} catch (Exception $e) {
						if ($e->getCode() == '23000') {
							$aryErrors['countryName']=' This email is already registered. try with different email';
						}
					}

                    // $sqlInsertSliderData= ' INSERT INTO mstuser SET
					// 	us_EmailID=\''.mysql_real_escape_string_port($userData['signupEmail']).'\',
					// 	us_mobileNo=\''.mysql_real_escape_string_port($userData['signupPhone']).'\',
					// 	us_Password=\''.mysql_real_escape_string_port($userData['signupPass']).'\'';
                        //$strRes=$dbh->query($sqlInsertSliderData);	//print_r($sqlInsertSliderData); die();
                        // $intInsertId= $dbh->lastInsertId();

                        // if($intInsertId){
						// 	$aryErrors['countryName']=' Signup Successfully';
						// 	$aryErrors['signupmsg'] ="a";
                        //     $email = $userData['signupEmail'];
                        //     $to = $email;
        				// 	$subject = "Registered successfully on Gorfkit.in";
        
         				// 	$message= "<html>
						// 		<head>
						// 		<style>

						// 		</style>
						// 		</head>
						// 		<body>

						// 		<p>Dear $email,</p>
						// 		<p>You has been successfully registered on Grofkit.in.</p>
						// 		<p>Thank you for being a part of Grofkit family.</p><br>
						// 		<p style='margin-bottom:10px'></p>

						// 		<p>You can write us to grofkit@gmail.com or 8521985288
						// 		Thank You for giving your precious time to us. </p>
						// 		<p>Happy Shopping!</p>

								
						// 		</body>
						// 		</html>";
						// 		$headers1[] = 'MIME-Version: 1.0';
						// 		$headers1[] = 'Content-type: text/html; charset=iso-8859-1';
						// 		// Additional headers
						// 		$headers1[] = 'To:'.$email;
						// 		$headers1[] = 'From: no-reply@grofkit.in';
        
        				// 	mail($to,$subject,$message,implode("\r\n", $headers1));
                        // }
				}
			}
			return $aryErrors;
		}
	}
}

$class_country = new class_country;

?>