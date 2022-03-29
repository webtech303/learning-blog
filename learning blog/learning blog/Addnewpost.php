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
		move_uploaded_file($_FILES['image']['tmp_name'],$terget);
		$query = "insert into admin_panel(datetime,title,category,author,image,post)
		values('$datetime','$Title','$Category','$admin','$image','$Post')";
		$excute=mysqli_query($connection,$query);
		if($excute){
		$_SESSION["SuccessMessage"]="Post Added Successfully";
		Redirect_to("Addnewpost.php");
		}else{
		$_SESSION["ErrorMessage"]="Something Went Wrong! Try Again";
		Redirect_to("Addnewpost.php");
		}
	}

}
?>
<!DOCTYPE>
<html>
<head>
	<title>Add New Post</title>
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
				<li class="active"><a href=""><span class="glyphicon glyphicon-list-alt">&nbsp;Add New Post</span></a></li>
				<li><a href="categories.php"><span class="glyphicon glyphicon-tags">&nbsp;Categories</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-user">&nbsp;Manage Admins</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-comment">&nbsp;Comments</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-equalizer">&nbsp;Blog</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-log-out">&nbsp;Logout</span></a></li>
				</ul>
			</div><!--Ending of Side Area-->
			<div class="col-sm-10">
			<h1>Add New Post</h1>
			<div>
			<?php echo Message();
			echo SuccessMessage();
			?>
			</div>
				<div>
					<form action="Addnewpost.php" method="post" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<label for="title">Title:</label>
								<input class="form-control" type="text" name="title" id="title" placeholder="title">
							</div>
							<div class="form-group">
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
								<label for="imageselect">Select Image:</label>
								<input type="file" class="form-control" name="image">
							</div>
							<div class="form-group">
								<label for="postarea">Post:</label>
								<textarea class="form-control" name="post" id="postarea"></textarea>
							</div>
							<br>
							<input class="btn btn-success btn-block" type="submit" name="submit" value="Add New Post">
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