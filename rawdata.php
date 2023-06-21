<?php
//this just prints Session data line for line. Its just a quick page to check if everythings in place
session_start();
echo "userid:";
echo $_SESSION['userid'];
echo "<br />";
echo "username:";
echo $_SESSION['username'];
echo "<br />";
echo "email:";
echo $_SESSION['email'];
echo "<br />";
echo "givenname:";
echo $_SESSION['givenName'];
echo "<br />";
echo "lastname:";
echo $_SESSION['lastName'];
echo "<br />";
echo "activated:";
echo $_SESSION['activated'];
echo "<br />";
echo "last updated:";
echo $_SESSION['updated_at'];
echo "<br />";
echo "isadmin:";
echo $_SESSION['isadmin'];

?>