<?php

class Kayttaja extends BaseModel {

    public $tunnus, $nimi, $salasana;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function haeKaikki() {

        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $query->execute();
        $rows = $query->fetchAll();
        $kayttajat = array();
        
        foreach ($rows as $row) {

            $kayttajat[] = new Kayttaja(array(
                'tunnus' => $row['tunnus'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));
        }

        return $kayttajat;
    }

    public static function authenticate($nimi, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi AND salasana = :salasana LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
            $kayttaja = new Kayttaja(array(
                'tunnus' => $row['tunnus'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));

            return $kayttaja;
        } else {
            return null;
        }
    }

    public static function haeKayttaja($tunnus) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE tunnus = :tunnus LIMIT 1');
        $query->execute(array('tunnus' => $tunnus));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja(array(
                'tunnus' => $row['tunnus'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));

            return $kayttaja;
        }

        return null;
    }

}
