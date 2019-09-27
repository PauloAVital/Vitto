<?php
namespace Vital\Controller;

use Vital\Models\Model;
use Vital\Views\View;
use Vital\Models\FunctionsQuery;

class Main
{
    var $model;
    var $view;
    var $conn;
    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
        $this->conn = new FunctionsQuery();
    }

    public function principal()
    {
        #Apenas para testar o Banco.
        $ret = $this->conn->consulta('usuario');
        #print_r($ret[0]['name']);
        #print_r($ret);
        $this->model->render($this->view->getLink('index'));
    }

}