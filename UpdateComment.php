<?php
session_start();
require 'database.php';

$currComment = (string) $_POST['editedComment'];
$currCID = (int) $_POST['commentID'];
$stmt=$mysqli->prepare("update comments set response=? where comment_id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('si', $currComment, $currCID);
$stmt->execute();
$stmt->close();
header ("Location: Updated.html");
exit;
?>