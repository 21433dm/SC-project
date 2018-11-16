<?php

class Login {

		public static function IsLoggedIn() {

		if (isset($_COOKIE['SCPID'])) {
				if (DB::query('SELECT userid FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SCPID'])))) {
						$userid = DB::query('SELECT userid FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SCPID'])))[0]
						['userid'];

						if(isset($_COOKIE['PFID_'])) {
								return $userid;	
						} else {
							$cstrong = True;
							$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
							DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :userid)', array(':token'=>sha1($token), ':userid'=>$userid));
							DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)));

							setcookie("SCPID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
							setcookie("SCPID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

							return $userid;

						}
						
				}

		}

		return false;
}

}

?>