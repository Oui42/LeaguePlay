<?php
$active_info1 = $__SETTINGS['active_info1'];
$active_info2 = $__SETTINGS['active_info2'];
$active_info3 = $__SETTINGS['active_info3'];
$info_text1 = $__SETTINGS['info_text1'];
$info_text2 = $__SETTINGS['info_text2'];
$info_text3 = $__SETTINGS['info_text3'];

if(isset($_POST['submit'])) {
	$error = array();

	$active_info1 = (isset($_POST['active_info1']))? $_POST['active_info1'] : 0;
	$active_info2 = (isset($_POST['active_info2']))? $_POST['active_info2'] : 0;
	$active_info3 = (isset($_POST['active_info3']))? $_POST['active_info3'] : 0;
	$info_text1 = (isset($_POST['info_text1']))? $_POST['info_text1'] : "";
	$info_text2 = (isset($_POST['info_text2']))? $_POST['info_text2'] : "";
	$info_text3 = (isset($_POST['info_text3']))? $_POST['info_text3'] : "";

	if(empty($error)) {
		query("UPDATE `lp_settings` SET `value` = '".$active_info1."' WHERE `name` = 'active_info1'");
		query("UPDATE `lp_settings` SET `value` = '".$active_info2."' WHERE `name` = 'active_info2'");
		query("UPDATE `lp_settings` SET `value` = '".$active_info3."' WHERE `name` = 'active_info3'");
		query("UPDATE `lp_settings` SET `value` = '".$info_text1."' WHERE `name` = 'info_text1'");
		query("UPDATE `lp_settings` SET `value` = '".$info_text2."' WHERE `name` = 'info_text2'");
		query("UPDATE `lp_settings` SET `value` = '".$info_text3."' WHERE `name` = 'info_text3'");
		alert("success", "Informations has been updated.");
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
		Informations
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label for="active_info1">Show information #1</label><br>
			<input id="active_info1-toggle-on" class="toggle toggle-left" name="active_info1" value="1" type="radio" <?php echo ($active_info1 == 1)? "checked" : ""; ?>>
			<label for="active_info1-toggle-on" class="togglebtn">Yes</label>
			<input id="active_info1-toggle-off" class="toggle toggle-right" name="active_info1" value="0" type="radio" <?php echo ($active_info1 == 0)? "checked" : ""; ?>>
			<label for="active_info1-toggle-off" class="togglebtn">No</label>
		</div>
		<div class="form-group">
			<label for="info_text1">Text information #1</label><br>
			<textarea id="info_text1" name="info_text1" placeholder="Type your information #1 text..."><?php echo $info_text1; ?></textarea>
		</div>
		<hr>
		<div class="form-group">
			<label for="active_info2">Show information #2</label><br>
			<input id="active_info2-toggle-on" class="toggle toggle-left" name="active_info2" value="1" type="radio" <?php echo ($active_info2 == 1)? "checked" : ""; ?>>
			<label for="active_info2-toggle-on" class="togglebtn">Yes</label>
			<input id="active_info2-toggle-off" class="toggle toggle-right" name="active_info2" value="0" type="radio" <?php echo ($active_info2 == 0)? "checked" : ""; ?>>
			<label for="active_info2-toggle-off" class="togglebtn">No</label>
		</div>
		<div class="form-group">
			<label for="info_text2">Text information #2</label><br>
			<textarea id="info_text2" name="info_text2" placeholder="Type your information #2 text..."><?php echo $info_text2; ?></textarea>
		</div>
		<hr>
		<div class="form-group">
			<label for="active_info3">Show information #3</label><br>
			<input id="active_info3-toggle-on" class="toggle toggle-left" name="active_info3" value="1" type="radio" <?php echo ($active_info3 == 1)? "checked" : ""; ?>>
			<label for="active_info3-toggle-on" class="togglebtn">Yes</label>
			<input id="active_info3-toggle-off" class="toggle toggle-right" name="active_info3" value="0" type="radio" <?php echo ($active_info3 == 0)? "checked" : ""; ?>>
			<label for="active_info3-toggle-off" class="togglebtn">No</label>
		</div>
		<div class="form-group">
			<label for="info_text3">Text information #3</label><br>
			<textarea id="info_text3" name="info_text3" placeholder="Type your information #3 text..."><?php echo $info_text3; ?></textarea>
		</div>
		<button class="btn-active" type="submit" name="submit">
			Save
		</button>
	</div>
</form>