<?php
$new_usersday = mysqli_num_rows(query("SELECT `uid` FROM `lp_users` WHERE `register_date` > '".(time()-(60*60*24))."'"));
$new_usersweek = mysqli_num_rows(query("SELECT `uid` FROM `lp_users` WHERE `register_date` > '".(time()-(60*60*24*7))."'"));
$new_usersmonth = mysqli_num_rows(query("SELECT `uid` FROM `lp_users` WHERE `register_date` > '".(time()-(60*60*24*30))."'"));
$top_users = mysqli_num_rows(query("SELECT `uid` FROM `lp_users`"));
$top_tickets = mysqli_num_rows(query("SELECT `ticket_id` FROM `lp_tickets`"));
$active_tournaments = mysqli_num_rows(query("SELECT `tournament_id` FROM `lp_tournaments` WHERE `status` = '".$__tournament['open']."' OR `status` = '".$__tournament['started']."'"));
$top_tournaments = mysqli_num_rows(query("SELECT `tournament_id` FROM `lp_tournaments`"));
?>

<div class="panel popup-panel">
	<div class="panel-head">
		Statistics
	</div>
	<div class="panel-body">
		New users (last 24 hours):&emsp;<b><?php echo $new_usersday; ?></b><br>
		New users (last 7 days):&emsp;<b><?php echo $new_usersweek; ?></b><br>
		New users (last 30 days):&emsp;<b><?php echo $new_usersmonth; ?></b><br>
		Total users:&emsp;<b><?php echo $top_users; ?></b>
		<hr>
		Matches played (last 24 hours):<br>
		Matches played (last 7 days):<br>
		Matches played (last 30 days):<br>
		Total matches:
		<hr>
		Total tickets:&emsp;<b><?php echo $top_tickets; ?></b>
		<hr>
		Active tournaments:&emsp;<b><?php echo $active_tournaments; ?></b><br>
		Total tournaments:&emsp;<b><?php echo $top_tournaments; ?></b>
	</div>
</div>