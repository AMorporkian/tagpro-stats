$.ajaxSetup({cache: false});//turn off ajax caching

var currentPage = 0;
var currentUrlHash;
$(document).ready(function() {
    $("#refresh-btn").on("click", function() { getLeaderboard(); });
    $(".leaderboard-controls select").on("change", function() { currentPage = 0; getLeaderboard(); });
    $("#LeaderBoard").on("click", ".prev-btn", function() { currentPage--; getLeaderboard(); });
    $("#LeaderBoard").on("click", ".next-btn", function() { currentPage++; getLeaderboard(); });
//    $("#permalink-btn").on("click", function() {
//        $("#permalink-txt").text("http://tagpro-stats.com/" + currentUrlHash);
//        $("#permalink-txt").attr("href", "/" + currentUrlHash);
//        $("#permalink-txt").toggleClass("hidden");
//    });
    parseURL();
    getUserCount();
    getStatLeaders("month", "#MonthlyStatLeaders");
    getStatLeaders("week", "#WeeklyStatLeaders");
    getLeaderboard();
});

function parseURL() {
    var Q = function () {
        var query_string = {};
        var query = window.location.hash.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (typeof query_string[pair[0]] === "undefined") {
                query_string[pair[0]] = pair[1];
            } else if (typeof query_string[pair[0]] === "string") {
                var arr = [ query_string[pair[0]], pair[1] ];
                query_string[pair[0]] = arr;
            } else {
                query_string[pair[0]].push(pair[1]);
            }
        }
        return query_string;
    }();

    // set anything that was in the url
    if(Q.range != undefined) {
        $('#SelectRange').val(Q.range);
    }
    if(Q.stat != undefined) {
        $('#SelectStat').val(Q.stat);
    }
    if(Q.game != undefined) {
        $('#SelectGame').val(Q.game);
    }
    if(Q.row != undefined) {
        $('#SelectRow').val(Q.row);
    }
    if(Q.order != undefined) {
        $('#SelectOrder').val(Q.order);
    }
    if(Q.active != undefined) {
        $('#SelectActive').val(Q.active);
    }
    if(Q.page >= 0) {
        currentPage = Q.page;
    }
}

function submitProfile() {

    $('#submitMsgDiv').html("");

    var isValid = true;
    var errorMsg = "";
    var profile = $("#profileInpt").val();

    if (profile.match(/[^A-Za-z0-9]+/) || profile.length < 1) {
        isValid = false;
        errorMsg += " Invalid Profile ID ";
    }

    if (!isValid) {
        alert(errorMsg);
    } else {/*Call AJAX to check validity & insert record*/
        var dataString = "&profile=" + profile;
        $.ajax({
            type: "GET",
            url: 'parse_url.php',
            data: "&profile=" + profile,
            success: function (data) {
                $('#submitMsgDiv').html(data);
            }
        });
    }
}

function getLeaderboard() {
    var page = currentPage;
    var board = "#LeaderBoard";
    var range = $('#SelectRange').val();
    var game = $('#SelectGame').val();
    var stat = $('#SelectStat').val();
    var row = $('#SelectRow').val();
    var order = $('#SelectOrder').val();
    var active = $('#SelectActive').val();

    //TODO: validate values here

    $(board).html("<img src='img/ajax-loader.gif'>");
    var mltp = 0;
    $.ajax({
        type: "GET",
        url: 'get_table.php',
        data: "range=" + range + "&stat=" + stat + "&page=" + page + "&game=" + game + "&row=" + row + "&order=" + order + "&active=" + active + "&mltp=" + mltp,
        success: function (data) {
            $(board).html(data);
        }
    });
    currentUrlHash = '#range=' + range + '&stat=' + stat + '&page=' + page + '&game=' + game + "&row=" + row + "&order=" + order + "&active=" + active;
    $("#permalink-btn").attr("href", "/" + currentUrlHash);
}

function getUserCount() {
    $('#RegistrationCount').html("<img src='img/ajax-loader.gif'>");
    $.ajax({
        url: "user_count.php",
        success: function (data) {
            $('#RegistrationCount').html(data);
        }
    });
}

function getStatLeaders(range, theDiv) {
    $(theDiv).html("<img src='img/ajax-loader.gif'>");
    $.ajax({
        type: "GET",
        url: "get_leaders.php",
        data: "range=" + range,
        success: function (data) {
            $(theDiv).html(data);
        }
    });
}
$('#SelectStat').on('change', function () {
    if (this.value == 'drops' || this.value == 'dropgame' || this.value == 'drophour' || this.value == 'popped' || this.value == 'popgame' || this.value == 'pophour' || this.value == 'dcs') {
        $('#SelectOrder').val('asc');
    } else {
        $('#SelectOrder').val('desc');
    }
});

//Autocomplete Profile Page Search Functions Here
function populateAutoComplete() {
    var theString = encodeURIComponent($("#autocompleteTextBox").val());
    if (theString.length > 0) {
        $.ajax({
            type: "GET",
            url: "autocomplete.php",
            data: "string=" + theString,
            success: function (data) {
                if ($("#autocompleteTextBox").val().length > 0) {
                    $("#autocomplete-div").html(data);
                }
            }
        });
    } else {
        $("#autocomplete-div").html("");
    }
}
//SUBMITTING RECORDS FOR MLTP TABLE
function addNewRegistrants() {
    $("#mltpStatusDiv").html('processing...');
    document.getElementById("mltpSubmit").disabled = true;

    var idArray = $('#idArea').val().split('\n');

    $.ajax({
        type: "POST",
        url: "mltp_submit.php",
        data: { ids: idArray },
        //      dataType: "json",
        success: function () {
            $("#mltpStatusDiv").html("finished");
            document.getElementById("mltpSubmit").disabled = false;
        }
    });
}
