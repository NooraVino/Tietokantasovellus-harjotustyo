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
      View::make('suunnitelmat/listaussivu.html');
    }
    
    public static function reseptin_esittely(){
      View::make('suunnitelmat/reseptin_esittely.html');
    }
    
    public static function login(){
      View::make('suunnitelmat/login.html');
    }
  }
