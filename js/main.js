$.ajaxSetup({cache: false});//turn off ajax caching

$(document).ready(function() {
    firstRun();
});

function firstRun() {
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
    if (Q.range != undefined && Q.stat != undefined && Q.page != undefined && Q.game != undefined && Q.row != undefined && Q.order != undefined) {
        $('#SelectRange').val(Q.range);
        $('#SelectStat').val(Q.stat);
        $('#SelectGame').val(Q.game);
        $('#SelectRow').val(Q.row);
        $('#SelectOrder').val(Q.order);
        $('#SelectActive').val(Q.active);
        getLeaderboard(Q.page, '#LeaderBoard', Q.range, Q.game, Q.stat, Q.row, Q.order, Q.active);
    } else {
        getLeaderboard(0, '#LeaderBoard', $('#SelectRange').val(), $('#SelectGame').val(), $('#SelectStat').val(), $('#SelectRow').val(), $('#SelectOrder').val(), $('#SelectActive').val());
    }
    getUserCount();
    getStatLeaders("month", "#MonthlyStatLeaders");
    getStatLeaders("week", "#WeeklyStatLeaders");
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

function getLeaderboard(page, board, range, game, stat, row, order, active) {
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
    window.location.hash = 'range=' + range + '&stat=' + stat + '&page=' + page + '&game=' + game + "&row=" + row + "&order=" + order + "&active=" + active;


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
