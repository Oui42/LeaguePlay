<?php
$title = (isset($_POST['title']))? $_POST['title'] : "";
$text = (isset($_POST['text']))? $_POST['text'] : "";

if(isset($_POST['new'])) {
	if(empty($title))
		$error[] = "Please type news title..";

	if(empty($text))
		$error[] = "Please type news text..";

	if(strlen($title) < 3 || strlen($title) > 32)
		$error[] = "Title must be at least 3 and at most 32 characters.";

	if(empty($error)) {
		query("INSERT INTO `lp_news` (title, `date`, `text`)
			VALUES('".$title."', '".time()."', '".$text."')")
			or die(mysqli_error($connect));
		$id = mysqli_insert_id($connect);
		alert("success", "News has been written.");
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
			<label for="title">Title</label><br>
			<input id="title" type="text" name="title" placeholder="Type title..." value="<?php echo $title; ?>">
		</div>
		<div class="form-group">
			<label for="password">Text</label><br>
			<textarea id="text" name="text" placeholder="Type your text..."><?php echo $text; ?></textarea>
		</div>
		<button class="btn-active" type="submit" name="new">
			Create
		</button>
	</div>
</form>