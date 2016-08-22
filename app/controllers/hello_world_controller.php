<?php



class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('etusivu.html');
    }

    public static function sandbox() {
        $askare = new Askare(array(
            'nimi' => '',
            'tarkeys' => '',
            'luokka' => 'hönnönö',
            'paikka_id' => 1,
            'kayttaja_id' => 1
            ));

        Kint::dump($askare->errors());
    }

    public static function muokkaus() {
        View::make('muokkaus.html');
    }

    public static function esittely() {
        View::make('esittelysivu.html');
    }

}
