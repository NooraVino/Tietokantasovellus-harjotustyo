<?php


class Resepti extends BaseModel{
    public $tunnus, $nimi, $valmistusaika, $valmistusohje;

public function __construct($attributes){
    parent::__construct($attributes);
  }

 
 public static function haeKaikki(){
 
    $query = DB::connection()->prepare('SELECT * FROM Resepti');
    $query->execute();
    $rows = $query->fetchAll();
    $reseptit = array();

  
    foreach($rows as $row){
     
      $reseptit[] = new Resepti (array(
        'tunnus' => $row['tunnus'],
        'nimi' => $row['nimi'],
        'valmistusaika' => $row['valmistusaika']     
        ));
    }

    return $reseptit;
  }
  
  public static function haeResepti($tunnus){
    $query = DB::connection()->prepare('SELECT * FROM Resepti WHERE tunnus = :tunnus LIMIT 1');
    $query->execute(array('tunnus' => $tunnus));
    $row = $query->fetch();

    if($row){
      $resepti = new Resepti(array(
        'tunnus' => $row['tunnus'],
        'nimi' => $row['nimi'],
        'valmistusaika' => $row['valmistusaika'],
        'valmistusohje' => $row['valmistusohje']
        ));

      return $resepti;
    }

    return null;
  }
  
 
}


