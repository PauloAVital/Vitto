<?php

namespace Vital\Controller;

use Vital\Models\Model;
use Vital\Views\View;
use Vital\Models\FunctionsQuery;

class ClientesController
{
    private $funcoes;
    private $table = 'usuario';
    public $campos = [];

    public function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
        $this->funcoes = new FunctionsQuery();
    }

    public function getCadastro()
    {
        $this->model->render($this->view->getLink('cliente\index'));
    }

    public function listar()
    {
        $this->model->render($this->view->getLink('cliente\list'));
    }

    public function listarClientes()
    {
        return $this->funcoes->consulta($this->table);
    }

    public function atuCliente()
    {
        #echo $_GET['id'];
        #die();
        #$dados = ['id' => $_GET['id']];
        $dados = $this->funcoes->consulta($this->table, 'where id = '.$_GET['id']);
        $this->model->render($this->view->getLink('cliente\atualiza'));
        return $dados; //compact('dados');
    }

    public function salvar()
    {
        $erros = [];

        ($_POST['name'] != null) && (strlen($_POST['name'])>3) ? $this->campos['NAME'] = $_POST['name'] : $erros[] = 'Nome';
        ($_POST['email'] != null)  ? $this->campos['EMAIL'] = $_POST['email'] : $erros[] = 'E-mail';
        ($_POST['senha'] != null)  ? $this->campos['SENHA'] = $_POST['senha'] : $erros[] = 'Senha';
        ($_POST['saldo'] != null)  ? $this->campos['SALDO'] = str_replace(",", ".", $_POST['saldo']) : $erros[] = 'Saldo';

        if (count($erros) <= 0)
        {
            $this->funcoes->gravar($this->table, $this->campos);
            $this->model->render($this->view->redirect('listarCliente'));
        } else {
            $this->model->render($this->view->redirect('cliente'));
        }

    }

    public function atualizar()
    {
        $erros = [];

        ($_POST['id'] != null)  ? $this->campos['ID'] = $_POST['id'] : $erros[] = 'id';
        ($_POST['name'] != null) && (strlen($_POST['name'])>3) ? $this->campos['NAME'] = $_POST['name'] : $erros[] = 'Nome';
        ($_POST['email'] != null)  ? $this->campos['EMAIL'] = $_POST['email'] : $erros[] = 'E-mail';
        ($_POST['senha'] != null)  ? $this->campos['SENHA'] = $_POST['senha'] : $erros[] = 'Senha';

        if ($_POST['saldo'] != null) {
           $saldo =  str_replace(".", "", $_POST['saldo']);
           $saldo =  str_replace(",", ".", $saldo);
            $this->campos['SALDO'] = $saldo;
        } else {
            $erros[] = 'Saldo';
        }
        if (count($erros) <= 0)
        {
            $this->funcoes->update($this->table, $this->campos, $this->campos['ID']);
            $this->model->render($this->view->redirect('listarCliente'));
        } else {
            $this->model->render($this->view->redirect('cliente'));
        }

    }

    public function apagarCliente()
    {
        $this->funcoes->delete($this->table, 'id', $_GET['id']);
        $this->model->render($this->view->redirect('listarCliente'));
    }


}