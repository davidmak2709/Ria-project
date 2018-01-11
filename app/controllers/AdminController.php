<?php
 
use Phalcon\Mvc\Controller;

class AdminController extends Controller{

	public function indexAction(){
		if ($this->session->has("id")) {
			$retVal = Admin::count(
			    	[
			        	"id_korisnik = :name:",
			        	"bind" => [
			            	"name" => $this->session->get("id"),
			        	    
			        	],
			    	]
				);
			if(!$retVal) $this->response->redirect("index");
		}
		else{
			$this->response->redirect("index");
		}
		$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
		$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
	}

	public function klubAction(){
		$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
		$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);

		$this->view->items = Klub::find();
	}

	public function dogadajAction(){
		$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
		$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
		
		$this->view->items = Dogadaj::find();
	}

	public function korisnikAction(){
		$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
		$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
		
		$this->view->items = Korisnik::find();
	}

	public function deleteKlubAction($id){
			$val = Klub::findFirst($id);
			$val->delete();
			$this->response->redirect("/admin/klub");

	}

	public function updateKlubAction($id){

		$val = Klub::findFirst($id);
		$val->save($this->request->getPost());
		$this->response->redirect("/admin/klub");
			

	}

	public function deleteDogadajAction($id){
			$val = Dogadaj::findFirst($id);
			$val->delete();
			$this->response->redirect("/admin/dogadaj");

	}

	public function updateDogadajAction($id){

		$val = Dogadaj::findFirst($id);
		$val->save($this->request->getPost());
		$this->response->redirect("/admin/dogadaj");
			

	}

	public function deleteKorisnikAction($id){
			$val = Korisnik::findFirst($id);
			$val->delete();
			$this->response->redirect("/admin/korisnik");

	}

	public function updateKorisnikAction($id){

		$val = Korisnik::findFirst($id);
		$val->save($this->request->getPost());
		$this->response->redirect("/admin/korisnik");
			
	//moguca primjena oblikovnog obrasca

	}
}

?>