<?php

use Phalcon\Mvc\Controller;

class DetailsController extends Controller{

/*

	Svrha registracije i facebook komentara

*/
	public function indexAction(){
		$id = $_GET["id"];

		$this->view->bar = Klub::findFirst($id);

		$this->view->bar->follow = Pretplata::isFollowed($this->session->get("id"),$id);

		if($id == null || $this->view->bar == null) 
			$this->response->redirect("index");
	}


}

?>