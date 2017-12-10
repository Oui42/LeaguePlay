<?php
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$_tournamentid = $_GET['id'];
	$_tournament = getTournament($_tournamentid);

	if($_tournament != -1) {
		$error = array();

		$name = $_tournament['name'];
		$award = $_tournament['award'];
		$slots = $_tournament['slots'];
		$status = $_tournament['status'];

		$datestring = date("d m Y H i", $_tournament['date']);
		$sepdate = explode(" ", $datestring);
		$dateD = $sepdate[0];
		$dateM = $sepdate[1];
		$dateY = $sepdate[2];
		$dateH = $sepdate[3];
		$dateMin = $sepdate[4];

		if(isset($_POST['submit'])) {
			$name = vtxt($_POST['name']);
			$award = vtxt($_POST['award']);
			$slots = vtxt($_POST['slots']);
			$status = $_POST['status'];

			$dateD = vtxt($_POST['dateD']);
			$dateM = vtxt($_POST['dateM']);
			$dateY = vtxt($_POST['dateY']);
			$dateH = vtxt($_POST['dateH']);
			$dateMin = vtxt($_POST['dateMin']);

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
				query("UPDATE `lp_tournaments` SET `name` = '".$name."', `award` = '".$award."', `date` = '".$date."', `slots` = '".$slots."', `status` = '".$status."' WHERE `tournament_id` = '".$_tournamentid."'");
				alert("success", "Tournament has been updated.");
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
				Edit tournament
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
						<option <?php echo ($slots == "16")? "selected" : ""; ?> value="16">16</option>
						<option <?php echo ($slots == "32")? "selected" : ""; ?> value="32">32</option>
						<option <?php echo ($slots == "64")? "selected" : ""; ?> value="64">64</option>
						<option <?php echo ($slots == "128")? "selected" : ""; ?> value="128">128</option>
						<option <?php echo ($slots == "256")? "selected" : ""; ?> value="256">256</option>
					</select>
				</div>
				<div class="form-group">
					<label for="status">Status</label><br>
					<span class="radio">
						<input type="radio" name="status" id="radio1" value="<?php echo $__tournament['open']; ?>" <?php echo ($status == $__tournament['open'])? "checked" : ""; ?>>
						<label for="radio1" class="radio-label">Open</label>
					</span>
					<span class="radio">
						<input type="radio" name="status" id="radio2" value="<?php echo $__tournament['started']; ?>" <?php echo ($status == $__tournament['started'])? "checked" : ""; ?>>
						<label for="radio2" class="radio-label">Started</label>
					</span>
					<span class="radio">
						<input type="radio" name="status" id="radio3" value="<?php echo $__tournament['closed']; ?>" <?php echo ($status == $__tournament['closed'])? "checked" : ""; ?>>
						<label for="radio3" class="radio-label">Closed</label>
					</span>
					<span class="radio">
						<input type="radio" name="status" id="radio4" value="<?php echo $__tournament['deleted']; ?>" <?php echo ($status == $__tournament['deleted'])? "checked" : ""; ?>>
						<label for="radio4" class="radio-label">Deleted</label>
					</span>
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