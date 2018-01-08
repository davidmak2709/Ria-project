<?php

use Phalcon\Mvc\Controller;

class AddeventsController extends Controller{

	public function indexAction(){
		
	}

	public function addAction(){

		if($this->request->isPost()){
			$dogadaj = new Dogadaj();
			$values["rezervacija"] = 0;
			$dogadaj->addDogadaj($this->request->getPost());

		}

		$this->response->redirect("events");

	}

}

?>