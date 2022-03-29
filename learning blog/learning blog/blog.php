<?php require_once("include/DB.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<!DOCTYPE>
<html>
<head>
	<title>Blog Page</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/publicstyle.css">
	<style>
	.img-rounded{
		padding-top: 5px;
	}
	.blog-header{
		text-align: center;
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
				<li><a href="#">Home</a></li>
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
				<?php
				if(isset($_GET["searchbutton"])){
					$Search=$_GET["search"];
					$viewquery="SELECT * from admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE'%$Search%'";
				}else{
						$viewquery = "select * from admin_panel order by datetime desc";}
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
							<p class="description">Category:<span style="color:red;border:1px solid red;padding:3px;"><?php echo htmlentities($Category);?></span> Published On:<?php echo htmlentities($DateTime);?> Posted By:<?php echo $Author;?></p>
							<p class="post"><?php
							if(strlen($Post)>150){
								$Post=substr($Post, 0,150).'.....';
							}
							echo htmlentities($Post);?></p>
							</div>
							<a href="Fullpost.php?id=<?php echo $Id;?>"><span class="btn btn-info">Read More &rsaquo;&rsaquo;</span></a>
						</div>
						
						<?php }?>
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
			Admin By Redowan | &copy;2018-2020 --- all right receive
		</p>
		<p>
			Email:redowan.bu.cse@gmail.com
		</p>
</div>
</html>