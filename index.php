<?php
require_once 'vendor/autoload.php';
require_once 'humanize.php';
$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, array());
$humanize = new Twig_SimpleFunction('humanize', function ($d) {
    return humanizeDateDifference("now");
});
echo $twig->render('index.html', array());