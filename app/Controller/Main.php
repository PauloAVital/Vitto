<?php
namespace Vital\Controller;

use Vital\Models\Model;
use Vital\Views\View;
use Vital\Models\Conn;

class Main
{
    var $model;
    var $view;
    var $conn;
    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
        $this->conn = new Conn();
    }

    public function principal()
    {
        $this->conn;
        $this->view->render($this->model->getLink('index'));
    }

}