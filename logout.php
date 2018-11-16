<?php

include('classes/db.php');
include('classes/Login.php');

if (Login::IsLoggedIn()) {

if(isset($_POST['confirm'])) {

		DB::query('DELETE FROM login_tokens WHERE userid=:userid', array(':userid'=>Login::IsLoggedIn()));
			
		} else {
				if(isset($_COOKIE['PFID'])) {
						DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['PFID'])));
				}
		}	
		}
				setcookie('PFID', '', time()-3600);
				setcookie('PFID_', '', time()-3600);
?>


						<h2>Logout of your account?</h2>
						<p>Are you sure you'd like to logout?</p>
						<form action="logout.php" method="post">
						<input type="submit" name="confirm" value="Confirm">
						</form>
					
