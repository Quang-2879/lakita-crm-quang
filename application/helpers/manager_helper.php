<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function sum_L8($L8) {
        $sum = 0;
        if (!empty($L8)) {
            foreach ($L8 as $value) {
                $sum += $value['price_purchase'];
            }
        }
        return $sum;
    }
