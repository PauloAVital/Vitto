<?php

namespace Vital\Models;

class Model
{
    public function getLink($str = 'index')
    {
        return include_once "../app/Views/".$str.".php";
    }
}