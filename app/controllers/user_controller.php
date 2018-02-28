<?php




class UserController extends BaseController{
  public static function login(){
      View::make('kirjautuminen/login.html');
  }
  
  public static function logout(){
    $_SESSION['user'] = null;
    Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
  }
  
  public static function handle_login(){
    $params = $_POST;
    $user = kayttaja::authenticate($params['nimi'], $params['salasana']);

    if(!$user){
        View::make('kirjautuminen/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'nimi' => $params['nimi']));
    }else{
     $_SESSION['user'] = $user->tunnus;
      Redirect::to('/index', array('message' => 'Tervetuloa takaisin ' . $user->nimi . '!'));
    }
  }
  
}


