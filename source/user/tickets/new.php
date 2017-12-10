<?php
if(checkTicketType($_GET['type']) != true) {
	alert("error", "Incorrectly ticket type.");
	die();
}

$type = (isset($_GET['type']) && is_numeric($_GET['type']))? vtxt($_GET['type']) : "";
$target = (isset($_GET['id']) && is_numeric($_GET['id']))? vtxt($_GET['id']) : "";

$title = (isset($_POST['title']))? vtxt($_POST['title']) : "";
$message = (isset($_POST['message']))? vtxt($_POST['message']) : "";

if(isset($_POST['submit'])) {
	if($type == $__ticketType['reportUser'])
		createTicket($type, $user['uid'], $target, time(), $title, $message);
	if($type == $__ticketType['reportTeam'])
		createTicket($type, $user['uid'], $target, time(), $title, $message);
	if($type == $__ticketType['support'])
		createTicket($type, $user['uid'], null, time(), $title, $message);
	if($type == $__ticketType['supportMatch'])
		createTicket($type, $user['uid'], $target, time(), $title, $message);
	if($type == $__ticketType['supportTournament'])
		createTicket($type, $user['uid'], $target, time(), $title, $message);
	if($type == $__ticketType['supportTournamentMatch']){
		createTicket($type, $user['uid'], $target, time(), $title, $message);
	}

	header("Location: index.php?app=user&module=tickets&section=list");
}
?>

<form method="post" action="" class="panel popup-panel">
	<div class="panel-head">
		Create new ticket
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label for="type">Type</label><br>
			<input id="type" type="text" class="text-center" value="<?php echo getTicketTypeName($type); ?>" disabled>
		</div>
		<?php if($type == $__ticketType['reportUser']) { ?>
			<div class="form-group">
				<label for="target">User ID</label><br>
				<input id="target" class="input-mini20" type="text" name="id" value="<?php echo $target; ?>" disabled>
			</div>
		<?php } ?>
		<?php if($type == $__ticketType['reportTeam']) { ?>
			<div class="form-group">
				<label for="target">Team ID</label><br>
				<input id="target" class="input-mini20" type="text" name="id" value="<?php echo $target; ?>" disabled>
			</div>
		<?php } ?>
		<?php if($type == $__ticketType['supportTournament']) { ?>
			<div class="form-group">
				<label for="target">Tournament ID</label><br>
				<input id="target" class="input-mini20" type="text" name="id" value="<?php echo $target; ?>" disabled>
			</div>
		<?php } ?>
		<?php if($type == $__ticketType['supportMatch'] || $type == $__ticketType['supportTournamentMatch']) { ?>
			<div class="form-group">
				<label for="target">Match ID</label><br>
				<input id="target" class="input-mini20" type="text" name="id" value="<?php echo $target; ?>" disabled>
			</div>
		<?php } ?>
		<div class="form-group">
			<label for="title">Title</label><br>
			<input id="title" type="text" name="title" maxlength="32" placeholder="Type ticket title..." value="<?php echo $title; ?>">
		</div>
		<div class="form-group">
			<label for="message">Message</label><br>
			<textarea id="message" name="message" placeholder="Type your message..."><?php echo $message; ?></textarea>
		</div>
		<button class="btn-active" type="submit" name="submit">
			Send
		</button>
	</div>
</form>