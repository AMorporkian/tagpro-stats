<?php

include 'config.php';

if(isset($_GET['string'])){$string = $_GET['string'];}else{$string = null;}
addslashes($string);
$string = str_replace('%', '\\\\%', $string);
$string = str_replace('_', '\\\\_', $string);

$sql = "SELECT a.vc_name, u.bi_user_id
		FROM user_profile u JOIN user_all_record a ON u.bi_user_id = a.bi_user_id 
		WHERE a.vc_name = '".$string."' ORDER BY i_games DESC LIMIT 0, 50";
$result = mysqli_query($con, $sql);

while($row=mysqli_fetch_array($result)){
	echo "<div class='autocomplete'>"
	."<a href='profile.php?userid=".$row['bi_user_id']."'>".$row['vc_name']."</a>"
	." </div>";
}

$sql = "SELECT a.vc_name, u.bi_user_id
		FROM user_profile u JOIN user_all_record a ON u.bi_user_id = a.bi_user_id 
		WHERE a.vc_name LIKE '".$string."%' and a.vc_name!='".$string."' ORDER BY i_games DESC LIMIT 0, 50";
$result = mysqli_query($con, $sql);
while($row=mysqli_fetch_array($result)){
	echo "<div class='autocomplete'>"
	."<a href='profile.php?userid=".$row['bi_user_id']."'>".$row['vc_name']."</a>"
	." </div>";
}

mysqli_close($con);

?>