<?php
session_start(); //first we need a session to store the data into

include 'db.inc.php'; //and a db connection
$username = $_SESSION['username']; //then we get the username from the session

$statement = $pdo->prepare("SELECT * FROM users WHERE username = :username"); //building a statement & getting the whole line of username = $username
$result = $statement->execute(array('username' => $username));
$user = $statement->fetch(); //putting the stuff in an array and afterwards store it in the session:
$_SESSION['userid'] = $user['id'];
$_SESSION['email'] = $user['email'];
$_SESSION['username'] = $user['username'];
$_SESSION['givenName'] = $user['givenName'];
$_SESSION['lastName'] = $user['lastName'];
$_SESSION['activated'] = $user['activated'];
$_SESSION['updated_at'] = $user['updated_at'];
$_SESSION['isadmin'] = $user['isadmin'];
$_SESSION['profilepicture'] = $user['profilepicture'];
?>