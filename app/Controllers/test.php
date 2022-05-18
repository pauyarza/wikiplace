<?php

namespace App\Controllers;

class test extends BaseController
{
    public function index()
    {
        echo session()->is_admin;
    }
}
