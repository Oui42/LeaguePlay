<?php
if(isset($_GET['uid']) && is_numeric($_GET['uid'])) {
	$_userid = $_GET['uid'];
	$_user = getUser($_userid);

	if($_user != -1) {
		$error = array();

		$nickname = $_user['nickname'];
		$email = $_user['email'];
		$level = $_user['level'];
		$points = $_user['points'];
		$perms = $_user['perms'];

		if(isset($_POST['submit'])) {
			$error = array();

			$nickname = (isset($_POST['nickname']))? vtxt($_POST['nickname']) : "";
			$email = (isset($_POST['email']))? vtxt($_POST['email']) : "";
			$level = (isset($_POST['level']))? vtxt($_POST['level']) : "1";
			$points = (isset($_POST['points']))? vtxt($_POST['points']) : "";
			$perms = (isset($_POST['perms']))? $_POST['perms'] : "";

			if(empty($nickname) || empty($email)) {
				$error[] = "Fill out all required fields.";
			} else {
				if(strlen($nickname) < 3 || strlen($nickname) > 32)
					$error[] = "Nickname must be at least 3 and at most 32 characters.";

				if(!filter_var($email, FILTER_VALIDATE_EMAIL))
					$error[] = "Email address is invalid format.";

				if(!is_numeric($level))
					$error[] = "Level must be numeric value.";

				if(!is_numeric($points))
					$error[] = "Points must be numeric value.";

				if(mysqli_num_rows(query("SELECT `nickname` FROM `lp_users` WHERE `nickname` = '".$nickname."' AND `uid` != '".$_userid."'")) > 0)
					$error[] = "This nickname is already taken.";

				if(mysqli_num_rows(query("SELECT `email` FROM `lp_users` WHERE `email` = '".$email."' AND `uid` != '".$_userid."'")) > 0)
					$error[] = "This email address is already taken.";
			}

			if(empty($error)) {
				query("UPDATE `lp_users` SET `nickname` = '".$nickname."', `email` = '".$email."', `level` = '".$level."', `points` = '".$points."', `perms` = '".$perms."' WHERE `uid` = '".$_userid."'");
				alert("success", "User has been updated.");
			} else {
				echo "<div class='alert alert-error'><div class='alert-title'><i class='fa fa-exclamation-circle fa-lg'></i> Error!</div> Errors occurred:<br>";
				foreach($error as $e)
					echo "&bull; ".$e."<br>";
				echo "</div>";
			}
		}

		if(isset($_POST['signin'])) {
			$_SESSION['uid'] = $_userid;
			header("Location: index.php");
		}
		?>
		<form method="post" action="" class="panel popup-panel">
			<div class="panel-head">
				Edit user
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="nickname">Nickname</label><br>
					<input id="nickname" type="text" name="nickname" placeholder="Type nickname..." value="<?php echo $nickname; ?>">
				</div>
				<div class="form-group">
					<label for="registerdate">Registration Date</label><br>
					<input id="registerdate" type="text" name="registerdate" class="text-center" placeholder="<?php echo date('H:i     d-m-Y', $_user['register_date']); ?>" disabled>
				</div>
				<div class="form-group">
					<label for="email">Email</label><br>
					<input id="email" type="text" name="email" placeholder="Type email address..." value="<?php echo $email; ?>">
				</div>
				<div class="form-group">
					<label for="level">Level</label><br>
					<input id="level" class="input-mini10" type="text" name="level" placeholder="1" maxlength="3" value="<?php echo $level; ?>">
				</div>
				<div class="form-group">
					<label for="points">Points</label><br>
					<input id="points" class="input-mini20" type="text" name="points" placeholder="0" maxlength="8" value="<?php echo $points; ?>">
				</div>
				<div class="form-group">
					<label for="perms">Perms</label><br>
					<span class="radio">
						<input type="radio" name="perms" id="radio1" value="<?php echo $__perms['ban']; ?>" <?php echo ($perms == $__perms['ban'])? "checked" : ""; ?>>
						<label for="radio1" class="radio-label">Banned</label>
					</span>
					<span class="radio">
						<input type="radio" name="perms" id="radio2" value="<?php echo $__perms['user']; ?>" <?php echo ($perms == $__perms['user'])? "checked" : ""; ?>>
						<label for="radio2" class="radio-label">User</label>
					</span>
					<span class="radio">
						<input type="radio" name="perms" id="radio3" value="<?php echo $__perms['admin']; ?>" <?php echo ($perms == $__perms['admin'])? "checked" : ""; ?>>
						<label for="radio3" class="radio-label">Admin</label>
					</span>
				</div>
				<button class="btn-active" type="submit" name="submit">
					Save
				</button>
				<button class="btn btn-small" type="submit" name="signin">
					Sign in
				</button>
			</div>
		</form>
		<?php
	} else
		die();
} else
	die();
?>