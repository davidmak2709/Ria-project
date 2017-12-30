<?php
	use Phalcon\Mvc\Model;

	class User extends Model{
		public function getUserType($type){
			if($type === null) return null;
			else if($type === "Korisnik") return new Korinsik();
			else if($type === "Vlasnik") return new Vlasnik();

			return null;
		}
	}
	
?>