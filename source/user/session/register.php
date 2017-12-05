<?php
if(isset($user['uid']))
	header("Location: index.php");

if(isset($_POST['submitRegister'])) {
	$error = array();
	$nickname = (isset($_POST['nickname']))? vtxt($_POST['nickname']) : "";
	$email = (isset($_POST['email']))? vtxt($_POST['email']) : "";
	$password = (isset($_POST['password']))? vtxt($_POST['password']) : "";
	$passwordr = (isset($_POST['passwordr']))? vtxt($_POST['passwordr']) : "";
	$rules = (isset($_POST['rules']))? $_POST['rules'] : "";

	if(empty($nickname) || empty($email) || empty($password) || empty($password)) {
		$error[] = "Fill out all required fields.";
	} else {
		if($password != $passwordr)
			$error[] = "Passwords are not identical.";

		if(strlen($password) < 6)
			$error[] = "Password must be at least 6 characters.";

		if(strlen($nickname) < 3 || strlen($nickname) > 32)
			$error[] = "Nickname must be at least 3 and at most 32 characters.";

		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			$error[] = "Email address is invalid format.";

		if(mysqli_num_rows(query("SELECT `nickname` FROM `lp_users` WHERE `nickname` = '".$nickname."'")) > 0)
			$error[] = "This nickname is already taken.";

		if(mysqli_num_rows(query("SELECT `email` FROM `lp_users` WHERE `email` = '".$email."'")) > 0)
			$error[] = "This email address is already taken.";

		if($rules != 1)
			$error[] = "You have to accept rules.";
	}

	if(empty($error)) {
		$salt = substr(md5(time()), 0, 5);
		$insertpassword = md5(md5($salt).md5($password));
		$code = substr(md5(time()), 0, 30);
		$ip = $_SERVER['REMOTE_ADDR'];

		mysqli_query($connect, "INSERT INTO `lp_users` (nickname, password, salt, code, register_date, ip, email, points)
			VALUES('".$nickname."', '".$insertpassword."', '".$salt."', '".$code."', '".time()."', '".$ip."', '".$email."', '".$__globalSettings['startPoints']."')")
			or die(mysqli_error($connect));
		$id = mysqli_insert_id($connect);
		alert("success", "Account has been created successfully.<br>Please confirm your email address to complete registration process.");
	} else {
		echo "<div class='alert alert-error'><div class='alert-title'><i class='fa fa-exclamation-circle fa-lg'></i> Error!</div> Errors occurred:<br>";
		foreach($error as $e)
			echo "&bull; ".$e."<br>";
		echo "</div>";
	}
}
?>

<form method="post" action="" class="panel popup-panel">
	<div class="panel-body">
		<div class="form-group">
			<label for="nickname">Nickname</label><br>
			<input id="nickname" type="text" name="nickname" placeholder="Type your nickname...">
		</div>
		<div class="form-group">
			<label for="email">Email</label><br>
			<input id="email" type="email" name="email" placeholder="Type your email address...">
		</div>
		<div class="form-group">
			<label for="password">Password</label><br>
			<input id="password" type="password" name="password" placeholder="Type your password...">
		</div>
		<div class="form-group">
			<label for="passwordr">Repeat password</label><br>
			<input id="passwordr" type="password" name="passwordr" placeholder="Repeat your password...">
		</div>
		<div class="form-group">
			<input type="checkbox" id="rules" name="rules" value="1">
			<label for="rules">I have read <a href="">the rules</a> and agree to abide by them.</label>
		</div>
		<button class="btn-golden" type="submit" name="submitRegister">
			Sing Up
		</button>
	</div>
</form>