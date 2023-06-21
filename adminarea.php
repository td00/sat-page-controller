
<html>
<head>
<title>Admin Area</title>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<script src="ressources/js/bootstrap.min.js"></script>
<?php
session_start();
//just a page to list all admin functions:
if($_SESSION['isadmin'] == 0) { //but first a check if you've got admin rights. if not, destroy the session and go back to start.
    die ('No rights for you! <meta http-equiv="refresh" content="0; URL=logout.php">');
} //this is purely a cosmetic effect. no harm could be done from here. it's merely a html page with a little check if you've got the right rights.
echo '<div class="alert alert-danger" role="alert">heres the admin world</div>';

echo '<a href="adminarea_useradmin.php"><button class="btn btn-primary">User Admin</button></a>';
echo '<br /> <br />';
echo '<a href="adminarea_sessions.php"><button class="btn btn-primary">Session Admin</button></a>';
echo '<br /> <br />';
echo '<a href="adminarea_admins.php"><button class="btn btn-danger">Admin Admin</button></a>';
echo '<br /> <br />';
echo '<a href="start.php"><button class="btn btn-info">Back</button></a>';
?>
