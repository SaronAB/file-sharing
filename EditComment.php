<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="MainPage.css">
    <title>Edit Comment</title>
</head>
<body>


<?php
session_start();
require 'database.php';

$target_comment=(int)$_GET['currCID'];

//selects a story and puts it in a textarea for editing purposes

$stmt=$mysqli->prepare("select response from comments where comment_id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('i', $target_comment);
$stmt->execute();
$stmt-> bind_result($currComment);
$stmt->fetch();
$stmt->close();
?>
<form action="UpdateComment.php" method="POST">
<label> Edit: <textarea name="editedComment" style="width:500px;height:500px;"> <?php echo htmlentities($currComment); ?> </textarea></label>
<input type="hidden" name="commentID" value="<?php echo htmlentities($target_comment); ?>" />
<input type="submit" value="Update" />
</form>

<form action="NewsFeed.php" method="post">
    <input type="submit" value="Cancel" />
</form>

</body>
</html>