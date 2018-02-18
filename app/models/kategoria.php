<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Kategoria extends Basemodel{
    public $tunnus, $nimi;

 public function _constructor($attributes) {
     parent::_constructor($attributes);
 }
 public static function haeKaikki(){
 
    $query = DB::connection()->prepare('SELECT * FROM Kategoria');
    $query->execute();
    $rows = $query->fetchAll();
    $kategoriat = array();

  
    foreach($rows as $row){
     
      $kategoriat[] = new Kategoria (array(
        'tunnus' => $row['tunnus'],
        'nimi' => $row['nimi']     
        ));
    }

    return $kategoriat;
  }
  public static function haeKategoria($tunnus){
    $query = DB::connection()->prepare('SELECT * FROM Kategoria WHERE tunnus = :tunnus LIMIT 1');
    $query->execute(array('tunnus' => $tunnus));
    $row = $query->fetch();

    if($row){
      $kategoria = new Kategoria(array(
        'tunnus' => $row['tunnus'],
        'nimi' => $row['nimi']
        ));

      return $kategoria;
    }

    return null;
  }
  

}