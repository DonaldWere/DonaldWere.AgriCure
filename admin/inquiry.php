<?php
session_start();
include_once('../includes/db_connect.php');
if(!isset($_SESSION["admin_login"])){
    header("Location:login.php");
}
else{
    
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Admin | Inquiries</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/custom.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
function ConfirmDelete(){
    var d = confirm('Do you really want to delete data?');
    if(d == false){
        return false;
    }
}
</script>
</head>
<body>
<?php include_once("header.php"); ?> 
<div class="container" >
<div style="width:80%">
<?php
	echo "<h3><u>All Our Crops</u></h3>";
		//get the records from the database
		if ($result = mysqli_query($con, "SELECT * FROM inquiry ORDER BY id")) {
			//display records if there are records to display
			if ($result->num_rows > 0){
				
				$total_results = $result->num_rows;
				//display records in a table
				echo "<p><b>Showing " . $total_results . " Entries </b></p>";
				echo "<table id='myTable' border='1' cellpadding='10' class='table table-responsive'>";
				
				//set table headers
				echo "<tr class='header' ><th>#</th><th>Name:</th><th>Phone Number:</th><th>Email Add:</th><th>Town:</th><th>Crop:</th><th>Inquiry</th><th>Elapsed Days:</th><th></th></tr>";
				
				while ($row = mysqli_fetch_assoc($result)){
					
					$now=time();
					$date = strtotime($row['date']);
					$diff= $now - $date;
					$days = floor($diff/86400);
					//set up a row for each record
					echo "<tr class='success'>";
					echo "<td>".$row["#"]. "</td>";
					echo "<td>".$row["name"]. "</td>";
					echo "<td>" .$row["phone"]. "</td>";
					echo "<td>" .$row["email"]. "</td>";
					echo "<td>" .$row["town"]. "</td>";
					echo "<td>" .$row["crop"]. "</td>";
					echo "<td>" .$row["message"]. "</td>";
					echo "<td>" .$days."</td>";
					echo "<td><a href= ' delete1.php?id=".$row["id"]."' onClick='return ConfirmDelete();'><image src='../images/link/trash.png' height='16px' width='16px'></a></td>";
					echo "</tr>";
				}
				echo "</table>";
			} else {
			//if there are no records in the database, display an alert message
			echo "No results to display!";
			}
		}else {
		//show an error if there is an issue with the database query
		echo "Error:" . $con->error;
		}
	
?> 
 <a class="btn btn-info"  href="index.php" id="myBtn" class="link-butn">Back to All Crops</a>
</div>
<?php
				if(isset($_POST['newcrop'])){ 
						
							$e_name=mysqli_real_escape_string($con, $_POST['english_name']);
							$s_name=mysqli_real_escape_string($con, $_POST['scientific_name']);
							$altitude=mysqli_real_escape_string($con, $_POST['altitude']);
							$harvest_time=mysqli_real_escape_string($con, $_POST['harvest_time']);
							$f_method=mysqli_real_escape_string($con, $_POST['farming_method']);
							$diseases=mysqli_real_escape_string($con, $_POST['diseases']);
							
							// check if the crop exists
							$check=mysqli_num_rows(mysqli_query($con, "SELECT * FROM allcrops WHERE scientific_name='$s_name'"));
							if ($check >= 1){
								echo "<div class='row'>";
								echo "<p class='text-danger'>A crop with a similar scientific name already exists. Please confirm and try again.</p>";
								echo "</div>";
							}else{
								
							if(isset($_FILES['croppic'])){
							  $croppic = $_FILES['croppic']['name'];
							  $file_size =$_FILES['croppic']['size'];
							  $file_tmp =$_FILES['croppic']['tmp_name'];
							  $file_type=$_FILES['croppic']['type'];
							  $extension=end(explode(".", $croppic));
							  $newcroppic=$s_name.".".$extension;
							  move_uploaded_file($file_tmp,"../images/crops/".$newcroppic);
						   }
							
							$insert=mysqli_query($con,"INSERT INTO allcrops (english_name,scientific_name,altitude,harvest_time,farming_method,diseases,pic) VALUES('$e_name','$s_name','$altitude','$harvest_time','$f_method','$diseases','$newcroppic')");
						   if($insert){
						   
						    echo "<div class='row' >";
						   echo "<p class='text-success'> $e_name was succefully added to the list of crops.</p>";
						   echo "</div>";
						   }
						   else{
						   echo "<div class='row'>";
						   echo "<p class='text-danger'>We experienced some problem adding the crop. Please try again later.</p>";
						   echo "</div>";
						   } 
						}
					}
                ?>

</div>
<?php include_once("../includes/footer.php"); ?>
</body>
</html>