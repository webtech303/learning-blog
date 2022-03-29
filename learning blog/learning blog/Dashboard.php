<?php require_once("include/DB.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<!DOCTYPE>
<html>
<head>
	<title>Cheacking bootstrap</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/adminstyle.css">
</head>

<body>
	<div style="height:10px; background:#27aae1;"></div>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container"><!--Container-->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="blog.php">
					<img style="margin-top:-6;" src="img/1.png" width=200;height=30;>
				</a>
			</div>
			<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav" style="margin-left:50px">
				<li><a href="#">Home</a></li>
				<li><a href="blog.php" target="_blank">Blog</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Service</a></li>
				<li><a href="#">Contact Us</a></li>
				<li><a href="#">Feature</a></li>
			</ul>
			<form action="blog.php" class="navbar-form navbar-right">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="search" name="search">
				</div>
				<button class="btn btn-success" name="searchbutton">Go</button>
			</form>
			</div>
		</div><!--Ending Container-->
	</nav>
	<div class="line" style="height:10px; background:#27aae1;margin-top:-20px;"></div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
				<h1>Redowan</h1>
				<ul id="Side_Manu" class="nav nav-pills nav-stacked">
				<li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-th">&nbsp;Dashoard</span></a></li>
				<li><a href="dashboard.php"><span class="glyphicon glyphicon-list-alt">&nbsp;Add New Post</span></a></li>
				<li><a href="categories.php"><span class="glyphicon glyphicon-tags">&nbsp;Categories</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-user">&nbsp;Manage Admins</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-comment">&nbsp;Comments</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-equalizer">&nbsp;Blog</span></a></li>
				<li><a href=""><span class="glyphicon glyphicon-log-out">&nbsp;Logout</span></a></li>
				</ul>
			</div><!--Ending of Side Area-->
			<div class="col-sm-10"><!--start main area -->
						<div><?php echo Message();
						echo SuccessMessage();?></div>
				<h1>About Dashboard</h1>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th>No</th>
							<th>Post Title</th>
							<th>Date & Time</th>
							<th>Author</th>
							<th>Category</th>
							<th>Banner</th>
							<th>Comment</th>
							<th>Action</th>
							<th>Details</th>
						</tr>
						<?php
						$Viewquery = "SELECT * FROM admin_panel ORDER BY datetime DESC";
						$Excute = mysqli_query($connection, $Viewquery);
						$Srno=0;
						while ($result = mysqli_fetch_array($Excute)) {
							$Id=$result["id"];
							$Datetime=$result["datetime"];
							$Title=$result["title"];
							$Category=$result["category"];
							$Author=$result["author"];
							$Image=$result["image"];
							$Post=$result["post"];
							$Srno++;
						?>
						<tr>
							<td><?php echo $Srno; ?></td>
							<td style="color:#5e5eff;"><?php
							if(strlen($Title)>20){
								$Title = substr($Title,0 ,20).'..';
							}
							echo $Title; ?></td>
							<td><?php
							if(strlen($Datetime)>11){
								$Datetime=substr($Datetime,0,11);
							}
							echo $Datetime; ?></td>
							<td><?php echo $Author; ?></td>
							<td><?php echo $Category; ?></td>
							<td><img src="upload/<?php echo $Image; ?>" width="200px" height="50px"></td>
							<td>Processing</td>
							<td>
								<a href="EditPost.php?Edit=<?php echo $Id; ?>">
									<span class="btn btn-warning">Edit</span></a>
								<a href="DeletePost.php?Delete=<?php echo $Id; ?>">
								<span class="btn btn-danger">Delete</span></a>
							</td>
							<td><a href="Fullpost.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
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