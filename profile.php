
<?php
session_start(); //start a session
if(!isset($_SESSION['userid'])) { //if there isnt a session print a please login page and go to login page
    die('<div class="alert alert-primary" role="alert">Please <a href="login.php">login</a></div><meta http-equiv="refresh" content="2; URL=login.php">');
}
 //for easier use we shove some of the session array into variables.
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$useremail = $_SESSION['email'];
$usergn = $_SESSION['givenName'];
$userln = $_SESSION['lastName'];
$activated = $_SESSION['activated'];
$isadmin = $_SESSION['isadmin'];
$profilepicture = $_SESSION['profilepicture'];

//lets build a page:
?>
<html>
<head>
<title>Profile Page</title>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<script src="ressources/js/bootstrap.min.js"></script>
<div class="float-right">
    <br />
    <br />
    <?php
    echo '<img src="'.$profilepicture.'" height=90 width=90 />';
    
    ?>
</div>


<?php

 //print a info bar with the username
echo '<div class="alert alert-info" role="alert">Profile of '.$username.'</div>';
echo "<br/>";
//lets build a table with infos:
echo '<table class="table table-dark table-striped" style="width:30%">';
echo "<tr>";
echo "<td>";
echo "Username";
echo "</td>";
echo "<td>";
echo $username;
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "User-ID";
echo "</td>";
echo "<td>";
echo $userid;
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "given Name";
echo "</td>";
echo "<td>";
echo $usergn;
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "lastName";
echo "</td>";
echo "<td>";
echo $userln;
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "E-Mail";
echo "</td>";
echo "<td>";
echo $useremail;
echo "</td>";
echo "</tr>";
?>
</table>
<br /> <br /><br />
<table class="table table-dark table-striped" style="width:30%">
<?php
//another table just for "activated" & "isadmin"
echo "<tr>";
echo "<td>";
echo "User Status:";
echo "</td>";
echo "<td>";
if ($activated == 0) { //if not activated print it in red and render a activation link
    echo '<p class="text-danger">Not Activated!</p><br>';
    echo 'Click <a href="activation.php">here</a> to activate';
}
if ($activated == 1) { //if activated print so, but in green
    echo '<p class="text-success">Activated!</p>';
}
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "User Level:";
echo "</td>";
echo "<td>";
if ($isadmin == 0) { //if not admin, print "User" in green
    echo '<p class="text-success">User</p><br>';
}
if ($isadmin == 1) { //if admin, print so but in red
    echo '<p class="text-danger">Admin</p>';
}
echo "</td>";
echo "</tr>";
//some html:
?>

</table>
<br>
<br/>
<br>
<a href="start.php"><button class="btn btn-info">Back</button></a>
<br/>
<br>
<!--<a href="rawdata.php"><button class="btn btn-black">Raw Data</button></a>-->
<br/>

<br/>

<a href="logout.php"><button class="btn btn-danger">LOGOUT</button></a>
</body>
</html>
