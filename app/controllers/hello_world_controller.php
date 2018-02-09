<?php
require 'app/models/resepti.php';
  class HelloWorldController extends BaseController{

    public static function index(){
   	echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
    $kaikki = resepti::haeKaikki();
    $yksi = resepti::haeResepti(1);
    Kint::dump($kaikki);
    Kint::dump($yksi);
   
  
    }
    public static function uusi(){
      View::make('suunnitelmat/uusi.html');
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
    public static function ruokaLista(){
      View::make('suunnitelmat/ruokaLista.html');
    }
  }
