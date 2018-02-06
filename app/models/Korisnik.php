<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Identical;


class Korisnik extends Model implements UserInterface
{
    private $id_Korisnik;
    private $password;
    private $email;
    private $first_name;
    private $last_name;
    private $ime;


    public function addUser($values, $pwd)
    {
        unset($values["bar"]);
        $values["ime"] = $values["first_name"] . " " . $values["last_name"];

        $val = $this->myValidation($values);
        $values["password"] = $pwd;

        if ($val) {
            return $val;
        } else {
            try {
                $this->save($values);
                return $this->id_Korisnik;
            } catch (Exception $exception) {
                echo $exception->getMessage();
            }
        }
    }


    public function getFirstName()
    {
        $retVal = explode(" ", $this->ime);

        return $retVal[0];
    }

    public function getLastName()
    {
        $retVal = explode(" ", $this->ime);

        return $retVal[1];
    }

    public function getIdKorisnik()
    {
        return $this->id_Korisnik;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getIme()
    {
        return $this->ime;
    }

    public function myValidation($values)
    {
        $validation = new Validation();

        if ($values["r-email"] && $values["r-password"]) {
            $validation->add(
                [
                    "email",
                ],
                new Identical(
                    [
                        "value" => [
                            "email" => $values["r-email"],
                        ],
                        "message" => [
                            "email" => "E-mail mora biti jednak kao i ponovljeni",
                        ],
                    ]
                ));
            $validation->add(
                [
                    "password",
                ],
                new Identical(
                    [
                        "value" => [
                            "password" => $values["r-password"],
                        ],
                        "message" => [
                            "password" => "Lozinke nisu iste",
                        ],
                    ]
                ));
        }

        $validation->add(
            "email",
            new EmailValidator(
                [
                    "message" => "E-mail neispravan: example@example.com",
                ]
            )
        );

        $validation->add(
            "email",
            new Uniqueness(
                [
                    "model" => new Korisnik(),
                    "message" => "E-mail je vec korišten",
                ]
            )
        );

        $messages = $validation->validate($values);

        if (count($messages)) {
            return $messages;
        } else {
            return false;
        }

    }

    public function updateUser($id, $values, $pwd)
    {
        $user = Korisnik::findFirst($id);
        $values["password"] = $pwd;
        $values["ime"] = $values["first_name"] . " " . $values["last_name"];
        $user->save($values);
    }

}


?>