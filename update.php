<?php
/*
This is just a little helper script if you dont want to include a whole backgroundupdate in the page, but after the action you want to go over the update path.

example: update.php?page=start.php does an update of your session and then redirects you directly to start.php
*/
include 'backgroundupdate.php'; //getting the real update script in the background
echo "freshly updated the session data<br />"; //printing a short message
if(isset($_GET['page'])) { //checks if "?page=" is set in the url
    echo "Going to ".$_GET['page']; //printing the next hop
    echo '<meta http-equiv="refresh" content="0; URL='.$_GET['page'].'">'; //going to the page specified in the url.
} else { //if there isn't anything in the header, just die already!
    die(); 
}
?>