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
		
			$this->save($values);

		}

		static function lastId(){
			$lastRecord =  Klub::find();
			return $lastRecord->getLast()->id_Klub;
		}
	}
?>