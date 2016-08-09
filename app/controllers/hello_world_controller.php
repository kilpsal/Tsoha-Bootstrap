<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('etusivu.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      echo 'Hello World!';
    }
    
    public static function muokkaus(){
        View::make('muokkaus.html');
    }
    
    public static function esittely() {
        View::make('esittelysivu.html');
    }
  }
