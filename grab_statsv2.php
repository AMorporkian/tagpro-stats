<?php

function grabStats($id, $server){

	include 'config.php';

	$name = null;
	$all_time_record = array();/*0:Points 1:Game 2:Wins 3:Losses 4:DCs 5:Time*/
	$weekly_record = array();
	$monthly_record = array();
	$all_time_stats = array();/*0:Tags 1:Popped 2:Grabs 3:Drops 4:Hold 5:Captures 6:Prevent 7:Returns 8:Support*/
	$weekly_stats = array();
	$monthly_stats = array();
	
	/*GET THE PROFILE URL*/
	$sql = "select * from user_profile where bi_user_id=".$id;
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$profile = $row['vc_profile_string'];
	
	/* intialize url string 0:origin 1:pi 2:radius 3:chord 4:diameter 5:centra*/
	switch($server){
		case 0: $url = "http://tagpro-origin.koalabeast.com/profile/".$profile;
		break;
		case 1: $url = "http://tagpro-pi.koalabeast.com/profile/".$profile;
		break;
		case 2: $url = "http://tagpro-radius.koalabeast.com/profile/".$profile;
		break;
		case 3: $url = "http://tagpro-chord.koalabeast.com/profile/".$profile;
		break;
		case 4: $url = "http://tagpro-diameter.koalabeast.com/profile/".$profile;
		break;
		case 5: $url = "http://tagpro-centra.koalabeast.com/profile/".$profile;
		break;
		default: $url = "http://tagpro-origin.koalabeast.com/profile/".$profile; $server = 0;
		break;
	}

	$output = addslashes(file_get_contents($url));/* load page contents into a string*/

	$pos = strpos($output, "<h3>");
	$output = substr($output, $pos+4);
//	if($server==0 or $server==1 or $server==4 or $server==3){//if origin, don't scrape degree in the name
		$pos = strpos($output, "<div>");
//	}else{$pos = strpos($output, "</h3>");}
	$name = substr($output, 0, $pos); /*GRAB PLAYERS NAME*/

/*SCRAPE WEELY WIN/LOSS RECORD*/
	$pos = strpos($output, "Week");
	$output = substr($output, $pos);
	for($a=0; $a<6; $a++){
		$pos = strpos($output, "<td");
		$output = substr($output, $pos);
		$pos = strpos($output, ">")+1;
		$output = substr($output, $pos);
		$pos = strpos($output, "</td>");
		$weekly_record[$a] = substr($output, 0, $pos);
		$output = substr($output, $pos);
	}
/*SCRAPE MONTHLY WIN/LOSS RECORD*/
	$pos = strpos($output, "Month");
	$output = substr($output, $pos);
	for($a=0; $a<6; $a++){
		$pos = strpos($output, "<td");
		$output = substr($output, $pos);
		$pos = strpos($output, ">")+1;
		$output = substr($output, $pos);
		$pos = strpos($output, "</td>");
		$monthly_record[$a] = substr($output, 0, $pos);
		$output = substr($output, $pos);
	}
/*SCRAPE ALL TIME WIN/LOSS RECORD*/	
	$pos = strpos($output, "All");
	$output = substr($output, $pos);
	for($a=0; $a<6; $a++){
		$pos = strpos($output, "<td");
		$output = substr($output, $pos);
		$pos = strpos($output, ">")+1;
		$output = substr($output, $pos);
		$pos = strpos($output, "</td>");
		$all_time_record[$a] = substr($output, 0, $pos);
		$output = substr($output, $pos);		
	}

/*SCRAPE WEEKLY STATS*/	
	$pos = strpos($output, "Week<");
	$output = substr($output, $pos);
	for($a=0; $a<9; $a++){
		$pos = strpos($output, "<td");
		$output = substr($output, $pos);
		$pos = strpos($output, ">")+1;
		$output = substr($output, $pos);
		$pos = strpos($output, "</td>");
		$weekly_stats[$a] = substr($output, 0, $pos);
		$output = substr($output, $pos);
	}
/*0:Tags 1:Popped 2:Grabs 3:Drops 4:Hold 5:Captures 6:Prevent 7:Returns 8:Support*/
/*SCRAPE MONTHLY STATS*/	
	$pos = strpos($output, "Month<");
	$output = substr($output, $pos);
	for($a=0; $a<9; $a++){
		$pos = strpos($output, "<td");
		$output = substr($output, $pos);
		$pos = strpos($output, ">")+1;
		$output = substr($output, $pos);
		$pos = strpos($output, "</td>");
		$monthly_stats[$a] = substr($output, 0, $pos);
		$output = substr($output, $pos);
	}
/*SCRAPE ALL TIME STATS*/	
	$pos = strpos($output, "All");
	$output = substr($output, $pos);
	for($a=0; $a<9; $a++){
		$pos = strpos($output, "<td");
		$output = substr($output, $pos);
		$pos = strpos($output, ">")+1;
		$output = substr($output, $pos);
		$pos = strpos($output, "</td>");
		$all_time_stats[$a] = substr($output, 0, $pos);
		$output = substr($output, $pos);
	}

	/*Insert scraped data into tables*/
	$sql = "update user_week_record set vc_name='".$name."'"
		.", i_points=".$weekly_record[0]
		.", i_games=".$weekly_record[1]
		.", i_wins=".$weekly_record[2]
		.", i_losses=".$weekly_record[3]
		.", i_dcs=".$weekly_record[4]
		.", f_hours=".($weekly_record[5]/3600)." where bi_user_id=".$id;
	mysqli_query($con, $sql);
	$sql = "update user_month_record set vc_name='".$name."'"
		.", i_points=".$monthly_record[0]
		.", i_games=".$monthly_record[1]
		.", i_wins=".$monthly_record[2]
		.", i_losses=".$monthly_record[3]
		.", i_dcs=".$monthly_record[4]
		.", f_hours=".($monthly_record[5]/3600)." where bi_user_id=".$id;
	mysqli_query($con, $sql);
	$sql = "update user_all_record set vc_name='".$name."'"
		.", i_points=".$all_time_record[0]
		.", i_games=".$all_time_record[1]
		.", i_wins=".$all_time_record[2]
		.", i_losses=".$all_time_record[3]
		.", i_dcs=".$all_time_record[4]
		.", f_hours=".($all_time_record[5]/3600)." where bi_user_id=".$id;
	mysqli_query($con, $sql);
	$sql = "update user_week_stats set vc_name='".$name."'"
		.", i_tags=".$weekly_stats[0]
		.", i_popped=".$weekly_stats[1]
		.", i_grabs=".$weekly_stats[2]
		.", i_drops=".$weekly_stats[3]
		.", i_hold=".$weekly_stats[4]
		.", i_captures=".$weekly_stats[5]
		.", i_prevent=".$weekly_stats[6]
		.", i_returns=".$weekly_stats[7]
		.", i_support=".$weekly_stats[8]." where bi_user_id=".$id;
	mysqli_query($con, $sql);
	$sql = "update user_month_stats set vc_name='".$name."'"
		.", i_tags=".$monthly_stats[0]
		.", i_popped=".$monthly_stats[1]
		.", i_grabs=".$monthly_stats[2]
		.", i_drops=".$monthly_stats[3]
		.", i_hold=".$monthly_stats[4]
		.", i_captures=".$monthly_stats[5]
		.", i_prevent=".$monthly_stats[6]
		.", i_returns=".$monthly_stats[7]
		.", i_support=".$monthly_stats[8]." where bi_user_id=".$id;
	mysqli_query($con, $sql);
	$sql = "update user_all_stats set vc_name='".$name."'"
		.", i_tags=".$all_time_stats[0]
		.", i_popped=".$all_time_stats[1]
		.", i_grabs=".$all_time_stats[2]
		.", i_drops=".$all_time_stats[3]
		.", i_hold=".$all_time_stats[4]
		.", i_captures=".$all_time_stats[5]
		.", i_prevent=".$all_time_stats[6]
		.", i_returns=".$all_time_stats[7]
		.", i_support=".$all_time_stats[8]." where bi_user_id=".$id;
	mysqli_query($con, $sql);

//	echo htmlspecialchars($output);
	mysqli_close($con);
}

?>