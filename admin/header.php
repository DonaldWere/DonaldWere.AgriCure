<div class="page-header"  style="margin-top:0px; padding:0px;">
<nav class="navbar navbar-inverse" style="background-color:#0170AF; border:none;">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="myNavbar">
      <p><h1><b>AgriCure Limited</b></h1>
	  <?php
					include_once('../includes/db_connect.php');
					if(isset($_SESSION['admin_login'])){
					$user_mail=$_SESSION['admin_login'];
					$result=(mysqli_query($con,"SELECT * FROM admin WHERE email='$user_mail'"));
					while($row=mysqli_fetch_assoc($result)){
						$m_desc=$row["email"];
						}
                      $login="<a href='logout.php'>Log Out</a>";
                  }
                  else{
                      $login="";
                  }
                  echo $login;
                ?></p>
    </div>
  </div>
</nav>
</nav>
</div>