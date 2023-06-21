<?php
$mysqlhost = 'localhost'; //the db host
$dbname = 'usertable'; //the db name
$dbuser = 'usertable'; //the db user
$dbpass = 'password'; //the db password
$pdo = new PDO('mysql:host='.$mysqlhost.';dbname='.$dbname.'', $dbuser , $dbpass); //building the string
//$pdo = new PDO('mysql:host=localhost;dbname=usertable', 'usertable', 'password');
?>

