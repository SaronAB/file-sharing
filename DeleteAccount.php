<?php
session_start();
require 'database.php';

$target_user=(int) $_SESSION['user_id']; 

//deletes all of the user's comments
$stmt=$mysqli->prepare("delete from comments where user_id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('i', $target_user);
$stmt->execute();
$stmt->close();


//deletes all of the user's story submissions
$stmt=$mysqli->prepare("delete from posts where user_id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('i', $target_user);
$stmt->execute();
$stmt->close();


//deletes the user's login info
$stmt=$mysqli->prepare("delete from users where user_id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('i', $target_user);
$stmt->execute();
$stmt->close();

header ("Location: LogoutPage.php");
exit;
?>