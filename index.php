<?php
require 'config.php';
include 'overall/header.php';

date_default_timezone_set('Europe/Warsaw');

$app = @$_GET['app'];
$module = @$_GET['module'];
$section = @$_GET['section'];

if(empty($app)) $app = 'main';
if(empty($module)) $module = 'main';
if(empty($section)) $section = 'index';

$path = 'source'."/".$app."/".$module."/".$section.".php";

if($app == "admin") {
	if(!isset($user['uid']) || $user['perms'] < $__perms['admin']) {
		alert("error", "You don't have permission to access this page.");
		include 'overall/footer.php';
		die();
	}
}

/*if($app == "user" && $module != "session") {
	if(!isset($user['uid'])) {
		header("Location: index.php?app=user&module=session&section=login");
	}
}*/

if(file_exists($path)) {
	if(isset($user['uid']) && $user['perms'] >= $__perms['admin'] && $app == "admin")
		include 'source/admin/main/admin-menu.php';

	include($path);

	if(isset($user['uid']) && $user['perms'] >= $__perms['admin'] && $app == "admin")
		include 'source/admin/main/admin-footer.php';
} else
	alert("warning", "Page doesn't exist!");

include 'overall/footer.php';