<?php

class PaikkaController extends BaseController {

    public static function index() {
        self::check_logged_in();

        $paikat = Paikka::all();
        View::make('paikka/index.html', array('paikat' => $paikat));
    }

    public static function store() {
        self::check_logged_in();

        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'osoite' => $params['osoite']
        );

        $paikka = new Paikka($attributes);



        if(count($paikka->errors()) == 0){
            $paikka->save();
            Redirect::to('/paikat', array('message' => 'Paikka on lisätty!'));    
        }else{
            View::make('paikka/new.html', array('errors' => $paikka->errors(), 'attributes' => $attributes));
        }
        


        
    }
    
    public static function show($id) {
        self::check_logged_in();

        $paikka = Paikka::find($id);
        if($paikka){
            View::make('paikka/show.html', array('paikka' => $paikka));
        }else{
            Redirect::to('/');
        }
        
        
    }
    public static function create(){
        self::check_logged_in();

        View::make('paikka/new.html');
    }
    public static function edit($id){
        self::check_logged_in();

        $paikka = Paikka::find($id);
        View::make('paikka/edit.html', array('paikka' => $paikka));

    }
    public static function update($id){
        self::check_logged_in();

        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'osoite' => $params['osoite']
            );
        $paikka = new Paikka($attributes);
        $errors = $paikka->errors();
        
        if(count($errors) > 0){
            View::make('paikka/edit.html', array('errors' =>  $errors, 'attributes' => $attributes));
        }else{
            $paikka->update();
            Redirect::to('/paikka/' . $paikka->id, array('message' => 'Muokattu onnistuneesti!'));
        }

    }
    public static function destroy($id){
        self::check_logged_in();

        $paikka = new Paikka(array('id' => $id));

        $paikka->destroy();

        Redirect::to('/', array('message' => 'Paikka     on poistettu'));

    }
    


    
}
