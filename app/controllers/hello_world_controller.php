<?php



class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('etusivu.html');
    }

    public static function sandbox() {
        $askare = Askare::find(1);
        $askareet = Askare::all();
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        Kint::dump($askare);
        Kint::dump($askareet);
    }

    public static function muokkaus() {
        View::make('muokkaus.html');
    }

    public static function esittely() {
        View::make('esittelysivu.html');
    }

}
