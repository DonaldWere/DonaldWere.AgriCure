<?php
include_once('includes/db_connect.php');
			 $id = $_GET['id'];
			 $result = mysqli_query($con, "SELECT * FROM allcrops WHERE id='$id'");
			$row = mysqli_fetch_assoc($result);
			$id = $row["id"];
			$e_name = $row["english_name"];
			$s_name = $row["scientific_name"];
			$altitude = $row["altitude"];
			$h_time = $row["harvest_time"];
			$f_method = $row["farming_method"];
			$diseases = $row["diseases"];
			$croppic=$row["pic"];
			if(!empty($croppic)){
						$pic="<img  class='img-responsive' width='80%' src='images/crops/$croppic'/>";
					}
					else{
						$pic="<img class='img-responsive' src='images/crops/general.jpg'/>";
					}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title> AgriCure | <?php echo $e_name; ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
	
</head>
<body>
<?php include_once("includes/header.php"); ?> 
<div class="container" >
<div style="width:80%">
<h3><?php echo $e_name."  (".$s_name.")"; ?></h3>
			<div class="col-sm-4">
							<?php echo $pic; ?>
			   </div>
			    <div class="col-sm-8">
					
                   <p><b>Altitude:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $altitude; ?></p>
                   <p><b>Time to harvest:</b> <?php echo $h_time; ?></p>
				   <p><a href="allcrops.php">All Crops</a></p>
                </div>
			<div class="col-sm-12">
                    <h4>Farming Method for <?php echo $e_name?>:</h4>
                    <p><?php echo $f_method; ?></p>
					 <h4>Diseases Affecting <?php echo $e_name?>:</h4>
					 <p><?php echo $diseases; ?></p>
                </div>
</div>


</div>
<?php include_once("includes/footer.php"); ?>
</body>
</html>