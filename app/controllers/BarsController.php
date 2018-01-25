<?php

use Phalcon\Mvc\Controller;

class BarsController extends Controller
{
    public function indexAction(){
        /* Treba napraviti da se uzimaju samo oni klubovi kojima je logirani korisnik vlasnik */
        /* I selectat samo id i ime */
        $this->view->bars = Klub::find([
            "limit" => 3
        ]);
    }

    public function editAction($id){
        $this->view->bar = Klub::findFirst($id);
    }
}