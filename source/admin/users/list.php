<?php
$active_menu = "users-list";

$list = array();
$sql = "SELECT * FROM `lp_users` ORDER BY `uid` ASC";
$query = query($sql);
if(mysqli_num_rows($query) > 0) {
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		if($row['perms'] == 0)
			$row['perms_text'] = "<i class='fa fa-ban' style='color: #f35151;'></i>";
		else if($row['perms'] == -1)
			$row['perms_text'] = "<i class='fa fa-check' style='color: #57e53b;'></i>";
		else if($row['perms'] > 0)
			$row['perms_text'] = "";
		$list[] = $row;
	}
}

if(!empty($list)) {
?>

<div class="panel">
	<div class="panel-head">
		Users list
	</div>
	<div class="panel-body">
		<table class="table">
			<tr class="table-tr">
				<th class="table-th" width="60">ID</th>
				<th class="table-th" width="240">Nickname</th>
				<th class="table-th" width="300">Email Address</th>
				<th class="table-th" width="60">Level</th>
				<th class="table-th" width="60">Points</th>
				<th class="table-th" width="100">Options</th>
				<th class="table-th"></th>
			</tr>
			<?php
				foreach($list as $l) {
					echo "<tr class='table-tr'>";
						echo "<td class='table-td text-center'>".$l['uid']."</td>";
						echo "<td class='table-td'><a href='index.php?app=user&section=main&section=profile&uid=".$l['uid']."'>".$l['nickname']."</a></td>";
						echo "<td class='table-td'>".$l['email']."</td>";
						echo "<td class='table-td text-center''>".$l['level']."</td>";
						echo "<td class='table-td text-center''><span class='points'>".$l['points']."<img src='images/points.png' alt='points' class='points-image'></span></td>";
						echo "<td class='table-td text-center'>";
						?>
							<a href="index.php?app=admin&module=users&section=edit&uid=<?php echo $l['uid']; ?>"><i class="fa fa-pencil"></i></a>
						<?php
						echo "</td>";
						echo "<td class='table-td text-center'>";
						?>
							<a href="index.php?app=admin&module=users&section=ban&uid=<?php echo $l['uid']; ?>"><?php echo $l['perms_text']; ?></a>
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
	alert("error", "Users not found in database!");
?>