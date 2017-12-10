<?php
$name = (isset($_POST['name']))? vtxt($_POST['name']) : "";
$award = (isset($_POST['award']))? vtxt($_POST['award']) : "";
$slots = (isset($_POST['slots']))? $_POST['slots'] : "";

$dateD = (isset($_POST['dateD']))? vtxt($_POST['dateD']) : "";
$dateM = (isset($_POST['dateM']))? vtxt($_POST['dateM']) : "";
$dateY = (isset($_POST['dateY']))? vtxt($_POST['dateY']) : "";
$dateH = (isset($_POST['dateH']))? vtxt($_POST['dateH']) : "";
$dateMin = (isset($_POST['dateMin']))? vtxt($_POST['dateMin']) : "";

if(isset($_POST['new'])) {
	if(empty($name))
		$error[] = "Please type tournament name.";

	if(strlen($name) < 3 || strlen($name) > 16)
		$error[] = "Name must be at least 3 and at most 16 characters.";

	if(!is_numeric($award))
		$error[] = "Award must be numeric value.";

	if(empty($dateD) || empty($dateM) || empty($dateY) || empty($dateH) || empty($dateMin))
		$error[] = "Please type start date.";

	if(!is_numeric($dateD) || !is_numeric($dateM) || !is_numeric($dateY) || !is_numeric($dateH) || !is_numeric($dateMin))
		$error[] = "Start date must be numeric value.";

	if(empty($error)) {
		$date = strtotime($dateY.'-'.$dateM.'-'.$dateD.' '.$dateH.':'.$dateMin);

		query("INSERT INTO `lp_tournaments` (name, award, `date`, slots, status)
			VALUES('".$name."', '".$award."', '".$date."', '".$slots."', '".$__tournament['open']."')")
			or die(mysqli_error($connect));
		$id = mysqli_insert_id($connect);
		alert("success", "Tournament has been created.");
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
		Create new tournament
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label for="name">Name</label><br>
			<input id="name" type="text" name="name" maxlength="16" placeholder="Type tournament name..." value="<?php echo $name; ?>">
		</div>
		<div class="form-group">
			<label for="date">Start Date</label><br>
			<input id="date" class="input-mini10" type="text" name="dateD" maxlength="2" placeholder="DD" value="<?php echo $dateD; ?>"> -
			<input id="date" class="input-mini10" type="text" name="dateM" maxlength="2" placeholder="MM" value="<?php echo $dateM; ?>"> -
			<input id="date" class="input-mini20" type="text" name="dateY" maxlength="4" placeholder="YYYY" value="<?php echo $dateY; ?>">&emsp;
			<input id="date" class="input-mini10" type="text" name="dateH" maxlength="2" placeholder="HH" value="<?php echo $dateH; ?>"> :
			<input id="date" class="input-mini10" type="text" name="dateMin" maxlength="2" placeholder="MM" value="<?php echo $dateMin; ?>">
		</div>
		<div class="form-group">
			<label for="award">Award</label><br>
			<input id="award" class="input-mini20" type="text" name="award" placeholder="0" maxlength="8" value="<?php echo $award; ?>">
		</div>
		<div class="form-group">
			<label for="slots">Slots</label><br>
			<select id="slots" name="slots">
				<option value="16">16</option>
				<option value="32">32</option>
				<option value="64">64</option>
				<option value="128">128</option>
				<option value="256">256</option>
			</select>
		</div>
		<button class="btn-active" type="submit" name="new">
			Create
		</button>
	</div>
</form>