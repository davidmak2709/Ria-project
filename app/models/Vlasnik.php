<?php
	use Phalcon\Mvc\Model;

	class Vlasnik extends Model implements UserInterface {
		
		private $id_Vlasnik;
		private $id_Korisnik;
		
		public function addUser($values,$pwd){
			$user = new Korisnik();
			$retval = $user->addUser($values,$pwd);

			if(!is_string($retval)){
			    return $retval;
            } else {
			    $values["id_korisnik"] = $retval;
            }

			try{
                $this->save($values);
            } catch (Exception $exception){
			    echo $exception->getMessage();
            }

			$bar = new Klub();
			if($this->save($values)){
				$values["bar"]["id_Vlasnik"] = $this->id_Vlasnik;
				$values["bar"]["ocjena"] = 0;
				$bar->addKlub($values["bar"]);
			}

			return false;

		}

		public function getIdKorisnik(){
		    return $this->id_Korisnik;
        }

        public function getIdVlasnik(){
		    return $this->id_Vlasnik;
        }


	}
	
?>