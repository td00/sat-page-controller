
<html>
<head>
<title>Admin Area</title>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<script src="ressources/js/bootstrap.min.js"></script>
<?php
session_start();
if($_SESSION['isadmin'] == 0) {
    die ('No rights for you! <meta http-equiv="refresh" content="0; URL=logout.php">');
}
echo '<div class="alert alert-danger" role="alert">heres the admin world</div>';
echo '<a href="adminarea_admins_give.php"><button class="btn btn-success">GIVE</button></a>';
echo '<a href="adminarea_admins_take.php"><button class="btn btn-danger">TAKE</button></a>';
echo "<br />";
echo $output;
echo "<br />";
echo "//implement a user search here."; //yeah! Do what the comment says!
echo '<br />';

$showForm = false;
 
if(isset($_GET['user']) ) {
 if(!isset($_POST['username']) || empty($_POST['username'])) {
 $error = "<b>Enter the username</b>";
 } else {
 $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
 $result = $statement->execute(array('username' => $_POST['username']));
 $user = $statement->fetch(); 
 
 if($user === false) {
 $error = "<b>no user found</b>";
 } else {
    echo $user['isadmin'];
    $showForm = false;

 }
 }
}

if($showForm):
?>
 
<h1>Search for Admin Rights!</h1>
Please enter the username below.<br><br>

<?php
if(isset($error) && !empty($error)) {
 echo $error;
}
?>
 <script src="ressources/js/bootstrap.min.js"></script>
<form action="?user=1" method="post">
<div class="form-group">
<label for="username">Username</label>
<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($_POST['username']) ? htmlentities($_POST['username']) : ''; ?>"><br>
</div>
<button type="submit" class="btn btn-primary">Search User Rights</button>
</form>
 
<?php
endif; 
?>
<?php
echo '<br /> <br />';
echo '<a href="adminarea.php"><button class="btn btn-info">Back</button></a>';
?>
