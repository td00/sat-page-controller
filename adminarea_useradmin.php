
<html>
<head>
<title>Admin Area</title>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<script src="ressources/js/bootstrap.min.js"></script>
<?php
session_start();
include 'backgroundupdate.php';


if($_SESSION['isadmin'] == 0) {
    die ('No rights for you! <meta http-equiv="refresh" content="0; URL=logout.php">');
}

echo '<div class="alert alert-danger" role="alert">heres the admin world</div>';



//create connection
$connection = mysqli_connect($mysqlhost, $dbuser, $dbpass, $dbname);

//test if connection failed
if(mysqli_connect_errno()){
    die("connection failed: "
        . mysqli_connect_error()
        . " (" . mysqli_connect_errno()
        . ")");
}

//get results from database
$result = mysqli_query($connection,"SELECT * FROM users");
$all_property = array();  //declare an array for saving property

//showing property
echo '<table class="table table-striped">
        <tr class="data-heading">';  //initialize table tag
while ($property = mysqli_fetch_field($result)) {
    echo '<td>' . $property->name . '</td>';  //get field name for header
    array_push($all_property, $property->name);  //save those to array
}
echo '</tr>'; //end tr tag

//showing all data
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    foreach ($all_property as $item) {
        echo '<td>' . $row[$item] . '</td>'; //get items using property value
    }
    echo '</tr>';
}
echo "</table>";

echo '<br /> <br />';
echo '<a href="adminarea.php"><button class="btn btn-info">Back</button></a>';
?>
