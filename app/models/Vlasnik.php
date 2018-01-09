<?php
	use Phalcon\Mvc\Model;

	class Vlasnik extends Model{
		
		private $id_Vlasnik;
		private $id_Korisnik;
		
		public function addUser($values,$pwd){
			$user = new Korisnik();
			$values["id_korisnik"] = $user->addUser($values,$pwd);
			
			$bar = new Klub();
			if($this->save($values)){
				$values["bar"]["id_Vlasnik"] = $this->id_Vlasnik;
				$values["bar"]["ocjena"] = 0;
				$bar->addKlub($values["bar"]);
			}

		}
	}
	
?>