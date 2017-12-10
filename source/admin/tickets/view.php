<?php
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$_ticketid = $_GET['id'];
	$_ticket = getTicket($_ticketid);

	if($_ticket != -1) {
		$list = array();

		if(isset($_POST['take'])) {
			query("UPDATE `lp_tickets` SET `admin` = '".$user['uid']."', `status` = '".$__ticketStatus['active']."' WHERE `ticket_id` = '".$_ticketid."'");
			header("Location: index.php?app=admin&module=tickets&section=view&id=".$_ticketid."");
		}

		if(isset($_POST['unlock'])) {
			query("UPDATE `lp_tickets` SET `admin` = 0, `status` = '".$__ticketStatus['new']."' WHERE `ticket_id` = '".$_ticketid."'");
			header("Location: index.php?app=admin&module=tickets&section=view&id=".$_ticketid."");
		}

		if(isset($_POST['close'])) {
			query("UPDATE `lp_tickets` SET `status` = '".$__ticketStatus['closed']."' WHERE `ticket_id` = '".$_ticketid."'");
			header("Location: index.php?app=admin&module=tickets&section=view&id=".$_ticketid."");
		}

		if(isset($_POST['open'])) {
			query("UPDATE `lp_tickets` SET `admin` = '".$user['uid']."', `status` = '".$__ticketStatus['active']."' WHERE `ticket_id` = '".$_ticketid."'");
			header("Location: index.php?app=admin&module=tickets&section=view&id=".$_ticketid."");
		}

		$sql = "SELECT u.*, t.*, tm.* FROM `lp_tickets` AS `t` LEFT JOIN `lp_users` AS `u` ON u.uid = t.author LEFT JOIN `lp_tickets_messages` AS `tm` ON tm.ticket = t.ticket_id WHERE t.ticket_id = ".$_ticketid." ORDER BY tm.date ASC";
		$query = query($sql);
		if(mysqli_num_rows($query) > 0) {
			while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
				if($row['admin'] == 0) {
					$adminname = "";
					if($user['perms'] >= $__perms['admin'])
						$adminname = "<form action='' method='post'><button name='take' class='btn btn-small'>Take it</button></form>";
				} else
					$adminname = "<a href='index.php?app=user&module=main&section=profile&uid=".$_ticket['admin']."'>".getUserNickname($row['admin'])."</a>";

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
				query("UPDATE `lp_tickets` SET `admin` = '".$user['uid']."', `status` = '".$__ticketStatus['active']."' WHERE `ticket_id` = '".$_ticketid."'");
				header("Location: index.php?app=admin&module=tickets&section=view&id=".$_ticketid."");
			}
		}

		if(!empty($list)) {
		?>

			<div class="panel">
				<div class="panel-head">
					Ticket #<?php echo $_ticketid; ?>
				</div>
				<div class="panel-body">
					<form action='' method='post'>
						Type: <?php echo getTicketTypeName($_ticket['type']); ?><br>
						Title: <?php echo $_ticket['title']; ?><br>
						Status: <?php echo $statusname; ?>
						<?php
						if(isset($_ticket['admin']) && $_ticket['admin'] != 0 && $_ticket['status'] != $__ticketStatus['closed'])
							echo "<button name='close' class='btn btn-small'>Close</button>";
						if($_ticket['status'] == $__ticketStatus['closed'])
							echo "<button name='open' class='btn btn-small'>Open</button>";
						?><br>
						Admin: <?php echo $adminname; ?>
						<?php if(isset($_ticket['admin']) && $_ticket['admin'] != 0) echo "<button name='unlock' class='btn btn-small'>Unlock</button>"; ?>
					</form>
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
										echo "<a href='index.php?app=user&module=main&section=profile&uid=".$l['user']."'><span style='color: #f35151;'>".getUserNickname($l['user'])."</span></a>";
									else
										echo "<a href='index.php?app=user&module=main&section=profile&uid=".$l['user']."'>".getUserNickname($l['user'])."</a>";

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
}
?>