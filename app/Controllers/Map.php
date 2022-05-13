<?php

namespace App\Controllers;

class Map extends BaseController
{
    public function index()
    {
        echo view("!map.php");
    }
}
