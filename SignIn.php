<?php
    session_start();
    require 'database.php';
    $user = (string) $_POST["usernameinput"];
    $password = (string) $_POST["passwordinput"];
    $stmt = $mysqli->prepare("select count(*), user_id, password from users where username=?");
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $stmt->bind_result($cnt, $user_id, $pwd_hash);
    $stmt->fetch();
    $pwd_guess = $password;
    if( $cnt == 1 && crypt($pwd_guess, $pwd_hash)==$pwd_hash){
      $_SESSION['user_id'] = $user_id;
      header ("Location: NewsFeed.php");
      exit;
    }
    else{
     header ("Location: LoginFailure.html");
     exit;
    }
?>