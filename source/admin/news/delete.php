<?php
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$id = vtxt($_GET['id']);

	$query = query("SELECT `active` FROM `lp_news` WHERE `id` = '".$id."'");
	if(mysqli_num_rows($query) > 0) {
		$row = mysqli_fetch_assoc($query);

		query("DELETE FROM `lp_news` WHERE `id` = '".$id."'");
		header("Location: index.php?app=admin&module=news");
	} else
		die();
}