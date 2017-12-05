<?php
if(isset($user['uid']))
	header("Location: index.php");

if(isset($_POST['submitLogin'])) {
	$nickname = (isset($_POST['nickname']))? vtxt($_POST['nickname']) : "";
	$password = (isset($_POST['password']))? vtxt($_POST['password']) : "";

	$sql = "SELECT `salt`, `uid` FROM `lp_users` WHERE `nickname` = '".$nickname."'";
	$query = mysqli_query($connect, $sql);
	if(mysqli_num_rows(query($sql)) > 0) {
		$row = mysqli_fetch_assoc($query);
		$password = md5(md5($row['salt']).md5($password));
		
		$sql = "SELECT * FROM `lp_users` WHERE `nickname` = '".$nickname."' AND `password` = '".$password."'";
		$query = query($sql) or die(mysqli_error($connect));
		
		if(mysqli_num_rows($query) > 0) {
			$user = mysqli_fetch_assoc($query);

			$_SESSION['nickname'] = $nickname;
			$_SESSION['uid'] = $user['uid'];
			header("Location: index.php");
		} else {
			alert("error", "Incorrect password.");
		}
	} else {
		alert("error", "This nickname is not registered.");
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
			<label for="password">Password</label><br>
			<input id="password" type="password" name="password" placeholder="Type your password...">
		</div>
		<button class="btn-active" type="submit" name="submitLogin">
			Sing In
		</button>
	</div>
</form>