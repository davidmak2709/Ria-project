<?php

use Phalcon\Mvc\Controller;

class UserController extends Controller
{
	public function indexAction(){
		$this->view->user=Korisnik::findFirst($this->session->id);
	}

	public function editAction(){
		$this->view->user=Korisnik::findFirst($this->session->id);
	}

	public function updateAction($id){
		if($this->request->isPost()){
			if($this->request->getPost("password")==NULL){
				$this->flashSession->error('Password field is empty!');
				return $this->response->redirect('/user/edit');
			}
			else{
				Korisnik::updateUser($id, $this->request->getPost(), $this->security->hash($this->request->getPost("password")));
				return $this->response->redirect("/user");
			}
		}
	}
}
