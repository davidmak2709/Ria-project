<?php

use Phalcon\Mvc\Model;

class Facebook extends Model
{

    public $id_Korisnik;
    private $id_Facebook;


    public function addRecord($id_Korisnik, $id_Facebook)
    {
        $val = array('id_Korisnik' => $id_Korisnik, 'id_Facebook' => $id_Facebook);
        try {
            $this->save($val);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function get()
    {
        return $this->id_Korisnik;
    }
}


?>