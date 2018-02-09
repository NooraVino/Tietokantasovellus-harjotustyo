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
        'valmistusaika' => $row['valmistusaika'], 
        'valmistusohje' => $row['valmistusohje']      
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
  
  public function tallenna(){
                                                                                                      
    $query = DB::connection()->prepare('INSERT INTO Resepti (nimi, valmistusaika, valmistusohje) VALUES (:nimi, :valmistusaika, :valmistusohje) RETURNING tunnus');
   
    $query->execute(array('nimi' => $this->nimi, 'valmistusaika' => $this->valmistusaika, 'valmistusohje' => $this->valmistusohje));
  
    $row = $query->fetch();

    $this->tunnus = $row['tunnus'];
    
  }
  
 public function update(){
                                                                                                      
    $query = DB::connection()->prepare('UPDATE Resepti (nimi, valmistusaika, valmistusohje) VALUES (:nimi, :valmistusaika, :valmistusohje) RETURNING tunnus');
   
    $query->execute(array('nimi' => $this->nimi, 'valmistusaika' => $this->valmistusaika, 'valmistusohje' => $this->valmistusohje));
  
    $row = $query->fetch();

    $this->tunnus = $row['tunnus'];
}

public function destroy(){
                                                                                                      
    $query = DB::connection()->prepare('DELETE FROM Resepti WHERE tunnus=:tunnus') ;
    $row = $query->fetch();
    $this->tunnus = $row['tunnus'];

}

}

