<?php
session_start();
require 'database.php';
$headers = $_POST['headerInput'];
$stories = $_POST['postInput'];
$link = $_POST['linkInput'];

$stmt = $mysqli->prepare("insert into posts (user_id, story, header, links) values(?, ?, ?, ?)");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('isss', $_SESSION['user_id'], $stories, $headers, $link);
$stmt->execute();
$stmt->close();

header ("location: Submitted.html");
exit;

?>