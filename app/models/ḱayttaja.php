<?php

class Kayttaja extends BaseModel {

    public $id, $kayttajatunnus, $salasana, $email;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array();
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');

        $query->execute();

        $rows = $query->fetchAll();
        $kayttajat = array();


        foreach ($rows as $row) {

            $kayttajat[] = new Kayttaja(array(
                'id' => $row['id'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana'],
                'email' => $row['email']
            ));
        }

        return $kayttajat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana'],
                'email' => $row['email']
            ));

            return $kayttaja;
        }

        return null;
    }
    public function destroy(){
        
        $query = DB::connection()->prepare('DELETE FROM Kayttaja WHERE id = :id');
        $query->execute(array('id' => $this->id));

    }
    public function authenticate($kayttajatunnus, $salasana){
    	$query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE kayttajatunnus = :kayttajatunnus AND salasana = :salasana LIMIT 1');
    	$query->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
    	$row = $query->fetch();

    	if($row){
    		$kayttaja = new Kayttaja(array(
    			'id' => $row['id'],
    			'kayttajatunnus' => $row['kayttajatunnus'],
    			'salasana' => $row['salasana'],
    			'email' => $row['email']
    			));

            return $kayttaja;
    	}else{
    		return null;
    	}
    }

}
