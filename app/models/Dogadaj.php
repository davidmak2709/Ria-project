<?php
	use Phalcon\Mvc\Model;

	class Dogadaj extends Model{
		private $id_Dogadaj;
		private $id_Klub;
		private $vrijeme;
		private $opis;


		public function addDogadaj($values){
			$values["rezervacija"] = 0;
			$this->save($values);

		}
	}
	
?>