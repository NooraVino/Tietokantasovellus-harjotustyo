<?php

require 'app/models/resepti.php';
require 'app/models/kategoria.php';

class ReseptiController extends BaseController {

    public static function index() {
        $reseptit = resepti::haeKaikki();
        View::make('etusivu/etusivu.html', array('reseptit' => $reseptit));
    }

    public static function store() {
        $params = $_POST;
        $kategoria = $params['kategoria'];
        $attributes = array(
            'nimi' => $params['nimi'],
            'valmistusaika' => $params['valmistusaika'],
            'kategoria' => $kategoria,
            'valmistusohje' => $params['valmistusohje']
        );

        $resepti = new Resepti($attributes);
        $errors = $resepti->errors();

        if (count($errors) == 0) {
            $resepti->save();
            Redirect::to('/resepti/' . $resepti->tunnus, array('message' => 'Resepti on lisätty arkistoosi!'));
        } else {
            $kategoriat = kategoria::haeKaikki();
            View::make('reseptiNakymat/uusi.html', array('errors' => $errors, 'resepti' => $resepti, 'kategoriat' => $kategoriat));
        }
    }

    public static function show($tunnus) {
        $resepti = resepti::haeResepti($tunnus);
        View::make('reseptiNakymat/resepti.html', array('resepti' => $resepti));
    }

    public static function luoUusi() {
        $kategoriat = kategoria::haeKaikki();
        View::make('reseptiNakymat/uusi.html', array('kategoriat' => $kategoriat));
    }

    public static function edit($tunnus) {
        $resepti = resepti::haeResepti($tunnus);
        $kategoriat = kategoria::haeKaikki();
        View::make('reseptiNakymat/edit.html', array('resepti' => $resepti, 'kategoriat' => $kategoriat));
    }

    public static function update($tunnus) {
        $params = $_POST;
        $kategoria = $params['kategoria'];

        $attributes = array(
            'tunnus' => $tunnus,
            'nimi' => $params['nimi'],
            'valmistusaika' => $params['valmistusaika'],
            'kategoria' => $kategoria,
            'valmistusohje' => $params['valmistusohje']
        );
        $resepti = new Resepti($attributes);
        $errors = $resepti->errors();

        if (count($errors) == 0) {
            $resepti->update();
            Redirect::to('/resepti/' . $resepti->tunnus, array( 'message' => 'Reseptiä on muokattu onnistuneesti!'));
        } else {
            View::make('reseptiNakymat/edit.html', array('errors' => $errors, 'resepti' => $resepti, 'kategoria' => $kategoria));
        }
    }

    public static function destroy($tunnus) {
        self::check_logged_in();
        $resepti = resepti::haeResepti($tunnus);
        $resepti->destroy($tunnus);

        Redirect::to('/etusivu', array('message' => 'Resepti on poistettu onnistuneesti!'));
    }

}
