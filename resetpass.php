<!DOCTYPE html> 
<html> 
<head>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
   
  <title>Reset Password</title>    
</head> 
<body>
<?php
include 'db.inc.php';
 
/*
more or less the same as activate.php

but some minor differences, find the documentation over there

*/
if(!isset($_GET['userid']) || !isset($_GET['code'])) {
 die('<div class="alert alert-warning" role="alert">No code delivered. nothing to do here.</div>');
}
 
$userid = $_GET['userid'];
$code = $_GET['code'];
 

$statement = $pdo->prepare("SELECT * FROM users WHERE id = :userid");
$result = $statement->execute(array('userid' => $userid));
$user = $statement->fetch();
 
//check if theres a code for the user delivered
if($user === null || $user['passwordcode'] === null) {
 die('<div class="alert alert-danger" role="alert">
 No User matching your request.</div>');
}
 
if($user['passwordcode_time'] === null || strtotime($user['passwordcode_time']) < (time()-24*3600) ) {
 die('<div class="alert alert-danger" role="alert">
 Ooops. This code isnt valid anymore.</div>');
}
 
 

if(sha1($code) != $user['passwordcode']) {
 die('<div class="alert alert-danger" role="alert">
 Thats not your code. Naughty user!</div>');
}
 

 
if(isset($_GET['send'])) {
 $password = $_POST['password'];
 $password_confirm = $_POST['password_confirm']; //we need to do the whole "is your password secure enough" thingy again here:
  //regexes for passvalidation:
    $REuppercase = preg_match('@[A-Z]@', $password);
    $RElowercase = preg_match('@[a-z]@', $password);
    $REnumber    = preg_match('@[0-9]@', $password);
    $REspecialChars = preg_match('@[^\w]@', $password);
 if($password != $password_confirm) {
 echo "password or confirmed password wrong";
 }
 if(!$REuppercase || !$RElowercase || !$REnumber || !$REspecialChars || strlen($password) < 8) {
    echo '<color="red">Password needs to be more complex.</color><br />';
    echo '<i>Please implement at least 8 chars, upper & downer caser, one number & one special char.</i><br />';
    $error = true;
}  else { 
 $passwordhash = password_hash($password, PASSWORD_DEFAULT);
 $statement = $pdo->prepare("UPDATE users SET password = :passwordhash, passwordcode = NULL, passwordcode_time = NULL WHERE id = :userid");
 $result = $statement->execute(array('passwordhash' => $passwordhash, 'userid'=> $userid ));
 //done. the rest is the same
 if($result) {
 die('Changed password. Going to <a href="login.php">login</a> now.<meta http-equiv="refresh" content="1; URL=login.php">');
 }
 }
}
?>
  <script src="ressources/js/bootstrap.min.js"></script>
<h1>Set new password</h1>
<form action="?send=1&amp;userid=<?php echo htmlentities($userid); ?>&amp;code=<?php echo htmlentities($code); ?>" method="post">
<div class="form-group">
<label for="password">New Password</label>
<input type="password" id="password" class="form-control" name="password"><br><br>
 </div>
 <div class=form-group>
 <label for="password_confirm">Confirm new Password</label>
<input type="password" id="password" class="form-control" name="password_confirm"><br><br>
 </div>
 <button type="submit" class="btn btn-primary">Submit new password</button>
</form>