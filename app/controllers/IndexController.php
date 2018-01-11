<?php

	use Phalcon\Mvc\Controller;
	use Phalcon\Paginator\Adapter\Model as PaginatorModel;

	class IndexController extends Controller{
		
		public function indexAction(){
			$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
			$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
			
			$this->request->getQuery("page", "int");
			$currentPage=(int)$_GET["page"];
			$klubovi=Klub::find();
			$paginator=new PaginatorModel(
				[
					"data"=>$klubovi,
					"limit"=>5,
					"page"=>$currentPage,
				]
			);
			$this->view->page=$paginator->getPaginate();
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
			return $this->response->redirect($_SERVER['HTTP_REFERER']);
				
		}

		public function unfollowAction($id){
			if($this->session->has("id")){
				$var = new Pretplata();
				$val = $var->find([
					"id_Korisnik = :name: AND id_Klub = :type:",
			        	
			        	"bind" =>[
			            	"name" => $this->session->get("id"),
			        	    "type" => $id,
			        	],
				]
				);

				$val->delete();
				
			}

			$this->view->disable();
			return $this->response->redirect($_SERVER['HTTP_REFERER']);
				
		}
	}

?>