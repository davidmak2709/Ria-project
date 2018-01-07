<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;

class MapController extends Controller{

	public function indexAction(){
		$this->request->getQuery("address", "string");		
		$this->view->address = $_GET["address"];

	}

	public function showAction(){

	

	}

}

?>
