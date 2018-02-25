<?php

require 'app/models/kategoria.php';

class KategoriaController extends BaseController {

    public static function index() {
        $kategoriat = Kategoria::haeKaikki();
        View::make('kategoriat/listaus.html', array('kategoriat' => $kategoriat));
    }

    public static function uusi() {
        View::make('kategoriat/uusi.html');
    }

    public static function store() {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi']
        );

        $kategoria = new Kategoria($attributes);
        $errors = 0;  // $kategoria->errors();

       // if (count($errors) == 0) {
            $kategoria->save();
            Redirect::to('/listaus', array('message' => 'Kategoria on lisätty onnistuneesti!'));
       // } else {

           // View::make('kategoriat/uusi.html', array('errors' => $errors, 'kategoria' => $kategoria));
       // }
    }

    public static function destroy($tunnus) {
        $kategoria = kategoria::haePoistettava($tunnus);
        if ($kategoria != null) {
            $kategoria->destroy($tunnus);
            Redirect::to('/listaus', array('message' => 'Kategoria on poistettu onnistuneesti!'));
        } else {
            $kategoriat = Kategoria::haeKaikki();
            View::make('kategoriat/listaus.html', array('message' => 'Kategoriaa ei voida poistaa!','kategoriat' => $kategoriat));
        }
    }

}
