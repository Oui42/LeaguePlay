<?php
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$_messageid = $_GET['id'];
	$_message = getMessage($_messageid);

	if($_message != -1) {
		if($_message['owner'] != $user['uid'] && $_message['target'] != $user['uid']) {
			alert("error", "It's not your message.");
			die();
		}

		$list = array();

		if($_message['owner'] == $user['uid'] && $_message['status'] == $__messages['newuser1'])
			query("UPDATE `lp_messages` SET `status` = '".$__messages['readed']."'");
		else if($_message['target'] == $user['uid'] && $_message['status'] == $__messages['newuser2'])
			query("UPDATE `lp_messages` SET `status` = '".$__messages['readed']."'");

		$sql = "SELECT u.*, m.*, mt.* FROM `lp_messages` AS `m` LEFT JOIN `lp_users` AS `u` ON u.uid = m.owner LEFT JOIN `lp_messages_text` AS `mt` ON mt.message_id = m.messageid WHERE m.messageid = ".$_messageid." ORDER BY mt.date ASC";
		$query = query($sql);
		if(mysqli_num_rows($query) > 0) {
			while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
/*				if($row['status'] == $__messages['new']) {
					$statusname = "New";
				} else if($row['status'] == $__messages['active']) {
					$statusname = "Open";
				} else if($row['status'] == $__messages['closed']) {
					$statusname = "Closed";
				}*/

				$list[] = $row;
			}
		}

		$message = (isset($_POST['message']))? vtxt($_POST['message']) : "";

		if(isset($_POST['submit'])) {
			if(empty($message))
				alert("error", "Please type text to message.");
			else {
				query("INSERT INTO `lp_messages_text` (message_id, user, `date`, `text`) VALUES ('".$_messageid."', '".$user['uid']."', '".time()."', '".$message."')");
				if($_message['status'] != $__messages['deleted']) {
					if($_message['owner'] == $user['uid'])
						query("UPDATE `lp_messages` SET `status` = '".$__messages['newuser2']."' WHERE `messageid` = '".$_messageid."'");
					else if($_message['target'] == $user['uid'])
						query("UPDATE `lp_messages` SET `status` = '".$__messages['newuser1']."' WHERE `messageid` = '".$_messageid."'");
				}
				header("Location: index.php?app=user&module=messages&section=view&id=".$_messageid."");
			}
		}

		if(!empty($list)) {
		?>

			<div class="panel">
				<div class="panel-head">
					Message - <?php echo $_message['title']; ?>
				</div>
				<div class="panel-body">
					<?php foreach($list as $l) { ?>
						<div class="message">
							<div class='message-head'>
								<div class="message-author"><a href="index.php?app=user&module=main&section=profile&uid=<?php echo $l['user']; ?>"><?php echo getUserNickname($l['user']); ?></a></div>
								<div class="message-info"><?php echo date("d-m-Y, H:i", $l['date']); ?></div>
							</div>
							<div class="message-text">
								<?php echo $l['text']; ?>
							</div>
						</div>
					<?php } ?>
					<form method="post" action="">
						<div class="text-center">
							<div class="form-group">
								<textarea id="message" name="message" placeholder="Type your message..."><?php echo $message; ?></textarea>
							</div>
							<button class="btn-active" type="submit" name="submit">
								Send
							</button>
						</div>
					</form>
				</div>
			</div>

		<?php
		} else
			alert("error", "Messages not found.");
	} else
		alert("error", "Message not found.");
} else
	alert("error", "Incorrectly message ID.");
?>