<?php
session_start();
require 'database.php';

$target_comment=(int) $_GET['currCID']; 

$stmt=$mysqli->prepare("delete from comments where comment_id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('i', $target_comment);
$stmt->execute();
$stmt->close();

header ("Location: Deleted.html");
exit;
?>