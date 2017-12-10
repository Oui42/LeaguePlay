<?php
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$_tournamentid = $_GET['id'];
	$_tournament = getTournament($_tournamentid);

	if($_tournament != -1) {
		if($_tournament['status'] == $__tournament['deleted']) {
			alert("error", "You have not permissions to view this tournament.");
			die();
		}

		$error = array();

		if(isset($user['uid'])) {
			if(mysqli_num_rows(query("SELECT * FROM `lp_tournaments_players` WHERE `tournamentid` = '".$_tournamentid."' AND `userid` = '".$user['uid']."'")) > 0)
				$signed = true;
			else
				$signed = false;
		}

		$name = $_tournament['name'];
		$award = $_tournament['award'];
		$slots = $_tournament['slots'];
		$date = $_tournament['date'];
		$status = $_tournament['status'];

		if($status == $__tournament['open'])
			$statustext = "Open";
		else if($status == $__tournament['closed'])
			$statustext = "Closed";
		else if($status == $__tournament['deleted'])
			$statustext = "Deleted";
		else if($status == $__tournament['started'])
			$statustext = "Started";

		$players = mysqli_num_rows(query("SELECT tpid FROM `lp_tournaments_players` WHERE `tournamentid` = '".$_tournamentid."'"));

		?>

		<div class="home-left" id="tabs">
			<ul class="tabs">
				<li class="tab-link current" data-tab="players">Players</li>
				<li class="tab-link" data-tab="ladder">Ladder</li>
			</ul>
			<div class="panel-body tab-content current" id="players">
				<?php include("view-players.php"); ?>
			</div>
			<div class="panel-body tab-content" id="ladder">
				<?php include("view-ladder.php"); ?>
			</div>
		</div>
		<div class="home-right">
			<div class="panel">
				<div class="panel-head">
					Details
					<?php if(isset($user['uid']) && $user['perms'] >= $__perms['admin']) { ?>
						<a href="index.php?app=admin&module=tournaments&section=edit&id=<?php echo $_tournamentid; ?>"><i class="fa fa-pencil"></i></a>
					<?php } ?>
				</div>
				<div class="panel-body text-center">
					Name:&emsp;<?php echo $name; ?>
					<hr>
					Status:&emsp;<?php echo $statustext; ?>
					<hr>
					Start date:&emsp;<?php echo date("d-m-Y, H:i", $date); ?>
					<hr>
					Award:&emsp;<span class="points"><?php echo $award; ?><img src="images/points.png" alt="points" class="points-image"></span>
					<hr>
					Players:&emsp;<?php echo $players." / ".$slots; ?>
					<?php if(isset($user['uid'])) { ?>
						<?php if($status == $__tournament['open'] && $signed == false) { ?>
							<hr>
							<a href="index.php?app=main&module=tournaments&section=signup&id=<?php echo $_tournamentid; ?>" class="btn-golden">Sign up</a>
						<?php } else if($status == $__tournament['open'] && $signed == true) { ?>
							<hr>
							<i class="fa fa-check" style="color: #57e53b;"></i> You are signed up to this tournament.
						<?php } ?>
						<hr>
						<a href="index.php?app=user&module=tickets&section=new&type=<?php echo $__ticketType['supportTournament']; ?>&id=<?php echo $_tournamentid; ?>" class="btn btn-small">Support ticket</a>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<?php
	} else
		die();
} else
	die();
?>