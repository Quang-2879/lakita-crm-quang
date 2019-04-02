<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cod2
 *
 * @author phong
 */
include_once (dirname(__FILE__) . "/Cod.php");


class Cod2 extends Cod{
     public function __construct() {
        parent::__construct();
    }

    public function index($offset = 0){
        echo '1';
    }
}
