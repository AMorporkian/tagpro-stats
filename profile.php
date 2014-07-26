<?php

include 'config.php';
require_once 'vendor/autoload.php';

if (isset($_GET['userid'])) {
    $user_id = $_GET['userid'];
} else {
    $user_id = null;
}


if ($user_id != null && is_numeric($user_id)) {
    $sql = "SELECT * FROM profile_stats WHERE bi_user_id='" . $user_id . "'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

}
$addSuffix = new Twig_SimpleFunction('addSuffix', function ($n)
{
    if ($n == 1 || ($n > 10 && ($n - 11) % 10 == 0 && substr($n, -2) != 11)) return $n . 'st';
    if ($n == 2 || ($n > 10 && ($n - 12) % 10 == 0 && substr($n, -2) != 12)) return $n . 'nd';
    if ($n == 3 || ($n > 10 && ($n - 13) % 10 == 0 && substr($n, -2) != 13)) return $n . 'rd';
    return $n . 'th';
});
$numberFormat = new Twig_SimpleFunction('numberFormat', function($a) {
    return number_format($a, 2);
});

$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, array());
$twig->addFunction($addSuffix);
$twig->addFunction($numberFormat);

$sql = "SELECT COUNT(bi_user_id) as UserCount FROM profile_stats WHERE i_games_m > 10";
$result = mysqli_query($con, $sql);
$ballCount = mysqli_fetch_assoc($result)['UserCount'];

echo $twig->render('profile.html', array("row" => $row, "month" => date('F'), "ballCount" => $ballCount));