<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $viewData = [];
    public function __construct()
    {
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $this->viewData["sessionData"] = $sessionData;
        
    }

    public function index()
    {
        return view("pages/index",$this->viewData);
    }
}
