<?php

use Phalcon\Mvc\Model;

class User extends Model
{
    static public function getUserType($type)
    {
        if ($type === null) {
            return null;
        } else {
            if ($type === "Korisnik") {
                return new Korisnik();
            } else {
                if ($type === "Vlasnik") {
                    return new Vlasnik();
                }
            }
        }

        return null;
    }
}

?>