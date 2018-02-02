<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ReseptiController extends BaseController {
    public static function index() {
        $reseptit = Resepti::haeKaikki();
        View::make('suunnitelmat/etusivu.html', array('reseptit' => $reseptit));
        
    }
}
