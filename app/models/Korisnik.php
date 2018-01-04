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
			return $this->save($values);
		}


		public function getValue($name){
			if($this->$name == null || $name == null ) return null;
			else return $this->$name;
		}
		
	}



?>