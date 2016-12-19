<!doctype html>

<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="InnerPages.css">
    <title>News Feed</title>
</head>
<body>     
<?php
	session_start();
	require 'database.php';
	
	//get the username and display a welcome message
	$stmt = $mysqli->prepare("select username from users where user_id=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->bind_param('i', $_SESSION['user_id']);
	$stmt->execute();
	$stmt-> bind_result($username);
	$stmt->fetch();
	$stmt->close();
			
	echo "<br> Welcome to Voxpopuli " . htmlentities($username) . "!";
	
		
	 
	$stmt = $mysqli->prepare("select post_id, header, postTime from posts order by header");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	 
	$stmt->execute();
	 
	$result = $stmt->get_result();
		 
	echo "<ul>\n";
		
	//diplays the story headers along with a View and Comments option
	echo "Articles to Read: <br><br>";
	while($row = $result->fetch_assoc()){
			echo ("&nbsp;".htmlentities($row['header'])."&nbsp; <br>"."&nbsp; posted on ".htmlentities($row['postTime']) . "&nbsp;");
			$hname=$row['header'];
			$hid=$row['post_id'];
			
			echo "<a href=\"ViewStory.php?currPID=$hid\">View</a> &nbsp;";
			echo "<a href=\"ViewComments.php?currPID=$hid\">Comments</a> &nbsp; <br>";
				
			if(isset($_SESSION['user_id'])){
				$stmt2 = $mysqli->prepare("select user_id from posts where header=?");
				if(!$stmt2){
					printf("Query Prep Failed: %s\n", $mysqli->error);
					exit;
				}
				$stmt2->bind_param('s', $hname);
				$stmt2->execute();
				$stmt2-> bind_result($userID);
				$stmt2->fetch();
				$stmt2->close();
					
				//if the user_id matches with that associated with a story,
				//	there are also edit and delete options
				
				if($userID == $_SESSION['user_id']){
					echo "&nbsp; <a href=\"DeleteStory.php?currPID=$hid\">Delete</a> &nbsp;";
					echo "<a href=\"EditStory.php?currPID=$hid\">Edit</a> &nbsp; <br>";
				}
					
				$stmt2->close();					
			}
		
	}
	
	echo "\n";
	$stmt->close();
	
	if(isset($_SESSION['user_id'])){
		echo "<form action='SubmitStory.php' method='POST'>
				<label> <br><br> Write a Story Commentary: <br></label>
				<p><label> Title: <input type='text' name='headerInput' /></label></p>
				<p><label> Link (optional): <input type='text' name='linkInput' /><label></p>
				<label> Story: <br><br> <textarea name='postInput' style='width:500px;height:600px;'></textarea></label><br>
				<input type='submit' value='Submit' />
				</form><br>
			
				<form action='LogoutPage.php' method='post'>
				<input type='submit' value='LogOut'>
				</form><br>
				
				<form action='DeleteConfirmation.html' method='post'>
				<input type='submit' value='Delete Account'>
				</form>";		
	
	}else{
		echo "<form action='LoginPage.html' method='POST'>
			<input type='submit' value='Log In or Sign Up' />
			</form>";
	}
				
	?>

	
</body>
</html>
