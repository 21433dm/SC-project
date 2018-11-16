<?php //login.php
include ('./classes/db.php');

if (isset($_POST['login'])) { //set variables
		$username = $_POST['username'];
		$password = $_POST['password'];
		//query the database to check if the username and password exist
		if (DB::query('SELECT username FROM accounts WHERE username=:username', array(':username'=>$username))) {

				if (password_verify($password, DB::query('SELECT password FROM accounts WHERE username=:username', array(':username'=>$username))[0]
					['password'])) {
						//create a login token for the user
						$cstrong = True;
						$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
						$userid = DB::query('SELECT id FROM accounts WHERE username=:username', array(':username'=>$username))[0]['id'];
						DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :userid)', array(':token'=>sha1($token), 'userid'=>$userid));
						//set the cookies and go to the profile page
						setcookie("PFID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
						setcookie("PFID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
						header ("location: profile.php?username=$username");

				} else {
						header("location: login.php");
				}

		} else {
				header("location: login.php");
		}
	}

?>

<form action="login.php" method="post" name="login" id="login" />
	<table>
		<tr>
			<td>Username:</td>
			<td><input type="text" name="username" placeholder="Username ..." /></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password" placeholder="Password ..." /></td>
		</tr>
		<tr>
			<td><input type="submit" name="login"value="Login" /></td>
		</tr>
	</table>
</form>