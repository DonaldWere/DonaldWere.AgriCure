<?php
$e_name=$s_name=$altitude=$harvest_time=$f_method=$diseases=$newcroppic="";
include_once('../includes/db_connect.php');
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $result=(mysqli_query($con,"SELECT * FROM allcrops WHERE id='$id'"));
    while($row=mysqli_fetch_assoc($result)){
        $e_name=$row["english_name"];
        $s_name=$row["scientific_name"];
        $altitude=$row["altitude"];
        $harvest_time=$row["harvest_time"];
        $f_method=$row["farming_method"];
        $diseases=$row["diseases"];
        $newcroppic=$row["pic"];
          
        if(!empty($newcroppic)){
            $croppic="<img class='img-responsive' src='../images/crops/$newcroppic'/>";
        }
        else{
            $croppic="<img class='img-responsive' src='../images/crops/general.jpg'/>";
        }
    }
    }
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title><?php echo $e_name; ?>: Edit Crop Info</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/custom.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
    $("header ul [href]").each(function() {
    if (this.href.split("?")[0] == window.location.href.split("?")[0]) {
        $(this).addClass("active");
        }
    });
        
         $("#mobile_menu").click(function(){
        $("nav").slideToggle("slow");
    });
});
    </script>
</head>
<body>
<?php include_once("../includes/header.php"); ?> 

<div class="container">
             <h3>Edit Crop Info : <?php echo $e_name." (" .$s_name. ")"; ?></h3>
            <div style="width:50%; border: 1px solid #0170AF; padding: 5%">
                <form role="form" action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
						<label for="english_name">English Name:</label>
							<input type="text" name="english_name" class="form-control" value="<?php echo $e_name; ?>" required /> <br/>
						</div>
						<div class="form-group">
						<label for="scientific_name">Scientific Name:</label>
							<input type="text" name="scientific_name" class="form-control" value="<?php echo $s_name; ?>" required /> <br/>
						</div>
						<div class="form-group">
						<label for="altitude">Altitude:</label>
							<input type="text" name="altitude" class="form-control" value="<?php echo $altitude; ?>" required /> <br/>
						</div>
						<div class="form-group">
						<label for="harvest_time">Time to Harvest:</label>
							<input type="text" name="harvest_time" class="form-control" value="<?php echo $harvest_time; ?>" required /> <br/>
						</div>
						<div class="form-group">
							 <label for="farming_method">Describe the farming method:</label>
							 <textarea class="form-control" rows="5" name="farming_method" required><?php echo $f_method; ?></textarea>
						 </div>
						 <div class="form-group">
							 <label for="diseases">Outline the diseases affecting the crop:</label>
							 <textarea class="form-control" rows="5" name="diseases" required><?php echo $diseases; ?></textarea>
						 </div>
						 <div class="form-group">
								 <label for="croppic">Upload a Picture for the Crop:</label>
								 <input type="file" id="croppic" name="croppic"  accept="image/gif, image/jpeg, image/png">
						</div>
                    
                     <button type="submit" name="update" class="btn btn-primary">Update Crop Info</button>
                   </form>
				   </div>
                <?php
				
				include_once('../includes/db_connect.php');
                 if(isset($_POST['update'])){ 
				 $id=$_GET['id'];
				 
							$e_name1=mysqli_real_escape_string($con, $_POST['english_name']);
							$s_name1=mysqli_real_escape_string($con, $_POST['scientific_name']);
							$altitude1=mysqli_real_escape_string($con, $_POST['altitude']);
							$harvest_time1=mysqli_real_escape_string($con, $_POST['harvest_time']);
							$f_method1=mysqli_real_escape_string($con, $_POST['farming_method']);
							$diseases1=mysqli_real_escape_string($con, $_POST['diseases']);
							
						if(isset($_FILES['croppic'])){
						  $croppic = $_FILES['croppic']['name'];
						  $file_size =$_FILES['croppic']['size'];
						  $file_tmp =$_FILES['croppic']['tmp_name'];
						  $file_type=$_FILES['croppic']['type'];
						  $extension=end(explode(".", $croppic));
						  $newcroppic=$s_name1.".".$extension;
						  move_uploaded_file($file_tmp,"../images/crops/".$newcroppic);
					   }
					
						$insert=mysqli_query($con,"UPDATE allcrops SET english_name='$e_name1',scientific_name='$s_name1',altitude='$altitude1',harvest_time='$harvest_time1',farming_method='$f_method1',diseases='$diseases1',pic='$newcroppic' WHERE id='$id' ");
					   if($insert){
					   echo"(
						<script>
						 window.alert('The update was succefull.');
						 window.location.href=('index.php');
						 </script>
							)"; 
					   }
					   else{
					   echo "<div class='row'>";
					   echo "<p class='text-danger'>We experienced some problem updating your profile, please try again.</p>";
					   echo "</div>";
					   }
					}
                ?>
            
</div>
<?php include_once("../includes/footer.php"); ?>
</body>
</html>