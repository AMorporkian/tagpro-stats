<?php

include 'config.php';
include 'grab_statsv2.php';

/* Initialize Variables from url */
if ((isset($_GET['password']))) {
    $password = $_GET['password'];
} else {
    $password = null;
}

if ($password = "sammypants") {
    /* intialize url string */
    $url = "http://tagpro-origin.koalabeast.com/boards";
    /* Mean Function */
    $output = addslashes(file_get_contents($url));
    $i = 0;
    while (strpos($output, "/profile/") != false) {
        $pos = strpos($output, "/profile/") + 9;
        $output = substr($output, $pos);
        $pos = strpos($output, "\"") - 1;
        $profile[$i] = substr($output, 0, $pos);
        $i++;
    }
    for ($j = 0; $j < $i; $j++) {
        /* check if record already exists */
        $sql = "select * from user_profile where vc_profile_string='" . $profile[$j] . "'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) < 1) { //Record Does Not Exist, insert record
            $sql = "insert into user_profile (vc_profile_string) values('" . $profile[$j] . "')";
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
                echo $profile[$j] . "<span style='font-size: 13px; color: #11ee00; font-weight: bold;'>Profile Successfully Added.</span><br>";
            } else {
                echo $profile[$j] . "<span style='font-size: 13px; color: red; font-weight: bold;'>Error. Please Try Again.</span><br>";
            }
        } else { //Record Does Exist
            echo $profile[$j] . "<span style='font-size: 13px; color: red; font-weight: bold;'>Profile Already Exists.</span><br>";
        }
    }
    mysqli_close($con);

} else {
    echo "uh uh uh. you didn't say the magic word";
}


?>