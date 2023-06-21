<!DOCTYPE html> 
<html> 
<head>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
   
  <title>Activate User</title>    
</head> 
<body>
<?php 
session_start(); //session & stuff, you know it
include 'db.inc.php'; //and a db connection, you know it...
 
function random_string() { //first we need a function, lets call it "random_string, shall we?
 if(function_exists('random_bytes')) { //then check if other functions exist to create random chars
 $bytes = random_bytes(16);
 $str = bin2hex($bytes); 
 } else if(function_exists('openssl_random_pseudo_bytes')) {
 $bytes = openssl_random_pseudo_bytes(16);
 $str = bin2hex($bytes); 
 } else if(function_exists('mcrypt_create_iv')) {
 $bytes = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
 $str = bin2hex($bytes); 
 } else { //failing to this string:
//this should be a unique string. if we use this in prod we should change this.
 $str = md5(uniqid('thisisnotreallyrandombutthisstringheresomakethislongandmaybewith12345numberskthxbye', true));
 } 
 return $str; //returning the string generated with one or another method
}
 
$sessionuser = $_SESSION['username']; //get the usernamne from the session
$showForm = true; //print the "form" (in this case just a button)
 
if(isset($_GET['send']) ) { //you know the drill. if theres a "?=send=1" this little script comes to action
 if(!isset($sessionuser) || empty($sessionuser)) { //checks if you've got a valid session if not, it prints it out.
 $error = '<span class="badge badge-pill badge-danger"><b>No Valid User in Session. Please Login Again!</b></span>';
 } else { //if theres a valid session do this:
 $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username"); //sql statement username = $sessionuser
 $result = $statement->execute(array('username' => $sessionuser));
 $user = $statement->fetch(); 
 
 if($user === false) { //in some cases users have a valid session, but the account was deleted in the background, this has that case covered: 
    $error = '<span class="badge badge-pill badge-warning"><b>no user found</b></span>';
 }
 if($user['username'] == ""){ //if you've managed to create a user without username, print an error.
    $error = '<span class="badge badge-pill badge-warning"><b>no user found</b></span>';
 }
 if($user['activated'] == "1"){ //if your account is already activated:
     $error = '<span class="badge badge-pill badge-warning"><b>user already activated!</b></span>';
 } else {
 $activationcode = random_string(); //store a random string in this variable
 $statement = $pdo->prepare("UPDATE users SET activationcode = :activationcode, activationcode_time = NOW() WHERE id = :userid"); //prepare the statement
 $result = $statement->execute(array('activationcode' => sha1($activationcode), 'userid' => $user['id'])); //activationcode in db is sha1 of real activationcode
 //now lets compose a mail:
 $mailrcpt = $user['email'];  //mail goes to user that should be validated.
 $mailsubject = "Activate the Account of ".$user['username']; //the subject
 $from = "From: Account Activation Service <activatemyaccount@".$_SERVER['HTTP_HOST'].">"; //send mail from "activatemyaccount@%urlyourusingtoaccessthisscript%"
 $url_activationcode = 'https://'.$_SERVER['HTTP_HOST'].'/activate.php?userid='.$user['id'].'&code='.$activationcode; //url for activation is https://%urlyourusingtoaccessthisscript%/activate.php?userid=$userid&code=$activationcode
 //thats the content of the mail:
 $text = 'Hallo '.$user['username'].', 
please use the following URL to activate your account in the next 24h:
'.$url_activationcode.'
 
If this mail comes unsolicited, please just ignore the mail.
 
cheers
loginpagefoo script';
 mail($mailrcpt, $mailsubject, $text, $from); //sending the mail with the build-in mail function.
 
 echo 'Link send. Going back to <a href="profile.php">profile</a> page. <meta http-equiv="refresh" content="0; URL=profile.php">'; 
 //afterwards going back to profile, and dont render the form again.
 $showForm = false;
 }
 }
}
 
if($showForm): //you guessed it: html & the form:
?>
 
<h1>Activate user</h1>
 
<?php
if(isset($error) && !empty($error)) {
 echo $error;
}
?>
 <script src="ressources/js/bootstrap.min.js"></script>
<form action="?send=1" method="post">
<button type="submit" class="btn btn-primary">Click to send activation notice</button>
</form>
 
<?php
endif; //thats all
?>