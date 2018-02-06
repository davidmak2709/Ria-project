<?php

use Phalcon\Mvc\Model;

class Pretplata extends Model
{
    private $id_Korisnik;
    private $id_Klub;
    private $notifikacije;

    public function getIdKorisnik()
    {
        return $this->id_Korisnik;
    }


    static function isFollowed($id_Korisnik, $id_Klub)
    {
        return Pretplata::count(
            [
                "id_Korisnik = :name: AND id_Klub = :type:",
                "bind" => [
                    "name" => $id_Korisnik,
                    "type" => $id_Klub,
                ],
            ]
        );
    }
}

?>