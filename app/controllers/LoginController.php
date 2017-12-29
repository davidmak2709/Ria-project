<?php  
	use Phalcon\Mvc\Controller;

	class LoginController extends Controller{
		public $user;

		public function indexAction(){
			$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
			$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
			$this->assets->addCss("css/style.css");

			
		}

		public function loginAction(){
			$this->user = new User();

			$value = $this->request->getPost();
		
			$success = User::findFirst([
				"Name = :name: AND Email = :email:",
				"bind" =>[
					"name" => $value["Email"],
					"email" => $value["Password"],
				],
			]);
			if($success){
				$this->session->set("user",$value["Email"]);
				header("LOCATION:index");
			}else{
				echo "Pokusaj ponovo";
			}
		}

	}

?>