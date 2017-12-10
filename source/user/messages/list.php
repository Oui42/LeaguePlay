<?php
$list = array();
$sql = "SELECT * FROM `lp_messages` WHERE `owner` = '".$user['uid']."' OR `target` = '".$user['uid']."' ORDER BY `messageid` DESC";
$query = query($sql);
if(mysqli_num_rows($query) > 0) {
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$row['new_message'] = "";
		if($row['status'] == $__messages['newuser1']) {
			if($row['owner'] == $user['uid'])
				$row['new_message'] = " - <span style='color: #f35151;'>NEW</span>";
		} else if($row['status'] == $__messages['newuser2']) {
			if($row['target'] == $user['uid'])
				$row['new_message'] = " - <span style='color: #f35151;'>NEW</span>";
		}

		$list[] = $row;
	}
}

if(!empty($list)) {
?>

<div class="panel">
	<div class="panel-head">
		Messages
	</div>
	<div class="panel-body">
		<table class="table">
			<tr class="table-tr">
				<th class="table-th" width="300">User</th>
				<th class="table-th" width="500">Title</th>
			</tr>
			<?php
				foreach($list as $l) {
					echo "<tr class='table-tr'>";
						if($l['owner'] == $user['uid'])
							echo "<td class='table-td'><a href='index.php?app=user&module=main&section=profile&uid=".$l['target']."'>".getUserNickname($l['target'])."</a></td>";
						else
							echo "<td class='table-td'><a href='index.php?app=user&module=main&section=profile&uid=".$l['owner']."'>".getUserNickname($l['owner'])."</a></td>";
						echo "<td class='table-td'><a href='index.php?app=user&module=messages&section=view&id=".$l['messageid']."'>".$l['title'].$l['new_message']."</a></td>";
					echo "<tr>";
				}
			?>
		</table>
	</div>
</div>

<?php
} else
	alert("info", "You have not messages.");
?>