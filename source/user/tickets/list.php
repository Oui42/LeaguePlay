<?php
$list = array();
$sql = "SELECT * FROM `lp_tickets` WHERE `author` = ".$user['uid']." ORDER BY ticket_id DESC";
$query = query($sql);
if(mysqli_num_rows($query) > 0) {
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		if($row['status'] == $__ticketStatus['new'])
			$row['status_name'] = "NEW";
		else if($row['status'] == $__ticketStatus['active'])
			$row['status_name'] = "<span style='color: #f35151;'>ACTIVE</span>";
		else if($row['status'] == $__ticketStatus['closed'])
			$row['status_name'] = "CLOSED";

		$list[] = $row;
	}
}
?>

<div class="panel">
	<div class="panel-head">
		Tickets list
		<a href="index.php?app=user&module=tickets&section=new&type=<?php echo $__ticketType['support']; ?>" class="btn btn-small">New support ticket</a>
	</div>
	<div class="panel-body">
		<?php if(!empty($list)) { ?>
		<table class="table">
			<tr class="table-tr">
				<th class="table-th" width="100">Type</th>
				<th class="table-th" width="500">Title</th>
				<th class="table-th" width="250">Admin</th>
				<th class="table-th" width="50">Status</th>
			</tr>
			<?php
				foreach($list as $l) {
					echo "<tr class='table-tr'>";
						echo "<td class='table-td text-center'>".getTicketTypeName($l['type'])."</td>";
						echo "<td class='table-td'><a href='index.php?app=user&module=tickets&section=view&id=".$l['ticket_id']."'>".$l['title']."</a></td>";
						echo "<td class='table-td'><a href='index.php?app=user&module=main&section=profile&uid=".$l['admin']."'>".getUserNickname($l['admin'])."</a></td>";
						echo "<td class='table-td text-center'>".$l['status_name']."</td>";
					echo "<tr>";
				}
			?>
		</table>
		<?php
		} else
			alert("info", "Tickets not found.");
		?>
	</div>
</div>