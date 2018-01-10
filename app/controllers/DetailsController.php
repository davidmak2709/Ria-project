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

		$this->view->images = scandir("img/" . $this->view->bar->id_Klub);
		$this->view->images = $files = array_diff($this->view->images, array('.', '..'));

		
		if($id == null || $this->view->bar == null) 
			$this->response->redirect("index");
	}


}

?>