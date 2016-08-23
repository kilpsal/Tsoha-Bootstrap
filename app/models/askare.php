<?php

class Askare extends BaseModel {

    public $id, $nimi, $tarkeys, $luokka, $paikka_id, $kayttaja_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi','validate_tarkeys');
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
    public function update(){
        $query = DB::connection()->prepare('UPDATE Askare SET nimi = :nimi, tarkeys = :tarkeys, luokka = :luokka, kayttaja_id = :kayttaja_id, paikka_id = :paikka_id WHERE id = :id RETURNING id');

        $query->execute(array('id' => $this->id, 'nimi' => $this->nimi, 'tarkeys' => $this->tarkeys, 'luokka' => $this->luokka, 'kayttaja_id' => $this->kayttaja_id, 'paikka_id' => $this->paikka_id));

        $row = $query->fetch();

        $this->id = $row['id'];

    }
    public function destroy(){
        
        $query = DB::connection()->prepare('DELETE FROM Askare WHERE id = :id');
        $query->execute(array('id' => $this->id));

    }

    public function validate_nimi(){
        $errors = array();
        if($this->nimi == '' || $this->nimi == null){
            $errors[] = "Askareella on oltava nimi";
        }
        if(strlen($this->nimi) < 4){
            $errors[] = "Nimen on oltava vähintään neljä merkkiä";
        }

        return $errors;

    }
    public function validate_tarkeys(){
        $errors = array();
        if($this->tarkeys == '' || $this->tarkeys == null){
            $errors[] = "Askareella on oltava tarkeys";
        }
        if(is_numeric($this->tarkeys) == 0){
            $errors[] = "Tärkeys on oltava kokonaisluku";
        }
        if($this->tarkeys > 5 || $this->tarkeys < 1){
            $errors[] = "Tärkeys on oltava välillä 1-5";
        }
        return $errors;
    }


}
