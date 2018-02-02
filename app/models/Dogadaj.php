<?php
	use Phalcon\Mvc\Model;
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	class Dogadaj extends Model{
		private $id_Dogadaj;
		private $vrijeme;
		private $opis;
		private $id_Klub;
		private $naziv;
		private $rezervacija;


		public function addDogadaj($values){
			$values["rezervacija"] = 0;
            try {
                $this->save($values);
            } catch (\Exception $e){
                echo $e->getMessage();
            }
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
            $mailData = $this->getDI()->get('config')->mail;

			$mail = new PHPMailer;
			
			$mail->isSMTP();
			$mail->SMTPDebug = 2;
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;
			$mail->Username = $mailData["mail"];
			$mail->Password =  $mailData["password"];

			$mail->setFrom($mailData["mail"], "RIA Club");
			$mail->addAddress($to, 'John Doe');
			
			$mail->Subject = $subject;
			$mail->Body = $message;
			
			if (!$mail->send()) {
   				 echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			    echo "Message sent!";
			}		
		}


		public function getIdDogadaj(){
			return $this->id_Dogadaj;
		}
		public function getVrijeme(){
			return $this->vrijeme;
		}
		public function getOpis(){
			return $this->opis;
		}
		public function getIdKlub(){
			return $this->id_Klub;
		}
		public function getNaziv(){
			return $this->naziv;
		}
		public function getRezervacija(){
			return $this->rezervacija;
		}
		public function setRezervacija($br){
			$this->rezervacija = $br;
		}
		static function lastId(){
			$lastRecord =  Dogadaj::find();
			return $lastRecord->getLast()->id_Klub;
		}
	}
	
?>