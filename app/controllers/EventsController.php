<?php

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;

class EventsController extends Controller{

	public function indexAction(){
				
			$currentPage=$this->request->getQuery("page", "int");

			$builder=new Phalcon\Mvc\Model\Query\Builder();
			$builder->from("Dogadaj");
			$paginator = new PaginatorQueryBuilder(
    			[
        			"builder" => $builder,
        			"limit"   => 5,
        			"page"    => $currentPage,
    			]
			);
			$this->view->page=$paginator->getPaginate();
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