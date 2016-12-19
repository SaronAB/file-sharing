<?php
session_start();
require 'database.php';

$target_post=(int) $_GET['currPID']; 

$stmt=$mysqli->prepare("delete from comments where post_id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('i', $target_post);
$stmt->execute();
$stmt->close();

$stmt=$mysqli->prepare("delete from posts where post_id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('i', $target_post);
$stmt->execute();
$stmt->close();

header ("Location: Deleted.html");
exit;
?>