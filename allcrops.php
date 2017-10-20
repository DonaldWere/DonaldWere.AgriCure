<?php include_once('includes/db_connect.php'); ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>AgriCure | Crop Information</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
			function mymodal(){
		// Get the modal
		var modal = document.getElementById("myModal");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks on the button, open the modal
			modal.style.display = "block";

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
			modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
		}
</script>
</head>
<body>
<?php include_once("includes/header.php"); ?> 
<a class="btn btn-info" href="index.php" class="link-butn">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a class="btn btn-info"  onClick="return mymodal();" id="myBtn" class="link-butn">Consult an Expert </a>
<div class="container">

		<?php 
			$result = mysqli_query($con, "SELECT * FROM allcrops ORDER BY id");
			while ($row = mysqli_fetch_assoc($result)){
			$id = $row["id"];
			$e_name = $row["english_name"];
			$s_name = $row["scientific_name"];
			$altitude = $row["altitude"];
			$h_time = $row["harvest_time"];
			$f_method = $row["farming_method"];
			$diseases = $row["diseases"];
			$croppic=$row["pic"];
			if(!empty($croppic)){
						$pic="<img  class='image' width='80%' src='images/crops/$croppic'/>";
					}
					else{
						$pic="<img class='img-responsive' src='images/crops/general.jpg'/>";
					}
				echo "<div style='width:33%; float:left'>";	
				echo $pic;
				  echo "<div class='middle'>";
					echo "<div class='text''>".$e_name."<a href= ' view.php?id=".$row["id"]."'><p>Read More</p></a></div>";
				  echo "</div>";
				  echo "</div>";
			}
		?>
			<!-- The Modal -->
	<div id="myModal" class="modal">

			  <!-- Modal content -->
			  <div class="modal-content">
					<div class="modal-header">
						<span class="close">&times;</span>
						<h2>Enter Your Details Below</h2>
					 </div>
					 <div class="modal-body">

					<form action="allcrops.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="Enter Name" required /> <br/>
						</div>
						<div class="form-group">
							<input type="text" name="phone" maxlength="10" class="form-control" placeholder="Enter  Phone Number (07xxxxxxxx)" required /> <br/>
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="Enter Email address (If available)" /> <br/>
						</div>
						<div class="form-group">
							<input type="text" name="town" class="form-control" placeholder="Enter Your Nearest Town" required /> <br/>
						</div>
						<div class="form-group">
							<input type="text" name="crop" class="form-control" placeholder="Enter Name of the Crop" required /> <br/>
						</div>
						<div class="form-group">
							 <label for="message">Your Message</label>
							 <textarea class="form-control" rows="5" name="message" required></textarea>
						 </div>
						<button type="submit" name= "inquire"class="btn btn-primary">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn btn-primary">Cancel</button>
					</form>
		
					 </div>
					 <div class="modal-footer">
						<h2>Thanks</h2>
					 </div>
			</div>

	</div>
	<?php

		if(isset($_POST['inquire'])){ 
							$name=mysqli_real_escape_string($con, $_POST['name']);
							$phone=mysqli_real_escape_string($con, $_POST['phone']);
							$email=mysqli_real_escape_string($con, $_POST['email']);
							$town=mysqli_real_escape_string($con, $_POST['town']);
							$crop= mysqli_real_escape_string($con, $_POST['crop']);
							$message=mysqli_real_escape_string($con, $_POST['message']);
								
							$insert=mysqli_query($con,"INSERT INTO inquiry (name,phone,email,town,crop,message) VALUES('$name','$phone','$email','$town','$crop','$message')");
						   if($insert){
						    echo "<div class='row' >";
						   echo "<p class='text-success'> Inquiry on  $crop submitted successfully. We shall get back to you shortly.</p>";
						   echo "</div>";
						   
						
						   }
						   else{
						   echo "<div class='row'>";
						   echo "<p class='text-danger'>We experienced some problem sending your inquiry. Please try again later.</p>";
						   echo "</div>";
						    
						}
					}
?>
</div>
<?php include_once("includes/footer.php"); ?>
</body>
</html>