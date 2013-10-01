<?php
	class KeyGen{
		function __construct(){
			require_once 'DB_EmailVerify.php';
			require_once 'KeyGen.php';
		}

		function __destruct() {
			 
		}
		public function generatekeys(){
			 print_r(md5(uniqid(rand(), true)));
		}
	}
?>