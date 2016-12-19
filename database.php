<?php
$mysqli = new mysqli('localhost', 'voxpopuliadmin', 'voiceofthepeople', 'voxpopuli');
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>