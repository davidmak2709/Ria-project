<?php
 
use Phalcon\Mvc\Controller;

class AddeventsController extends Controller{

	public function indexAction(){
	    $this->assets->addCss("css/addEvents.css");
		$this->view->myClubs = Klub::getMyClubs($this->session->get("id"));
	}


	public function addAction(){
			
            $values = $this->request->getPost();
            $bars = $values["bars"];

            unset($values["bars"]);
            unset($values["submit"]);

            $dogadaj = new Dogadaj();
            foreach($bars as $bar){
                $values["id_Klub"] = $bar;
                var_dump($values);
                $dogadaj->addDogadaj($values);
            }
            $this->response->redirect("events");
	}
}

?>