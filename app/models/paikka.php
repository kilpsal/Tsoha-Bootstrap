<?php

  class Paikka extends BaseModel{

public $id, $nimi, $osoite;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array();
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Paikka');

        $query->execute();

        $rows = $query->fetchAll();
        $paikat = array();


        foreach ($rows as $row) {

            $paikat[] = new Paikka(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'osoite' => $row['osoite']
            ));
        }

        return $paikat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Paikka WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $paikka = new Paikka(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'osoite' => $row['osoite']
            ));

            return $paikka;
        }

        return null;
    }
    
    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Paikka (nimi, osoite) VALUES (:nimi, :osoite) RETURNING id');

        $query->execute(array('nimi' => $this->nimi, 'osoite' => $this->osoite));

        $row = $query->fetch();

        $this->id = $row['id'];
    }
    public function update(){
        $query = DB::connection()->prepare('UPDATE Paikka SET nimi = :nimi, osoite = :osoite WHERE id = :id RETURNING id');

        $query->execute(array('id' => $this->id, 'nimi' => $this->nimi, 'osoite' => $this->osoite));

        $row = $query->fetch();

        $this->id = $row['id'];

    }
    public function destroy(){
        
        $query = DB::connection()->prepare('DELETE FROM Paikka WHERE id = :id');
        $query->execute(array('id' => $this->id));

    }
  }
