<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'app/models/resepti.php';

class ReseptiController extends BaseController {
   
    public static function index() {
        $reseptit = resepti::haeKaikki();
        View::make('suunnitelmat/etusivu.html', array('reseptit' => $reseptit));     
    }
   
    public static function store() {
        $params = $_POST;
    
        $resepti = new Resepti(array(
            'nimi' => $params['nimi'],
            'valmistusaika' => $params['valmistusaika'],
            'valmistusohje' => $params['valmistusohje']
               ));
         
        Kint::dump($params);
        $resepti->tallenna();
        
    }
    public static function show($tunnus) {
       $resepti = resepti::haeResepti($tunnus);
        View::make('suunnitelmat/resepti.html', array('resepti' => $resepti));      
    }
    public static function luoUusi(){
      View::make('suunnitelmat/uusi.html');
    }
    public static function edit($tunnus) {
      $resepti = resepti::haeResepti($tunnus); 
      View::make('suunnitelmat/edit.html', array('resepti' => $resepti));
    }
    public static function update($tunnus){
    $params = $_POST;

    $attributes = array(
      'tunnus' => $tunnus,
      'nimi' => $params['nimi'],
      'valmitusaika' => $params['valmistusaika'],
      'valmistusohje' => $params['valmistusohje']
    );
    $resepti = new Resepti($attributes);
      $resepti->update();
  }
  public static function destroy($tunnus){
    $resepti = new Resepti(array('tunnus' => $tunnus));
    $resepti->destroy($tunnus);

    // Ohjataan käyttäjä pelien listaussivulle ilmoituksen kera
    Redirect::to('/suunnitelmat/etusivu.html', array('message' => 'Peli on poistettu onnistuneesti!'));
  }

  
}
