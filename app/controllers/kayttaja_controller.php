<?php

class KayttajaController extends BaseController {

    public static function index() {
        self::check_logged_in();

        $kayttajat = Kayttaja::all();
        View::make('kayttaja/index.html', array('kayttajat' => $kayttajat));
    }

    public static function store() {

        $params = $_POST;
        $attributes = array(
            'kayttajatunnus' => $params['kayttajatunnus'],
            'salasana' => $params['salasana'],
            'email' => $params['email']
        );

        $kayttaja = new Kayttaja($attributes);



        if(count($kayttaja->errors()) == 0){
            $kayttaja->save();
            Redirect::to('/kayttaja/' . $kayttaja->id, array('message' => 'Käyttäjä on lisätty!'));    
        }else{
            View::make('kayttaja/new.html', array('errors' => $kayttaja->errors(), 'attributes' => $attributes));
        }
        


        
    }
    
    public static function show($id) {
        self::check_logged_in();

        $kayttaja = Kayttaja::find($id);
        if($kayttaja){
            View::make('kayttaja/show.html', array('kayttaja' => $kayttaja));
        }else{
            Redirect::to('/');
        }
        
        
    }
    public static function create(){
        
        View::make('kayttaja/new.html');
    }
    public static function destroy($id){
        self::check_logged_in();

        $kayttaja = new Kayttaja(array('id' => $id));

        $kayttaja->destroy();

        Redirect::to('/', array('message' => 'Käyttäjä on poistettu'));

    }
    public static function login(){
        if(isset($SESSION['user'])){
            Redirect::to('/', array('message' => 'Olet jo kirjautunut'));
        }else{
            View::make('/kayttaja/login.html');
        }
    }
    public static function handle_login(){
        $params = $_POST;

        $kayttaja = Kayttaja::authenticate($params['kayttajatunnus'], $params['salasana']);

        if(!$kayttaja){
            View::make('kayttaja/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana', 'kayttajatunnus' => $params['kayttajatunnus']));
        }else{

            $_SESSION['user'] = $kayttaja->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $kayttaja->kayttajatunnus . '!'));
        }
    }
    public static function logout(){
        $_SESSION['user'] = null;

        Redirect::to('/', array('message' => 'Onnistunut uloskirjaus.'));
    }
    


    
}
