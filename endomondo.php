<?php

    $userID = ''; // User ID
    $sport = '0';
    /*
        0 - Running
        1 - Cycling, transport
        2 - Cycling, sport
        3 - Mountain Biking
        4 - Skating
        5 - Roller Skiing
        6 - Skiing, cross country
        7 - Skiing, downhill
        8 - Snowboarding
        ...
        94 - Treadmill walking
    */
    
    // Get date (last 7 days)
    $to = date('Ymd'); // Today's date
    $from = date('Ymd', strToTime('-6 days')); // Last week

    function GetBetween($content,$start,$end){
        $r = explode($start, $content);
        if (isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }

    // Get contents
    $data = file_get_contents('http://www.endomondo.com/embed/user/summary?id='.$userID.'&sport='.$sport.'&from='.$from.'&to='.$to.'&measure=0&zone=Gm0000_GMT&width=680&height=217');
    $distance = strip_tags(GetBetween($data, '<th>Distance:</th>', '</td>'));
    $duration = strip_tags(GetBetween($data, '<th>Duration:</th>', '</td>'));

    // Print to files
    $fp = fopen('workout-duration.txt', 'w');
    fwrite($fp, $duration);
    fclose($fp);
    $fp = fopen('workout-lenght.txt', 'w');
    fwrite($fp, $distance);
    fclose($fp);

    // Optional: Read the files
    $lenght = fopen("workout-lenght.txt", "r");
    $duration = fopen("workout-duration.txt", "r");
    $show_lenght = fread($lenght,8192);
    $show_duration = fread($duration,8192);                                                                                                   
    fclose($lenght);
    fclose($duration);
    echo $show_lenght.' ran in a total of '.$show_duration.'h';
?>
