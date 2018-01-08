<?php

use Phalcon\Mvc\Controller;

class DetailsController extends Controller{

	public function indexAction(){
		$id = $_GET["id"];

		$this->view->bar = Klub::findFirst($id);

		if($id == null || $this->view->bar == null) 
			$this->response->redirect("index");
	}


}

?>