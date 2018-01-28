<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
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
