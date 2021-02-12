<?php

namespace App\Controllers;

use IvansWeb\Controller\Action;

class FuncionariosController extends Action {

    //isso é um método
    public function indexAction() {
        $this->render("index");
    }

}
