<?php

use Phalcon\Mvc\Controller;

class BarsController extends Controller
{
    public function indexAction(){
        /* Treba napraviti da se uzimaju samo oni klubovi kojima je logirani korisnik vlasnik */
        /* I selectat samo id i ime */
        $this->view->bars = Klub::find([
            "limit" => 20
        ]);
    }

    public function editAction($id){
        $this->assets->addCss("css/barsEdit.css");

        $this->view->bar = Klub::findFirst($id);


    }

    public function updateAction($id){
        if($this->request->isPost()){
            $data = $this->request->getPost();
            $bar = Klub::findFirst($id);

            $bar->save($data);
            $this->response->redirect("/bars/edit/".$bar->getIdKlub());
        }


    }

    public function deleteAction($id){
        $bar = Klub::findFirst($id);
        if($bar->delete()){
            $this->response->redirect("/bars");
        }
    }

}