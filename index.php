<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TagPro Stats</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css?<?php echo time(); ?>">
        <link rel="stylesheet" href="css/main.css?<?php echo time(); ?>">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
<body onload="firstRun();">
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
		<td class="main">
			
<!--Begin The LeaderBoard-->			
			<div class="containers">
				<table style="width:100%;">
					<tr>
						<th class="header" colspan=8>The TagPro Leaderboard</th>
					</tr>
					<tr>
						<td>
						<select id="SelectRange" class="leaderBoardSelect">
							<option value="all">All Time Leaders</option>
							<option value="month">Monthly Leaders</option>
							<option value="week">Weekly Leaders</option>
						</select>
						</td>
						<td>
						<select id="SelectActive">
							<option value="0" selected="selected">Played Ever</option>
							<option value="1">Last 1 Day</option>
							<option value="3">Last 3 Days</option>
							<option value="7">Last 7 Days</option>
							<option value="30">Last 30 Days</option>
							<option value="180">Last 180 Days</option>
							<option value="365">Last 365 Days</option>

						</select>
						</td>
						<td>
						<select id="SelectGame">
							<option value="0">Games > 0</option>
							<option value="10">Games > 10</option>
							<option value="50">Games > 50</option>
							<option value="100" selected="selected">Games > 100</option>
							<option value="200">Games > 200</option>
							<option value="500">Games > 500</option>
							<option value="1000">Games > 1000</option>
						</select>
						</td>
						<td>
						<select id="SelectStat">
							<optgroup label="Win/Loss Record">
								<option value="winpercent">Win %</option>
								<option value="wins">Wins</option>
								<option value="losses">Losses</option>
								<option value="games">Games</option>
								<option value="winpercentnodcs">Win % (DCs Excluded)</option>
							</optgroup>
							<optgroup label="Caps/Returns/Tags">
								<option value="tags">Tags</option>
								<option value="taggame">Tags/Game</option>
								<option value="taghour">Tags/Hour</option>
								<option value="returns">Returns</option>
								<option value="returngame">Returns/Game</option>
								<option value="returnhour">Returns/Hour</option>
								<option value="captures">Captures</option>
								<option value="capgame">Captures/Game</option>
								<option value="caphour">Captures/Hour</option>						
							</optgroup>
							<optgroup label="Grabs/Drops/Pops">
								<option value="grabs">Grabs</option>
								<option value="grabgame">Grabs/Game</option>
								<option value="grabhour">Grabs/Hour</option>
								<option value="drops">Drops</option>
								<option value="dropgame">Drops/Game</option>
								<option value="drophour">Drops/Hour</option>					
								<option value="popped">Popped</option>
								<option value="popgame">Popped/Game</option>
								<option value="pophour">Popped/Hour</option>
							</optgroup>
							<optgroup label="Hold/Prevent/Support">
								<option value="hold">Hold</option>
								<option value="holdgame">Hold/Game</option>
								<option value="holdhour">Hold/Hour</option>
								<option value="prevent">Prevent</option>
								<option value="preventgame">Prevent/Game</option>
								<option value="preventhour">Prevent/Hour</option>
								<option value="support">Support</option>
								<option value="supportgame">Support/Game</option>
								<option value="supporthour">Support/Hour</option>															
							</optgroup>
							<optgroup label="Miscellaneous">
								<option value="capgrab">Captures/Grab</option>
								<option value="tagpop">Tag/Pop Ratio</option>
								<option value="holdgrab">Hold/Grab</option>
								<option value="nrtags">Non-Return Tags</option>
								<option value="nrtagsgame">Non-Return Tags/Game</option>
								<option value="nrtagshour">Non-Return Tags/Hour</option>
								<option value="keptflags">Kept Flags</option>														
							</optgroup>
							<optgroup label="Points/Hours/DCs">
								<option value="points">Rank Points</option>
								<option value="pointgame">Rank Points/Game</option>
								<option value="pointhour">Rank Points/Hour</option>
								<option value="hours">Hours</option>
								<option value="hourgame">Minutes/Game</option>
								<option value="dcs">Disconnects</option>						
							</optgroup>
						</select>
						</td><td>				
						<select id="SelectRow">
							<option value="10">10 Rows</option>
							<option value="20">20 Rows</option>
							<option value="50">50 Rows</option>
							<option value="100" selected="selected">100 Rows</option>
							<option value="250">250 Rows</option>
							<option value="500">500 Rows</option>
							<option value="1000">1000 Rows</option>
						</select>
						</td>
						<td>
						<select id="SelectOrder">
							<option value="desc">Desc</option>
							<option value="asc">Asc</option>
						</select>
						</td>
						<td>
							<div style="border: 1px solid black; font-size: 11px;">
								<table>
									<tr>
										<td style="padding-left: 2px; padding-right: 2px;"><input type="checkbox" id="mltpCheck" value="1" /> </td>
										<td style="text-align: center; width: 50px;">Only MLTP Registered</td>
									</tr>
								</table>
							</div>
						</td>
						<td>
						<button style="width: 100%;" onclick="getLeaderboard(0, '#LeaderBoard', $('#SelectRange').val(), $('#SelectGame').val(), $('#SelectStat').val(), $('#SelectRow').val(), $('#SelectOrder').val(), $('#SelectActive').val() )">Generate New Leaderboard</button>
						</td>
					</tr>
				</table>
				
				<div id="LeaderBoard" style="width: 100%;">
					<img href="img/ajax-loader.gif">
				</div>				
			</div>

			
		</td><td class="main" style="width: 33%;">

			
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
				<div id="MonthlyStatLeaders" style="font-size: 13px;"> </div>
			</div>

			
			<div class="containers">
				<div id="WeeklyStatLeaders" style="font-size: 13px;"> </div>
			</div>


			<div style="" class="containers">
				<div style="font-weight: bold; color: #00FF00; text-align: center; background-color: #420f59; padding-top: 5px; padding-bottom: 5px;">
					New Stat - Kept Flags
				</div>
				<div style="font-size: 13px; padding: 5px 5px 0px 5px;">
					Ever wonder how many times the clock has run out while you were still holding the flag? Check out the 
					<a href="http:///www.tagpro-stats.com/#range=all&stat=keptflags&page=0&game=100&row=100&order=desc&active=0">kept flags</a> 
					stat.
				</div>
				<div style="font-size: 14px; margin-top: 10px; margin-bottom: 5px; text-align: center; font-weight: bold;">
							Kept Flags = Grabs - (Captures + Drops)
				</div>
				<div style="font-size: 13px; padding: 5px 5px 0px 5px; text-align: center;">
					<a href="http://www.reddit.com/message/compose/?to=Some_Ball">Send me</a> your new stat suggestions.
				</div>
			</div>
			
			
			<div style="text-align: center; margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px;">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- TagPro LeaderBoard -->
				<ins class="adsbygoogle" style="display:inline-block;width:336px;height:280px; padding: 0 0 0 0 margin: 0 0 0 0;" data-ad-client="ca-pub-3578354369996923" data-ad-slot="2213918706"> </ins>
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


			<div style="" class="containers">
				<div style="font-weight: bold; font-size: 16px; text-align: center; background-color: #420f59; padding-top: 3px;">
					Database Backup File
				</div>
				<div style="font-size: 13px; padding: 5px 5px 0px 5px;">
					For those who want to monkey around with the stats themselves.
				</div>
				<div style="font-size: 14px; margin-top: 10px; margin-bottom: 10px; text-align: center;">
					<a href="tagpro_stats_backup.sql.gz">tagpro_stats_backup.sql.gz</a> - 
					<?php
						echo number_format(filesize("tagpro_stats_backup.sql.gz")/1048576,1) . ' MB - ';
						echo date ("m/d/Y H:i:s", filemtime("tagpro_stats_backup.sql.gz"));
					?>					
				</div>
			</div>	
		</td>
	</tr>
</table>
</div>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/main.js?<?php echo time(); ?>"></script>

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
