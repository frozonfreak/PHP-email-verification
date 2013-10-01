<?php
	class EmailVerify{
		function __construct(){
			require_once 'DB_EmailVerify.php';
			require_once 'KeyGen.php';
		}

		function __destruct() {
			 
		}
		public function sendVerificationEmail($userDetails){
			$keygen = new KeyGen();
			$db_emailVerify = new DB_EmailVerify();
			 if(filter_var($userDetails[0]->contactEmail, FILTER_VALIDATE_EMAIL)){
			 	//$hash = $keygen->generatekeys();
			 	$hash = "3fa29b5ebbbba086143b7f3b2dd6afc0";
			 	$result = $db_emailVerify->updateDetailsToDB($userDetails, $hash);
			 	if($result){
			 		$to      = $userDetails[0]->contactEmail; // Send email to our user  
			 		$subject = 'Signup | Verification'; // Give the email a subject   
			 		$message = ' 
			 		 
			 		Thanks for signing up! 
			 		Please click this link to activate your account: 
			 		 
			 		http://localhost:8888/email_verify/server/verify.php?email='.$userDetails[0]->contactEmail.'&hash='.$hash.' 
			 		 
			 		'; // Our message above including the link  
			 		                      
			 		$headers = 'From:noreply@localhost.com' . "\r\n"; // Set from headers  
			 		mail($to, $subject, $message, $headers); // Send our email  
			 	}
			 	else
			 		exit(json_encode(array("status" => 0,"message"=> "Failed Insertion to DB")));

			 }
			 else
			 	exit(json_encode(array("status" => 0,"message"=> "Invalid Email ID")));
		}
	}
?>