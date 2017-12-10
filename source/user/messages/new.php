<?php
$target = (isset($_GET['id']) && is_numeric($_GET['id']))? vtxt($_GET['id']) : "";

$title = (isset($_POST['title']))? vtxt($_POST['title']) : "";
$message = (isset($_POST['message']))? vtxt($_POST['message']) : "";

if(isset($_POST['submit'])) {
	$error = array();

	if(empty($target))
		$error[] = "User doesn't exist.";

	if(empty($title))
		$error[] = "Please type message title.";

	if(strlen($title) > 32)
		$error[] = "Title must be at least 3 and at most 32 characters.";

	if(empty($message))
		$error[] = "Please type message text.";

	if(empty($error)) {
		query("INSERT INTO `lp_messages` (owner, target, title, status) VALUES ('".$user['uid']."', '".$target."', '".$title."', '".$__messages['newuser2']."')");
		$message_id = mysqli_insert_id($connect);
		query("INSERT INTO `lp_messages_text` (message_id, user, `date`, `text`) VALUES ('".$message_id."', '".$user['uid']."', '".time()."', '".$message."')");

		header("Location: index.php?app=user&module=messages&section=view&id=".$message_id."");
	} else {
		echo "<div class='alert alert-error'><div class='alert-title'><i class='fa fa-exclamation-circle fa-lg'></i> Error!</div> Errors occurred:<br>";
		foreach($error as $e)
			echo "&bull; ".$e."<br>";
		echo "</div>";
	}
}
?>

<form method="post" action="" class="panel popup-panel">
	<div class="panel-head">
		Create new message
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label for="type">User</label><br>
			<input id="type" type="text" class="text-center" value="<?php echo getUserNickname($target); ?>" disabled>
		</div>
		<div class="form-group">
			<label for="title">Title</label><br>
			<input id="title" type="text" name="title" maxlength="32" placeholder="Type ticket title..." value="<?php echo $title; ?>">
		</div>
		<div class="form-group">
			<label for="message">Message</label><br>
			<textarea id="message" name="message" placeholder="Type your message..."><?php echo $message; ?></textarea>
		</div>
		<button class="btn-active" type="submit" name="submit">
			Send
		</button>
	</div>
</form>