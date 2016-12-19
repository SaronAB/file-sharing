<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="MainPage.css">
    <title>Vox Populi</title>
</head>
<body>


<?php
session_start();
require 'database.php';

$target_post=(int)$_GET['currPID'];

//selects a story and puts it in a textarea for editing purposes

$stmt=$mysqli->prepare("select story from posts where post_id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('i', $target_post);
$stmt->execute();
$stmt-> bind_result($currStory);
$stmt->fetch();
$stmt->close();
?>
<form action="UpdateStory.php" method="POST">
<label> Edit: <textarea name="editedStory" style="width:500px;height:500px;"> <?php echo htmlentities($currStory); ?> </textarea></label>
<input type="hidden" name="postID" value="<?php echo htmlentities($target_post); ?>" />
<input type="submit" value="Update" />
</form>

<form action="NewsFeed.php" method="post">
    <input type="submit" value="Cancel" />
</form>

</body>
</html>