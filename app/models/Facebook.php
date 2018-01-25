<?php
	use Phalcon\Mvc\Model;

	class Facebook extends Model{
		
		public $id_Korisnik;
		private $accessToken;



		public function addRecord($id_Korisnik,$accessToken){
			$val = array('id_Korisnik' => $id_Korisnik, 'accessToken' => $accessToken);
			try {
				$this->save($val);
			} catch (Exception $e) {
				echo $e->getMessage();
			}

		}

		public function get(){
			return $this->id_Korisnik;
		}
	}
	
	
?>