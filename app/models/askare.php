<?php

class Askare extends BaseModel {

    public $nimi, $tarkeys, $luokka, $paikka_id, $kayttaja_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Askare');

        $query->execute();

        $rows = $query->fetchAll();
        $askareet = array();


        foreach ($rows as $row) {

            $askareet[] = new Askare(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'tarkeys' => $row['tarkeys'],
                'luokka' => $row['luokka'],
                'paikka_id' => $row['paikka_id'],
                'kayttaja_id' => $row['kayttaja_id']
            ));
        }

        return $askareet;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Askare WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $askare = new Askare(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'tarkeys' => $row['tarkeys'],
                'luokka' => $row['luokka'],
                'paikka_id' => $row['paikka_id'],
                'kayttaja_id' => $row['kayttaja_id']
            ));

            return $askare;
        }

        return null;
    }
    
    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Askare (nimi, tarkeys, luokka, kayttaja_id, paikka_id) VALUES (:nimi, :tarkeys, :luokka, :kayttaja_id, :paikka_id) RETURNING id');

        $query->execute(array('nimi' => $this->nimi, 'tarkeys' => $this->tarkeys, 'luokka' => $this->luokka, 'kayttaja_id' => $this->kayttaja_id, 'paikka_id' => $this->paikka_id));

        $row = $query->fetch();

        $this->id = $row['id'];
    }


}
