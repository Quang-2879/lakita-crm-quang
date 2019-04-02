<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function timestamp_from_format($date = '12/4/2017 22:54'){
        $date = date_parse_from_format("m/d/Y H:i", $date); 
        $year = $date['year'];
        $month = $date['month'];
        $day = $date['day'];
        $hour = $date['hour'];
        $minute = $date['minute'];
       return strtotime("$year-$month-$day $hour:$minute");
}