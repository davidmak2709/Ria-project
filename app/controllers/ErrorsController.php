<?php

use Phalcon\Mvc\Controller;

class ErrorsController extends Controller
{

    public function indexAction()
    {

    }


    public function show404Action()
    {
        $this->response->redirect("errors");
    }

    public function show500Action()
    {
        echo "Error 500";
    }
}

?>