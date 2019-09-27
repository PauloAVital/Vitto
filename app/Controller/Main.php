<?php
namespace Vital\Controller;

use Vital\Models\Model;
use Vital\Views\View;
use Vital\Models\FunctionsQuery;

class Main
{
    private $notas = [];
    private $model;
    private $view;
    private $func;
    private $table = 'usuario';
    private $campos = [];

    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
        $this->func = new FunctionsQuery();
    }

    public function principal()
    {
        $this->model->render($this->view->getLink('index'));
    }

    public function verficaCliente()
    {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
        $ret = $this->func->consulta($this->table, "where email = '".$email."' and senha = '".$senha."'");
        $this->model->render($this->view->getLink('index'));
        return $ret;
    }

    public function validaValor()
    {
        if (isset($_POST['valorSolicitado'])) {
            $valorSolicitado = str_replace(".", "", $_POST['valorSolicitado']);
            $valorSolicitado = str_replace(",", ".", $valorSolicitado );
            (float)$valorSolicitado = $valorSolicitado;
        } else {
            $valorSolicitado = 0.00;
        }

        (float)$saldo = isset($_POST['saldo']) ? $_POST['saldo'] : 0.00;

        if (($valorSolicitado >= 1) and ( $valorSolicitado <= 10000))
        {
            if ($saldo < $valorSolicitado ) {
                $erro = 'Valor solicitado maior que saldo disponível';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
                $ret = $this->func->consulta($this->table, "where email = '".$email."' and senha = '".$senha."'");
                $this->model->render($this->view->getLink('index'));
                return ['erro'=>$erro, $ret];

            } else {

                $restante = $saldo - $valorSolicitado;

                #tratando saldo do cliente
                if(isset($_POST['id']))
                {
                    $erros = [];

                    ($_POST['id'] != null)  ? $this->campos['ID'] = $_POST['id'] : $erros[] = 'id';
                    ($_POST['name'] != null)  ? $this->campos['NAME'] = $_POST['name'] : $erros[] = 'Nome';
                    ($_POST['email'] != null)  ? $this->campos['EMAIL'] = $_POST['email'] : $erros[] = 'E-mail';
                    ($_POST['senha'] != null)  ? $this->campos['SENHA'] = $_POST['senha'] : $erros[] = 'Senha';

                    $saldo =  str_replace(".", "", $restante);
                    $saldo =  str_replace(",", ".", $saldo);
                    $this->campos['SALDO'] = $saldo;
                    if (count($erros) <= 0) {
                        $this->func->update($this->table, $this->campos, $this->campos['ID']);
                    }
                    $ret = $this->func->consulta($this->table, "where email = '".$_POST['email']."' and senha = '".$_POST['senha']."'");
                    $this->model->render($this->view->getLink('index'));
                    return ['valor'=>$valorSolicitado, 'notas'=>$this->separaNotas($valorSolicitado)];
                }

            }
        }
    }

    public function separaNotas($valor)
    {
        while($valor >= 50){
            @$this->notas['50'] += 1;
            $valor = $valor-50;
        }

        while($valor>=10){
            @$this->notas['10'] += 1;
            $valor = $valor-10;
        }

        while($valor>=5){
            @$this->notas['5'] += 1;
            $valor = $valor-5;
        }

        while($valor>=1){
            @$this->notas['1'] += 1;
            $valor = $valor-1;
        }

        return $this->notas;

    }


}