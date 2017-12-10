<?php
$_profileid = (isset($_GET['uid']) && is_numeric($_GET['uid']))? vtxt($_GET['uid']) : $user['uid'];
$_profile = getUser($_profileid);

?>

<div class="panel">
	<div class="panel-head">
		<?php echo getUserNickname($_profileid); ?> <small>#<?php echo $_profileid; ?></small>
	</div>
	<div class="panel-body">
		<div class="panel panel-body">
			<div class="profile-avatar-box">
				<img src="images/avatar.png" alt="avatar" class="profile-avatar">
			</div>
			<div class="profile-informations-box">
				Nickname: <?php echo getUserNickname($_profileid); ?><br>
				Ranking: #...<br>
				Level: <span class="profile-level"><?php echo $_profile['level']; ?><img src="images/level.png" alt="level" class="profile-level-image"></span>
			</div>
			<div class="profile-buttons-box">
				<?php if($_profileid == $user['uid']) { ?>
					<ul class="profile-buttons">
						<li><a href="" class="btn btn-small">Settings</a></li>
					</ul>
				<?php } else { ?>
					<ul class="profile-buttons">
						<li><a href="index.php?app=user&module=tickets&section=new&type=<?php echo $__ticketType['reportUser']; ?>&id=<?php echo $_profileid; ?>" class="btn btn-small">Report Profile</a><br></li>
						<li><a href="" class="btn btn-small">Add Friend</a></li>
						<li><a href="index.php?app=user&module=messages&section=new&id=<?php echo $_profileid; ?>" class="btn btn-small">Send Message</a></li>
					</ul>
				<?php } ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="panel">
			<div class="panel-head">
				Last matches
			</div>
			<div class="panel-body">
				test
			</div>
		</div>
	</div>
</div>