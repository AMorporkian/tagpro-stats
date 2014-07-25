<?php 

include 'config.php';

if(isset($_GET['userid'])){$user_id = $_GET['userid'];}else{$user_id = null;}


if($user_id != null && is_numeric($user_id)){
	$sql = "SELECT * FROM profile_stats WHERE bi_user_id='".$user_id."'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);

}

function addSuffix($n){ 
    if($n == 1 || ($n > 10 && ($n-11)%10 == 0 && substr($n,-2) != 11)) return $n.'st'; 
    if($n == 2 || ($n > 10 && ($n-12)%10 == 0 && substr($n,-2) != 12)) return $n.'nd'; 
    if($n == 3 || ($n > 10 && ($n-13)%10 == 0 && substr($n,-2) != 13)) return $n.'rd'; 
    return $n.'th'; 
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TagPro Stats Profile Page</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

<div class="containers">
<table style="width: 100%; font-weight: bold;">
	<tr>
		<td style="text-align: left; padding-left: 10%;"><a href="http://tagpro.koalabeast.com/">PLAY TAGPRO</a></td>
		<td style="text-align: center;"><a href="http://www.reddit.com/r/tagpro">DISCUSS TAGPRO</a></td>
		<td style="text-align: right; padding-right: 10%;"><a href="http://www.twitch.tv/tagprotv">WATCH TAGPRO</a></td>
	</tr>
</table>
</div>




<div style="margin: 0px 1% 0px 1%;">
<table>
	<tr>
		<td class="main" style="width: 66%;">


<div class="profile-containers">
				<div class="statGroup">
					<div style="font-size: 24px; text-align: center;">
					Name <b><a href="http://tagpro-origin.koalabeast.com/profile/<?php echo $row['vc_profile_string']; ?>"><?php echo $row['vc_name']; ?></a></b>
					</div>
					<div style="text-align: center; font-size: 20px; margin-top: 0px; margin-bottom: 0px;">
						Career Record and Stats
					</div>					
				</div>
				<table style="width: 100%;">
					<tr>
						<td style="vertical-align: top;"><!-- COLUMN #1 -->
							<div class="statGroup">
								<table style="width: 100%;">
									<tr>
									<td class="head">Win Percent</td>
									<td class="stat"><?php echo number_format($row['f_win_percent']*100, 2)."%"; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=winpercent&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_win_percent_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Wins</td>
									<td class="stat"><?php echo $row['i_wins']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=wins&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_wins_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Losses</td>
									<td class="stat"><?php echo $row['i_losses']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=losses&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_losses_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Games</td>
									<td class="stat"><?php echo $row['i_games']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=games&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_games_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Hours</td>
									<td class="stat"><?php echo $row['f_hours']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=hours&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_hours_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Minutes/Game</td>
									<td class="stat"><?php echo number_format($row['f_minute_game'], 3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=hourgame&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_minute_game_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Disconnects</td>
									<td class="stat"><?php echo $row['i_dcs']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=dcs&page=0&game=100&row=100&order=desc&active=0"><?php echo addSuffix($row['i_dcs_rank']); ?></a></td>
									</tr>
								</table>
							</div>
							<div class="statGroup">
								<table style="width: 100%;">
									<tr>
									<td class="head">Grabs</td>
									<td class="stat"><?php echo $row['i_grabs']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=grabs&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_grabs_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Grabs/Game</td>
									<td class="stat"><?php echo number_format($row['f_grab_game'], 3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=grabgame&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_grab_game_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Grabs/Hour</td>
									<td class="stat"><?php echo number_format($row['f_grab_hour'], 3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=grabhour&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_grab_hour_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Drops</td>
									<td class="stat"><?php echo $row['i_drops']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=drops&page=0&game=100&row=100&order=desc&active=0"><?php echo addSuffix($row['i_drops_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Drops/Game</td>
									<td class="stat"><?php echo number_format($row['f_drop_game'], 3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=dropgame&page=0&game=100&row=100&order=desc&active=0"><?php echo addSuffix($row['i_drop_game_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Drops/Hour</td>
									<td class="stat"><?php echo number_format($row['f_drop_hour'], 3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=drophour&page=0&game=100&row=100&order=desc&active=0"><?php echo addSuffix($row['i_drop_hour_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Popped</td>
									<td class="stat"><?php echo $row['i_popped']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=popped&page=0&game=100&row=100&order=desc&active=0"><?php echo addSuffix($row['i_popped_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Pops/Game</td>
									<td class="stat"><?php echo number_format($row['f_pop_game'], 3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=popgame&page=0&game=100&row=100&order=desc&active=0"><?php echo addSuffix($row['i_pop_game_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Pops/Hour</td>
									<td class="stat"><?php echo number_format($row['f_pop_hour'], 3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=pophour&page=0&game=100&row=100&order=desc&active=0"><?php echo addSuffix($row['i_pop_hour_rank']); ?></a></td>
									</tr>
								</table>
							</div>
						</td>
						<td style="vertical-align: top;"><!-- COLUMN #2 -->
							<div class="statGroup">
								<table style="width: 100%;">
									<tr>
									<td class="head">Tags</td>
									<td class="stat"><?php echo $row['i_tags']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=tags&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_tags_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Tags/Game</td>
									<td class="stat"><?php echo number_format($row['f_tag_game'], 3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=taggame&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_tag_game_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Tags/Hour</td>
									<td class="stat"><?php echo number_format($row['f_tag_hour'], 3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=taghour&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_tag_hour_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Returns</td>
									<td class="stat"><?php echo $row['i_returns']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=returns&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_returns_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Returns/Game</td>
									<td class="stat"><?php echo number_format($row['f_return_game'], 3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=returngame&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_return_game_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Returns/Hour</td>
									<td class="stat"><?php echo number_format($row['f_return_hour'], 3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=returnhour&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_return_hour_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Captures</td>
									<td class="stat"><?php echo $row['i_captures']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=captures&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_captures_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Captures/Game</td>
									<td class="stat"><?php echo number_format($row['f_cap_game'], 3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=capgame&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_cap_game_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Captures/Hour</td>
									<td class="stat"><?php echo number_format($row['f_cap_hour'], 3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=caphour&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_cap_hour_rank']); ?></a></td>
									</tr>
								</table>
							</div>
							<div class="statGroup">
								<table style="width: 100%;">
									<tr>
									<td class="head">Captures/Grab</td>
									<td class="stat"><?php echo number_format($row['f_caps_grab'],3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=capgrab&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_caps_grab_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Tags/Pop</td>
									<td class="stat"><?php echo number_format($row['f_tag_pop'],3); ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=tagpop&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_tag_pop_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Non-Return Tags</td>
									<td class="stat"><?php echo $row['i_nrtags']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=nrtags&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_nrtags_rank']); ?></a></td>
									</tr>
								</table>
							</div>
							<div class="statGroup">
								<table style="width: 100%;">
									<tr>
									<td class="head">Support</td>
									<td class="stat"><?php echo $row['i_support']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=support&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_support_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Hold</td>
									<td class="stat"><?php echo $row['i_hold']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=hold&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_hold_rank']); ?></a></td>
									</tr>
									<tr>
									<td class="head">Prevent</td>
									<td class="stat"><?php echo $row['i_prevent']; ?></td>
									<td class="rank"><a href="http://tagpro-stats.com/#range=all&stat=prevent&page=0&game=100&row=100&order=desc&active=0&active=0"><?php echo addSuffix($row['i_prevent_rank']); ?></a></td>
									</tr>
								</table>
							</div>
							<div style="font-size: 12px; text-align: center; margin-top: 20px;">
								Profile last updated <span style="color: #00FF00;"><?php echo $row['dt_last_update']; ?></span>
							</div>
						</td>
					</tr>
				</table>
				<div style="width: 100%; text-align: center; font-size: 13px; margin-top: 10px">
					Only balls that have played over 100 games are counted.
					<span style="color: #00FF00;"> 
						<?php 
							$sql = "SELECT COUNT(bi_user_id) as UserCount FROM profile_stats WHERE i_games > 100";
							$result0 = mysqli_query($con, $sql);
							$row0 = mysqli_fetch_assoc($result0);
							echo $row0['UserCount'];
						?></span> balls included in ranking.
				</div>
			</div>

			<div class="profile-containers">
				<div style="width: 100%; text-align: center; font-size: 20px; padding-top: 10px;">
					<?php echo date('F'); ?> Record and Stats
				</div>
				<div>
				<table style="width: 100%;">
					<tr>
						<td style="vertical-align: top;"><!-- COLUMN #1 -->
							<div class="statGroup">
								<table style="width: 100%;">
									<tr>
										<td class="head">Win Percent</td>
										<td class="stat"><?php echo number_format($row['f_win_percent_m']*100, 2)."%"; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=winpercent&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_win_percent_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Wins</td>
										<td class="stat"><?php echo $row['i_wins_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=wins&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_wins_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Losses</td>
										<td class="stat"><?php echo $row['i_losses_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=losses&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_losses_rank_m']); ?></a></td>						
									</tr>
									<tr>
										<td class="head">Games</td>
										<td class="stat"><?php echo $row['i_games_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=games&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_games_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Hours</td>
										<td class="stat"><?php echo $row['f_hours_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=hours&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_hours_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Minutes/Game</td>
										<td class="stat"><?php echo number_format($row['f_minute_game_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=hourgame&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_minute_game_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Disconnects</td>
										<td class="stat"><?php echo $row['i_dcs_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=dcs&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_dcs_rank_m']); ?></a></td>
									</tr>
								</table>
							</div>
							<div class="statGroup">
								<table style="width: 100%;">
									<tr>
										<td class="head">Grabs</td>
										<td class="stat"><?php echo $row['i_grabs_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=grabs&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_grabs_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Grabs/Game</td>
										<td class="stat"><?php echo number_format($row['f_grab_game_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=grabgame&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_grab_game_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Grabs/Hour</td>
										<td class="stat"><?php echo number_format($row['f_grab_hour_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=grabhour&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_grab_hour_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Drops</td>
										<td class="stat"><?php echo $row['i_drops_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=drops&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_drops_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Drops/Game</td>
										<td class="stat"><?php echo number_format($row['f_drop_game_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=dropgame&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_drop_game_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Drops/Hour</td>
										<td class="stat"><?php echo number_format($row['f_drop_hour_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=drophour&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_drop_hour_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Popped</td>
										<td class="stat"><?php echo $row['i_popped_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=popped&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_popped_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Pops/Game</td>
										<td class="stat"><?php echo number_format($row['f_pop_game_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=popgame&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_pop_game_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Pops/Hour</td>
										<td class="stat"><?php echo number_format($row['f_pop_hour_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=pophour&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_pop_hour_rank_m']); ?></a></td>
									</tr>
								</table>
							</div>
							<div class="statGroup">
								<table style="width: 100%;">
									<tr>
										<td class="head">Rank Points</td>
										<td class="stat"><?php echo $row['i_points_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=points&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_points_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Points/Game</td>
										<td class="stat"><?php echo number_format($row['f_points_game_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=pointgame&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_points_game_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Points/Hour</td>
										<td class="stat"><?php echo number_format($row['f_points_hour_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=pointhour&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_points_hour_rank_m']); ?></a></td>
									</tr>
								</table>
							</div>
						</td>
						<td style="vertical-align: top;"><!-- COLUMN #2 -->
							<div class="statGroup">
								<table style="width: 100%;">
									<tr>
										<td class="head">Tags</td>
										<td class="stat"><?php echo $row['i_tags_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=tags&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_tags_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Tags/Game</td>
										<td class="stat"><?php echo number_format($row['f_tag_game_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=taggame&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_tag_game_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Tags/Hour</td>
										<td class="stat"><?php echo number_format($row['f_tag_hour_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=taghour&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_tag_hour_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Returns</td>
										<td class="stat"><?php echo $row['i_returns_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=returns&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_returns_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Returns/Game</td>
										<td class="stat"><?php echo number_format($row['f_return_game_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=returngame&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_return_game_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Returns/Hour</td>
										<td class="stat"><?php echo number_format($row['f_return_hour_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=returnhour&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_return_hour_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Captures</td>
										<td class="stat"><?php echo $row['i_captures_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=captures&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_captures_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Captures/Game</td>
										<td class="stat"><?php echo number_format($row['f_cap_game_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=capgame&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_cap_game_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Captures/Hour</td>
										<td class="stat"><?php echo number_format($row['f_cap_hour_m'], 3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=caphour&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_cap_hour_rank_m']); ?></a></td>
									</tr>
								</table>
							</div>
							<div class="statGroup">
								<table style="width: 100%">
									<tr>
										<td class="head">Captures/Grab</td>
										<td class="stat"><?php echo number_format($row['f_caps_grab_m'],3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=capgrab&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_caps_grab_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Tags/Pop</td>
										<td class="stat"><?php echo number_format($row['f_tag_pop_m'],3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=tagpop&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_tag_pop_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Non-Return Tags</td>
										<td class="stat"><?php echo $row['i_nrtags_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=nrtags&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_nrtags_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Hold/Grab</td>
										<td class="stat"><?php echo number_format($row['f_hold_grab_m'],3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=holdgrab&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_hold_grab_rank_m']); ?></a></td>
									</tr>
								</table>
							</div>
							<div class="statGroup">
								<table style="width: 100%">
									<tr>
										<td class="head">Hold</td>
										<td class="stat"><?php echo $row['i_hold_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=hold&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_hold_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Hold/Game</td>
										<td class="stat"><?php echo number_format($row['f_hold_game_m'],3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=holdgame&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_hold_game_rank_m']); ?></a></td>
									</tr>
									<tr>
									</tr>
										<td class="head">Hold/Hour</td>
										<td class="stat"><?php echo number_format($row['f_hold_hour_m'],3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=holdhour&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_hold_hour_rank_m']); ?></a></td>
									<tr>
									</tr>
										<td class="head">Prevent</td>
										<td class="stat"><?php echo $row['i_prevent_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=prevent&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_prevent_rank_m']); ?></a></td>
									<tr>
										<td class="head">Prevent/Game</td>
										<td class="stat"><?php echo number_format($row['f_prevent_game_m'],3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=preventgame&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_prevent_game_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Prevent/Hour</td>
										<td class="stat"><?php echo number_format($row['f_prevent_hour_m'],3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=preventhour&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_prevent_hour_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Support</td>
										<td class="stat"><?php echo $row['i_support_m']; ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=support&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_support_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Support/Game</td>
										<td class="stat"><?php echo number_format($row['f_support_game_m'],3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=supportgame&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_support_game_rank_m']); ?></a></td>
									</tr>
									<tr>
										<td class="head">Support/Hour</td>
										<td class="stat"><?php echo number_format($row['f_support_hour_m'],3); ?></td>
										<td class="rank"><a href="http://tagpro-stats.com/#range=month&stat=supporthour&page=0&game=10&row=100&order=desc&active=0"><?php echo addSuffix($row['i_support_hour_rank_m']); ?></a></td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
				</table>
				</div>
				<div style="width: 100%; text-align: center; font-size: 13px; margin-top: 10px">
					Only balls that have played over 10 games in the current month are counted.
					<span style="color: #00FF00;"> 
							<?php 
								$sql = "SELECT COUNT(bi_user_id) as UserCount FROM profile_stats WHERE i_games_m > 10";
								$result = mysqli_query($con, $sql);
								$row = mysqli_fetch_assoc($result);
								echo $row['UserCount'];
							?></span> balls included in monthly ranking.
				</div>
			</div>
			
		</td>
		<td class="main" style="width: 33%; text-align: center; padding-left: 50px;">
			<div class="search-top">
				<div style="font-weight: bold; color: #00FF00; text-align: center; background-color: #420f59; padding-top: 5px; padding-bottom: 5px;">
					Search Player Profile By Name
				</div>
				<div style="margin-top: 4px;">
					<input type="text" style="width: 98%;" id="autocompleteTextBox" onkeyup="populateAutoComplete();">
				</div>
				<div id="autocomplete-div" >
				</div>		
			</div>
			<div class="search-bot">
				For names starting with non-alphanumeric characters, try starting your search with <b>A</b> or <b>&amp;</b>.
			</div>
			
			<div class="containers">
				<a href="index.php">Back To Leader Boards</a>
			</div>

			<div style="z-index: 1; text-align: center; margin: 5px 0px 5px 0px; padding: 0px 0px 0px 0px;" >
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<!-- TagPro Profile -->
					<ins class="adsbygoogle"
					     style="display:inline-block;width:336px;height:280px"
					     data-ad-client="ca-pub-3578354369996923"
					     data-ad-slot="8951783107"></ins>
					<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
			</div>
			<div class="containers">
				<div style="font-weight: bold; font-size: 16px; text-align: center; background-color: #420f59; padding-top: 3px;">
					Welcome to TagPro-Stats.com
				</div>
				<div style="font-size: 13px; padding: 5px 5px 0px 5px;">
					Use the form below to add yourself to the leaderboards.
					Once added, your stats will be updated once every 4 hours.
				</div>
				<div style="font-size: 13px; padding: 5px 5px 0px 5px;">
					Comments, questions, or suggestions? <a href="http://www.reddit.com/message/compose/?to=Some_Ball">contact me here</a>.
				</div>
				<div style="font-size: 13px; padding: 10px 5px 0px 5px; text-align: center;">
					<div id="RegistrationCount">
						<?php include 'user_count.php'; ?>
					</div>
				</div>
			</div>

			<div style="" class="containers">
				<div style="font-weight: bold; font-size: 16px; text-align: center; background-color: #420f59; padding-top: 3px;">
					Can't Find Your Name? Add Yourself!
				</div>
				<table style="width: 100%;">
					<tr>
						<td style="width: 50%; text-align: center; vertical-align: bottom;">
							<span style="font-size: 14px;">Enter your Profile ID</span><br><input type="text" name="" id="profileInpt" size="25">
						</td>
						<td style="width: 50%;  vertical-align: bottom;">
							<button onclick="submitProfile()">Add Your Stats To The Rankings</button><br>
							<div id="submitMsgDiv"></div>
						</td>
					</tr><tr>
						<td colspan="2" style="font-size: 12px; padding-top: 10px;">
							What's your <b>Profile ID</b>? It is the hex value that appears at the end of the url on your profile page.
							Just login to any server, click <b>Profile</b>, and copy/paste the value into the box above.
							<br>ex: http://tagpro-pi.koalabeast.com/profile/<b>XXXXXXXXXXXXXXXXXXXXXXXX</b>
						</td>
					</tr>
				</table>
			</div>

			<div>
				<script type="text/javascript">
				  ( function() {
				    if (window.CHITIKA === undefined) { window.CHITIKA = { 'units' : [] }; };
				    var unit = {"publisher":"aml264","width":300,"height":250,"sid":"Chitika tagpro-stats.com","color_site_link":"0000CC","color_bg":"FFFFFF"};
				    var placement_id = window.CHITIKA.units.length;
				    window.CHITIKA.units.push(unit);
				    document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
				    var s = document.createElement('script');
				    s.type = 'text/javascript';
				    s.src = '//cdn.chitika.net/getads.js';
				    try { document.getElementsByTagName('head')[0].appendChild(s); } catch(e) { document.write(s.outerHTML); }
				}());
				</script>
			</div>

		</td>
	</tr>
</table>
</div>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/main.js"></script>

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-44822081-1', 'tagpro-stats.com');
		ga('send', 'pageview');
	</script>
    </body>
</html>
