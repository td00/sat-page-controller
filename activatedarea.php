
<html>
<head>
<title>Activated Area</title>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<script src="ressources/js/bootstrap.min.js"></script>
<?php
session_start(); //check for a session
if($_SESSION['activated'] == 0) { //check if the account is activated, if not, die with an error
    die ("Not activated yet");
}
echo "heres the fun world"; //just a placeholder
?>
<br /> <br />
<div class="jumbotron jumbotron-fluid">
  <div class="container">
<?php
echo "Hi ".$_SESSION['username']."!";
if(isset($_GET['notimplemented'])) { //if "?notimplemented=1" is received, print the following error code:
    echo '<div class="alert alert-danger" role="alert">Feature not yet implemented!</div>';
}
//some html links to other pages
?>
<br /><br />
<a href="changeprofilepicture.php"><button class="btn btn-primary">Change Profile Picture</button>
<br /><br />
<a href="?notimplemented=1"><button class="btn btn-primary disabled">Change Description</button></a>
<br /> <br /><br />
<a href="start.php"><button class="btn btn-info">Back</button></a>
</div>
</div>