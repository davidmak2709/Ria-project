<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Query\Builder as Builder;

class BarsController extends Controller
{
    public function indexAction(){
        /* Treba napraviti da se uzimaju samo oni klubovi kojima je logirani korisnik vlasnik */
        /* I selectat samo id i ime
            mozda paginacija a mozda ne
        */
        $this->view->bars = Klub::find([
            "limit" => 30
        ]);
    }

    public function addAction(){
        $this->assets->addJs("js/edit.js");
        $this->assets->addCss("css/barsAdd.css");
    }

    public function newBarAction(){
        $bar = new Klub();
        $builder = new Builder();
        $builder->from("Vlasnik");
        $builder->where("id_korisnik =". $this->session->get("id"));
        try{
            $values = $this->request->getPost();
            $values["id_Vlasnik"] = $builder->getQuery()->execute()->getFirst()->getIdVlasnik();
            $values["ocjena"] = 0;
            $bar->addKlub($values);

        } catch (Exception $e){
            echo $e->getMessage();
        }

        if ($this->request->hasFiles(true) == true) {
            mkdir("img/" . $bar->getIdKlub()  ."/", 0755);
            foreach ($this->request->getUploadedFiles() as $file) {
                $file->moveTo("img/". $bar->getIdKlub()."/".$file->getName());
            }
        }

        $this->response->redirect("/bars/index");
    }

    public function editAction($id){
        $this->assets->addCss("css/barsEdit.css");
        $this->assets->addJs("js/edit.js");
        $this->view->bar = Klub::findFirst($id);


    }

    public function updateAction($id){
        if($this->request->isPost()){
            $data = $this->request->getPost("bar");
            $imagesDelete = $this->request->getPost("delete");
            $imagesAdd = $this->request->getUploadedFiles("add");

            $bar = Klub::findFirst($id);
            $bar->save($data);


            if(!empty($imagesDelete)){
                foreach ($imagesDelete as $image){
                    unlink("img/".$bar->getIdKlub()."/".$image);
                }
            }
            var_dump($imagesAdd);

            if(!empty($imagesAdd)){
                if(!file_exists("img/".$bar->getIdKlub()."/")){
                    mkdir("img/" . $bar->getIdKlub()  ."/", 0755);
                }

                $cnt = count(scandir("img/" . $bar->getIdKlub()  ."/"))-2;

                foreach ($imagesAdd as $img){
                    if($cnt == 5) break;
                    $img->moveTo("img/".$bar->getIdKlub()."/".$img->getName());
                    $cnt++;
                }

            }

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