<?php
if(isset($_GET['uid']) && is_numeric($_GET['uid'])) {
	$uid = vtxt($_GET['uid']);

	$query = query("SELECT `perms` FROM `lp_users` WHERE `uid` = '".$uid."'");
	if(mysqli_num_rows($query) > 0) {
		$row = mysqli_fetch_assoc($query);

		if($row['perms'] == 0) {
			query("UPDATE `lp_users` SET `perms` = '-1' WHERE `uid` = '".$uid."'");
			header("Location: index.php?app=admin&module=users");
		} else if($row['perms'] == -1) {
			query("UPDATE `lp_users` SET `perms` = '0' WHERE `uid` = '".$uid."'");
			header("Location: index.php?app=admin&module=users");
		} else
			header("Location: index.php?app=admin&module=users");
	} else
		die();
}