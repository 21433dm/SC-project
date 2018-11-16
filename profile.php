<?php
include ('classes/db.php');
include ('classes/Login.php');

if (Login::IsLoggedIn()) {
				
			if(isset($_POST['changepass'])) {

			$oldpass = $_POST['oldpass'];
            $newpass = $_POST['newpass'];
            $newconfirm = $_POST['newconfirm'];
            $userid = Login::IsLoggedIn();

            if (password_verify($oldpass, DB::query('SELECT password FROM accounts WHERE id=:id', array(':id'=>$userid))[0]['password'])) {
                        if ($newpass == $newconfirm) {
                                if (strlen($newpass) >= 6 && strlen($newpass) <= 60) {
                                        DB::query('UPDATE accounts SET password=:newpass WHERE id=:id', array(':newpass'=>password_hash($newpass, PASSWORD_BCRYPT), ':id'=>$userid));
                                        header ("location: profile.php?username=$username");
										echo 'Password changed!';
                                }
                        } else {
                                echo 'Passwords don\'t match!';
                        }
                } else {
                        echo 'Incorrect old password!';
                }

		}

} else {
		//die('Not logged in!');
}
?>
<script type="text/javascript">
		function display_c(){
		var refresh=1000; // Refresh rate in milli seconds
		mytime=setTimeout('display_ct()',refresh)
	}
	</script>
<b><?php echo date("l d F Y"); ?></b><br>
<script>display_c;</script><br>
<h3>Change your password here</h3>
<br><br>
<form action="profile.php?username=$username" method="post">
<table>
	<tr>
		<td>Old Password:</td>
		<td><input type="password" name="oldpass" value="" placeholder="Current password..."></td>
	</tr>
	<tr>
		<td>New Password:</td>
		<td><input type="password" name="newpass" value="" placeholder="New password..."></td>
	</tr>
	<tr>
		<td>Confirm Password:</td>
		<td><input type="password" name="newconfirm" value="" placeholder="Confirm password..."></td>
	</tr>
	<tr>
		<td><input type="submit" name="changepass" value="Change password..."></td>
	</tr>
</form>
</table>					
					