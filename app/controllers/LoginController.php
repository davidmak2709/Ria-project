<?php  
	use Phalcon\Mvc\Controller;

	class LoginController extends Controller{
		public function indexAction(){
			$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
			$this->assets->addCss("css/style.css");
		}

		public function loginAction(){
			$user = new User();

			$value = $this->request->getPost();
		
			$success = User::findFirst([
				"Name = :name: AND Email = :email:",
				"bind" =>[
					"name" => $value["Email"],
					"email" => $value["Password"],
				],
			]);
			if($success){
				echo "Uspjesno ste logirani";
			}else{
				echo "Pokusaj ponovo";
			}
		}

	}

?>