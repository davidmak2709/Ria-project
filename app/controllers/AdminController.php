<?php

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;


class AdminController extends Controller
{

    public function indexAction()
    {
    }

    public function klubAction()
    {
        $currentPage = $this->request->getQuery("page", "int");
        $this->view->page = $this->paginate("Klub", $currentPage);
    }

    public function dogadajAction()
    {
        $currentPage = $this->request->getQuery("page", "int");
        $this->view->page = $this->paginate("Dogadaj", $currentPage);
    }

    public function korisnikAction()
    {
        $currentPage = $this->request->getQuery("page", "int");
        $this->view->page = $this->paginate("Korisnik", $currentPage);
    }

    public function adminsAction()
    {
        $currentPage = $this->request->getQuery("page", "int");
        $this->view->page = $this->paginate("Admin", $currentPage);
    }

//za sve

    private function paginate($type, $page)
    {
        $builder = new Phalcon\Mvc\Model\Query\Builder();
        $builder->from($type);
        $paginator = new PaginatorQueryBuilder(
            [
                "builder" => $builder,
                "limit" => 5,
                "page" => $page,
            ]
        );

        return $paginator->getPaginate();
    }

//admin

    public function addAdminAction()
    {
        $val = new Admin();
        $val->save([
            'id_korisnik' => 81
        ]);
        $this->response->redirect("/admin/admins");

    }

    public function deleteAdminAction($id)
    {
        $val = Admin::findFirst($id);
        $val->delete();
        $this->response->redirect("/admin/admins");

    }

    public function updateAdminAction($id)
    {

        $val = Admin::findFirst($id);
        $val->save($this->request->getPost());
        $this->response->redirect("/admin/admins");


    }


//klub

    public function addKlubAction()
    {
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

    public function deleteKlubAction($id)
    {
        $val = Klub::findFirst($id);
        $val->delete();
        $this->response->redirect("/admin/klub");

    }

    public function updateKlubAction($id)
    {

        $val = Klub::findFirst($id);
        $val->save($this->request->getPost());
        $this->response->redirect("/admin/klub");


    }

//dogadaj

    public function addDogadajAction()
    {
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

    public function deleteDogadajAction($id)
    {
        $val = Dogadaj::findFirst($id);
        $val->delete();
        $this->response->redirect("/admin/dogadaj");

    }

    public function updateDogadajAction($id)
    {

        $val = Dogadaj::findFirst($id);
        $val->save($this->request->getPost());
        $this->response->redirect("/admin/dogadaj");


    }

//korisnik

    public function addKorisnikAction()
    {
        $val = new Korisnik();
        $val->save([
            'ime' => 'root',
            'password' => 'root',
            'email' => 'root@root.com'

        ]);
        $this->response->redirect("/admin/korisnik");

    }

    public function deleteKorisnikAction($id)
    {
        $val = Korisnik::findFirst($id);
        $val->delete();
        $this->response->redirect("/admin/korisnik");

    }

    public function updateKorisnikAction($id)
    {

        $val = Korisnik::findFirst($id);
        $val->save($this->request->getPost());
        $this->response->redirect("/admin/korisnik");

        //moguca primjena oblikovnog obrasca

    }
}

?>