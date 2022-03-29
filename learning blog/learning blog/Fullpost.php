<?php require_once("include/DB.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php
if(isset($_POST["submit"])){
	$Name=mysqli_real_escape_string($connection,$_POST["name"]);
	$Email=mysqli_real_escape_string($connection,$_POST["email"]);
	$Comment=mysqli_real_escape_string($connection,$_POST["comment"]);
	date_default_timezone_set("Asia/Karachi");
	$currentTime=time();
	$Datetime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
	$Datetime;
	$PostId = $_GET["id"];
	if(empty($Title) || empty($Email) || empty($Comment)){
		$_SESSION["ErrorMessage"]="All Fields Are Required";
	}elseif(strlen($Comment)>500){
		$_SESSION["ErrorMessage"]="Only 500 Character Are Allow In Comment";
	}else{
		$query = "INSERT INTO comments (datetime,name,email,comment,status) VALUES('$Datetime','$Name','$Email','$Comment','OFF')";
		$excute=mysqli_query($connection,$query);
		if($excute){
		$_SESSION["SuccessMessage"]="Comment Submitted Successfully";
		Redirect_to("Fullpost.php?id=<?php echo $PostId; ?>");
		}else{
		$_SESSION["ErrorMessage"]="Something Went Wrong! Try Again";
		Redirect_to("Fullpost.php?id=<?php echo $PostId; ?>");
		 }
	}

}
?>
<!DOCTYPE>
<html>
<head>
	<title>Full Blog Page</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/publicstyle.css">
	<style>
	.FieldInfo{
		color:rgb(251, 174, 44);
	}
	</style>
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
				<li><a href="blog.php">Home</a></li>
				<li><a href="#">Blog</a></li>
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
	<div class="container"><!--Container-->
		<div class="blog-header">
			<h1>Welcome To <span style="color:blue">Learn For Learn</span> Blog</h1>
			<p>It is a learning blog web page.It create to provide infomation about programming language.</p>
		</div>
		<div class="row"><!--row-->
			<div class="col-sm-8"><!--main blog area-->
				<?php echo Message();
			echo SuccessMessage();
			?>
				<?php
				if(isset($_GET["searchbutton"])){
					$Search=$_GET["search"];
					$viewquery="SELECT * from admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE'%$Search%'";
				}else{
						$PosrIdFromUrl=$_GET['id'];
						$viewquery = "select * from admin_panel where id='$PosrIdFromUrl' order by datetime desc";}
						$excute = mysqli_query($connection,$viewquery);
						while($result = mysqli_fetch_array($excute)){
							$Id=$result["id"];
							$DateTime=$result["datetime"];
							$Title=$result["title"];
							$Category=$result["category"];
							$Author=$result["author"];
							$Image=$result["image"];
							$Post=$result["post"];
							
						?>
						<div class="blogpost thumbnail">
							<img class="img-responsive img-rounded" src="upload/<?php echo $Image;?>">
							<div class="caption">
								<h1 id="heading"><?php echo htmlentities($Title);?></h1>
								<p class="description">Category:<?php echo htmlentities($Category);?> Published On:<?php echo htmlentities($DateTime);?></p>
								<p class="post"><?php echo htmlentities($Post);?></p>
							</div>
						</div>
				
						<?php }?>
						<br>
						<span class="FieldInfo">Share Your Thoughts About This Post</span>
						<br>
						<span class="FieldInfo">Comments</span>
						<div><!--start comment section-->
						<form action="Fullpost.php?id=<?php echo $PosrIdFromUrl; ?>" method="post" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<label for="name"><span class="FieldInfo">Name:</span></label>
								<input class="form-control" type="text" name="name" id="name" placeholder="Name">
							</div>
							<div class="form-group">
								<label for="email"><span class="FieldInfo">Email:</span></label>
								<input class="form-control" type="email" name="email" id="email" placeholder="Email">
							</div>
							<div class="form-group">
								<label for="commentarea"><span class="FieldInfo">Comments:</span></label>
								<textarea class="form-control" name="comment" id="commentarea"></textarea>
							</div>
							<br>
							<input class="btn btn-primary" type="submit" name="submit" value="submit">
						</fieldset>
						<br>
					</form>
				</div><!--start comment section-->
			</div><!--ending main blog area-->
			<div class="col-sm-ofset-1 col-sm-3"><!--side area-->
				<h2>Test</h2>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
			</div><!--side area ending-->
		</div><!--Ending row-->
	</div><!--Ending Container-->
</body>
<div id="footer">
		<hr>
		<p>
			Admin By | Redowan | &copy;2018-2020 --- all right receive
		</p>
</div>
</html>