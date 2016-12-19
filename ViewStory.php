<!doctype html>

<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="InnerPages.css">
    <title>View Story</title>
</head>
<body>
<?php
    session_start();
    require 'database.php';
    
    $stmt = $mysqli->prepare("select story, links from posts where post_id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $target_post =(int) $_GET['currPID'];
    $stmt->bind_param('i', $target_post); 
    $stmt->execute();
     
    $stmt->bind_result($currStory, $currLink);
    $stmt->fetch();
    
    printf("\t<li>%s %s</li>\n",
		'<a href="'.$currLink.'">' .$currLink. '</a> &nbsp;',
		htmlspecialchars($currStory)
	);
    
    $stmt->close();
?>

<form action="ViewComments.php" method="GET">
	<input type="hidden" name="currPID" value="<?php echo htmlentities($target_post); ?>" />
    <input type="submit" value="Comments" />
</form>

<form action="NewsFeed.php" method="POST">
    <input type="submit" value="Return to NewsFeed" />
</form>

</body>
</html>