<?php

	use Phalcon\Mvc\Model;
    use Phalcon\Validation;
    use Phalcon\Validation\Validator\Uniqueness;
    use Phalcon\Validation\Validator\PresenceOf;

	class Korisnik extends Model implements UserInterface {
		private $id_Korisnik;
		private $password;
		private $email;
		private $first_name;
		private $last_name;
        private $ime;


		public function addUser($values,$pwd){
			$values["password"] = $pwd;
			$values["ime"] = $values["first_name"] ." ". $values["last_name"];

			$val = Korisnik::myValidation($values);


			if($val)
			    return false;
			else{
			    try{
			        $this->save($values);
			        return $this->id_Korisnik;
                } catch (Exception $exception){
			        echo $exception->getMessage();
                }
            }
		}


		public function getFirstName(){
			$retVal = explode(" ",$this->ime);

			return $retVal[0];
		}

		public function getIdKorisnik(){
			return $this->id_Korisnik;
		}

		public function getEmail(){
			return $this->email;
		}

		public function getPassword(){
			return $this->password;
		}

		public  static function myValidation($values){
            $validation = new Validation();

            $validation->add(
                "email",
                new Uniqueness(
                    [
                        "model"   => new Korisnik(),
                        "message" => ":field je vec korišten",
                    ]
                )
            );

            $messages = $validation->validate($values);

            if(count($messages)){
                return true;
            } else {
                return false;
            }

		}

	}
	


?>