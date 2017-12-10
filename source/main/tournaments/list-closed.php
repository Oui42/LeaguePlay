<?php
$list = array();
$sql = "SELECT * FROM `lp_tournaments` WHERE `status` = '".$__tournament['closed']."' ORDER BY `date` DESC";
$query = query($sql);
if(mysqli_num_rows($query) > 0) {
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		if($row['status'] == $__tournament['closed'])
			$row['status_text'] = "<span style='color: #f35151;'>Closed</span>";

		$row['players'] = mysqli_num_rows(query("SELECT tpid FROM `lp_tournaments_players` WHERE `tournamentid` = '".$row['tournament_id']."'"));

		$list[] = $row;
	}
}

if(!empty($list)) {
?>

<div class="panel">
	<div class="panel-head">
		Closed Tournaments
	</div>
	<div class="panel-body">
		<table class="table">
			<tr class="table-tr">
				<th class="table-th" width="300">Date</th>
				<th class="table-th" width="300">Name</th>
				<th class="table-th" width="60">Players</th>
				<th class="table-th" width="90">Award</th>
				<th class="table-th" width="100">Action</th>
			</tr>
			<?php
				foreach($list as $l) {
					echo "<tr class='table-tr'>";
						echo "<td class='table-td text-center'>".date("d-m-Y, H:i", $l['date'])."&emsp;".$l['status_text']."</a></td>";
						echo "<td class='table-td'>".$l['name']."</td>";
						echo "<td class='table-td text-center'>".$l['players']." / ".$l['slots']."</td>";
						echo "<td class='table-td text-center'><span class='points'>".$l['award']."<img src='images/points.png' alt='points' class='points-image'></span></td>";
						echo "<td class='table-td text-center'>";
						?>
							<a href="index.php?app=main&module=tournaments&section=view&id=<?php echo $l['tournament_id']; ?>" class="btn btn-small">View</a>
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
	alert("info", "Tournaments wasn't be played yet.");
?>