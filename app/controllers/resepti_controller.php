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

        $errors = $resepti->errors();

        if (count($errors) == 0) {
            $resepti->save();
            Redirect::to('/resepti/' . $resepti->tunnus, array('message' => 'Resepti on lisätty arkistoosi!'));
        } else {
            View::make('suunnitelmat/uusi.html', array('errors' => $errors, 'resepti' => $resepti));
        }
    }

    public static function show($tunnus) {
        $resepti = resepti::haeResepti($tunnus);
        View::make('suunnitelmat/resepti.html', array('resepti' => $resepti));
    }

    public static function luoUusi() {
        View::make('suunnitelmat/uusi.html');
    }

    public static function edit($tunnus) {
        $resepti = resepti::haeResepti($tunnus);
        View::make('suunnitelmat/edit.html', array('resepti' => $resepti));
    }

    public static function update($tunnus) {
        $params = $_POST;

        $attributes = array(
            'tunnus' => $tunnus,
            'nimi' => $params['nimi'],
            'valmitusaika' => $params['valmistusaika'],
            'valmistusohje' => $params['valmistusohje']
        );
        $resepti = new Resepti($attributes);

        $errors = $resepti->errors();

        if (count($errors) == 0) {
            $resepti->update();
            Redirect::to('/resepti/' . $resepti->tunnus, array('message' => 'Reseptiä on muokattu onnistuneesti!'));
        } else {
            View::make('suunnitelmat/edit.html', array('errors' => $errors, 'resepti' => $resepti));
        }
    }

    public static function destroy($tunnus) {
        $resepti = resepti::haeResepti($tunnus);
        $resepti->destroy($tunnus);

        Redirect::to('/etusivu', array('message' => 'Resepti on poistettu onnistuneesti!'));
    }

}
