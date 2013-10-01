<?php
	require_once 'EmailVerify.php';
	$receivedData = json_decode(file_get_contents("php://input"));

	$emailVerify = new EmailVerify();

	if(isset($receivedData->{"type"})){
		$response = '';
		switch ($receivedData->{"type"}) {
			case 'sendVerificationEmail':
				if(isset($receivedData->{"userDetail"})){
					$response = $emailVerify->sendVerificationEmail($receivedData->{"userDetail"});
				}
				else
					exit(json_encode(array("status" => 0,"message"=> "All user details needs to be set")));
			break;
		}
	}
	else {
	    exit(json_encode(array("status" => 0,"message"=> "Field type not set")));
	}
?>
