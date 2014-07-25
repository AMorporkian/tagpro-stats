<?php

include 'config.php';
include 'grab_statsv2.php';

/* Initialize Variables from url */
if ((isset($_GET['profile']))) {
    $profile = $_GET['profile'];
} else {
    $profile = null;
}

/* intialize url string */
$url = "http://tagpro-origin.koalabeast.com/profile/" . $profile;

/* Mean Function */
if ($profile != null && $url != null) {

    $output = file_get_contents($url);
    $pos = strpos($output, "<h3>");

    if ($pos != false) {
        /* check if record already exists */
        $sql = "select * from user_profile where vc_profile_string='" . $profile . "'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) < 1) { //Record Does Not Exist, insert record
            $sql = "insert into user_profile (vc_profile_string) values('" . $profile . "')";
            $result = mysqli_query($con, $sql);
            if ($result != false) {
                $id = mysqli_insert_id($con);
                $sql = "insert into user_all_record (bi_user_id) values(" . $id . ")";
                $result = mysqli_query($con, $sql);
                $sql = "insert into user_week_record (bi_user_id) values(" . $id . ")";
                $result = mysqli_query($con, $sql);
                $sql = "insert into user_month_record (bi_user_id) values(" . $id . ")";
                $result = mysqli_query($con, $sql);
                $sql = "insert into user_all_stats (bi_user_id) values(" . $id . ")";
                $result = mysqli_query($con, $sql);
                $sql = "insert into user_week_stats (bi_user_id) values(" . $id . ")";
                $result = mysqli_query($con, $sql);
                $sql = "insert into user_month_stats (bi_user_id) values(" . $id . ")";
                $result = mysqli_query($con, $sql);
                grabStats($id, 0);
                echo "<span style='font-size: 13px; color: #11ee00; font-weight: bold;'>Profile Successfully Added.</span>";
            } else {
                echo "<span style='font-size: 13px; color: red; font-weight: bold;'>Error. Please Try Again.</span>";
            }
        } else { //Record Does Exist
            echo "<span style='font-size: 13px; color: red; font-weight: bold;'>Profile Already Exists.</span>";
        }
    } else {
        echo "<span style='font-size: 13px; color: red; font-weight: bold;'>Error. Profile not found.</span>";
    }
} else {
    echo "<span style='font-size: 13px; color: red; font-weight: bold;'>Error. Please Try Again.</span>";
}

mysqli_close($con);

?>