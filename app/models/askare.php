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

}
