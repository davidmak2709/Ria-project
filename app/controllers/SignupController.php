<?php 
	
	use Phalcon\Mvc\Controller;

	class SignupController extends Controller{

		public function indexAction(){
			$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
			
		}

		public function registerAction(){
			$values = $this->request->getPost();

			

		}	
	}
?>