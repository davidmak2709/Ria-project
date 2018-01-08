<?php
	use Phalcon\Mvc\Model;

	class Dogadaj extends Model{
		private $id_Dogadaj;
		private $vrijeme;
		private $opis;
		private $id_Klub;
		private $naziv;
		private $rezervacija;


		public function addDogadaj($values){
			$values["rezervacija"] = 0;
			$this->save($values);

		}
		public function getId_Dogadaj(){
			return $this->id_Dogadaj;
		}
		public function getVrijeme(){
			return $this->vrijeme;
		}
		public function getOpis(){
			return $this->opis;
		}
		public function getId_Klub(){
			return $this->id_Klub;
		}
		public function getNaziv(){
			return $this->naziv;
		}
		public function getRezervacija(){
			return $this->rezervacija;
		}
		static function lastId(){
			$lastRecord =  Dogadaj::find();
			return $lastRecord->getLast()->id_Klub;
		}
	}
	
?>