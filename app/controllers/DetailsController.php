<?php

use Phalcon\Mvc\Controller;

class DetailsController extends Controller{

/*

	Svrha registracije i facebook komentara

*/
	public function indexAction(){
		$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
		$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
		$this->assets->addCss('css/rating.css');

		$id = $_GET["id"];
		$this->view->id_Klub=$id;

		$this->view->ocjena_klub=Ocjena_klub::getOcjena($id);

		$this->view->bar = Klub::findFirst($id);

		$this->view->bar->follow = Pretplata::isFollowed($this->session->get("id"),$id);

		$this->view->images = scandir("img/" . $this->view->bar->id_Klub);
		$this->view->images = $files = array_diff($this->view->images, array('.', '..'));

		
		if($id == null || $this->view->bar == null) 
			$this->response->redirect("index");
	}

	public function rateAction(){
		if (!$this->request->isPost()){
			$this->flash->error('404');
		}
		elseif (!$this->session->get("id")) {
			$this->flashSession->error('You have to be logged in!');
			return $this->response->redirect('login');
		}
		else{
			$ocjena=new Ocjena_klub();
			$retVal=$ocjena->addOcjena($this->request->getPost(), $this->session->get("id"));
			$this->flashSession->notice($retVal);
			return $this->response->redirect('details?id='.$_POST["id_Klub"].'#rating_done');
		}

	}


}

?>