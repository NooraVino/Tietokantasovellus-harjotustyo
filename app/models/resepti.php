<?php

class Resepti extends BaseModel {

    public $tunnus, $nimi, $valmistusaika, $kayttaja, $kategoria, $valmistusohje;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_valmistusaika');
    }

    public static function haeKaikki() {

        $query = DB::connection()->prepare('SELECT Resepti.tunnus, Resepti.nimi, Resepti.valmistusaika, Kayttaja.nimi AS kayttaja, Kategoria.nimi AS kategoria FROM Resepti, Kayttaja, Kategoria WHERE Kayttaja.tunnus = Resepti.kayttaja AND Kategoria.tunnus = Resepti.Kategoria');
        $query->execute();
        $rows = $query->fetchAll();
        $reseptit = array();


        foreach ($rows as $row) {

            $reseptit[] = new Resepti(array(
                'tunnus' => $row['tunnus'],
                'nimi' => $row['nimi'],
                'valmistusaika' => $row['valmistusaika'],
                'kategoria' => $row['kategoria'],
                'kayttaja' => $row['kayttaja']
            ));
        }

        return $reseptit;
    }

    public static function haeKaikkiKayttajan($kayttaja) {

        $query = DB::connection()->prepare('SELECT Resepti.tunnus, Resepti.nimi, Resepti.valmistusaika, Resepti.kayttaja, Kategoria.nimi AS kategoria, Resepti.valmistusohje FROM Resepti INNER JOIN Kategoria ON Kategoria.tunnus = Resepti.kategoria WHERE Resepti.kayttaja = :kayttaja');
        $query->execute(array('kayttaja' => $kayttaja));
        $rows = $query->fetchAll();
        $reseptit = array();


        foreach ($rows as $row) {

            $reseptit[] = new Resepti(array(
                'tunnus' => $row['tunnus'],
                'nimi' => $row['nimi'],
                'valmistusaika' => $row['valmistusaika'],
                'kategoria' => $row['kategoria'],
                'kayttaja' => $row['kayttaja'],
                'valmistusohje' => $row['valmistusohje']
            ));
        }

        return $reseptit;
    }

    public static function haeResepti($tunnus) {
        $query = DB::connection()->prepare('SELECT Resepti.tunnus, Resepti.nimi, Resepti.valmistusaika, Kategoria.nimi AS kategoria, Resepti.valmistusohje  FROM Resepti INNER JOIN Kategoria ON Kategoria.tunnus = Resepti.kategoria WHERE Resepti.tunnus = :tunnus;');
        $query->execute(array('tunnus' => $tunnus));
        $row = $query->fetch();

        if ($row) {
            $resepti = new Resepti(array(
                'tunnus' => $row['tunnus'],
                'nimi' => $row['nimi'],
                'valmistusaika' => $row['valmistusaika'],
                'kategoria' => $row['kategoria'],
                'valmistusohje' => $row['valmistusohje']
            ));

            return $resepti;
        }

        return null;
    }

    public static function haeNimella($nimi) {
        $query = DB::connection()->prepare('SELECT Resepti.nimi FROM Resepti WHERE Resepti.nimi = :nimi');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();

        if ($row) {
            $resepti = new Resepti(array(
                'nimi' => $row['nimi']
            ));
            return $resepti;
        }
        return null;
    }

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Resepti (nimi, valmistusaika, kayttaja, kategoria, valmistusohje) VALUES (:nimi, :valmistusaika, :kayttaja, :kategoria, :valmistusohje) RETURNING tunnus');

        $query->execute(array('nimi' => $this->nimi, 'valmistusaika' => $this->valmistusaika, 'kayttaja' => $this->kayttaja, 'kategoria' => $this->kategoria, 'valmistusohje' => $this->valmistusohje));

        $row = $query->fetch();

        $this->tunnus = $row['tunnus'];
    }

    public function update() {

        $query = DB::connection()->prepare('UPDATE Resepti SET nimi = :nimi, valmistusaika = :valmistusaika, kategoria = :kategoria, valmistusohje = :valmistusohje WHERE tunnus = :tunnus ');
        $query->execute(array('nimi' => $this->nimi, 'valmistusaika' => $this->valmistusaika, 'kategoria' => $this->kategoria, 'valmistusohje' => $this->valmistusohje, 'tunnus' => $this->tunnus));
    }

    public function destroy() {

        $query = DB::connection()->prepare('DELETE FROM Resepti WHERE tunnus = :tunnus');
        $query->execute(array('tunnus' => $this->tunnus));
    }

}
