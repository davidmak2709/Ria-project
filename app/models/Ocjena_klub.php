<?php

use Phalcon\Mvc\Model;

class Ocjena_klub extends Model
{
    private $id_Klub;
    private $id_Korisnik;
    private $ocjena;

    public function addOcjena($values, $id_Korisnik)
    {
        $is_rated = Ocjena_klub::find(
            [
                "conditions" => "id_Klub = ?1 and id_Korisnik = ?2",
                "bind" => [
                    1 => $values['id_Klub'],
                    2 => $id_Korisnik,
                ]
            ]
        );


        if (count($is_rated) != 0) {
            return false;
        } else {
            $this->save(
                [
                    'id_Klub' => $values['id_Klub'],
                    'id_Korisnik' => $id_Korisnik,
                    'ocjena' => $values['rating'],
                ]
            );
            return true;
        }
    }

    public function getOcjena($id_Klub)
    {
        $ratings = Ocjena_klub::find(
            [
                "conditions" => "id_Klub = ?1",
                "bind" => [
                    1 => $id_Klub,
                ]
            ]
        );
        $klub = Klub::findFirst($id_Klub);

        if (count($ratings) == 0) {
            $klub->ocjena = 0;
            $klub->save();
            return false;
        }

        $sum_rating = 0;
        foreach ($ratings as $rating) {
            $sum_rating = $sum_rating + $rating->ocjena;
        }
        $club_rating = $sum_rating / count($ratings);


        $klub->ocjena = $club_rating;
        $klub->save();
        return $club_rating;
    }
}

?>