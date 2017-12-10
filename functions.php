<?php
function query($query) {
	global $connect;
	return mysqli_query($connect, $query);
}

function vtxt($var) {
	global $connect;
	return trim(mysqli_real_escape_string($connect, strip_tags($var)));
};

function row($query) {
	global $connect;
	return mysqli_fetch_assoc(query($query)); 
}

function getSettings() {
	$sql = "SELECT * FROM `lp_settings`";
	$query = query($sql);
	$ret = array();
	
	while($row = mysqli_fetch_array($query)) {
		$ret[$row['name']] = $row['value'];
	}
	return $ret;
}

$__SETTINGS = getSettings();

function getUser($uid) {
	if(isset($uid) && is_numeric($uid)) {
		$ret = row("SELECT * FROM `lp_users` WHERE uid = '".$uid."' LIMIT 1");
		return $ret;
	} else {
		return array();
	}
}

if(isset($_SESSION['uid'])) {
	$user = getUser($_SESSION['uid']);
}

function getUserNickname($uid) {
	global $connect;
	if(isset($uid) && is_numeric($uid)) {
		if(empty($uid) || $uid == 0) {
			$ret = "";
		} else {
			$query = "SELECT `nickname` FROM `lp_users` WHERE uid = '".$uid."' LIMIT 1";
			if($result = query($query)) {
				while($row = mysqli_fetch_assoc($result)) {
					$ret = $row['nickname'];
				}
			}
		}
		return $ret;
	} else {
		return array();
	}
}

function getNews($id) {
	if(isset($id) && is_numeric($id)) {
		$ret = row("SELECT * FROM `lp_news` WHERE id = '".$id."' LIMIT 1");
		return $ret;
	} else {
		return array();
	}
}

function newMessage($owner, $target, $date, $title, $text) {
	global $connect;
	include("constants.php");
	
	query("INSERT INTO `lp_messages` (owner, target, title, status) VALUES ('".$owner."', '".$target."', '".$title."', '".$__message['newuser2']."')");
	$message_id = mysqli_insert_id($connect);
	query("INSERT INTO `lp_messages_text` (message_id, user, `date`, `text`) VALUES ('".$message_id."', '".$owner."', '".$date."', '".$text."')");
}

function getTicket($id) {
	if(isset($id) && is_numeric($id)) {
		$ret = row("SELECT * FROM `lp_tickets` WHERE ticket_id = '".$id."' LIMIT 1");
		return $ret;
	} else {
		return array();
	}
}

function getMessage($id) {
	if(isset($id) && is_numeric($id)) {
		$ret = row("SELECT * FROM `lp_messages` WHERE messageid = '".$id."' LIMIT 1");
		return $ret;
	} else {
		return array();
	}
}

function getTournament($id) {
	if(isset($id) && is_numeric($id)) {
		$ret = row("SELECT * FROM `lp_tournaments` WHERE tournament_id = '".$id."' LIMIT 1");
		return $ret;
	} else {
		return array();
	}
}

function alert($type, $text) {
	if($type == "warning") {
		$message = "<div class='alert alert-warning'><div class='alert-title'><i class='fa fa-exclamation-triangle fa-lg'></i> Warning!</div> ".$text."</div>";
	} else if($type == "error") {
		$message = "<div class='alert alert-error'><div class='alert-title'><i class='fa fa-exclamation-circle fa-lg'></i> Error!</div> ".$text."</div>";
	} else if($type == "success") {
		$message = "<div class='alert alert-success'><div class='alert-title'><i class='fa fa-check-circle fa-lg'></i> Success!</div> ".$text."</div>";
	} else if($type == "info") {
		$message = "<div class='alert alert-info'><div class='alert-title'><i class='fa fa-info-circle fa-lg'></i> Information!</div> ".$text."</div>";
	} else {
		$message = "alert error";
	}

	echo $message;
}

function checkTicketType($type) {
	include("constants.php");

	if(!is_numeric($type) || empty($type))
		$result = false;
	else {
		if($type == $__ticketType['reportUser'])
			$result = true;
		else if($type == $__ticketType['reportTeam'])
			$result = true;
		else if($type == $__ticketType['support'])
			$result = true;
		else if($type == $__ticketType['supportMatch'])
			$result = true;
		else if($type == $__ticketType['supportTournament'])
			$result = true;
		else if($type == $__ticketType['supportTournamentMatch'])
			$result = true;
		else
			$result = false;
	}

	return $result;
}

function getTicketTypeName($type) {
	include("constants.php");

	if($type == $__ticketType['reportUser'])
		$name = "Report User";
	else if($type == $__ticketType['reportTeam'])
		$name = "Report Team";
	else if($type == $__ticketType['support'])
		$name = "Support Ticket";
	else if($type == $__ticketType['supportMatch'])
		$name = "Match Support Ticket";
	else if($type == $__ticketType['supportTournament'])
		$name = "Tournament Support Ticket";
	else if($type == $__ticketType['supportTournamentMatch'])
		$name = "Tournament Match Support Ticket";
	else
		$name = "error name ticket";

	return $name;
}

function createTicket($type, $author, $target, $date, $title, $message) {
	global $connect;
	include("constants.php");
	$error = array();

	if(empty($type) || !is_numeric($type))
		$error[] = "Incorrectly ticket type.";

	if(empty($author) || !is_numeric($author))
		$error[] = "Incorrectly ticket author.";

	if(empty($date) || !is_numeric($date))
		$error[] = "Incorrectly ticket date.";

	if(empty($title))
		$title = "(no title)";

	if(empty($error)) {
		if($type == $__ticketType['reportUser']) {
			if(empty($target) || !is_numeric($target) || strlen($title) > 32)
				$error[] = "Incorrectly ticket values.";

			if(empty($error)) {
				query("INSERT INTO `lp_tickets` (type, author, target, title) VALUES ('".$type."', '".$author."', '".$target."', '".$title."')") or die(mysqli_error($connect));
				$ticket_id = mysqli_insert_id($connect);
				query("INSERT INTO `lp_tickets_messages` (ticket, user, `date`, message) VALUES ('".$ticket_id."', '".$author."', '".$date."', '".$message."')") or die(mysqli_error($connect));
			}
		} else if($type == $__ticketType['reportTeam']) {
			if(empty($target) || !is_numeric($target) || strlen($title) > 32)
				$error[] = "Incorrectly ticket values.";

			if(empty($error)) {
				query("INSERT INTO `lp_tickets` (type, author, target, title) VALUES ('".$type."', '".$author."', '".$target."', '".$title."')") or die(mysqli_error($connect));
				$ticket_id = mysqli_insert_id($connect);
				query("INSERT INTO `lp_tickets_messages` (ticket, user, `date`, message) VALUES ('".$ticket_id."', '".$author."', '".$date."', '".$message."')") or die(mysqli_error($connect));
			}
		} else if($type == $__ticketType['support']) {
			if(strlen($title) > 32)
				$error[] = "Incorrectly ticket values.";

			if(empty($error)) {
				query("INSERT INTO `lp_tickets` (type, author, title) VALUES ('".$type."', '".$author."', '".$title."')") or die(mysqli_error($connect));
				$ticket_id = mysqli_insert_id($connect);
				query("INSERT INTO `lp_tickets_messages` (ticket, user, `date`, message) VALUES ('".$ticket_id."', '".$author."', '".$date."', '".$message."')") or die(mysqli_error($connect));
			}
		} else if($type == $__ticketType['supportMatch']) {
			if(empty($target) || !is_numeric($target) || strlen($title) > 32)
				$error[] = "Incorrectly ticket values.";
				
				//$targetUser = ;				// GET TARGET USER ID FROM MATCH

			if(empty($error)) {
				query("INSERT INTO `lp_tickets` (type, author, target, match, title) VALUES ('".$type."', '".$author."', '".$targetUser."', '".$target."', '".$title."')") or die(mysqli_error($connect));
				$ticket_id = mysqli_insert_id($connect);
				query("INSERT INTO `lp_tickets_messages` (ticket, user, `date`, message) VALUES ('".$ticket_id."', '".$author."', '".$date."', '".$message."')") or die(mysqli_error($connect));
			}
		} else if($type == $__ticketType['supportTournament']) {
			if(strlen($title) > 32)
				$error[] = "Incorrectly ticket values.";

			if(empty($error)) {
				query("INSERT INTO `lp_tickets` (type, author, title) VALUES ('".$type."', '".$author."', '".$title."')") or die(mysqli_error($connect));
				$ticket_id = mysqli_insert_id($connect);
				query("INSERT INTO `lp_tickets_messages` (ticket, user, `date`, message) VALUES ('".$ticket_id."', '".$author."', '".$date."', '".$message."')") or die(mysqli_error($connect));
			}
		} else if($type == $__ticketType['supportTournamentMatch']) {
			if(empty($target) || !is_numeric($target) || strlen($title) > 32)
				$error[] = "Incorrectly ticket values.";

				//$targetUser = ;				// GET TARGET USER ID FROM MATCH

			if(empty($error)) {
				query("INSERT INTO `lp_tickets` (type, author, target, match, title) VALUES ('".$type."', '".$author."', '".$targetUser."', '".$target."', '".$title."')") or die(mysqli_error($connect));
				$ticket_id = mysqli_insert_id($connect);
				query("INSERT INTO `lp_tickets_messages` (ticket, user, `date`, message) VALUES ('".$ticket_id."', '".$author."', '".$date."', '".$message."')") or die(mysqli_error($connect));
			}
		} else {
			$error[] = "Incorrectly ticket type.";
		}
	} 

	if(!empty($error)) {
		echo "<div class='alert alert-error'><div class='alert-title'><i class='fa fa-exclamation-circle fa-lg'></i> Error!</div> Errors occurred:<br>";
		foreach($error as $e)
			echo "&bull; ".$e."<br>";
		echo "</div>";
	}
}