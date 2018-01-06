<?php

	use Phalcon\Mvc\Model;

	class Klub extends Model{
		private $id_Klub;
		private $ime;
		private $adresa;
		private $ocjena;
		private $id_Vlasnik;
		private $grad;
		private $telefon;
		private $opis;


		public function addKlub($values){
			return $this->save($values);
		}
		
		public function getIdKlub(){
			return $this->id_Klub;
		}
		
		public function getIme(){
			return $this->ime;
		}
		
		public function getAdresa(){
			return $this->adresa;
		}
		
		public function getOcjena(){
			return $this->ocjena;
		}
		
		public function getIdVlasnik(){
			return $this->id_Vlasnik;
		}
		
		public function getGrad(){
			return $this->grad;
		}
		
		public function getTelefon(){
			return $this->telefon;
		}
		
		public function getOpis(){
			return $this->opis;
		}
	}
?>
