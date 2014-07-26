<?php

/* index.html */
class __TwigTemplate_60210e781c35b84183d8f8b904c773a48fdb4a50d8ac9b67e10ff8247e941927 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">

<head>

    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    <title>TagPro Stats</title>

    <!-- Bootstrap Core CSS -->
    <link href=\"../css/bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"../css/main.css\" rel=\"stylesheet\">

    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 70px;
            /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
    <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
    <![endif]-->

</head>

<body onload=\"firstRun();\">

<!-- Navigation -->
<nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">
    <div class=\"container\">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class=\"navbar-header\">
            <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\"
                    data-target=\"#bs-example-navbar-collapse-1\">
                <span class=\"sr-only\">Toggle navigation</span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
            </button>
            <a class=\"navbar-brand\" href=\"#\">TagPro Stats</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
            <ul class=\"nav navbar-nav\">
                <li>
                    <a href=\"http://tagpro.koalabeast.com/\">Play TagPro</a>
                </li>
                <li>
                    <a href=\"http://www.reddit.com/r/tagpro\">Discuss TagPro</a>
                </li>
                <li>
                    <a href=\"http://www.twitch.tv/tagprotv\">Watch TagPro</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class=\"container\">

    <div class=\"row\">
        <div class=\"col-lg-8 col-md-12 col-sm-12\">
            <div class=\"panel panel-default\">
                <div class=\"panel-heading\">
                    <table class=\"table\">
                        <tr>
                            <th class=\"header\" colspan=8>The TagPro Leaderboard</th>
                        </tr>
                        <tr>
                            <td>Timeframe</td>
                            <td>Last played</td>
                            <td>Games</td>
                            <td>Sort by</td>
                            <td>Row count</td>
                            <td>Order</td>
                        </tr>
                        <tr>
                            <td>
                                <select id=\"SelectRange\" class=\"leaderBoardSelect\">
                                    <option value=\"all\">All</option>
                                    <option value=\"month\">Monthly</option>
                                    <option value=\"week\">Weekly</option>
                                </select>
                            </td>
                            <td>
                                <select id=\"SelectActive\">
                                    <option value=\"0\" selected=\"selected\">Anytime</option>
                                    <option value=\"1\">-1 Day</option>
                                    <option value=\"3\">-3 Days</option>
                                    <option value=\"7\">-7 Days</option>
                                    <option value=\"30\">-30 Days</option>
                                    <option value=\"180\">-180 Days</option>
                                    <option value=\"365\">-365 Days</option>
                                </select>
                            </td>
                            <td>
                                <select id=\"SelectGame\">
                                    <option value=\"0\">> 0</option>
                                    <option value=\"10\">> 10</option>
                                    <option value=\"50\">> 50</option>
                                    <option value=\"100\" selected=\"selected\">> 100</option>
                                    <option value=\"200\">> 200</option>
                                    <option value=\"500\">> 500</option>
                                    <option value=\"1000\">> 1000</option>
                                </select>
                            </td>
                            <td>
                                <select id=\"SelectStat\">
                                    <optgroup label=\"Win/Loss\">
                                        <option value=\"winpercent\">Win %</option>
                                        <option value=\"wins\">Wins</option>
                                        <option value=\"losses\">Losses</option>
                                        <option value=\"games\">Games</option>
                                        <option value=\"winpercentnodcs\">Win % (DCs Excluded)</option>
                                    </optgroup>
                                    <optgroup label=\"Caps/Returns/Tags\">
                                        <option value=\"tags\">Tags</option>
                                        <option value=\"taggame\">Tags/Game</option>
                                        <option value=\"taghour\">Tags/Hour</option>
                                        <option value=\"returns\">Returns</option>
                                        <option value=\"returngame\">Returns/Game</option>
                                        <option value=\"returnhour\">Returns/Hour</option>
                                        <option value=\"captures\">Captures</option>
                                        <option value=\"capgame\">Captures/Game</option>
                                        <option value=\"caphour\">Captures/Hour</option>
                                    </optgroup>
                                    <optgroup label=\"Grabs/Drops/Pops\">
                                        <option value=\"grabs\">Grabs</option>
                                        <option value=\"grabgame\">Grabs/Game</option>
                                        <option value=\"grabhour\">Grabs/Hour</option>
                                        <option value=\"drops\">Drops</option>
                                        <option value=\"dropgame\">Drops/Game</option>
                                        <option value=\"drophour\">Drops/Hour</option>
                                        <option value=\"popped\">Popped</option>
                                        <option value=\"popgame\">Popped/Game</option>
                                        <option value=\"pophour\">Popped/Hour</option>
                                    </optgroup>
                                    <optgroup label=\"Hold/Prevent/Support\">
                                        <option value=\"hold\">Hold</option>
                                        <option value=\"holdgame\">Hold/Game</option>
                                        <option value=\"holdhour\">Hold/Hour</option>
                                        <option value=\"prevent\">Prevent</option>
                                        <option value=\"preventgame\">Prevent/Game</option>
                                        <option value=\"preventhour\">Prevent/Hour</option>
                                        <option value=\"support\">Support</option>
                                        <option value=\"supportgame\">Support/Game</option>
                                        <option value=\"supporthour\">Support/Hour</option>
                                    </optgroup>
                                    <optgroup label=\"Miscellaneous\">
                                        <option value=\"capgrab\">Captures/Grab</option>
                                        <option value=\"tagpop\">Tag/Pop Ratio</option>
                                        <option value=\"holdgrab\">Hold/Grab</option>
                                        <option value=\"nrtags\">Non-Return Tags</option>
                                        <option value=\"nrtagsgame\">Non-Return Tags/Game</option>
                                        <option value=\"nrtagshour\">Non-Return Tags/Hour</option>
                                        <option value=\"keptflags\">Kept Flags</option>
                                    </optgroup>
                                    <optgroup label=\"Points/Hours/DCs\">
                                        <option value=\"points\">Rank Points</option>
                                        <option value=\"pointgame\">Rank Points/Game</option>
                                        <option value=\"pointhour\">Rank Points/Hour</option>
                                        <option value=\"hours\">Hours</option>
                                        <option value=\"hourgame\">Minutes/Game</option>
                                        <option value=\"dcs\">Disconnects</option>
                                    </optgroup>
                                </select>
                            </td>
                            <td>
                                <select id=\"SelectRow\">
                                    <option value=\"10\">10</option>
                                    <option value=\"20\">20</option>
                                    <option value=\"50\">50</option>
                                    <option value=\"100\" selected=\"selected\">100</option>
                                    <option value=\"250\">250</option>
                                    <option value=\"500\">500</option>
                                    <option value=\"1000\">1000</option>
                                </select>
                            </td>
                            <td>
                                <select id=\"SelectOrder\">
                                    <option value=\"desc\">Desc</option>
                                    <option value=\"asc\">Asc</option>
                                </select>
                            </td>
                            <td>
                                <div style=\"border: 1px solid black; font-size: 11px;\">
                                    <table>
                                        <tr>
                                            <td style=\"padding-left: 2px; padding-right: 2px;\"><input type=\"checkbox\"
                                                                                                      id=\"mltpCheck\"
                                                                                                      value=\"1\"/></td>
                                            <td style=\"text-align: center; width: 50;\">Only MLTP Registered</td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                            <td>
                                <button style=\"width: 100%;\"
                                        onclick=\"getLeaderboard(0, '#LeaderBoard', \$('#SelectRange').val(), \$('#SelectGame').val(), \$('#SelectStat').val(), \$('#SelectRow').val(), \$('#SelectOrder').val(), \$('#SelectActive').val() )\">
                                    Generate New Leaderboard
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class=\"panel-body\" id=\"LeaderBoard\">
                    <img src=\"../img/ajax-loader.gif\">
                </div>
            </div>
        </div>
        <div class=\"col-lg-4 col-md-12 col-sm-12\">
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <div class=\"panel panel-default\">
                        <div class=\"panel-heading\"><label for=\"autocompleteTextBox\">Search Player Profile By
                            Name</label></div>
                        <div class=\"panel panel-body\">
                            <div style=\"margin-top: 4px;\">
                                <input type=\"text\" style=\"width: 98%;\" id=\"autocompleteTextBox\"
                                       onkeyup=\"populateAutoComplete();\">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <div class=\"panel panel-default\">
                        <div class=\"panel-heading\">
                            Monthly Leaders
                        </div>
                        <div class=\"panel-body\" id=\"MonthlyStatLeaders\">
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <div class=\"panel panel-default\">
                        <div class=\"panel-heading\">
                            Can't Find Your Name? Add Yourself!
                        </div>
                        <div class=\"panel-body\">
                            <table>
                                <tr>
                                    <td style=\"width: 50%; text-align: center; vertical-align: bottom;\">
                                        <span style=\"font-size: 14px;\">Enter your Profile ID</span><br><input type=\"text\" name=\"\"
                                                                                                              id=\"profileInpt\" size=\"25\">
                                    </td>
                                    <td style=\"width: 50%;  vertical-align: bottom;\">
                                        <button onclick=\"submitProfile()\">Add Your Stats To The Rankings</button>
                                        <br>

                                        <div id=\"submitMsgDiv\"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=\"2\" style=\"font-size: 12px; padding-top: 10;\">
                                        What's your <b>Profile ID</b>? It is the hex value that appears at the end of the url on your
                                        profile page.
                                        Just login to any server, click <b>Profile</b>, and copy/paste the value into the box above.
                                        <br>ex: http://tagpro-pi.koalabeast.com/profile/<b>XXXXXXXXXXXXXXXXXXXXXXXX</b>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

</body>
<script src=\"../js/jquery-1.11.0.js\"></script>
<script src=\"../js/bootstrap.min.js\"></script>
<script src=\"../js/main.js\"></script>

</html>
";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
