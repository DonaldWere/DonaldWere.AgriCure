<?php
session_start();
include_once('../includes/db_connect.php');
$msg='';
if(isset($_POST['login'])){
  $email=$_POST['email'];
  $pwd=$_POST['pwd'];
  $sql="SELECT * FROM admin WHERE email='$email'";
  $result = mysqli_query($con, $sql);
  if (mysqli_num_rows($result)==1) {
  while($row = mysqli_fetch_assoc($result)) {
  $dbemail=$row["email"];
  $dbpassword=$row["password"];
  }
  if(($email==$dbemail)&&($pwd==$dbpassword)){
  $_SESSION["admin_login"] = $dbemail;
  header("Location:index.php");
  exit;
   }
   else{
   $msg='Wrong username or password.Please try again.'; 
   }
   }
  }
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>AgriCure | Admin Login</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/custom.css">
<link rel="stylesheet" href="css/custom.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</head>
<body>
<?php include_once("header.php"); ?> 

<div class="container" >
     
     <div class="logarea">     
			<h2 class="form-signin-heading"><marquee behavior="scroll">AgriCure ADMIN LOGIN <?php echo date("d/m/Y")  ?></marquee></h2><hr />
          <form role="form" action="login.php" method="post">
            <div class="form-group">
             <input type="email" class="form-control" class="input-block-level" placeholder="Email address" id="email" name="email" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" class="input-block-level" placeholder="Password" id="pwd" name="pwd" required>
            </div>
              <button type="submit" class="btn btn-primary" name="login">Log In</button>
            </form>
			<p class='text-danger'><?php echo $msg ?></p>
    </div>
	<div class='row'>
		
	</div>
</div>
<?php include_once("../includes/footer.php"); ?>
</body>
</html>