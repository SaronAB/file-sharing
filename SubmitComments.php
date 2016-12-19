<!doctype html>

<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="InnerPages.css">
    <title>Replied</title>
</head>
<body>    
<?php
session_start();
require 'database.php';

$target_post =(int) $_GET['currPID'];
$currComment =(string) $_GET['commentInput'];

$stmt = $mysqli->prepare("insert into comments (user_id, post_id, response) values(?, ?, ?)");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('iis', $_SESSION['user_id'], $target_post, $currComment);
$stmt->execute();
$stmt->close();

?>

<form action="Replied.php" method="GET">
    <input type="hidden" name="currPID" value="<?php echo htmlentities($target_post); ?>" />
    <input type="submit" value="Confirm Submission" />
</form>

</body>
</html>