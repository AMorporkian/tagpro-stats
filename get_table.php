<?php

include 'config.php';

function humanizeDateDifference($now, $otherDate = null, $offset = null)
{
    if ($otherDate != null) {
        $offset = $now - $otherDate;
    }
    if ($offset != null) {
        $deltaS = $offset % 60;
        $offset /= 60;
        $deltaM = $offset % 60;
        $offset /= 60;
        $deltaH = $offset % 24;
        $offset /= 24;
        $deltaD = ($offset > 1) ? ceil($offset) : $offset;
    } else {
        throw new Exception("Must supply otherdate or offset (from now)");
    }
    if ($deltaD > 1) {
        if ($deltaD > 365) {
            $years = ceil($deltaD / 365);
            if ($years == 1) {
                return "last year";
            } else {
                return "$years years ago";
            }
        }
        if ($deltaD > 6) {
            return date('d M', strtotime("$deltaD days ago"));
        }
        return "$deltaD days ago";
    }
    if ($deltaD == 1) {
        return "Yesterday";
    }
    if ($deltaH == 1) {
        return "last hour";
    }
    if ($deltaM == 1) {
        return "last minute";
    }
    if ($deltaH > 0) {
        return $deltaH . " hours ago";
    }
    if ($deltaM > 0) {
        return $deltaM . " minutes ago";
    } else {
        return "few seconds ago";
    }
}

if (isset($_GET['range'])) {
    $range = $_GET['range'];
} else {
    $range = null;
}
if (isset($_GET['stat'])) {
    $stat = $_GET['stat'];
} else {
    $stat = null;
}
if (isset($_GET['game'])) {
    $game = $_GET['game'];
} else {
    $game = 0;
}
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 0;
}
if (isset($_GET['row'])) {
    $rows = $_GET['row'];
} else {
    $rows = 100;
}
if (isset($_GET['order'])) {
    $order = $_GET['order'];
} else {
    $order = "desc";
}
if (isset($_GET['active'])) {
    $active = $_GET['active'];
} else {
    $active = "0";
}
if (isset($_GET['mltp'])) {
    $mltp = $_GET['mltp'];
} else {
    $mltp = false;
}

if (!is_numeric($active)) {
    $active = 0;
}
if (!is_numeric($game)) {
    $game = 100;
}
//activity
if ($active == 0) {
    $where_string = " where i_games > " . $game . " ";
} else {
    $where_string = " where i_games > " . $game . " AND s.dt_last_update>=DATE_SUB(NOW(), INTERVAL " . $active . " DAY) ";
}
//mltp
if ($mltp == "true") {
    $where_string = $where_string . "AND vc_profile_string in (SELECT * FROM mltp_season_5) ";
}

//validate order
if ($order != "asc" and $order != "desc") {
    $order = $desc;
}

/*SET WHICH TIME FRAME TO PULL STATS FOR*/
$record_string = "user_all_record";
$stat_string = "user_all_stats";
if ($range == "month") {
    $record_string = "user_month_record";
    $stat_string = "user_month_stats";
}
if ($range == "week") {
    $record_string = "user_week_record";
    $stat_string = "user_week_stats";
}
$table_string = $record_string . " r on r.bi_user_id = p.bi_user_id join " . $stat_string . " s on s.bi_user_id = p.bi_user_id ";

/* SET STAT PART OF QUERY HERE*/
switch ($stat) {
    case "winpercent":
        $select_string = "select p.vc_server_name, r.dt_last_update,  r.vc_name, (i_wins/i_games)*100 as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_wins/i_games) " . $order;
        $stat_header = "Win %";
        break;
    case "wins":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_wins as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_wins " . $order;
        $stat_header = "Wins";
        break;
    case "losses":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_losses as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_losses " . $order;
        $stat_header = "Losses";
        break;
    case "games":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_games as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_games " . $order;
        $stat_header = "Games";
        break;
    case "tags":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_tags as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_tags " . $order;
        $stat_header = "Tags";
        break;
    case "returns":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_returns as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_returns " . $order;
        $stat_header = "Returns";
        break;
    case "nrtags":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_tags-i_returns) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_tags-i_returns) " . $order;
        $stat_header = "Non-Return Tags";
        break;
    case "nrtagsgame":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_tags-i_returns)/i_games as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_tags-i_returns)/i_games " . $order;
        $stat_header = "Non-Return Tags Per Game";
        break;
    case "nrtagshour":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_tags-i_returns)/f_hours as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_tags-i_returns)/f_hours " . $order;
        $stat_header = "Non-Return Tags Per Hour";
        break;
    case "captures":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_captures as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_captures " . $order;
        $stat_header = "Captures";
        break;
    case "grabs":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_grabs as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_grabs " . $order;
        $stat_header = "Grabs";
        break;
    case "drops":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_drops as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_drops " . $order;
        $stat_header = "Drops";
        break;
    case "popped":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_popped as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_popped " . $order;
        $stat_header = "Popped";
        break;
    case "support":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_support as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_support " . $order;
        $stat_header = "Support";
        break;
    case "hold":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_hold as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_hold " . $order;
        $stat_header = "Hold <span style='font-size: 10px;'>(in seconds)</span>";
        break;
    case "prevent":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_prevent as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_prevent " . $order;
        $stat_header = "Prevent <span style='font-size: 10px;'>(in seconds)</span>";
        break;
    case "hours":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, f_hours as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by f_hours " . $order;
        $stat_header = "Hours";
        break;
    case "dcs":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_dcs as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_dcs " . $order;
        $stat_header = "Disconnects";
        break;
    case "winpercentnodcs":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_wins/(i_games-i_dcs)) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_wins/(i_games-i_dcs)) " . $order;
        $stat_header = "Win % (DCs excluded)";
        break;
    case "capgrab":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_captures/i_grabs) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_captures/i_grabs) " . $order;
        $stat_header = "Captures Per Grab";
        break;
    case "tagpop":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_tags/i_popped) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_tags/i_popped) " . $order;
        $stat_header = "Tag/Pop Ratio";
        break;
    case "taggame":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_tags/i_games) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_tags/i_games) " . $order;
        $stat_header = "Tags Per Game";
        break;
    case "taghour":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_tags/f_hours) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_tags/f_hours) " . $order;
        $stat_header = "Tags Per Hour";
        break;
    case "capgame":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_captures/i_games) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_captures/i_games) " . $order;
        $stat_header = "Captures Per Game";
        break;
    case "caphour":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_captures/f_hours) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_captures/f_hours) " . $order;
        $stat_header = "Captures Per Hour";
        break;
    case "returngame":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_returns/i_games) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_returns/i_games) " . $order;
        $stat_header = "Returns Per Game";
        break;
    case "returnhour":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_returns/f_hours) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_returns/f_hours) " . $order;
        $stat_header = "Returns Per Hour";
        break;
    case "popgame":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_popped/i_games) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_popped/i_games) " . $order;
        $stat_header = "Popped Per Game";
        break;
    case "pophour":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_popped/f_hours) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_popped/f_hours) " . $order;
        $stat_header = "Popped Per Hour";
        break;
    case "grabgame":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_grabs/i_games) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_grabs/i_games) " . $order;
        $stat_header = "Grabs Per Game";
        break;
    case "grabhour":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_grabs/f_hours) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_grabs/f_hours) " . $order;
        $stat_header = "Grabs Per Hour";
        break;
    case "dropgame":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_drops/i_games) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_drops/i_games) " . $order;
        $stat_header = "Drops Per Game";
        break;
    case "drophour":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_drops/f_hours) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_drops/f_hours) " . $order;
        $stat_header = "Drops Per Hour";
        break;
    case "hourgame":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (f_hours/(i_games-i_dcs))*60 as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (f_hours/(i_games-i_dcs)) " . $order;
        $stat_header = "Minutes Per Game";
        break;
    case "points":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_points as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_points " . $order;
        $stat_header = "Points";
        break;
    case "pointgame":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_points/i_games) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_points/i_games) " . $order;
        $stat_header = "Points Per Game";
        break;
    case "pointhour":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_points/f_hours) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_points/f_hours) " . $order;
        $stat_header = "Points Per Hour";
        break;
    case "holdgame":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_hold/i_games) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_hold/i_games) " . $order;
        $stat_header = "Hold Per Game <span style='font-size: 10px;'>(in seconds)</span>";
        if ($record_string == "user_all_record") {
            $stat_header = "Hold Per Game <span style='font-size: 10px;'>(in seconds)</span><br><span style='font-size: 9px; font-weight:normal;'>*results inaccurate for users who played prior to Jan 2014</span>";
        }
        break;
    case "holdhour":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_hold/f_hours) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_hold/f_hours) " . $order;
        $stat_header = "Hold Per Hour <span style='font-size: 10px;'>(in seconds)</span>";
        if ($record_string == "user_all_record") {
            $stat_header = "Hold Per Game <span style='font-size: 10px;'>(in seconds)</span><br><span style='font-size: 9px; font-weight:normal;'>*results inaccurate for users who played prior to Jan 2014</span>";
        }
        break;
    case "holdgrab":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_hold/i_grabs) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_hold/i_grabs) " . $order;
        $stat_header = "Hold Per Grab <span style='font-size: 10px;'>(in seconds)</span>";
        if ($record_string == "user_all_record") {
            $stat_header = "Hold Per Game <span style='font-size: 10px;'>(in seconds)</span><br><span style='font-size: 9px; font-weight:normal;'>*results inaccurate for users who played prior to Jan 2014</span>";
        }
        break;
    case "preventgame":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_prevent/i_games) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_prevent/i_games) " . $order;
        $stat_header = "Prevent Per Game <span style='font-size: 10px;'>(in seconds)</span>";
        if ($record_string == "user_all_record") {
            $stat_header = "Hold Per Game <span style='font-size: 10px;'>(in seconds)</span><br><span style='font-size: 9px; font-weight:normal;'>*results inaccurate for users who played prior to Jan 2014</span>";
        }
        break;
    case "preventhour":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_prevent/f_hours) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_prevent/f_hours) " . $order;
        $stat_header = "Prevent Per Hour <span style='font-size: 10px;'>(in seconds)</span>";
        if ($record_string == "user_all_record") {
            $stat_header = "Hold Per Game <span style='font-size: 10px;'>(in seconds)</span><br><span style='font-size: 9px; font-weight:normal;'>*results inaccurate for users who played prior to Jan 2014</span>";
        }
        break;
    case "supportgame":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_support/i_games) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_support/i_games) " . $order;
        $stat_header = "Support Per Game";
        if ($record_string == "user_all_record") {
            $stat_header = "Hold Per Game <span style='font-size: 10px;'>(in seconds)</span><br><span style='font-size: 9px; font-weight:normal;'>*results inaccurate for users who played prior to Jan 2014</span>";
        }
        break;
    case "supporthour":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, (i_support/f_hours) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by (i_support/f_hours) " . $order;
        $stat_header = "Support Per Hour";
        if ($record_string == "user_all_record") {
            $stat_header = "Hold Per Game <span style='font-size: 10px;'>(in seconds)</span><br><span style='font-size: 9px; font-weight:normal;'>*results inaccurate for users who played prior to Jan 2014</span>";
        }
        break;
    case "keptflags":
        $select_string = "select p.vc_server_name, r.dt_last_update, r.vc_name, i_grabs-(i_captures+i_drops) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_grabs-(i_captures+i_drops) " . $order;
        $stat_header = "Kept Flags";
        break;

    default:
        $select_string = "select p.vc_server_name, r.dt_last_update,  r.vc_name, (i_wins/i_games) as stat,  if(i_games < 50, '*', '') as asterisk ";
        $order_string = " order by i_wins " . $order;
        $stat_header = "Wins";
        break;
}

/* PAGINATION */
$records_per_page = $rows;
$start = $page * $records_per_page;
$sql = "select p.bi_user_id from user_profile p join " . $table_string . " " . $where_string;
$result = mysqli_query($con, $sql);
$total_records = mysqli_num_rows($result);
$total_pages = ceil($total_records / $records_per_page);
$actual_page = $page + 1;

/*RUN THE QUERY AND GENERATE THE TABLE*/
if ($range != null && $stat != null) {

    $sql = $select_string . ", vc_profile_string, r.bi_user_id "
        . "from user_profile p join "
        . $table_string
        . $where_string
        . $order_string
        . " limit " . $start . "," . $records_per_page;
    $result = mysqli_query($con, $sql);

    $rank = 1 + $start;
    echo "<table class='leaderTable table'>";
    echo "<tr><th>Rank</th><th class=\"last_updated\">Updated</th><th>Name</th><th>" . $stat_header . "</th>";
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        echo "<tr><td class='leaderTable'>" . $rank
            . "</td><td class='last_updated'>" . humanizeDateDifference(time(), strtotime($row['dt_last_update']))
            . "</td><td class='leaderTable'><a href='profile.php?userid=" . $row['bi_user_id'] . "'>" . $row['vc_name'] . "</a>" . $row['asterisk']
            . "</td><td class='leaderTable'>" . $row['stat'] . "</td></tr>";
        $rank++;
    }
    echo "</table>";
    /* Pagination UI */

    echo "<table style='width: 100%;'><tr>";
    if ($actual_page == 1) {
        echo "<td> <button class=\"btn btn-default btn-sm pull-left\" disabled>Previous</button> </td>";
    } else {
        echo "<td> <button class=\"btn btn-default btn-sm pull-left\" onclick='getLeaderboard(" . ($page - 1) . ", \"#LeaderBoard\", \"" . $range . "\", " . $game . ", \"" . $stat . "\", \"" . $rows . "\", \"" . $order . "\", \"" . $active . "\")'>Previous</button> </td>";
    }
    echo "<td> Page " . $actual_page . " of " . $total_pages . "</td>";
    if ($actual_page == $total_pages) {
        echo "<td> <button class=\"btn btn-default btn-sm pull-right\"> disabled>Next</button> </td>";
    } else {
        echo "<td> <button class=\"btn btn-default btn-sm pull-right\" onclick='getLeaderboard(" . ($page + 1) . ", \"#LeaderBoard\", \"" . $range . "\", " . $game . ", \"" . $stat . "\", \"" . $rows . "\", \"" . $order . "\", \"" . $active . "\")'>Next</button> </td>";
    }

} else {
    echo "Error Getting Table. You broke it!";
}

mysqli_close($con);
?>
