<?php

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class EventsController extends Controller{

	public function indexAction(){
			$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
			$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
			
			$this->request->getQuery("page", "int");
			$currentPage=(int)$_GET["page"];
			$eventi=Dogadaj::find();
			$paginator2=new PaginatorModel(
				[
					"data"=>$eventi,
					"limit"=>5,
					"page"=>$currentPage,
				]
			);
			$this->view->page=$paginator2->getPaginate();
	}

	public function addAction(){
	}

	public function reserveAction($id){
		
		if($this->session->has("id")){
			$var = new Rezervacija();

			$var->save(
				[
						"id_Dogadaj" => $id,
						"id_Korisnik" => $this->session->get("id")
				]
				);

			$var2 = Dogadaj::findFirst($id);
			$var2->rezervacija += 1;
			$var2->save();
		}

		return $this->response->redirect("events");
				
	}

	public function unreserveAction($id){
		if($this->session->has("id")){
			$var = Rezervacija::find([
					"id_Korisnik = :name: AND id_Dogadaj = :type:",
			        	
			        	"bind" =>[
			            	"name" => $this->session->get("id"),
			        	    "type" => $id,
			        	],
				]
				);
			$var->delete();

			$var2 = Dogadaj::findFirst($id);
			$var2->rezervacija -= 1;
			$var2->save();
				
		}

		return $this->response->redirect("events");
				
		}
}

?>