<?php
    //VARIABLES -- EDIT THIS VALUES
    $userID = '2226023'; //THIS IS FOR JOÃO RAMOS! PUT YOUR OWN IN HERE
    $sport = '0';
    /* Edit this if you want to change the sport
     * 0 - Running
     * 1 - Cycling, transport
     * 2 - Cycling, sport
     * 3 - Mountain Biking
     * 4 - Skating
     * 5 - Roller Skiing
     * 6 - Skiing, cross country
     * 7 - Skiing, downhill
     * 8 - Snowboarding
     * ...
     * 94 - Treadmill walking
     */
    
    //GET DATE
    $to = date('Ymd'); //Today's date
    $from = date('Ymd', strToTime('-6 days')); //One week ago
    // <!-- DATE -->
    function GetBetween($content,$start,$end){
        $r = explode($start, $content);
        if (isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }
    //GET CONTENTS
    $data = file_get_contents('http://www.endomondo.com/embed/user/summary?id='.$userID.'&sport='.$sport.'&from='.$from.'&to='.$to.'&measure=0&zone=Gm0000_GMT&width=680&height=217');
    $distance = strip_tags(GetBetween($data, '<th>Distance:</th>', '</td>'));
    $duration = strip_tags(GetBetween($data, '<th>Duration:</th>', '</td>'));

    //PRINT TO FILES
    $fp = fopen('workout-duration.txt', 'w');
    fwrite($fp, $duration);
    fclose($fp);
    $fp = fopen('workout-lenght.txt', 'w');
    fwrite($fp, $distance);
    fclose($fp);
?>