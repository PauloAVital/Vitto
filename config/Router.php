<?php

namespace Vital\Configuration;

class Router
{
    private static $URI;
    private static $PARAMS;
    private static $PARAMS_URI;

    public function __construct()
    {
      #  echo '<pre>';
      #  echo 'Roteador iniciando'.PHP_EOL;
    }

    public function autoload()
    {
        self::$URI = $_SERVER['REQUEST_URI'];
        self::$PARAMS = explode('?', self::$URI);
        self::$PARAMS_URI = (isset(self::$PARAMS[1])) ? self::$PARAMS[1] : '';

        if (empty(self::$PARAMS = rtrim(self::$PARAMS[0], '/'))) {
            self::$PARAMS = '/';
        }

        $routes = [
            '/' => ['Vital\\Controller\\Main', 'principal'],
            '/confirmarCliente' => ['Vital\\Controller\\Main', 'verficaCliente'],
            '/confirmarValor' => ['Vital\\Controller\\Main', 'validaValor'],


            '/cliente' => ['Vital\\Controller\\ClientesController', 'getCadastro'],
            '/salvarCliente' => ['Vital\\Controller\\ClientesController', 'salvar'],
            '/listarCliente' => ['Vital\\Controller\\ClientesController', 'listar'],
            '/atualizarCliente' => ['Vital\\Controller\\ClientesController', 'atuCliente'],
            '/atualizaCliente' => ['Vital\\Controller\\ClientesController', 'atualizar'],
            '/apagaCliente' => ['Vital\\Controller\\ClientesController', 'apagarCliente'],

        ];


        if (isset($routes[self::$PARAMS])) {
            $controller = $routes[self::$PARAMS][0];
            $function = $routes[self::$PARAMS][1];

            if (class_exists($controller)) {
                $classe = new $controller;
                call_user_func_array([$classe, $function], []);
            }

        } else {
            echo 'Página não encontrada';
        }
    }

}