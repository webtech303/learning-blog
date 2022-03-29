<?php require_once("include/DB.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php
if(isset($_POST["submit"])){
	$Title=mysqli_real_escape_string($connection,$_POST["title"]);
	$Category=mysqli_real_escape_string($connection,$_POST["category"]);
	$Post=mysqli_real_escape_string($connection,$_POST["post"]);
	$image=$_FILES["image"]["name"];
	$terget = "upload/".basename($_FILES['image']['name']);
	 
	date_default_timezone_set("Asia/Karachi");
	$currentTime=time();
	$datetime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
	$datetime;
	$admin="Redowan";
	if(empty($Title)){
		$_SESSION["ErrorMessage"]="Title Can't Be Empty";
		Redirect_to("Addnewpost.php");
	}elseif(strlen($Title)<2){
		$_SESSION["ErrorMessage"]="Title Should Be At-Least 2 Character";
		Redirect_to("Addnewpost.php");
	}else{
		$EditFromURL=$_GET['Edit'];
		move_uploaded_file($_FILES['image']['tmp_name'],$terget);
		$query = "UPDATE admin_panel SET datetime='$datetime', title='$Title',category='$Category', author='$admin', image='$image', post='$Post'
		WHERE id='$EditFromURL'";
		$excute=mysqli_query($connection,$query);
		if($excute){
		$_SESSION["SuccessMessage"]="Post Update Successfully";
		Redirect_to("Dashboard.php");
		}else{
		$_SESSION["ErrorMessage"]="Something Went Wrong! Try Again";
		Redirect_to("Dashboard.php");
		}
	}

}
?>
<!DOCTYPE>
<html>
<head>
	<title>Edit Post</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/adminstyle.css">
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
				<h1>Redowan</h1>
				<ul id="Side_Manu" class="nav nav-pills nav-stacked">
				<li><a href="dashboard.php"><span class="glyphicon glyphicon-th">&nbsp;Dashoard</span></a></li>
				<li class="active"><a href=""><span class="glyphicon glyphicon-list-alt">&nbsp;Update Post</span></a></li>
				<li><a href="categories.php"><span class="glyphicon glyphicon-tags">&nbsp;Categories</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-user">&nbsp;Manage Admins</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-comment">&nbsp;Comments</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-equalizer">&nbsp;Blog</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-log-out">&nbsp;Logout</span></a></li>
				</ul>
			</div><!--Ending of Side Area-->
			<div class="col-sm-10">
			<h1>Update Post</h1>
			<div>
			<?php echo Message();
			echo SuccessMessage();
			?>
			</div>
				<div>
					<?php
					$SearchId = $_GET['Edit'];
					$query = "select * from admin_panel where id='$SearchId'";
					$excute = mysqli_query($connection,$query);
					while($result=mysqli_fetch_array($excute)){
							$Title=$result["title"];
							$Category=$result["category"];					
							$Image=$result["image"];
							$Post=$result["post"];
					}
					?>
					<form action="EditPost.php?Edit=<?php echo $SearchId; ?>" method="post" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<label for="title">Title:</label>
								<input value="<?php echo $Title; ?>" class="form-control" type="text" name="title" id="title" placeholder="title">
							</div>
							<div class="form-group">
								<label>Existing Category:</label>
								<?php echo $Category; ?>
								<br>
								<label for="categoryselect">Category:</label>
								<select class="form-control" id="categoryselect" name="category">
								<?php
									$viewquery = "select * from category order by datetime desc";
									$excute = mysqli_query($connection,$viewquery);
									
									while($result = mysqli_fetch_array($excute)){
									$Id=$result["id"];
									$CategoryName=$result["name"];
								?>
									<option><?php echo $CategoryName;?></option>
								<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label>Existing Image:</label>
								<img src="upload/<?php echo $Image; ?>" width="150" height="60">
								<br>
								<label for="imageselect">Select Image:</label>
								<input type="file" class="form-control" name="image">
							</div>
							<div class="form-group">
								<label for="postarea">Post:</label>
								<textarea class="form-control" name="post" id="postarea">
									<?php echo $Post?>
								</textarea>
							</div>
							<br>
							<input class="btn btn-success btn-block" type="submit" name="submit" value="Update Post">
						</fieldset>
						<br>
					</form>
				</div>	
			</div><!--Ending of Main Area-->
		</div><!--Ending of Row-->
	</div><!--Ending of Container-->
	<div id="footer">
		<hr><p>
			Admin By | Redowan | &copy;2018-2020 --- all right receive
		</p>
	</div>
</body>
</html>