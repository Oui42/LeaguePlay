<?php
if(isset($_GET['id']) && is_numeric($_GET['id'])) {

	$_tournamentid = $_GET['id'];
	$_tournament = getTournament($_tournamentid);

	if($_tournament > 0) {
		$error = array();

		if(!isset($user['uid'])) 
			$error[] = "You have to sign in.";
		else {
			if($_tournament['status'] != $__tournament['open'])
				$error[] = "You can't sign up to this tournament.";

			if(mysqli_num_rows(query("SELECT * FROM `lp_tournaments_players` WHERE `tournamentid` = '".$_tournamentid."' AND `userid` = '".$user['uid']."'")) > 0)
				$error[] = "You are already signed up to this tournament.";
		}

		if(empty($error)) {
			query("INSERT INTO `lp_tournaments_players` (tournamentid, userid, signdate)
				VALUES('".$_tournamentid."', '".$user['uid']."', '".time()."')")
				or die(mysqli_error($connect));
			$id = mysqli_insert_id($connect);
			alert("success", "You signed up to the tournament.");
		} else {
			echo "<div class='alert alert-error'><div class='alert-title'><i class='fa fa-exclamation-circle fa-lg'></i> Error!</div> Errors occurred:<br>";
			foreach($error as $e)
				echo "&bull; ".$e."<br>";
			echo "</div>";
		}
	} else
		die();
} else
	die();
?>