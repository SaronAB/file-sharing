
<?php
require 'database.php';
 //session_start();
    $user = (string) $_POST["newusername"];
    $password1 = (string) $_POST["newpassword1"];
    $password2 = (string) $_POST["newpassword2"];
   if (strcmp($password1, $password2) !== 0){
        header ("Location: Non-identicalPasswords.html");
        exit;
    }
    
    $stmt = $mysqli->prepare("select count(*) from users where username=?");
    if(!$stmt){
	echo "error1";
    	printf("Query Prep Failed: %s\n", $mysqli->error);
    	exit;
    }
    
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $stmt-> bind_result($cnt);
    $stmt->fetch();
    
    echo "cnt: " . $cnt . "\n";
    
    if ($cnt !== 0){
        header ("Location: DuplicateUsername.html");
        exit;
    }
    $stmt->close();
   
    $cryptedpassword = crypt($password1);
    $stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)");
	echo "user: ". $user . "passowrd: ". $cryptedpassword;    
	if(!$stmt){
	echo "error2";
        printf("Query Prep Failed: %s/n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('ss', $user, $cryptedpassword);
    $stmt->execute();
    $stmt->close();
    header("Location: NewUserSuccess.html");
?>