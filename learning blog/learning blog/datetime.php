<?php
	date_default_timezone_set("Asia/Karachi");
	$currentTime=time();
	$datetime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
	echo $datetime
?>