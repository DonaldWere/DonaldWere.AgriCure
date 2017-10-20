<?php
session_start();
include_once('../includes/db_connect.php');
if(!isset($_SESSION["admin_login"])){
    header("Location:login.php");
}
else{
    
}
<?php
	//connect to the database
	include('../includes/db_connect.php');
	
	//confirm that the 'id' variable has been set
	if (isset($_GET['id']) && is_numeric($_GET['id'])){
		//get the 'id' variable from the URL
		$id = $_GET['id'];
		
		//delete record from the database
		if ($stmt = $con->prepare("DELETE FROM inquiry WHERE id = ? LIMIT 1")){
			$stmt->bind_param("i",$id);
			$stmt->execute();
			$stmt->close();
			
			echo"(
				<script>
				 window.alert('Confirmed. Delete successful');
				 window.location.href=('inquiry.php');
				 </script>
					)";
		}else{
			echo "ERROR: could not prepare SQL statement.";
		}
		$con->close();
	}else{
		//if the 'id' variable  isn't set
		echo"(
    <script>
	 window.alert('Sorry. id variable not set');
	 window.location.href=('inquiry.php');
	 </script>
		)";
	}
?>