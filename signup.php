<?php
include('classes/db.php');
include('classes/passgen.php');

if (isset($_POST['create'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$tel = $_POST['tel'];
		$address = $_POST['address'];
		$username = $_POST['username'];
		$password = createRandomPassword();
		
		if (preg_match('/[a-zA-Z0-9_]+/', $name)) {

			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

				DB::query('INSERT INTO accounts VALUES (\'\', :name, :email, :tel, :address, :username, :password)', array(':name'=>$name, ':email'=>$email, ':tel'=>$tel, ':address'=>$address, ':username'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT)));
					
					echo 'Account created, your password is<font color="red"><b> '. $password .' </b>please note it down.
					<p><a href="login.php"> Click here to login and change your password now!</a></font>';
				}
			}		
		}
?>
<html>
<body>
<div>
	<h2>Sign Up!</h2>
			<form action="signup.php" method="post">
			<input type="text" name="name" placeholder="Full name..."><p />
			<input type="text" name="email" placeholder="Email address..."><p />
			<input type="text" name="tel" placeholder="Tel No:..."><p />
			<textarea name="address" rows="10" cols="50" placeholder="Address..."></textarea><p />
			<input type="text" name="username" placeholder="Choose a username..."><p />
			<input type="submit" name="create" value="Sign Up!">
			</form>
</div>	
</body>
</html>	
		