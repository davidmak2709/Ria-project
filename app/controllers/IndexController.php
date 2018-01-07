<?php

	use Phalcon\Mvc\Controller;


	class IndexController extends Controller{
		
		public function indexAction(){
			$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
			$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);


			$this->view->bars = Klub::find();
		}

		public function followAction($id){
			if($this->session->has("id")){
				$var = new Pretplata();

				$var->save(
					[
						"id_Korisnik" => $this->session->get("id"),
						"id_Klub" => $id,
						"notifikacije" =>0					]
				);
			}

			$this->view->disable();
			$this->response->redirect("index");
				
		}

		public function unfollowAction($id){
			if($this->session->has("id")){
				$var = new Pretplata();
				$val = $var->find(
					[
						"id_Korisnik" => $this->session->get("id"),
						"id_Klub" => $id,
					]
				);

				$val->delete();
				
			}

			// $this->view->disable();
			// $this->response->redirect("index");
				
		}


	}

?>