<?php
	use Phalcon\Mvc\Model;

	class Vlasnik extends Model implements UserInterface {
		
		private $id_Vlasnik;
		private $id_korisnik;
		
		public function addUser($values,$pwd){
			$user = new Korisnik();
			$retval = $user->myValidation($values);

            if($retval !== false){
			    return $retval;
            }

            $bar = new Klub();

			$validation = $bar->myValidation($values["bar"]);

			if($validation !== false){
                return $validation;
            }

            try{
                $user->addUser($values,$pwd);
                $values["id_korisnik"] = $user->getIdKorisnik();

                $this->save($values);
                $values["bar"]["id_Vlasnik"] = $this->id_Vlasnik;
                $values["bar"]["ocjena"] = 0;

                $bar->addKlub($values["bar"]);
            } catch (Exception $exception){
                echo $exception->getMessage();
            }

            return false;

		}

		public function getIdKorisnik(){
		    return $this->id_korisnik;
        }

        public function getIdVlasnik(){
		    return $this->id_Vlasnik;
        }


	}
	
?>