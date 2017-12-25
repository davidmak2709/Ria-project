<?php 
	
	use Phalcon\Mvc\Controller;

	class SignupController extends Controller{

		public function indexAction(){
			$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
			
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