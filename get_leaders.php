<?php

include 'config.php';

if(isset($_GET['range'])){$range = $_GET['range'];}else{$range = null;}


if($range=="month"){$table = "user_month_stats"; $title = "Monthly Leaders";}
if($range=="week"){$table = "user_week_stats"; $title = "Weekly Leaders";}

if($range!=null){
	
	echo "<table class='leaderTable'><tr>";
	echo "<tr><th colspan = 4 style='font-size: 15px;'>".$title."</th></tr>";
	echo "<tr><th class='leaderTable'></th><th class='leaderTable'>Name</th><th class='leaderTable'>Total</th></tr>";
	//grab capture leader	
	$sql = "select i_captures, vc_name, vc_profile_string, p.bi_user_id from user_profile p join ".$table." s on s.bi_user_id = p.bi_user_id order by i_captures desc limit 1";
	$result = mysqli_query($con, $sql);
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
		echo "<th class='leaderTable'>Captures</th>"
		."<td class='leaderTable'><a href='http://tagpro-origin.koalabeast.com/profile/".$row['vc_profile_string']."'>".$row['vc_name']."</a>"
		." <a href='profile.php?userid=".$row['bi_user_id']."'>"
		."<img src='http://www.tagpro-stats.com/img/blue_flag.gif' onmouseover='this.src = \"http://www.tagpro-stats.com/img/red_flag.gif\";' onmouseout='this.src = \"http://www.tagpro-stats.com/img/blue_flag.gif\";'/></a></td>"
		."<td class='leaderTable'><a href='http://www.tagpro-stats.com/#range=".$range."&stat=captures&page=0&game=100&row=100&order=desc&active=0'>".$row['i_captures']."</a></td>";
	}
	echo "</tr><tr>";
	//grab return leader
	$sql = "select i_returns, vc_name, vc_profile_string, p.bi_user_id from user_profile p join ".$table." s on s.bi_user_id = p.bi_user_id order by i_returns desc limit 1";
	$result = mysqli_query($con, $sql);
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
		echo "<th class='leaderTable'>Returns</th>"
		."<td class='leaderTable'><a href='http://tagpro-origin.koalabeast.com/profile/".$row['vc_profile_string']."'>".$row['vc_name']."</a>"
		." <a href='profile.php?userid=".$row['bi_user_id']."'>"
		."<img src='http://www.tagpro-stats.com/img/blue_flag.gif' onmouseover='this.src = \"http://www.tagpro-stats.com/img/red_flag.gif\";' onmouseout='this.src = \"http://www.tagpro-stats.com/img/blue_flag.gif\";'/></a></td>"
		."<td class='leaderTable'><a href='http://www.tagpro-stats.com/#range=".$range."&stat=returns&page=0&game=100&row=100&order=desc&active=0'>".$row['i_returns']."</a></td>";
	}
	echo "</tr><tr>";
	//grab tag leader
	$sql = "select i_tags, vc_name, vc_profile_string, p.bi_user_id from user_profile p join ".$table." s on s.bi_user_id = p.bi_user_id order by i_tags desc limit 1";
	$result = mysqli_query($con, $sql);
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
		echo "<th class='leaderTable'>Tags</th>"
		."<td class='leaderTable'><a href='http://tagpro-origin.koalabeast.com/profile/".$row['vc_profile_string']."'>".$row['vc_name']."</a>"
		." <a href='profile.php?userid=".$row['bi_user_id']."'>"
		."<img src='http://www.tagpro-stats.com/img/blue_flag.gif' onmouseover='this.src = \"http://www.tagpro-stats.com/img/red_flag.gif\";' onmouseout='this.src = \"http://www.tagpro-stats.com/img/blue_flag.gif\";'/></a></td>"
		."<td class='leaderTable'><a href='http://www.tagpro-stats.com/#range=".$range."&stat=tags&page=0&game=100&row=100&order=desc&active=0'>".$row['i_tags']."</a></td>";
	}
	echo "</tr><tr>";
	//grab hold leader
	$sql = "select i_hold, vc_name, vc_profile_string, p.bi_user_id from user_profile p join ".$table." s on s.bi_user_id = p.bi_user_id order by i_hold desc limit 1";
	$result = mysqli_query($con, $sql);
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
		echo "<th class='leaderTable'>Hold</th>"
		."<td class='leaderTable'><a href='http://tagpro-origin.koalabeast.com/profile/".$row['vc_profile_string']."'>".$row['vc_name']."</a>"
		." <a href='profile.php?userid=".$row['bi_user_id']."'>"
		."<img src='http://www.tagpro-stats.com/img/blue_flag.gif' onmouseover='this.src = \"http://www.tagpro-stats.com/img/red_flag.gif\";' onmouseout='this.src = \"http://www.tagpro-stats.com/img/blue_flag.gif\";'/></a></td>"
		."<td class='leaderTable'><a href='http://www.tagpro-stats.com/#range=".$range."&stat=hold&page=0&game=100&row=100&order=desc&active=0'>".$row['i_hold']."</a></td>";
	}
	echo "</tr><tr>";
	//grab prevent leader
	$sql = "select i_prevent, vc_name, vc_profile_string, p.bi_user_id from user_profile p join ".$table." s on s.bi_user_id = p.bi_user_id order by i_prevent desc limit 1";
	$result = mysqli_query($con, $sql);
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
		echo "<th class='leaderTable'>Prevent</th>"
		."<td class='leaderTable'><a href='http://tagpro-origin.koalabeast.com/profile/".$row['vc_profile_string']."'>".$row['vc_name']."</a>"
		." <a href='profile.php?userid=".$row['bi_user_id']."'>"
		."<img src='http://www.tagpro-stats.com/img/blue_flag.gif' onmouseover='this.src = \"http://www.tagpro-stats.com/img/red_flag.gif\";' onmouseout='this.src = \"http://www.tagpro-stats.com/img/blue_flag.gif\";'/></a></td>"
		."<td class='leaderTable'><a href='http://www.tagpro-stats.com/#range=".$range."&stat=prevent&page=0&game=100&row=100&order=desc&active=0'>".$row['i_prevent']."</a></td>";
	}	
		
	echo "</tr></table>";
	
}
mysqli_close($con);
?>