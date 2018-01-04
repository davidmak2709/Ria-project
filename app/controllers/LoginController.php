<?php  
	use Phalcon\Mvc\Controller;
	
	class LoginController extends Controller{
	

		public function indexAction(){
			$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
			$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
			$this->assets->addCss("css/style.css");

			
		}

		public function loginAction(){
			$value = $this->request->getPost();
		
			$success = Korisnik::findFirst([
				"email = :email: AND password = :password:",
				"bind" =>[
					"email" => $value["email"],
					"password" => $value["password"],
				],
			]);
			if($success){
				$this->session->set("id",$success->getValue("id_Korisnik"));
				$this->session->set("ime",$success->getValue("ime"));

				$this->response->redirect("index");
			}else{
				$this->response->redirect("login");
			}
		}


		public function logoutAction(){
			$this->session->destroy();
			$this->response->redirect("index");
		}

		
}

?>