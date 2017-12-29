<?php
	use Phalcon\Mvc\Model;

	class Komentar extends Model{
		private $id_Komentar;
		private $vrijeme;
		private $sadrzaj;
		private $id_Klub;
		private $id_Korisnik;
		private $ocjena;
	}
	
?>