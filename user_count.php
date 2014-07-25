<?php
    include 'config.php';
	
	$sql = "SELECT COUNT(DISTINCT bi_user_id) as usercount FROM user_all_record WHERE dt_last_update >= DATE_SUB(NOW(), INTERVAL 24 HOUR)";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	echo "<span style='color: #00FF00;'>".$row['usercount']."</span> balls have logged in & played in the last 24 hours.<br>";
	
	$sql = "select count(bi_user_id) as usercount from user_week_record where i_games > 0";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	echo "<span style='color: #00FF00;'>".$row['usercount']."</span> balls have logged in & played this week.<br>";
	
	$sql = "select count(bi_user_id) as usercount from user_profile";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	echo "<span style='color: #00FF00;'>".$row['usercount']."</span> total balls being tracked.";
	
	mysqli_close($con);
?>