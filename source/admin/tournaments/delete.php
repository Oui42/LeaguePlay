<?php
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$id = vtxt($_GET['id']);

	$query = query("SELECT `status` FROM `lp_tournaments` WHERE `tournament_id` = '".$id."'");
	if(mysqli_num_rows($query) > 0) {
		$row = mysqli_fetch_assoc($query);

		if($row['status'] == $__tournament['open']) {
			query("UPDATE `lp_tournaments` SET `status` = '".$__tournament['deleted']."' WHERE `tournament_id` = '".$id."'");
			header("Location: index.php?app=admin&module=tournaments");
		}
	} else
		die();
}