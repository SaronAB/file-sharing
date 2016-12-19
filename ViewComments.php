<!doctype html>

<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="InnerPages.css">
    <title>View Comments</title>
</head>
<body>
<p><form action="NewsFeed.php" method="POST">
    <input type="submit" value="Return to NewsFeed" />
</form></p>

<?php
 session_start();
    require 'database.php';
    
    $stmt = $mysqli->prepare("select user_id, comment_id, response, postTime from comments where post_id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $target_post =(int) $_GET['currPID'];    //current post_id
    $stmt->bind_param('i', $target_post); 
    $stmt->execute();
     
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc()){
			echo (htmlentities($row['user_id']). "&nbsp;&nbsp;&nbsp;&nbsp;" . htmlentities($row['response'])."&nbsp; <br>"."posted on ".htmlentities($row['postTime'])." <br>");
            $cid = $row['comment_id'];
            if(isset($_SESSION['user_id'])){
								
				//if the user_id matches with that associated with a story,
				//	there are also edit and delete options
				
				if($row['user_id'] == $_SESSION['user_id']){
					echo "&nbsp;&nbsp;&nbsp;&nbsp; <a href=\"DeleteComment.php?currCID=$cid\">Delete</a> &nbsp;";
					echo "<a href=\"EditComment.php?currCID=$cid\">Edit</a> &nbsp; <br><br>";
				}
										
			}
		
    }
    
    $stmt->close();
    if(!isset($_SESSION['user_id'])){
        exit;
    }
?>

<form action="SubmitComments.php" method="GET">
    <label> Reply: <textarea name="commentInput" style="width:400px;height:300px;"></textarea></label>
    <input type="hidden" name="currPID" value="<?php echo htmlentities($target_post); ?>" />
     <input type="submit" value="Reply" />
</form>

<p><form action="NewsFeed.php" method="POST">
    <input type="submit" value="Return to NewsFeed" />
</form></p>

</body>
</html>