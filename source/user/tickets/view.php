<?php
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$_ticketid = $_GET['id'];
	$_ticket = getTicket($_ticketid);

	if($_ticket != -1) {
		if($_ticket['author'] != $user['uid']) {
			alert("error", "It's not your ticket.");
			die();
		}

		$list = array();

		$sql = "SELECT u.*, t.*, tm.* FROM `lp_tickets` AS `t` LEFT JOIN `lp_users` AS `u` ON u.uid = t.author LEFT JOIN `lp_tickets_messages` AS `tm` ON tm.ticket = t.ticket_id WHERE t.ticket_id = ".$_ticketid." ORDER BY tm.date ASC";
		$query = query($sql);
		if(mysqli_num_rows($query) > 0) {
			while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
				if($row['admin'] == 0)
					$adminname = "";
				else
					$adminname = getUserNickname($row['admin']);

				if($row['status'] == $__ticketStatus['new']) {
					$statusname = "New";
				} else if($row['status'] == $__ticketStatus['active']) {
					$statusname = "Open";
				} else if($row['status'] == $__ticketStatus['closed']) {
					$statusname = "Closed";
				}

				$list[] = $row;
			}
		}

		$message = (isset($_POST['message']))? vtxt($_POST['message']) : "";

		if(isset($_POST['submit'])) {
			if(empty($message))
				alert("error", "Please type text to message.");
			else {
				query("INSERT INTO `lp_tickets_messages` (ticket, user, `date`, message) VALUES ('".$_ticketid."', '".$user['uid']."', '".time()."', '".$message."')");
				if($_ticket['status'] != $__ticketStatus['closed'])
					query("UPDATE `lp_tickets` SET `status` = '".$__ticketStatus['new']."' WHERE `ticket_id` = '".$_ticketid."'");
				header("Location: index.php?app=user&module=tickets&section=view&id=".$_ticketid."");
			}
		}

		if(!empty($list)) {
		?>

			<div class="panel">
				<div class="panel-head">
					Ticket #<?php echo $_ticketid; ?>
				</div>
				<div class="panel-body">
					Type: <?php echo getTicketTypeName($_ticket['type']); ?><br>
					Title: <?php echo $_ticket['title']; ?><br>
					Status: <?php echo $statusname; ?><br>
					Admin: <?php echo $adminname; ?>
				</div>
			</div>
			<div class="panel">
				<div class="panel-head">
					Messages
				</div>
				<div class="panel-body">
					<?php foreach($list as $l) { ?>
						<div class="message">
							<div class='message-head'>
								<div class="message-author">
									<?php
									if($l['admin'] == $l['user'])
										echo "<span style='color: #f35151;'>".getUserNickname($l['user'])."</span>";
									else
										echo getUserNickname($l['user']);

									if($l['user'] == $l['author'])
										echo " <small>- author</small>";
									?>
								</div>
								<div class="message-info"><?php echo date("d-m-Y, H:i", $l['date']); ?></div>
							</div>
							<div class="message-text">
								<?php echo $l['message']; ?>
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
			alert("error", "Ticket messages not found in database.");
	} else
		alert("error", "Ticket not found in database.");
} else
	alert("error", "Incorrectly ticket ID.");
?>