<?php


class Kategoria extends BaseModel {
    public $tunnus, $nimi;

 public function __constructor($attributes) {
     parent::__constructor($attributes);
     $this->validators = array('validate_nimi');
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
  
  public function save() {

        $query = DB::connection()->prepare('INSERT INTO Kategoria (nimi) VALUES (:nimi) RETURNING tunnus');

        $query->execute(array('nimi' => $this->nimi));

        $row = $query->fetch();

        $this->tunnus = $row['tunnus'];
    }
public function destroy() {

        $query = DB::connection()->prepare('DELETE FROM Kategoria WHERE tunnus = :tunnus');
        $query->execute(array('tunnus' => $this->tunnus));
    }
    
     public static function haePoistettava($tunnus) {
        $query = DB::connection()->prepare('SELECT Kategoria.tunnus, Kategoria.nimi FROM Kategoria LEFT JOIN Resepti ON Resepti.kategoria = Kategoria.tunnus WHERE Resepti.kategoria is null AND Kategoria.tunnus = :tunnus');
        $query->execute(array('tunnus' => $tunnus));
        $row = $query->fetch();

        if ($row) {
            $kategoria = new Kategoria(array(
                'tunnus' => $row['tunnus'],
                'nimi' => $row['nimi']
            ));

            return $kategoria;
        }

        return null;
    }

}