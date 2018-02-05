<?php
	use Phalcon\Mvc\Model;
	use Phalcon\Mvc\Model\Query\Builder as Builder;
	use Phalcon\Mvc\Model\Query;

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
			try{
  				$this->save($values);
            } catch (Exception $exception){
				echo $exception->getMessage();
			}
		}
		public function setOpis($values){
			$this->opis = $values;
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

		public function setOcjena($ocjena){
			$this->ocjena=$ocjena;
		}
		
		public static function lastId(){
			$lastRecord =  Klub::find();
			return $lastRecord->getLast()->id_Klub;
		}

		public static function getMyClubs($id_Korisnik){
			$builder = new Builder();

			$builder->distinct(null);
			$builder->from("klub");
			$builder->columns([
				"klub.ime",
				"klub.id_Klub",
			]);

			$builder->innerJoin("Vlasnik","Vlasnik.id_Vlasnik = klub.id_Vlasnik");

			$builder->where("id_korisnik =".$id_Korisnik);
			try{
				$retVal = Phalcon\Di::getDefault()->get("modelsManager");
				return $retVal->executeQuery($builder->getPhql())->jsonSerialize();
	        } catch (Exception $e){
				return $e->getMessage();
			}

		}
	}
?>
