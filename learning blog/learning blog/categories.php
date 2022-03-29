<?php require_once("include/DB.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php
if(isset($_POST["submit"])){
	$Category=mysqli_real_escape_string($connection,$_POST["category"]);
	date_default_timezone_set("Asia/Karachi");
	$currentTime=time();
	$datetime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
	$datetime;
	$admin="Redowan";
	if(empty($Category)){
		$_SESSION["ErrorMessage"]="Field Must Not Be Empty";
		Redirect_to("categories.php");
	}elseif(strlen($Category)>99){
		$_SESSION["ErrorMessage"]="Too long category";
		Redirect_to("categories.php");
	}else{
		$query = "insert into category(datetime,name,creatorname)
		values('$datetime','$Category','$admin')";
		$excute=mysqli_query($connection,$query);
		if($excute){
		$_SESSION["SuccessMessage"]="Successful";
		Redirect_to("categories.php");
		}else{
		$_SESSION["ErrorMessage"]="error";
		Redirect_to("categories.php");
		}
	}

}
?>
<!DOCTYPE>
<html>
<head>
	<title>Manage Category</title>
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
				<li><a href="Addnewpost.php"><span class="glyphicon glyphicon-list-alt">&nbsp;Add New Post</span></a></li>
				<li class="active"><a href="categories.php"><span class="glyphicon glyphicon-tags">&nbsp;Categories</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-user">&nbsp;Manage Admins</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-comment">&nbsp;Comments</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-equalizer">&nbsp;Blog</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-log-out">&nbsp;Logout</span></a></li>
				</ul>
			</div><!--Ending of Side Area-->
			<div class="col-sm-10">
			<h1>Manage Categories</h1>
			<div>
			<?php echo Message();
			echo SuccessMessage();
			?>
			</div>
				<div>
					<form action="categories.php" method="post">
						<fieldset>
							<div class="form-group">
							<label for="categoryname">Name:</label>
							<input class="form-control" type="text" name="category" id="categoryname" placeholder="name">
							</div>
							<input class="btn btn-success btn-block" type="submit" name="submit" value="Add New Category">
						</fieldset>
					</form>
				</div>

				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th>Sr.No.</th>
							<th>Date &Time</th>
							<th>Category Name</th>
							<th>creator Name</th>
						</tr>
						<?php
						$viewquery = "select * from category order by datetime desc";
						$excute = mysqli_query($connection,$viewquery);
						$SrNo=0;
						while($result = mysqli_fetch_array($excute)){
							$Id=$result["id"];
							$DateTime=$result["datetime"];
							$CategoryName=$result["name"];
							$CreatorName=$result["creatorname"];
							$SrNo++;
						?>
						<tr>
							<td><?php echo $SrNo;?></td>
							<td><?php echo $DateTime;?></td>
							<td><?php echo $CategoryName;?></td>
							<td><?php echo $CreatorName;?></td>
						</tr>
						<?php } ?>
					</table>
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