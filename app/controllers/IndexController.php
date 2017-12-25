<?php

	use Phalcon\Mvc\Controller;

	class IndexController extends Controller{
		public function indexAction(){
			$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
			$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
			
		}

	}

?>