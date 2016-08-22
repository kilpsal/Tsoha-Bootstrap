<?php

class AskareController extends BaseController {

    public static function index() {
        $askareet = Askare::all();
        View::make('askare/index.html', array('askareet' => $askareet));
    }

    public static function store() {

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
        $askare = Askare::find($id);
        View::make('askare/show.html', array('askare' => $askare));
        
    }
    public static function create(){
        
        View::make('askare/new.html');
    }
    public static function edit($id){
        $askare = Askare::find($id);
        View::make('askare/edit.html', array('askare' => $askare));

    }
    public static function update($id){
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
            $game->update();
            Redirect::to('/askare/' . $askare->id, array('message' => 'Muokattu onnistuneesti!'));
        }

    }
    public static function destroy(){
        $askare = new Askare(array('id' => $id));

        $askare->destroy();

        Redirect::to('/askare', array('message' => 'Askare on poistettu'));

    }
    


    
}
