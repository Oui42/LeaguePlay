<?php
$list = array();
//$sql = "SELECT u.*, tm.*, t.* FROM `teams_members` AS `tm` LEFT JOIN `users` AS `u` ON u.uid = tm.user_id LEFT JOIN `teams` AS `t` ON tm.team_id = t.tid WHERE tm.team_id = ".$_teamid." ORDER BY tm.team_rank DESC";
$sql = "SELECT u.*, tp.*, t.* FROM `lp_tournaments_players` AS `tp` LEFT JOIN `lp_users` AS `u` ON u.uid = tp.userid LEFT JOIN `lp_tournaments` AS `t` ON tp.tournamentid = t.tournament_id WHERE tp.tournamentid = ".$_tournamentid." ORDER BY tp.signdate ASC";
$query = query($sql);
if(mysqli_num_rows($query) > 0) {
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
/*		if($row['status'] == $__tournament['started'])
			$row['status_text'] = "<i class='fa fa-fw fa-play' style='color: #57e53b;'></i>";
		else if($row['status'] == $__tournament['closed'])
			$row['status_text'] = "<i class='fa fa-fw fa-calendar-check-o' style='color: #57e53b;'></i>";
		else if($row['status'] == $__tournament['open'])
			$row['status_text'] = "<i class='fa fa-fw fa-calendar-o'></i>";
		else if($row['status'] == $__tournament['deleted'])
			$row['status_text'] = "<i class='fa fa-fw fa-calendar-times-o' style='color: #f35151;'></i>";
*/
		$list[] = $row;
	}
}

if(!empty($list)) {
	$i = 0;
	foreach($list as $l) {
		$i++;
	?>
		<?php echo $i.". "; ?>
		<a href="index.php?app=user&module=main&section=profile&uid=<?php echo $l['uid']; ?>" class="user-link">
			<img src="images/avatar.png" alt="avatar" class="avatar">
			<span class="nickname"><?php echo $l['nickname']; ?></span>
		</a>&emsp;
		<span class="level"><?php echo $l['level']; ?><img src="images/level.png" alt="level" class="level-image"></span>
		<hr>
		<?php
	}
} else
	alert("info", "Empty players list.");
?>