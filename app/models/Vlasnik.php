<?php
	use Phalcon\Mvc\Model;

	class Vlasnik extends Model{
		
		private $id_Vlasnik;
		private $first_name;
		private $last_name;
		private $password;
		private $email;
		private $gender;
		private $address;
		private $hometown;
		private $birthday;

		public function addUser($values,$pwd){
			$values["password"] = $pwd;
			
			$barData["ime"] = $values["ime"]; 
			$barData["adresa"] = $values["adresa"]; 
			$barData["grad"] = $values["grad"]; 
			$barData["telefon"] = $values["telefon"]; 
			$barData["opis"] = $values["opis"]; 
			$barData["files"] = $values["files"]; 
			
			$bar = new Klub();
			$bar->addKlub($barData);

			var_dump($this->save($values));
		}
	}
	
?>