<?php
$list = array();
$sql = "SELECT * FROM `lp_news` ORDER BY `date` DESC";
$query = query($sql);
if(mysqli_num_rows($query) > 0) {
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$row['active_text'] = ($row['active'] == 1)? "<i class='fa fa-check' style='color: #57e53b;'></i>" : "<i class='fa fa-times' style='color: #f35151;'></i>";
		$list[] = $row;
	}
}

if(!empty($list)) {
?>

<div class="panel">
	<div class="panel-head">
		News list
	</div>
	<div class="panel-body">
		<table class="table">
			<tr class="table-tr">
				<th class="table-th" width="50">ID</th>
				<th class="table-th" width="50">Active</th>
				<th class="table-th" width="200">Publish Date</th>
				<th class="table-th" width="500">Title</th>
				<th class="table-th" width="100">Options</th>
			</tr>
			<?php
				foreach($list as $l) {
					echo "<tr class='table-tr'>";
						echo "<td class='table-td text-center'>".$l['id']."</td>";
						echo "<td class='table-td text-center'>".$l['active_text']."</td>";
						echo "<td class='table-td text-center'>".date("H:i:s, d-m-Y", $l['date'])."</a></td>";
						echo "<td class='table-td'>".$l['title']."</td>";
						echo "<td class='table-td text-center'>";
						?>
							<a href="index.php?app=admin&module=news&section=delete&id=<?php echo $l['id']; ?>"><i class="fa fa-trash"></i></a>
							<a href="index.php?app=admin&module=news&section=active&id=<?php echo $l['id']; ?>"><?php echo ($l['active'] == 0)? '<i class="fa fa-eye"></i>' : '<i class="fa fa-eye-slash"></i>'; ?></a>
							<a href="index.php?app=admin&module=news&section=edit&id=<?php echo $l['id']; ?>"><i class="fa fa-pencil"></i></a>
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
	alert("error", "News not found in database!");
?>