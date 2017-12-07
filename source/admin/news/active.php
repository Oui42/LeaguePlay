<?php
if(isset($_GET['id'])) {
	$id = vtxt($_GET['id']);

	$query = query("SELECT `active` FROM `lp_news` WHERE `id` = '".$id."'");
	if(mysqli_num_rows($query) > 0) {
		$row = mysqli_fetch_assoc($query);

		if($row['active'] == 0) {
			query("UPDATE `lp_news` SET `active` = '1' WHERE `id` = '".$id."'");
			header("Location: index.php?app=admin&module=news");
		} else {
			query("UPDATE `lp_news` SET `active` = '0' WHERE `id` = '".$id."'");
			header("Location: index.php?app=admin&module=news");
		}
	} else {
		die();
	}
}