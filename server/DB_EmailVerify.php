<?php
	class DB_EmailVerify{
		function __construct(){
			require_once 'Config.php';
		}

		function __destruct() {
			 
		}
		public function updateDetailsToDB($userDetails, $hash){
			try{
				$db = new PDO(DB_STRING, DB_USER, DB_PASSWORD);
				$stmt = $db->prepare ("INSERT INTO email_verification (email, code, send_date, timeout, verification_date) VALUES (:email, :code, NOW(), 30, 0)");
				if($stmt->execute(array(':email' => $userDetails[0]->contactEmail, ':code'=> $hash)))
					return true;
				else
					return false;
			}
			catch(Exception $e){
				exit(json_encode(array("status" => 0,"message"=> "unable to connect to DB")));
			}
		}
	}
?>