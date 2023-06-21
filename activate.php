<!DOCTYPE html> 
<html> 
<head>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
   
  <title>Activate</title>    
</head> 
<body>
<?php
include 'db.inc.php'; //first we need a db
//this time no session, cause you don't need that session here. (and cause i stole my code from my forgot password script)
 
if(!isset($_GET['userid']) || !isset($_GET['code'])) { //if theres a code or userid missing, say so & die 
 die('<div class="alert alert-warning" role="alert">No code delivered. nothing to do here.</div>');
}
 
$userid = $_GET['userid']; //storing the userid & code provided in variables
$code = $_GET['code'];
 

$statement = $pdo->prepare("SELECT * FROM users WHERE id = :userid");
$result = $statement->execute(array('userid' => $userid));
$user = $statement->fetch();
 
//check if theres a code for the user delivered
if($user === null || $user['activationcode'] === null) {
 die('<div class="alert alert-danger" role="alert">
 No User matching your request.</div>');
}
 //check if the 24h window is still open for this code
if($user['activationcode_time'] === null || strtotime($user['activationcode_time']) < (time()-24*3600) ) {
 die('<div class="alert alert-danger" role="alert">
 Ooops. This code isnt valid anymore.</div>');
}
 
 
//check if the codes match
if(sha1($code) != $user['activationcode']) {
 die('<div class="alert alert-danger" role="alert">
 Not the valid activationcode!</div>');
}
 //activate user:
if(isset($_GET['send'])) {
  $statement = $pdo->prepare("UPDATE users SET activated = 1, activationcode = NULL, activationcode_time = NULL WHERE id = :userid");
 $result = $statement->execute(array('userid'=> $userid ));
 
 if($result) { //if successfull: die & go to start.php via update.php
 die('Activated. Going to <a href="start.php">start</a> now.<meta http-equiv="refresh" content="1; URL=update.php?page=start.php">');
 }
}
?>
  <script src="ressources/js/bootstrap.min.js"></script>
<h1>Activate your user</h1>
<form action="?send=1&amp;userid=<?php echo htmlentities($userid); ?>&amp;code=<?php echo htmlentities($code); ?>" method="post">
<div class="form-group">
 <button type="submit" class="btn btn-success">Activate</button>
</form>