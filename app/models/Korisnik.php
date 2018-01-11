<?php

	use Phalcon\Mvc\Model;

	class Korisnik extends Model{
		private $id_Korisnik;
		private $password;
		private $email;
		private $first_name;
		private $last_name;
		private $address;
		private $hometown;
		private $gender;
		private $birthday;


		public function addUser($values,$pwd){
			$values["password"] = $pwd;
			$values["ime"] = $values["first_name"] ." ". $values["last_name"];
			if($this->save($values))
				return $this->id_Korisnik;
		}


		
		public function getValue($name = null){
			if($this->$name == null || $name == null ) return null;
			else return $this->$name;
		}

		public function getFirstName(){
			$retVal = explode(" ",$this->ime);

			return $retVal[0];
		}

	}
	


?>