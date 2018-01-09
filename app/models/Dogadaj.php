<?php
	use Phalcon\Mvc\Model;
	
	require_once APP_PATH . "/phpmailer/PHPMailerAutoload.php";

	class Dogadaj extends Model{
		private $id_Dogadaj;
		private $vrijeme;
		private $opis;
		private $id_Klub;
		private $naziv;
		private $rezervacija;


		public function addDogadaj($values){
			$values["rezervacija"] = 0;
			$this->save($values);

			$this->sendMails();

		}

		public function sendMails(){
			$users = Pretplata::find(
			    	[
			        	"id_Klub = :type:",
			        	"bind" => [
			            	"type" => $this->id_Klub,
			        	],
			    	]);

			foreach($users as $user) {
				
				$retVal = Korisnik::find(
			    	[
			    		'columns' => 'email',
			        	"id_Korisnik = :name:",
			        	"bind" => [
			            	"name" => $user->getIdKorisnik(),
			        	],
			    	]
				)->toArray();

				$to = $retVal[0]["email"];
				
				$subject = $this->id_Klub. " " . $this->naziv;

				$message = $this->opis;


				$this->createMail($to,$subject,$message);
			}
		}


		private function createMail($to,$subject,$message){
				
			$mail = new PHPMailer();
			
				$mail->SMTPDebug = 4;
				$mail->Host = "smtp.gmail.com";

				//ukljucuje smtp
				$mail->isSMTP();

				$mail->SMTPAuth = true;

				$mail->Username = "riaclubprojekt@gmail.com";
				$mail->Password = "projektRIA";

				$mail->SMTPSecure = "tls";
				$mail->Port = 587;


				$mail->Subject = $subject;
				$mail->Body = $message;

				$mail->setFrom("riaclubprojekt@gmail.com","Club RIA");
				$mail->addAddress($to);

				if($mail->send()) echo "da";
					
		}


		public function getId_Dogadaj(){
			return $this->id_Dogadaj;
		}
		public function getVrijeme(){
			return $this->vrijeme;
		}
		public function getOpis(){
			return $this->opis;
		}
		public function getId_Klub(){
			return $this->id_Klub;
		}
		public function getNaziv(){
			return $this->naziv;
		}
		public function getRezervacija(){
			return $this->rezervacija;
		}

		static function lastId(){
			$lastRecord =  Dogadaj::find();
			return $lastRecord->getLast()->id_Klub;
		}
	}
	
?>