<?php
	use Phalcon\Mvc\Model;
	use Phalcon\Mvc\Model\Query\Builder as Builder;
	use Phalcon\Mvc\Model\Query;
	use Phalcon\Validation;
	use Phalcon\Validation\Validator\PresenceOf;
	use Phalcon\Validation\Validator\Regex as RegexValidator;

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
            $builder = new Builder();

            $builder->distinct(null);
            $builder->from("klub");
            $builder->columns([
                "klub.id_Klub",
            ]);

            $builder->orderBy("klub.id_Klub DESC");
            $builder->limit(1);

            return $builder->getQuery()->execute()->toArray()[0]["id_Klub"];
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
				return $builder->getQuery()->execute()->jsonSerialize();
	        } catch (Exception $e){
				return $e->getMessage();
			}

		}

		public function myValidation($values){
  			$validation = new Validation();

            $validation->add(
                'ime',
                new PresenceOf(
                    [
                        'message' => 'Ime kluba je obavezno',
                    ]
                )
            );

            $validation->add(
                'adresa',
                new PresenceOf(
                    [
                        'message' => 'Adresa kluba je obavezna',
                    ]
                )
            );


            $validation->add(
                'grad',
                new PresenceOf(
                    [
                        'message' => 'Grad kluba je obavezan',
                    ]
                )
            );


            $validation->add(
                'telefon',
                new PresenceOf(
                    [
                        'message' => 'Telefon kluba je obavezan',
                    ]
                )
            );

            $validation->add(
                'opis',
                new PresenceOf(
                    [
                        'message' => 'Opis kluba je obavezan',
                    ]
                )
            );

            $validation->add(
                "telefon",
                new RegexValidator(
                    [
                        "pattern" => "/^[0-9]{2,3}-[0-9]{6,7}$/",
                        "message" => "Nesipravan broj telefona",
                    ]
                )
            );

            $messages = $validation->validate($values);
            if(count($messages)){
                return $messages;
            } else {
                return false;
            }

		}
	}
?>
