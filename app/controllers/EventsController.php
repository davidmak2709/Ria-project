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

}

?>