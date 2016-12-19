<?php
session_start();
require 'database.php';

$currStory = (string) $_POST['editedStory'];
$currPID = (int) $_POST['postID'];
$stmt=$mysqli->prepare("update posts set story=? where post_id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('si', $currStory, $currPID);
$stmt->execute();
$stmt->close();
header ("Location: Updated.html");
exit;
?>