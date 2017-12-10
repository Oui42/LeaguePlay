<?php
$list = array();
$sql = "SELECT * FROM `lp_tournaments` ORDER BY `date` DESC";
$query = query($sql);
if(mysqli_num_rows($query) > 0) {
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		if($row['status'] == $__tournament['started'])
			$row['status_text'] = "<i class='fa fa-fw fa-play' style='color: #57e53b;'></i>";
		else if($row['status'] == $__tournament['closed'])
			$row['status_text'] = "<i class='fa fa-fw fa-calendar-check-o' style='color: #57e53b;'></i>";
		else if($row['status'] == $__tournament['open'])
			$row['status_text'] = "<i class='fa fa-fw fa-calendar-o'></i>";
		else if($row['status'] == $__tournament['deleted'])
			$row['status_text'] = "<i class='fa fa-fw fa-calendar-times-o' style='color: #f35151;'></i>";

		$row['players'] = mysqli_num_rows(query("SELECT tpid FROM `lp_tournaments_players` WHERE `tournamentid` = '".$row['tournament_id']."'"));

		$list[] = $row;
	}
}

if(!empty($list)) {
?>

<div class="panel">
	<div class="panel-head">
		Tournaments list
	</div>
	<div class="panel-body">
		<table class="table">
			<tr class="table-tr">
				<th class="table-th" width="50">ID</th>
				<th class="table-th" width="200">Date, status</th>
				<th class="table-th" width="60">Players</th>
				<th class="table-th" width="90">Award</th>
				<th class="table-th" width="200">Name</th>
				<th class="table-th" width="100">Options</th>
			</tr>
			<?php
				foreach($list as $l) {
					echo "<tr class='table-tr'>";
						echo "<td class='table-td text-center'>".$l['tournament_id']."</td>";
						echo "<td class='table-td text-center'>".date("d-m-Y, H:i", $l['date'])."&emsp;".$l['status_text']."</td>";
						echo "<td class='table-td text-center'>".$l['players']." / ".$l['slots']."</td>";
						echo "<td class='table-td text-center'><span class='points'>".$l['award']."<img src='images/points.png' alt='points' class='points-image'></span></td>";
						echo "<td class='table-td'>".$l['name']."</td>";
						echo "<td class='table-td text-center'>";
							if($l['status'] == $__tournament['open']) { ?>
								<a href="index.php?app=admin&module=tournaments&section=delete&id=<?php echo $l['tournament_id']; ?>"><i class="fa fa-trash"></i></a>
							<?php } ?>
							<a href="index.php?app=main&module=tournaments&section=view&id=<?php echo $l['tournament_id']; ?>"><i class="fa fa-eye"></i></a>
							<a href="index.php?app=admin&module=tournaments&section=edit&id=<?php echo $l['tournament_id']; ?>"><i class="fa fa-pencil"></i></a>
						<?php
						echo "</td>";
					echo "<tr>";
				}
			?>
		</table>
	</div>
</div>

<?php
} else
	alert("error", "Tournaments not found in database!");
?>