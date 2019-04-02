<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function ReArrangeContactsByBillCheck($contacts){
    if (empty($contacts)) {
        return array();
    }
    $billArr = [];
    foreach($contacts as $value){
        $billArr[] = $value['code_cross_check'];
    }
    $billArr = array_unique($billArr);
    $billArr = ReArrangeBillCheck($billArr);
    $ResultContacts = [];
    foreach ($billArr as $Bill){
        foreach($contacts as $key => $value){
            if($value['code_cross_check'] == $Bill){
                $ResultContacts[] = $contacts[$key];
            }
        }
    }
    return $ResultContacts;
}


function ReArrangeBillCheck($billArr) {
    $numberOrderedArr = ConvertToNumberArr($billArr);
    sort($numberOrderedArr);
    return ConvertToBillOrderArr($numberOrderedArr);
}

function ConvertToNumberArr($billArr) {
    $numberArr = array();
    if (is_array($billArr) && !empty($billArr)) {
        foreach ($billArr as $value) {
            $day = substr($value, 6, 2);
            $month = substr($value, 8, 2);
            $order = substr($value, 10);
            $numberArr[] = $month . $day . $order;
        }
    }
    return $numberArr;
}

function ConvertToBillOrderArr($numberOrderedArr) {
    $billOrderArr = array();
    if (is_array($numberOrderedArr) && !empty($numberOrderedArr)) {
        foreach ($numberOrderedArr as $value) {
            $month = substr($value, 0, 2);
            $day = substr($value, 2, 2);
            $order = substr($value, 4);
            $billOrderArr[] = 'LAKITA' . $day . $month . $order;
        }
    }
    return $billOrderArr;
}
