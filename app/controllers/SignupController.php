<?php 
	
	use Phalcon\Mvc\Controller;

	class SignupController extends Controller{

		public function indexAction(){
			$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
			
		}

		public function registerAction(){

			$user = User::getUserType($this->request->getPost("Tip"));
			$user->addUser($this->request->getPost(),
							 $this->security->hash($this->request->getPost("password")
						)
					);

			$this->response->redirect("index");

		}	
	}
?>