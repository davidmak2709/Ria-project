<?php

use Phalcon\Mvc\Controller;

class AddeventsController extends Controller{

	public function indexAction(){
		
		$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
		$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
	}


	public function addAction(){
			
			$dogadaj = new Dogadaj();	
			$values["rezervacija"] = 0;
			$dogadaj->addDogadaj($this->request->getPost());
			
			$this->response->redirect("events");
	}
}

?>