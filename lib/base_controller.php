<?php
require 'app/models/kayttaja.php';

class BaseController {

    public static function get_user_logged_in() {
        if (isset($_SESSION['user'])) {
            $tunnus = $_SESSION['user'];
            $user = kayttaja::haeKayttaja($tunnus);

            return $user;
        }
        return null;
    }

    public static function check_logged_in() {
        if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään! Sen jälkeen voit jatkaa omien reseptien parissa.'));
    }
    
    
    }
//    public static function onkoKirjautunut() {
//        if(isset($_SESSION['user'])){
//       return true;
//    }
//     return false;
//    }
}
