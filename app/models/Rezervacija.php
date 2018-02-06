<?php

use Phalcon\Mvc\Model;

class Rezervacija extends Model
{
    private $id_Korisnik;
    private $id_Dogadaj;

    static function isReserved($id_Korisnik, $id_Dogadaj)
    {
        return Rezervacija::count(
            [
                "id_Korisnik = :name: AND id_Dogadaj = :type:",
                "bind" => [
                    "name" => $id_Korisnik,
                    "type" => $id_Dogadaj,
                ],
            ]
        );
    }


}

?>