<?php
require 'app/models/resepti.php';
  class HelloWorldController extends BaseController{

    public static function index(){
   	echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
    
    $resepti = resepti::haeResepti(2);
    $kaikki = resepti::haeKaikki();
    Kint::dump($kaikki);
    Kint::dump($resepti);
  
    }
    
    public static function listaus_sivu(){
      View::make('suunnitelmat/listaus_sivu.html');
    }
    
    public static function resepti(){
      View::make('suunnitelmat/resepti.html');
    }
    
     public static function etusivu(){
      View::make('suunnitelmat/etusivu.html');
    }
    
    public static function login(){
      View::make('suunnitelmat/login.html');
    }
  }
