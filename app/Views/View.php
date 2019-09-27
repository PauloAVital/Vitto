<?php

namespace Vital\Views;

class View
{
    public function getLink($str = 'index')
    {
        return include_once "../app/Views/".$str.".php";
    }

    public function redirect($str = '')
    {
        return header("Location: /".$str);
    }
}