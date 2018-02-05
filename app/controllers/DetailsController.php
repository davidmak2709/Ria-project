<?php

use Phalcon\Mvc\Controller;

class DetailsController extends Controller{

	public function indexAction(){
		$this->assets->addCss("https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css",false);
		$this->assets->addCss('css/rating.css');
		$this->assets->addCss('css/details.css');


		$this->assets->addJs("https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js",false);
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js",false);
		$this->assets->addJs("https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js",false);


		$id = $_GET["id"];
		$this->view->id_Klub=$id;

		$this->view->ocjena_klub=Ocjena_klub::getOcjena($id);
		if ($this->view->ocjena_klub==False){
			$this->view->ocjena_klub="Klub još nije ocijenjen!";
		}
		
		$this->view->bar = Klub::findFirst($id);

		$this->view->bar->follow = Pretplata::isFollowed($this->session->get("id"),$id);

		$this->view->images = scandir("img/" . $this->view->bar->id_Klub);
		$this->view->images = $files = array_diff($this->view->images, array('.', '..'));

		
		if($id == null || $this->view->bar == null) 
			$this->response->redirect("/index");
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
			if ($retVal){
				$this->flashSession->notice("Uspješno ste ocijenili klub!");
			}
			else{
				$this->flashSession->notice("Već ste ocijenili ovaj klub!");
			}
			return $this->response->redirect('details?id='.$_POST["id_Klub"].'#rating_done');
		}

	}


}

?>