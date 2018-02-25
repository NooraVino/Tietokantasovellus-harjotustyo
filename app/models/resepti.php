<?php

class Resepti extends BaseModel {

    public $tunnus, $nimi, $valmistusaika, $kategoria, $valmistusohje;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_valmistusaika');
    }

    public static function haeKaikki() {

        $query = DB::connection()->prepare('SELECT Resepti.tunnus, Resepti.nimi, Resepti.valmistusaika, Kategoria.nimi AS kategoria, Resepti.valmistusohje FROM Resepti INNER JOIN Kategoria ON Kategoria.tunnus = Resepti.kategoria;');
        $query->execute();
        $rows = $query->fetchAll();
        $reseptit = array();


        foreach ($rows as $row) {

            $reseptit[] = new Resepti(array(
                'tunnus' => $row['tunnus'],
                'nimi' => $row['nimi'],
                'valmistusaika' => $row['valmistusaika'],
                'kategoria' => $row['kategoria'],
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

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Resepti (nimi, valmistusaika, kategoria, valmistusohje) VALUES (:nimi, :valmistusaika, :kategoria, :valmistusohje) RETURNING tunnus');

        $query->execute(array('nimi' => $this->nimi, 'valmistusaika' => $this->valmistusaika, 'kategoria' => $this->kategoria, 'valmistusohje' => $this->valmistusohje));

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
