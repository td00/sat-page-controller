
<?php 
echo "not implemented yet!";
   /*
   session_start();
include 'db.inc.php';
 
if(isset($_GET['changed'])) {
    $username = $_POST['username'];
    $oldpassword = $_POST['oldpassword'];
    $password = $_POST('password');
    $password_confirm = $_POST('password_confirm');
    
    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $result = $statement->execute(array('username' => $username));
    $user = $statement->fetch();
     
    if ($user !== false && password_verify($oldpassword, $user['password'])) {
        if(isset($_GET['send'])) {
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
             //regexes for passvalidation:
               $REuppercase = preg_match('@[A-Z]@', $password);
               $RElowercase = preg_match('@[a-z]@', $password);
               $REnumber    = preg_match('@[0-9]@', $password);
               $REspecialChars = preg_match('@[^\w]@', $password);
            if($password != $password_confirm) {
            echo "password or confirmed password wrong";
            }
            if(!$REuppercase || !$RElowercase || !$REnumber || !$REspecialChars || strlen($password) < 8) {
               echo '<color="red">Password needs to be more complex.</color><br />';
               echo '<i>Please implement at least 8 chars, upper & downer caser, one number & one special char.</i><br />';
               $error = true;
           }  else { 
            $passwordhash = password_hash($password, PASSWORD_DEFAULT);
            $statement = $pdo->prepare("UPDATE users SET password = :passwordhash, passwordcode = NULL, passwordcode_time = NULL WHERE id = :userid");
            $result = $statement->execute(array('passwordhash' => $passwordhash, 'userid'=> $userid ));
            
            if($result) {
            die('Changed password. Going to <a href="start.php">start</a> now.<meta http-equiv="refresh" content="1; URL=start.php">');
            }
            }
           }
        die('<div class="alert alert-success" role="alert"> successfull. go to: <a href="start.php">start page</a></div> <meta http-equiv="refresh" content="0; URL=start.php">');
    } else {
        $errorMessage = '<div class="alert alert-danger" role="alert">somethings wrong (maybe wrong password or wrong user)</div><br>';
    }
    
}

?>
<!DOCTYPE html> 
<html> 
<head>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
   
  <title>Change Password</title>    
</head> 
<body>
 
<?php 
if(isset($errorMessage)) {
    echo $errorMessage;
}

?>
 <script src="ressources/js/bootstrap.min.js"></script>
 <div class="jumbotron jumbotron-fluid">
  <div class="container">

<form action="?changed=1" method="post">
<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" size="40" id="username" placeholder="Username" name="username"><br><br>
</div>
 <div class="form-group">
<label for="oldpassword">Current Password</label>
<input type="password" class="form-control" size="40" id="oldpassword" placeholder="Your old password" name="oldpassword"><br>
 </div>
 <div class="form-group">
<label for="password">New Password</label>
<input type="password" class="form-control" size="40" id="password" placeholder="Your new password" name="password"><br>
 </div>
 <div class="form-group">
<label for="password_confirm">Confirm New^ Password</label>
<input type="password" class="form-control" size="40" id="password_confirm" placeholder="Your new password" name="password_confirm"><br>
 </div>
 <button type="submit" class="btn btn-primary">Change Password</button>
</form> 
<br />
<br />
<a href="forgotpass.php"><button class="btn btn-warning">I forgot my password</button></a>
<br /> <br />
</div>
</div>
</div>

</main><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../../../assets/js/vendor/popper.min.js"></script>
<script src="../../../../dist/js/bootstrap.min.js"></script>
</body>
</html>
*/