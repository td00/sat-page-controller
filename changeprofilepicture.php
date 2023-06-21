
<html>
<head>
<title>Activated Area</title>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<script src="ressources/js/bootstrap.min.js"></script>
<?php
session_start();
include 'db.inc.php';
if($_SESSION['activated'] == 0) {
    die ("Not activated yet");
}
echo "heres the fun world";
?>
<?php

//TODO: regex to parse file extensions here:

//function to insert url into table here:
if(isset($_GET['new'])) {
    $imageurl = $_POST['imageurl'];
    $userid = $_SESSION['userid'];
    
    if($imageurl == "https://web.td00.de/woddle.gif") {
        echo "<br> returning to default picture";
        $statement = $pdo->prepare("UPDATE users SET profilepicture = :imageurl WHERE id = :userid");
    $result = $statement->execute(array('imageurl' => $imageurl, 'userid'=> $userid ));
 
    if($result) {
    die('<br>Changed Profile Picture. Going to <a href="update.php?page=profile.php">profile</a> now.<meta http-equiv="refresh" content="1; URL=update.php?page=profile.php">');
    }
}
     else { 
    $statement = $pdo->prepare("UPDATE users SET profilepicture = :imageurl WHERE id = :userid");
    $result = $statement->execute(array('imageurl' => $imageurl, 'userid'=> $userid ));
 
    if($result) {
    die('<br>Changed Profile Picture. Going to <a href="update.php?page=profile.php">profile</a> now.<meta http-equiv="refresh" content="1; URL=update.php?page=profile.php">');
    }
    }
   }

?>
<br /> <br />
<div class="jumbotron jumbotron-fluid">
  <div class="container">
      <i>Right now you need to upload the picture somewhere and input the URL here.</i><br />
      <b>Please be aware that only the following filetypes will work!</b>
      <li>jpg</li>
      <li>gif</li>
      <li>png</li>
      <br /><br /><br />
      <script src="ressources/js/bootstrap.min.js"></script>

<form action="?new=1&amp;userid=<?php echo htmlentities($userid); ?>&amp;code=<?php echo htmlentities($code); ?>" method="post">
<div class="form-group">
<label for="imageurl">URL to new image</label>
<input type="url" pattern="https://.*" id="imageurl" class="form-control" name="imageurl"><br><br>
 </div>

 <button type="submit" class="btn btn-primary">Submit new Image</button>
</form>
<br /> <br /><br />
<a href="activatedarea.php"><button class="btn btn-info">Back</button></a>
</div>
</div>