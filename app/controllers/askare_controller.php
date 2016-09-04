<?php

class AskareController extends BaseController {

    public static function index() {
        self::check_logged_in();

        $askareet = Askare::all();
        $paikat = Paikka::all();
        View::make('askare/index.html', array('askareet' => $askareet, 'paikat' => $paikat));
    }

    public static function store() {
        self::check_logged_in();

        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'tarkeys' => $params['tarkeys'],
            'luokka' => $params['luokka'],
            'kayttaja_id' => $params['kayttaja_id'],
            'paikka_id' => $params['paikka_id']
        );

        $askare = new Askare($attributes);



        if(count($askare->errors()) == 0){
            $askare->save();
            Redirect::to('/askare/' . $askare->id, array('message' => 'Askare on lisätty!'));    
        }else{
            View::make('askare/new.html', array('errors' => $askare->errors(), 'attributes' => $attributes));
        }
        


        
    }
    
    public static function show($id) {
        self::check_logged_in();

        $askare = Askare::find($id);
        $paikka = Paikka::find($askare->paikka_id);
        if($askare){
            View::make('askare/show.html', array('askare' => $askare, 'paikka' => $paikka));
        }else{
            Redirect::to('/');
        }
        
        
    }
    public static function create(){
        self::check_logged_in();

        $paikat = Paikka::all();

        View::make('askare/new.html', array('paikat' => $paikat));
    }
    public static function edit($id){
        self::check_logged_in();

        $askare = Askare::find($id);
        $paikat = Paikka::all();
        View::make('askare/edit.html', array('askare' => $askare, 'paikat' => $paikat));

    }
    public static function update($id){
        self::check_logged_in();

        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'tarkeys' => $params['tarkeys'],
            'luokka' => $params['luokka'],
            'paikka_id' => $params['paikka_id'],
            'kayttaja_id' => $params['kayttaja_id']
            );
        $askare = new Askare($attributes);
        $errors = $askare->errors();
        
        if(count($errors) > 0){
            View::make('askare/edit.html', array('errors' =>  $errors, 'attributes' => $attributes));
        }else{
            $askare->update();
            Redirect::to('/askare/' . $askare->id, array('message' => 'Muokattu onnistuneesti!'));
        }

    }
    public static function destroy($id){
        self::check_logged_in();

        $askare = new Askare(array('id' => $id));

        $askare->destroy();

        Redirect::to('/', array('message' => 'Askare on poistettu'));

    }
    


    
}
