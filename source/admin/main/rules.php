<?php
$rules = $__SETTINGS['rules'];

if(isset($_POST['submit'])) {
	$error = array();

	$rules = (isset($_POST['rules']))? $_POST['rules'] : "";

	if(empty($error)) {
		query("UPDATE `lp_settings` SET `value` = '".$rules."' WHERE `name` = 'rules'");
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
		Preview Rules
	</div>
	<div class="panel-body">
		<?php echo $rules; ?>
	</div>
</div>

<form method="post" action="" class="panel">
	<div class="panel-body">
		<textarea id="editor" name="rules"><?php echo $rules; ?></textarea>
		<hr>
		<div class="text-center">
			<button class="btn-active" type="submit" name="submit">
				Save
			</button>
		</div>
	</div>
</form>