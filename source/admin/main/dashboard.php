<?php
$admin_note = $__SETTINGS['admin_note'];

if(isset($_POST['submit'])) {
	$error = array();

	$admin_note = (isset($_POST['admin_note']))? $_POST['admin_note'] : "";

	if(empty($error)) {
		query("UPDATE `lp_settings` SET `value` = '".$admin_note."' WHERE `name` = 'admin_note'");
		alert("success", "Admin note has been updated.");
	} else {
		echo "<div class='alert alert-error'><div class='alert-title'><i class='fa fa-exclamation-circle fa-lg'></i> Error!</div> Errors occurred:<br>";
		foreach($error as $e)
			echo "&bull; ".$e."<br>";
		echo "</div>";
	}
}
?>

<form method="post" action="" class="panel">
	<div class="panel-head">
		Admin note
	</div>
	<div class="panel-body">
		<textarea id="editor" name="admin_note"><?php echo $admin_note; ?></textarea>
		<hr>
		<div class="text-center">
			<button class="btn-active" type="submit" name="submit">
				Save
			</button>
		</div>
	</div>
</form>