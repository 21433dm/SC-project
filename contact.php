<?php
include('classes/db.php');

if (isset($_POST['send'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$message = $_POST['message'];
		
		DB::query('INSERT INTO contacts VALUES (\'\', :name, :email, :username, :message)', array(':name'=>$name, ':email'=>$email,  ':username'=>$username, ':message'=>$message));
					
					echo 'Message posted, thank you!';
}				
?>

<html>
<body>
<div>
	<h2>Post a message!</h2>
			<form action="contact.php" method="post">
			<input type="text" name="name" placeholder="Full name..."><p />
			<input type="text" name="email" placeholder="Email address..."><p />
			<input type="text" name="Username" placeholder="Username (optional)..."><p />
			<textarea name="message" rows="10" cols="80" placeholder="Message..."></textarea><p />
			<input type="submit" name="send" value="Send Message!">
			</form>
</div>	
</body>
</html>	
					