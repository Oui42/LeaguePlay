<?php
$pagestatus = $__SETTINGS['active_page'];
$registration = $__SETTINGS['active_register'];

if(isset($_POST['submit'])) {
	$error = array();

	$pagestatus = (isset($_POST['pagestatus']))? $_POST['pagestatus'] : 0;
	$registration = (isset($_POST['registration']))? $_POST['registration'] : 0;

	if(empty($error)) {
		query("UPDATE `lp_settings` SET `value` = '".$pagestatus."' WHERE `name` = 'active_page'");
		query("UPDATE `lp_settings` SET `value` = '".$registration."' WHERE `name` = 'active_register'");
		alert("success", "Settings has been updated.");
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
		General Settings
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label for="pagestatus">Page status</label><br>
			<input id="pagestatus-toggle-on" class="toggle toggle-left" name="pagestatus" value="1" type="radio" <?php echo ($pagestatus == 1)? "checked" : ""; ?>>
			<label for="pagestatus-toggle-on" class="togglebtn">On</label>
			<input id="pagestatus-toggle-off" class="toggle toggle-right" name="pagestatus" value="0" type="radio" <?php echo ($pagestatus == 0)? "checked" : ""; ?>>
			<label for="pagestatus-toggle-off" class="togglebtn">Off</label>
		</div>
		<div class="form-group">
			<label for="registration">Registration status</label><br>
			<input id="registration-toggle-on" class="toggle toggle-left" name="registration" value="1" type="radio"  <?php echo ($registration == 1)? "checked" : ""; ?>>
			<label for="registration-toggle-on" class="togglebtn">On</label>
			<input id="registration-toggle-off" class="toggle toggle-right" name="registration" value="0" type="radio" <?php echo ($registration == 0)? "checked" : ""; ?>>
			<label for="registration-toggle-off" class="togglebtn">Off</label>
		</div>
		<button class="btn-active" type="submit" name="submit">
			Save
		</button>
	</div>
</form>