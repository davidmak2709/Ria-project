<?php

interface UserInterface
{
    public function addUser($values, $pwd);

    public function getIdKorisnik();
}