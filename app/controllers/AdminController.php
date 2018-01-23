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
		
	}

	public function klubAction(){
		$this->view->items = Klub::find();
	}

	public function dogadajAction(){
		$this->view->items = Dogadaj::find();
	}

	public function korisnikAction(){
		$this->view->items = Korisnik::find();
	}

	public function adminsAction(){
		$this->view->items = Admin::find();
	}

//admin

	public function addAdminAction(){
			$val = new Admin();
			$val->save([
					'id_korisnik' => 81
				]);
			$this->response->redirect("/admin/admins");

	}
	public function deleteAdminAction($id){
			$val = Admin::findFirst($id);
			$val->delete();
			$this->response->redirect("/admin/admins");

	}

	public function updateAdminAction($id){

		$val = Admin::findFirst($id);
		$val->save($this->request->getPost());
		$this->response->redirect("/admin/admins");
			

	}


//klub

	public function addKlubAction(){
			$val = new Klub();
			$val->save([
					'ime' => 'defult',
					'adresa' => 'default',
					'ocjena' => 0,
					'id_Vlasnik' => 987654325,
					'opis' => 'dodaj opis'

				]);
			$this->response->redirect("/admin/klub");

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

//dogadaj

	public function addDogadajAction(){
			$val = new Dogadaj();
			$val->save([
					'id_Klub' => 123456784,
					'naziv' => '#NOVI',
					'vrijeme' => "1.1.2000",
					'rezervacija' => 0,
					'opis' => '#OPIS'

				]);
			$this->response->redirect("/admin/dogadaj");

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

//korisnik

	public function addKorisnikAction(){
			$val = new Korisnik();
			$val->save([
					'ime' => 'root',
					'password' => 'root',
					'email' => 'root@root.com'

				]);
			$this->response->redirect("/admin/korisnik");

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