<?php

use Phalcon\Mvc\Model;

class Admin extends Model
{

    private $id_Admin;
    private $id_korisnik;

    public function getidAdmin()
    {
        return $this->id_Admin;

    }

    public function getidKorisnik()
    {
        return $this->id_korisnik;

    }

}


?>