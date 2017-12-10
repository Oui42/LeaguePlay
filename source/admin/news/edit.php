<?php
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$_newsid = $_GET['id'];
	$_news = getNews($_newsid);

	if($_news != -1) {
		$error = array();

		$title = $_news['title'];
		$text = $_news['text'];

		if(isset($_POST['submit'])) {
			$title = vtxt($_POST['title']);
			$text = $_POST['text'];

			if(empty($title))
				$error[] = "Please type news title..";

			if(empty($text))
				$error[] = "Please type news text..";

			if(strlen($title) < 3 || strlen($title) > 32)
				$error[] = "Title must be at least 3 and at most 32 characters.";

			if(empty($error)) {
				query("UPDATE `lp_news` SET `title` = '".$title."', `text` = '".$text."' WHERE `id` = '".$_newsid."'");
				alert("success", "News has been updated.");
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
				Edit news
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="title">Title</label><br>
					<input id="title" type="text" name="title" maxlength="32" placeholder="Type title..." value="<?php echo $title; ?>">
				</div>
				<div class="form-group">
					<label for="text">Text</label><br>
					<textarea id="text" name="text" placeholder="Type your text..."><?php echo $text; ?></textarea>
				</div>
				<button class="btn-active" type="submit" name="submit">
					Save
				</button>
			</div>
		</form>
		<?php
	} else
		die();
} else
	die();
?>