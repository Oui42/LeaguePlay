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
	return mysqli_fetch_assoc(mysqli_query($connect, $query)); 
}

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