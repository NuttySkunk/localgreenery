<?php
	require_once(dirname(__FILE__) . "/../lib/autoload.php");
	if ($_SESSION['user']['role'] != "ADMIN") {
		header('location:http://arachnias.co.cc/lg/');
	}
?>