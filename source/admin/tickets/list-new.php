<?php
$list = array();
$sql = "SELECT u.*, t.* FROM `lp_tickets` AS `t` LEFT JOIN `lp_users` AS `u` ON u.uid = t.author WHERE t.status = ".$__ticketStatus['new']." AND t.admin = 0 ORDER BY t.ticket_id DESC";
$query = query($sql);
if(mysqli_num_rows($query) > 0) {
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		if($row['status'] == $__ticketStatus['new'])
			$row['status_name'] = "<span style='color: #f35151;'>NEW</span>";
		else if($row['status'] == $__ticketStatus['active'])
			$row['status_name'] = "ACTIVE";
		else if($row['status'] == $__ticketStatus['closed'])
			$row['status_name'] = "CLOSED";

		$list[] = $row;
	}
}

if(!empty($list)) {
?>

<table class="table">
	<tr class="table-tr">
		<th class="table-th" width="100">Type</th>
		<th class="table-th" width="250">Title</th>
		<th class="table-th" width="150">Author</th>
		<th class="table-th" width="50">Status</th>
	</tr>
	<?php
		foreach($list as $l) {
			echo "<tr class='table-tr'>";
				echo "<td class='table-td text-center'>".getTicketTypeName($l['type'])."</td>";
				echo "<td class='table-td'><a href='index.php?app=admin&module=tickets&section=view&id=".$l['ticket_id']."'>".$l['title']."</a></td>";
				echo "<td class='table-td'><a href='index.php?app=user&module=main&section=profile&uid=".$l['author']."'>".getUserNickname($l['author'])."</a></td>";
				echo "<td class='table-td text-center'>".$l['status_name']."</td>";
			echo "<tr>";
		}
	?>
</table>

<?php
} else
	alert("info", "Tickets not found in database.");
?>