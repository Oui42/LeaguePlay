<?php
$new_tickets = 0;
$sql = "SELECT * FROM `lp_tickets` WHERE `status` = '".$__ticketStatus['new']."'";
$query = query($sql);
if(mysqli_num_rows($query) > 0) {
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$new_tickets = mysqli_num_rows(query("SELECT `ticket_id` FROM `lp_tickets` WHERE `status` = '".$__ticketStatus['new']."'"));
	}
}
?>

<div class="admin-menu">
	<ul>
		<li class="<?php echo ($_GET['module'] == "main" && $_GET['section'] == "dashboard")? "admin-menu-btn-active" : "admin-menu-btn"; ?>"><a href="index.php?app=admin"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
		<li class="<?php echo ($_GET['module'] == "main" && $_GET['section'] == "statistics")? "admin-menu-btn-active" : "admin-menu-btn"; ?>"><a href="index.php?app=admin&module=main&section=statistics"><i class="fa fa-fw fa-bar-chart"></i> Statistics</a></li>
		<li class="admin-menu-separator"><i class="fa fa-globe"></i> General</li>
		<li class="<?php echo ($_GET['module'] == "main" && $_GET['section'] == "settings")? "admin-menu-btn-active" : "admin-menu-btn"; ?>"><a href="index.php?app=admin&module=main&section=settings"><i class="fa fa-fw fa-wrench"></i> Settings</a></li>
		<li class="<?php echo ($_GET['module'] == "tickets" && $_GET['section'] == "list")? "admin-menu-btn-active" : "admin-menu-btn"; ?>"><a href="index.php?app=admin&module=tickets"><i class="fa fa-fw fa-life-ring"></i> Tickets
			<?php if(!empty($new_tickets)) echo '<span class="new-sign">'.$new_tickets.'</span>'; ?></a></li>
		<li class="<?php echo ($_GET['module'] == "main" && $_GET['section'] == "informations")? "admin-menu-btn-active" : "admin-menu-btn"; ?>"><a href="index.php?app=admin&module=main&section=informations"><i class="fa fa-fw fa-bullhorn"></i> Informations</a></li>
		<li class="<?php echo ($_GET['module'] == "main" && $_GET['section'] == "rules")? "admin-menu-btn-active" : "admin-menu-btn"; ?>"><a href="index.php?app=admin&module=main&section=rules"><i class="fa fa-fw fa-file-text-o"></i> Rules</a></li>
		<li class="<?php echo ($_GET['module'] == "main" && $_GET['section'] == "faq")? "admin-menu-btn-active" : "admin-menu-btn"; ?>"><a href="index.php?app=admin&module=main&section=faq"><i class="fa fa-fw fa-question"></i> FAQ</a></li>
		<li class="admin-menu-separator"><i class="fa fa-home"></i> News</li>
		<li class="<?php echo ($_GET['module'] == "news" && $_GET['section'] == "new")? "admin-menu-btn-active" : "admin-menu-btn"; ?>"><a href="index.php?app=admin&module=news&section=new"><i class="fa fa-fw fa-plus"></i> Create New</a></li>
		<li class="<?php echo ($_GET['module'] == "news" && $_GET['section'] == "list")? "admin-menu-btn-active" : "admin-menu-btn"; ?>"><a href="index.php?app=admin&module=news"><i class="fa fa-fw fa-list"></i> List</a></li>
		<li class="admin-menu-separator"><i class="fa fa-user"></i> Users</li>
		<li class="<?php echo ($_GET['module'] == "users" && $_GET['section'] == "list")? "admin-menu-btn-active" : "admin-menu-btn"; ?>"><a href="index.php?app=admin&module=users"><i class="fa fa-fw fa-list"></i> List</a></li>
		<li class="admin-menu-separator"><i class="fa fa-users"></i> Teams</li>
		<li class="admin-menu-btn"><a href=""><i class="fa fa-fw fa-list"></i> List</a></li>
		<li class="admin-menu-separator"><i class="fa fa-diamond"></i> Tournaments</li>
		<li class="<?php echo ($_GET['module'] == "tournaments" && $_GET['section'] == "new")? "admin-menu-btn-active" : "admin-menu-btn"; ?>"><a href="index.php?app=admin&module=tournaments&section=new"><i class="fa fa-fw fa-plus"></i> Create New</a></li>
		<li class="<?php echo ($_GET['module'] == "tournaments" && $_GET['section'] == "list")? "admin-menu-btn-active" : "admin-menu-btn"; ?>"><a href="index.php?app=admin&module=tournaments"><i class="fa fa-fw fa-list"></i> List</a></li>
		<li class="admin-menu-separator"><i class="fa fa-tint"></i> Matches</li>
		<li class="admin-menu-btn"><a href=""><i class="fa fa-fw fa-plus"></i> List</a></li>
	</ul>
</div>
<div class="admin-content">