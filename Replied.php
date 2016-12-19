<!doctype html>

<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="InnerPages.css">
    <title>Replied</title>
</head>
<body>
    Response submitted successfuly!
    <?php
    $target_post=$_GET['currPID'];
    ?>
    <form action="ViewComments.php" method="GET">
        <input type="hidden" name="currPID" value="<?php echo htmlentities($target_post); ?>" />
        <input type="submit" value="Return to Comments" />
    </form>
    
    <form action="NewsFeed.php" method="POST">
        <input type="submit" value="Return to NewsFeed" />
    </form>
</body>
</html>
