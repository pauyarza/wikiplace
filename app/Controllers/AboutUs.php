<?php

namespace App\Controllers;

class AboutUs extends BaseController
{
    private $viewData = [];
    public function __construct()
    {
        // Load session info to viewData
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $this->viewData["sessionData"] = $sessionData;
    }

    public function index()
    {
        return view("pages/about_us",$this->viewData);
    }
}
