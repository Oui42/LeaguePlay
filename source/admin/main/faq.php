<?php
$faq = $__SETTINGS['faq'];

if(isset($_POST['submit'])) {
	$error = array();

	$faq = (isset($_POST['faq']))? $_POST['faq'] : "";

	if(empty($error)) {
		query("UPDATE `lp_settings` SET `value` = '".$faq."' WHERE `name` = 'faq'");
		alert("success", "Rules has been updated.");
	} else {
		echo "<div class='alert alert-error'><div class='alert-title'><i class='fa fa-exclamation-circle fa-lg'></i> Error!</div> Errors occurred:<br>";
		foreach($error as $e)
			echo "&bull; ".$e."<br>";
		echo "</div>";
	}
}
?>

<div class="panel">
	<div class="panel-head">
		Preview FAQ
	</div>
	<div class="panel-body">
		<?php echo $faq; ?>
	</div>
</div>

<form method="post" action="" class="panel">
	<div class="panel-body">
		<textarea id="editor" name="faq"><?php echo $faq; ?></textarea>
		<hr>
		<div class="text-center">
			<button class="btn-active" type="submit" name="submit">
				Save
			</button>
		</div>
	</div>
</form>