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
	}
?>