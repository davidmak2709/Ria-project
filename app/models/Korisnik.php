<?php

	use Phalcon\Mvc\Model;

	class Korisnik extends Model implements UserInterface {
		private $id_Korisnik;
		private $password;
		private $email;
		private $first_name;
		private $last_name;



		public function addUser($values,$pwd){
			$values["password"] = $pwd;
			$values["ime"] = $values["first_name"] ." ". $values["last_name"];
			if($this->save($values))
				return $this->id_Korisnik;
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

	}
	


?>