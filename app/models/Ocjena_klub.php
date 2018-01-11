<?php
	use Phalcon\Mvc\Model;

	class Ocjena_klub extends Model{
		private $id_Klub;
		private $id_Korisnik;
		private $ocjena;

		public function addOcjena($values, $id_Korisnik){
			$is_rated=Ocjena_klub::find(
				[
					"conditions" => "id_Klub = ?1 and id_Korisnik = ?2",
					"bind" => [
            			1 => $values['id_Klub'],
            			2 => $id_Korisnik,
        			]
				]
			);


			if (count($is_rated)!=0){
				return "Već ste ocijenili ovaj klub!";
			}
			else{
				$this->save(
					[
						'id_Klub' => $values['id_Klub'],
						'id_Korisnik' => $id_Korisnik,
						'ocjena' => $values['rating'],
					]
				);
				return "Uspješno ste ocijenili klub!";
			}
		}
	}
	
?>