<?php 
	
	use Phalcon\Mvc\Controller;

	class SignupController extends Controller{

		public function indexAction(){

		}

		public function registerAction(){
			$user = new User();
			
			//var_dump($this->request->getPost());

			/*$success = $user->save(
				$this->request->getPost(),
				["ID","Name","Email",]
			);	

			if($success){
				echo "Uspjesno ste logirani";
			}else{
				echo "Sorry! Problemi: ";
				$mess = $user->getMessages();

				foreach ($mess as $m) {
					echo $m->getMessage() . "<br/>";
				}
			
			}*/

			var_dump(count($user->find()));
		}	
	}
?>