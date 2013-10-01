<?php
	class DB_Verify{
		function __construct(){
			require_once 'Config.php';
		}

		function __destruct() {
			 
		}
		public function verifyHash($userEmail, $hash){
			try{
				$db = new PDO(DB_STRING, DB_USER, DB_PASSWORD);
				$stmt = $db->prepare('SELECT id FROM email_verification WHERE email=? AND code=?');
				$stmt->execute(array($userEmail, $hash));
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				return (count($row['id']>0) ? true : false);
			}
			catch(Exception $e){
				exit(json_encode(array("status" => 0,"message"=> "Unable to connect to DB")));
			}
		}
		public function updateEmailVerification($userEmail){
			try{
				$db = new PDO(DB_STRING, DB_USER, DB_PASSWORD);
				$stmt = $db->prepare("UPDATE customer SET email_verification=1 WHERE user_id=(SELECT user_id from user WHERE contact_email=?)");
				if($stmt->execute(array($userEmail)))
					return true;
				else
					return false;
			}
			catch(Exception $e){
				exit(json_encode(array("status" => 0,"message"=> "Unable to connect to DB")));
			}
		}
	}
?>