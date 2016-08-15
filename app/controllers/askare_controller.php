<?php

class AskareController extends BaseController {

    public static function index() {
        $askareet = Askare::all();
        View::make('askare/index.html', array('askareet' => $askareet));
    }

    public static function store() {

        $params = $_POST;

        $askare = new Askare(array(
            'nimi' => $params['nimi'],
            'tarkeys' => $params['tarkeys'],
            'luokka' => $params['luokka'],
            'kayttaja_id' => $params['kayttaja_id'],
            'paikka_id' => $params['paikka_id']
        ));


        $askare->save();


        Redirect::to('/askare/' . $askare->id, array('message' => 'Askare on lisätty!'));
    }
    
    public static function show($id) {
        $askare = Askare::find($id);
        View::make('askare/show.html', array('askare' => $askare));
        
    }
    public static function create(){
        
        View::make('askare/new.html');
    }
    


    
}
