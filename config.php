<?php
ob_start();
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$name = "leagueplay";

$connect = new mysqli($host, $user, $pass, $name);

if(mysqli_connect_errno()) {
	die("Database connection failed: ".mysqli_connect_errno());
}

mysqli_set_charset($connect, "utf-8");

require_once('constants.php');
require_once('functions.php');